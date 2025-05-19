<!DOCTYPE html>
<html lang="sk"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Domovská Stránka - Testy z Matematiky</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            background-color: #f4f7f6;
            color: #333;
            padding: 20px;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .top-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
            padding-right: 20px;
            width: 100%;
            max-width: 840px;
            margin-left: auto;
            margin-right: auto;
        }
        .lang-btn {
            padding: 8px 12px;
            border: 1px solid #ced4da;
            background-color: #fff;
            cursor: pointer;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .lang-btn:hover { background-color: #e9ecef; }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            flex-grow: 1;
        }
        header.page-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        header.page-header h1 {
            color: #343a40;
            margin-bottom: 10px;
            font-weight: 500;
            font-size: 2.2em;
        }
        .welcome-message {
            font-size: 1.1em;
            color: #6c757d;
            margin-bottom: 0;
        }

        nav.main-navigation {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
            align-items: center;
        }
        .action-btn {
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.05em;
            transition: background-color 0.2s ease, border-color 0.2s ease, transform 0.1s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            border: none;
            font-weight: 500;
            min-width: 220px;
        }
        .action-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .action-btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }
        .action-btn.primary-action {
            background-color: #198754;
            color: white;
        }
        .action-btn.primary-action:hover:not(:disabled) { background-color: #157347; }

        .action-btn.secondary-action {
            background-color: #6c757d;
            color: white;
        }

        .action-btn.tertiary-action {
            background-color: #395ad8;
            color: white;
        }

        .action-btn.secondary-action:hover:not(:disabled) { background-color: #5a6268; }
        .action-btn.secondary-action.disabled-link { /* Pre deaktivovaný profil link */
            opacity: 0.65;
            cursor: not-allowed;
            pointer-events: none;
        }

        .user-actions {
            text-align: center;
            margin-bottom: 30px;
        }
        .user-actions h2, .developer-tests h3 {
            font-weight: 500;
            color: #495057;
            margin-bottom: 15px;
            font-size: 1.4em;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .action-btn.auth-btn {
            background-color: #0d6efd;
            color: white;
            min-width: 150px;
        }
        .action-btn.auth-btn:hover:not(:disabled) { background-color: #0b5ed7; }

        .developer-tests {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
        }
        .action-btn.dev-btn {
            background-color: #ffc107;
            color: #000;
        }
        .action-btn.dev-btn:hover:not(:disabled) { background-color: #e0a800; }

        #api-questions-output {
            display:none;
            background-color: #282c34;
            color: #abb2bf;
            padding: 15px;
            border-radius: 4px;
            max-height: 300px;
            overflow-y: auto;
            margin-top:15px;
            text-align: left;
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace;
            font-size: 0.85em;
            white-space: pre-wrap;
            word-break: break-all;
        }
        #api-questions-output.loading, #api-questions-output.error-msg {
            color: #6c757d;
            font-style: italic;
            background-color: #f8f9fa;
            white-space: normal;
        }
        #api-questions-output.error-msg {
            color: #dc3545;
        }

        footer.page-footer {
            text-align: center;
            margin-top: auto; /* Posunie pätičku nadol, ak je málo obsahu */
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #6c757d;
            font-size: 0.9em;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 25px 30px;
            border: 1px solid #888;
            width: 90%;
            max-width: 450px;
            border-radius: 8px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
        }
        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal h3 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: 500;
            color: #343a40;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; margin-bottom: 6px; font-weight: 500;
            font-size: 0.95em; color: #495057;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%; padding: 10px; border: 1px solid #ced4da;
            border-radius: 4px; box-sizing: border-box; font-size: 1em;
        }
        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus {
            border-color: #80bdff; outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .form-message {
            margin-top: 15px; font-size: 0.9em;
            text-align: center; font-weight: 500;
        }
        .form-message.success { color: #198754; }
        .form-message.error { color: #dc3545; }
        .modal-content .action-btn { width: 100%; margin-top: 10px; }
        #user-status { color: #343a40; font-weight: 500; }
        #user-greeting { margin-right: 10px; }
        #logout-btn {
            min-width: auto !important; padding: 8px 15px !important;
            margin-left:10px !important; font-size: 0.95em !important;
            background-color: #dc3545 !important;
        }
        #logout-btn:hover:not(:disabled) { background-color: #c82333 !important; }
        /* Globálna notifikácia */
        #global-notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border-radius: 5px;
            z-index: 2000;
            display: none;
            font-size: 0.95em;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        #global-notification.success { background-color: #28a745; }
        #global-notification.error { background-color: #dc3545; }
        #global-notification.info { background-color: #0dcaf0; color: #000;}

    </style>
</head>
<body>
<div class="top-bar">
    <button id="toggle-lang-btn" class="lang-btn">English</button>
</div>

<div id="global-notification">Správa...</div>


<div class="container">
    <header class="page-header">
        <h1 id="main-title">Vitajte v Testovacej Aplikácii z Matematiky</h1>
        <p id="welcome-message" class="welcome-message">Otestujte si svoje vedomosti, pripravte sa na prijímacie skúšky alebo si len tak zopakujte učivo!</p>
    </header>

    <nav class="main-navigation">
        <a href="test.php" id="start-quiz-link" class="action-btn primary-action">Spustiť Nový Test</a>
        <a href="profile.php" id="profile-link" class="action-btn secondary-action">Môj Profil</a>
        <a href="manual.php" id="manual-link" class="action-btn tertiary-action">Manuál</a>
    </nav>

    <section class="user-actions">
        <h2 id="user-auth-title">Prihlásenie / Registrácia</h2>
        <div class="button-group">
            <button id="show-login-modal-btn" class="action-btn auth-btn">Prihlásiť sa</button>
            <button id="show-register-modal-btn" class="action-btn auth-btn">Zaregistrovať sa</button>
        </div>
        <div id="user-status" style="display: none; margin-top: 20px; padding: 10px; background-color: #e9ecef; border-radius: 4px;">
            <span id="user-greeting"></span>
            <button id="logout-btn" class="action-btn">Odhlásiť sa</button>
        </div>
    </section>

    <section class="developer-tests">
        <h3 id="dev-tools-title">Vývojárske Nástroje</h3>
        <button id="load-all-questions-btn" class="action-btn dev-btn">Načítať Všetky Otázky (API Test)</button>
        <pre id="api-questions-output"></pre>
    </section>
</div>
<footer class="page-footer">
    <p>&copy; <span id="current-year"></span> <span id="footer-team-name">WEBTE2</span>. <span id="footer-rights">Všetky práva vyhradené.</span></p>
</footer>

<div id="login-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="close-login-modal-btn">&times;</span>
        <h3 id="login-modal-title">Prihlásenie</h3>
        <form id="login-form">
            <div class="form-group">
                <label for="login-username" id="login-username-label">Používateľské meno:</label>
                <input type="text" id="login-username" name="username" required autocomplete="username">
            </div>
            <div class="form-group">
                <label for="login-password" id="login-password-label">Heslo:</label>
                <input type="password" id="login-password" name="password" required autocomplete="current-password">
            </div>
            <button type="submit" id="login-submit-btn" class="action-btn primary-action">Prihlásiť sa</button>
            <p id="login-message" class="form-message"></p>
        </form>
    </div>
</div>

<div id="register-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="close-register-modal-btn">&times;</span>
        <h3 id="register-modal-title">Registrácia</h3>
        <form id="register-form">
            <div class="form-group">
                <label for="register-username" id="register-username-label">Používateľské meno:</label>
                <input type="text" id="register-username" name="username" required autocomplete="username">
            </div>
            <div class="form-group">
                <label for="register-password" id="register-password-label">Heslo:</label>
                <input type="password" id="register-password" name="password" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="register-password-confirm" id="register-password-confirm-label">Potvrdenie hesla:</label>
                <input type="password" id="register-password-confirm" name="password_confirm" required autocomplete="new-password">
            </div>
            <button type="submit" id="register-submit-btn" class="action-btn primary-action">Zaregistrovať sa</button>
            <p id="register-message" class="form-message"></p>
        </form>
    </div>
</div>

<script>
    const currentYearEl = document.getElementById('current-year');
    const toggleLangBtn = document.getElementById('toggle-lang-btn');
    const apiBase = 'https://node53.webte.fei.stuba.sk/skuska/api/api.php?route=';
    let currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk';

    const pageTitleEl = document.getElementById('page-title');
    const mainTitleEl = document.getElementById('main-title');
    const welcomeMessageEl = document.getElementById('welcome-message');
    const startQuizLinkEl = document.getElementById('start-quiz-link');
    const profileLinkEl = document.getElementById('profile-link');
    const manualLinkEl = document.getElementById('manual-link');
    const userAuthTitleEl = document.getElementById('user-auth-title');
    const showLoginModalBtnEl = document.getElementById('show-login-modal-btn');
    const showRegisterModalBtnEl = document.getElementById('show-register-modal-btn');
    const devToolsTitleEl = document.getElementById('dev-tools-title');
    const loadAllQuestionsBtnEl = document.getElementById('load-all-questions-btn');
    const apiQuestionsOutputEl = document.getElementById('api-questions-output');
    const footerTeamNameEl = document.getElementById('footer-team-name');
    const footerRightsEl = document.getElementById('footer-rights');

    const loginModal = document.getElementById('login-modal');
    const registerModal = document.getElementById('register-modal');
    const closeLoginModalBtn = document.getElementById('close-login-modal-btn');
    const closeRegisterModalBtn = document.getElementById('close-register-modal-btn');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const loginMessageEl = document.getElementById('login-message');
    const registerMessageEl = document.getElementById('register-message');
    const userStatusEl = document.getElementById('user-status');
    const userGreetingEl = document.getElementById('user-greeting');
    const logoutBtnEl = document.getElementById('logout-btn');
    const globalNotificationEl = document.getElementById('global-notification');


    const uiStrings = {
        sk: {
            pageTitle: "Domov - Testy z Matematiky", mainTitle: "Vitajte v Testovacej Aplikácii z Matematiky",
            welcomeMessage: "Otestujte si svoje vedomosti, pripravte sa na prijímacie skúšky alebo si len tak zopakujte učivo!",
            startQuizLink: "Spustiť Nový Test", profileLink: "Môj Profil", userAuthTitle: "Prihlásenie / Registrácia",
            loginBtn: "Prihlásiť sa", registerBtn: "Zaregistrovať sa", devToolsTitle: "Vývojárske Nástroje",
            loadAllQuestionsBtn: "Načítať Všetky Otázky (API Test)", loadingData: "Načítavam dáta...",
            errorLoadingData: "Chyba pri načítaní dát.", noDataLoaded: "Žiadne dáta neboli načítané.",
            footerTeamName: "WEBTE2", footerRights: "Všetky práva vyhradené.", switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            loginModalTitle: "Prihlásenie", registerModalTitle: "Registrácia", manualLink: "Manuál", usernameLabel: "Používateľské meno:",
            passwordLabel: "Heslo:", passwordConfirmLabel: "Potvrdenie hesla:", loginSubmitBtn: "Prihlásiť sa",
            registerSubmitBtn: "Zaregistrovať sa", registrationSuccess: "Registrácia úspešná! Môžete sa prihlásiť.",
            loginSuccess: "Prihlásenie úspešné!", generalError: "Vyskytla sa chyba. Skúste znova.",
            passwordMismatch: "Heslá sa nezhodujú.", logoutBtn: "Odhlásiť sa", loggedInAs: "Prihlásený ako:",
            profileNeedsLogin: "Pre zobrazenie profilu sa musíte prihlásiť.",
            logoutSuccess: "Boli ste úspešne odhlásený."
        },
        en: {
            pageTitle: "Home - Mathematics Tests", mainTitle: "Welcome to the Mathematics Test Application",
            welcomeMessage: "Test your knowledge, prepare for entrance exams, or just review the material!",
            startQuizLink: "Start New Test", profileLink: "My Profile", manualLink: "Manual", userAuthTitle: "Login / Registration",
            loginBtn: "Login", registerBtn: "Register", devToolsTitle: "Developer Tools",
            loadAllQuestionsBtn: "Load All Questions (API Test)", loadingData: "Loading data...",
            errorLoadingData: "Error loading data.", noDataLoaded: "No data was loaded.",
            footerTeamName: "WEBTE2", footerRights: "All rights reserved.", switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            loginModalTitle: "Login", registerModalTitle: "Register", usernameLabel: "Username:",
            passwordLabel: "Password:", passwordConfirmLabel: "Confirm Password:", loginSubmitBtn: "Login",
            registerSubmitBtn: "Register", registrationSuccess: "Registration successful! You can now log in.",
            loginSuccess: "Login successful!", generalError: "An error occurred. Please try again.",
            passwordMismatch: "Passwords do not match.", logoutBtn: "Logout", loggedInAs: "Logged in as:",
            profileNeedsLogin: "You need to be logged in to view your profile.",
            logoutSuccess: "You have been successfully logged out."
        }
    };

    function t(key) { return uiStrings[currentLanguage][key] || key; }

    function showGlobalNotification(message, type = 'info', duration = 3000) {
        globalNotificationEl.textContent = message;
        globalNotificationEl.className = type; // success, error, info
        globalNotificationEl.style.display = 'block';
        setTimeout(() => {
            globalNotificationEl.style.display = 'none';
        }, duration);
    }

    function updateUIText() {
        document.documentElement.lang = currentLanguage;
        pageTitleEl.textContent = t('pageTitle');
        mainTitleEl.textContent = t('mainTitle');
        welcomeMessageEl.textContent = t('welcomeMessage');
        startQuizLinkEl.textContent = t('startQuizLink');
        profileLinkEl.textContent = t('profileLink');
        manualLinkEl.textContent = t('manualLink');
        userAuthTitleEl.textContent = t('userAuthTitle');
        showLoginModalBtnEl.textContent = t('loginBtn');
        showRegisterModalBtnEl.textContent = t('registerBtn');
        devToolsTitleEl.textContent = t('devToolsTitle');
        loadAllQuestionsBtnEl.textContent = t('loadAllQuestionsBtn');
        footerTeamNameEl.textContent = t('footerTeamName');
        footerRightsEl.textContent = t('footerRights');
        toggleLangBtn.textContent = currentLanguage === 'sk' ? t('switchToEnglish') : t('switchToSlovak');

        document.getElementById('login-modal-title').textContent = t('loginModalTitle');
        document.getElementById('login-username-label').textContent = t('usernameLabel');
        document.getElementById('login-password-label').textContent = t('passwordLabel');
        document.getElementById('login-submit-btn').textContent = t('loginSubmitBtn');
        document.getElementById('register-modal-title').textContent = t('registerModalTitle');
        document.getElementById('register-username-label').textContent = t('usernameLabel');
        document.getElementById('register-password-label').textContent = t('passwordLabel');
        document.getElementById('register-password-confirm-label').textContent = t('passwordConfirmLabel');
        document.getElementById('register-submit-btn').textContent = t('registerSubmitBtn');
        logoutBtnEl.textContent = t('logoutBtn');
        const storedUsername = localStorage.getItem('loggedInUsername');
        if (userStatusEl.style.display !== 'none' && storedUsername) {
            userGreetingEl.textContent = `${t('loggedInAs')} ${storedUsername}`;
        }
    }

    function openModal(modal) {
        modal.style.display = 'block';
        loginMessageEl.textContent = '';
        registerMessageEl.textContent = '';
        loginMessageEl.className = 'form-message';
        registerMessageEl.className = 'form-message';
        const firstInput = modal.querySelector('input[type="text"], input[type="password"]');
        if (firstInput) { firstInput.focus(); }
    }
    function closeModal(modal) { modal.style.display = 'none'; }

    showLoginModalBtnEl.onclick = () => openModal(loginModal);
    showRegisterModalBtnEl.onclick = () => openModal(registerModal);
    closeLoginModalBtn.onclick = () => closeModal(loginModal);
    closeRegisterModalBtn.onclick = () => closeModal(registerModal);

    window.onclick = (event) => {
        if (event.target == loginModal) closeModal(loginModal);
        if (event.target == registerModal) closeModal(registerModal);
    }

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        loginMessageEl.textContent = t('loadingData');
        loginMessageEl.className = 'form-message';
        const submitButton = loginForm.querySelector('button[type="submit"]');
        submitButton.disabled = true;

        const username = loginForm.username.value;
        const password = loginForm.password.value;
        const loginApiUrl = apiBase + 'login';

        try {
            const response = await fetch(loginApiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password })
            });
            const data = await response.json();

            if (response.ok && data.api_token) {
                loginMessageEl.textContent = t('loginSuccess') + (data.message ? ` (${data.message})` : '');
                loginMessageEl.classList.add('success');
                localStorage.setItem('apiToken', data.api_token);
                localStorage.setItem('loggedInUsername', username);
                // Predpokladáme, že API vráti aj user_id, ak nie, toto pole bude prázdne
                if (data.user_id) { localStorage.setItem('userId', data.user_id); }
                else { console.warn("API pre login nevrátilo user_id.");}

                updateUserStatusUI(true, username);
                setTimeout(() => {
                    closeModal(loginModal);
                    loginForm.reset();
                }, 1500);
            } else {
                loginMessageEl.textContent = data.error || data.message || t('generalError');
                loginMessageEl.classList.add('error');
            }
        } catch (error) {
            console.error('Login error:', error);
            loginMessageEl.textContent = t('generalError');
            loginMessageEl.classList.add('error');
        } finally {
            submitButton.disabled = false;
        }
    });

    registerForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        registerMessageEl.textContent = t('loadingData');
        registerMessageEl.className = 'form-message';
        const submitButton = registerForm.querySelector('button[type="submit"]');
        submitButton.disabled = true;

        const username = registerForm.username.value;
        const password = registerForm.password.value;
        const passwordConfirm = registerForm.password_confirm.value;

        if (password !== passwordConfirm) {
            registerMessageEl.textContent = t('passwordMismatch');
            registerMessageEl.classList.add('error');
            submitButton.disabled = false;
            return;
        }

        const registerApiUrl = apiBase + 'register';

        try {
            const response = await fetch(registerApiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password })
            });
            const data = await response.json();

            if (response.ok && data.api_token && data.message === "Registrovaný") {
                registerMessageEl.textContent = t('registrationSuccess');
                registerMessageEl.classList.add('success');
                setTimeout(() => {
                    closeModal(registerModal);
                    registerForm.reset();
                }, 2000);
            } else {
                registerMessageEl.textContent = data.error || data.message || t('generalError');
                registerMessageEl.classList.add('error');
            }
        } catch (error) {
            console.error('Registration error:', error);
            registerMessageEl.textContent = t('generalError');
            registerMessageEl.classList.add('error');
        } finally {
            submitButton.disabled = false;
        }
    });

    function updateUserStatusUI(isLoggedIn, username = '') {
        if (isLoggedIn) {
            showLoginModalBtnEl.style.display = 'none';
            showRegisterModalBtnEl.style.display = 'none';
            userAuthTitleEl.style.display = 'none'; // Skryjeme aj titulok "Prihlásenie / Registrácia"
            userStatusEl.style.display = 'block';
            userGreetingEl.textContent = `${t('loggedInAs')} ${username}`;
            logoutBtnEl.textContent = t('logoutBtn');
            profileLinkEl.classList.remove('disabled-link'); // Aktivujeme profil link
            profileLinkEl.href = 'profile.php';
        } else {
            showLoginModalBtnEl.style.display = 'inline-block';
            showRegisterModalBtnEl.style.display = 'inline-block';
            userAuthTitleEl.style.display = 'block'; // Zobrazíme titulok
            userStatusEl.style.display = 'none';
            localStorage.removeItem('apiToken');
            localStorage.removeItem('loggedInUsername');
            localStorage.removeItem('userId'); // Odstránime aj userId
            profileLinkEl.classList.add('disabled-link');
            profileLinkEl.href = '#';
        }
    }

    logoutBtnEl.addEventListener('click', () => {
        updateUserStatusUI(false);
        showGlobalNotification(t('logoutSuccess'), 'success');
    });

    loadAllQuestionsBtnEl.addEventListener('click', async () => {
        apiQuestionsOutputEl.style.display = 'block';
        apiQuestionsOutputEl.textContent = t('loadingData');
        apiQuestionsOutputEl.className = 'loading';
        loadAllQuestionsBtnEl.disabled = true;

        try {
            const response = await fetch(apiBase + 'questions');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status} ${response.statusText}`);
            }
            const data = await response.json();
            apiQuestionsOutputEl.className = '';
            apiQuestionsOutputEl.textContent = JSON.stringify(data, null, 2);
        } catch (error) {
            console.error("Error fetching questions:", error);
            apiQuestionsOutputEl.className = 'error-msg';
            apiQuestionsOutputEl.textContent = `${t('errorLoadingData')} \n${error.message}`;
        } finally {
            loadAllQuestionsBtnEl.disabled = false;
        }
    });

    profileLinkEl.addEventListener('click', (e) => {
        const token = localStorage.getItem('apiToken');
        if (!token) {
            e.preventDefault();
            showGlobalNotification(t('profileNeedsLogin'), 'info');
        }
        // Ak je token, odkaz normálne presmeruje na profil.html
    });

    toggleLangBtn.addEventListener('click', () => {
        // Toggle between 'sk' and 'en'
        currentLanguage = currentLanguage === 'sk' ? 'en' : 'sk';

        // Save the selected language to localStorage
        localStorage.setItem('mathTestLanguageHomepage', currentLanguage);

        // Update the UI text with the new language
        updateUIText();
    });

    // Inicializácia
    if (currentYearEl) {
        currentYearEl.textContent = new Date().getFullYear();
    }

    const storedToken = localStorage.getItem('apiToken');
    const storedUsername = localStorage.getItem('loggedInUsername');
    if (storedToken && storedUsername) {
        updateUserStatusUI(true, storedUsername);
    } else {
        updateUserStatusUI(false);
    }
    updateUIText();

</script>
</body>
</html>