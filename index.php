<!DOCTYPE html>
<html lang="sk"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Domovská Stránka - Testy z Matematiky</title>
    <link rel="stylesheet" href="theme.css">
    <script>
    // Apply theme immediately to prevent flash
    (function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark-theme');
        }
    })();
    </script>
    <script src="theme.js"></script>
</head>
<body>
<nav class="navbar">
    <a href="index.php" class="navbar-brand">Math Test</a>
    <ul class="navbar-nav">
        <li class="nav-item"><a href="profile.php" id="profile-link" class="nav-link">Môj Profil</a></li>
        <li class="nav-item"><a href="manual.php" id="manual-link" class="nav-link">Manuál</a></li>
        <li class="nav-item" id="show-login-modal-btn-container"><button id="show-login-modal-btn" class="btn btn-primary">Prihlásiť sa</button></li>
        <li class="nav-item" id="show-register-modal-btn-container"><button id="show-register-modal-btn" class="btn btn-secondary">Zaregistrovať sa</button></li>
        <li class="nav-item"><a href="test.php" id="start-quiz-link" class="btn btn-primary">Spustiť Nový Test</a></li>
        <li class="nav-item"><button id="toggle-lang-btn" class="btn btn-secondary">English</button></li>
        <li class="nav-item"><button id="toggle-theme-btn" class="theme-toggle">🌙</button></li>
    </ul>
</nav>

<div id="global-notification">Správa...</div>


<div class="container">
    <header class="page-header">
        <h1 id="main-title">Vitajte v Testovacej Aplikácii z Matematiky</h1>
        <p id="welcome-message" class="welcome-message">Otestujte si svoje vedomosti, pripravte sa na prijímacie skúšky alebo si len tak zopakujte učivo!</p>
    </header>
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
            <button type="submit" id="login-submit-btn" class="btn btn-primary">Prihlásiť sa</button>
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
            <button type="submit" id="register-submit-btn" class="btn btn-primary">Zaregistrovať sa</button>
            <p id="register-message" class="form-message"></p>
        </form>
    </div>
</div>

<script>
    const currentYearEl = document.getElementById('current-year');
    document.addEventListener('DOMContentLoaded', () => {
        // Get references to UI elements
        const toggleLangBtn = document.getElementById('toggle-lang-btn');
        
        // Language toggle event listener
        if (toggleLangBtn) {
            toggleLangBtn.addEventListener('click', () => {
                currentLanguage = currentLanguage === 'sk' ? 'en' : 'sk';
                localStorage.setItem('mathTestLanguageHomepage', currentLanguage);
                updateUIText();
            });
        } else {
            console.error('Language toggle button not found!');
        }
        
        // Initialize UI with current language
        updateUIText();
    });
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