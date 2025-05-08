<?php
/**
 * @OA\Schema(
 *     schema="User",
 *     required={"username", "password"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="username", type="string", example="student1"),
 *     @OA\Property(property="password", type="string", example="tajneheslo"),
 *     @OA\Property(property="api_token", type="string", example="d87a01b29c...")
 * )
 */
class Auth {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
/**
 * @OA\Post(
 *     path="/register.php",
 *     summary="Registrácia používateľa",
 *     tags={"Autentifikácia"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"username", "password"},
 *             @OA\Property(property="username", type="string", example="student1"),
 *             @OA\Property(property="password", type="string", example="tajneheslo")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registrovaný",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Registrovaný"),
 *             @OA\Property(property="api_token", type="string", example="abc123token")
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Používateľ už existuje"
 *     )
 * )
 */
    public function register($username, $password) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = :u");
        $stmt->execute([':u' => $username]);
        if ($stmt->fetch()) {
            return ["error" => "Používateľ už existuje"];
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(32));

        $stmt = $this->db->prepare("INSERT INTO users (username, password, api_token) VALUES (:u, :p, :t)");
        $stmt->execute([':u' => $username, ':p' => $hashed, ':t' => $token]);

        return ["message" => "Registrovaný", "api_token" => $token];
    }
/**
 * @OA\Post(
 *     path="/login.php",
 *     summary="Prihlásenie používateľa",
 *     tags={"Autentifikácia"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"username", "password"},
 *             @OA\Property(property="username", type="string", example="student1"),
 *             @OA\Property(property="password", type="string", example="tajneheslo")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Prihlásený",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Prihlásený"),
 *             @OA\Property(property="api_token", type="string", example="abc123token")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Zlé meno alebo heslo"
 *     )
 * )
 */
    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT id, password, api_token FROM users WHERE username = :u");
        $stmt->execute([':u' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            return ["error" => "Zlé meno alebo heslo"];
        }

        return ["message" => "Prihlásený", "api_token" => $user['api_token']];
    }
/**
 * @OA\Post(
 *     path="/token/refresh",
 *     summary="Znovuvygenerovanie API tokenu",
 *     tags={"Autentifikácia"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Nový token",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Token aktualizovaný"),
 *             @OA\Property(property="api_token", type="string", example="novyTokenABC123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Neautorizovaný"
 *     )
 * )
 */
    public function regenerateToken($api_token) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE api_token = :t");
        $stmt->execute([':t' => $api_token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return ["error" => "Neplatný token"];
        }

        $newToken = bin2hex(random_bytes(32));
        $stmt = $this->db->prepare("UPDATE users SET api_token = :nt WHERE id = :id");
        $stmt->execute([':nt' => $newToken, ':id' => $user['id']]);

        return ["message" => "Token aktualizovaný", "api_token" => $newToken];
    }

    public function authenticate($headers) {
        if (!isset($headers['Authorization'])) {
            return false;
        }

        $token = trim(str_replace("Bearer", "", $headers['Authorization']));
        $stmt = $this->db->prepare("SELECT id FROM users WHERE api_token = :token");
        $stmt->execute([':token' => $token]);

        return $stmt->fetchColumn() ?: false;
    }
}
