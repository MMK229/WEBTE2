<?php
/**
 * @OA\Schema(
 *     schema="Question",
 *     required={"area", "text_sk", "text_en", "correct_answer"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="area", type="string", example="Matematika"),
 *     @OA\Property(property="text_sk", type="string", example="Koľko je 2+2?"),
 *     @OA\Property(property="text_en", type="string", example="What is 2+2?"),
 *     @OA\Property(property="correct_answer", type="string", example="4")
 * )
 */
class Test {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * @OA\Get(
     *     path="/skuska/api/api.php",
     *     summary="Získať všetky otázky",
     *     operationId="getAllQuestions",
     *     tags={"Test"},
     *     @OA\Parameter(
     *         name="route",
     *         in="query",
     *         required=true,
     *         description="Musí byť 'questions'",
     *         @OA\Schema(type="string", example="questions")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zoznam otázok",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Question"))
     *     )
     * )
     */
    public function getAllQuestions() {
        $stmt = $this->db->prepare("SELECT * FROM questions");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @OA\Get(
     *     path="/skuska/api/api.php",
     *     summary="Získať otázku podľa ID",
     *     operationId="getQuestionById",
     *     tags={"Test"},
     *     @OA\Parameter(
     *         name="route",
     *         in="query",
     *         required=true,
     *         description="Musí byť 'questions/{id}'",
     *         @OA\Schema(type="string", example="questions/1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail otázky",
     *         @OA\JsonContent(ref="#/components/schemas/Question")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Otázka neexistuje"
     *     )
     * )
     */
    public function getQuestion($id) {
        $stmt = $this->db->prepare("SELECT * FROM questions WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @OA\Post(
     *     path="/skuska/api/api.php",
     *     summary="Spustiť nový test",
     *     operationId="startTest",
     *     tags={"Test"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="route",
     *         in="query",
     *         required=true,
     *         description="Musí byť 'tests/start'",
     *         @OA\Schema(type="string", example="tests/start")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "city", "country"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="city", type="string", example="Bratislava"),
     *             @OA\Property(property="country", type="string", example="Slovensko")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Test vytvorený",
     *         @OA\JsonContent(
     *             @OA\Property(property="test_id", type="integer", example=42)
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Chýbajúce dáta"
     *     )
     * )
     */
    public function startTest($userId, $city, $country) {
        $stmt = $this->db->prepare("INSERT INTO tests (user_id, datetime, city, country) VALUES (:user_id, NOW(), :city, :country)");
        $stmt->execute([
            ':user_id' => $userId,
            ':city' => $city,
            ':country' => $country
        ]);
        $testId = $this->db->lastInsertId();
        return ['test_id' => $testId];
    }


    /**
     * @OA\Post(
     *     path="/skuska/api/api.php",
     *     summary="Uložiť odpoveď k jednej otázke",
     *     operationId="storeAnswer",
     *     tags={"Test"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="route",
     *         in="query",
     *         required=true,
     *         description="Musí byť 'tests/answer'",
     *         @OA\Schema(type="string", example="tests/answer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"test_id", "question_id", "answered_correctly", "time_taken"},
     *             @OA\Property(property="test_id", type="integer", example=42),
     *             @OA\Property(property="question_id", type="integer", example=5),
     *             @OA\Property(property="answered_correctly", type="boolean", example=true),
     *             @OA\Property(property="time_taken", type="number", format="float", example=3.2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Odpoveď uložená",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Odpoveď uložená")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Neplatné dáta"
     *     )
     * )
     */
    public function storeAnswer($testId, $questionId, $correct, $time) {
        $stmt = $this->db->prepare("
            INSERT INTO test_questions (test_id, question_id, answered_correctly, time_taken)
            VALUES (:test_id, :question_id, :correct, :time)
        ");
        $stmt->execute([
            ':test_id' => $testId,
            ':question_id' => $questionId,
            ':correct' => $correct ? 1 : 0,
            ':time' => $time
        ]);
        return ['message' => 'Odpoveď uložená'];
    }


    /**
     * @OA\Get(
     *     path="/skuska/api/api.php",
     *     summary="Získať výsledok testu podľa ID",
     *     operationId="getTestResult",
     *     tags={"Test"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="route",
     *         in="query",
     *         required=true,
     *         description="Musí byť 'tests/{id}'",
     *         @OA\Schema(type="string", example="tests/5")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Výsledky testu",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="area", type="string", example="Matematika"),
     *                 @OA\Property(property="text_sk", type="string", example="Koľko je 2+2?"),
     *                 @OA\Property(property="answered_correctly", type="boolean", example=true),
     *                 @OA\Property(property="time_taken", type="number", format="float", example=4.2)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Neautorizovaný prístup"
     *     )
     * )
     */
    public function getTestResult($testId) {
        $stmt = $this->db->prepare("
            SELECT q.area, q.text_sk, tq.answered_correctly, tq.time_taken
            FROM test_questions tq
            JOIN questions q ON tq.question_id = q.id
            WHERE tq.test_id = :id
        ");
        $stmt->execute([':id' => $testId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUserTestsWithQuestions($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM tests WHERE user_id = :id ORDER BY datetime DESC");
        $stmt->execute([':id' => $user_id]);
        $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tests as &$test) {
            $test_id = $test['id'];
            $qstmt = $this->db->prepare("
                SELECT tq.question_id, q.area, q.text_sk, q.text_en, tq.answered_correctly, tq.time_taken
                FROM test_questions tq
                JOIN questions q ON tq.question_id = q.id
                WHERE tq.test_id = :test_id
            ");
            $qstmt->execute([':test_id' => $test_id]);
            $test['questions'] = $qstmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $tests;
    }

}


