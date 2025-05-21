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
        <li class="nav-item" id="admin-link-li" style="display: none;"><a href="admin.php" id="admin-link" class="nav-link">Administrácia</a></li>

        <li class="nav-item" id="show-login-modal-btn-container"><button id="show-login-modal-btn" class="btn btn-primary">Prihlásiť sa</button></li>
        <li class="nav-item" id="show-register-modal-btn-container"><button id="show-register-modal-btn" class="btn btn-secondary">Zaregistrovať sa</button></li>

        <li class="nav-item" id="user-status-li" style="display: none; align-items: center;">
            <span id="user-greeting" style="margin-right: 10px; color: var(--text-color);"></span>
            <button id="logout-btn" class="btn btn-secondary"></button>
        </li>

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
                <input type="text" id="login-username" name="username" class="form-control" required autocomplete="username">
            </div>
            <div class="form-group">
                <label for="login-password" id="login-password-label">Heslo:</label>
                <input type="password" id="login-password" name="password" class="form-control" required autocomplete="current-password">
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
                <input type="text" id="register-username" name="username" class="form-control" required autocomplete="username">
            </div>
            <div class="form-group">
                <label for="register-password" id="register-password-label">Heslo:</label>
                <input type="password" id="register-password" name="password" class="form-control" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="register-password-confirm" id="register-password-confirm-label">Potvrdenie hesla:</label>
                <input type="password" id="register-password-confirm" name="password_confirm" class="form-control" required autocomplete="new-password">
            </div>
            <button type="submit" id="register-submit-btn" class="btn btn-primary">Zaregistrovať sa</button>
            <p id="register-message" class="form-message"></p>
        </form>
    </div>
</div>

<script>
    const currentYearEl = document.getElementById('current-year');
    const apiBase = 'https://node53.webte.fei.stuba.sk/skuska/api/api.php?route=';
    let currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk';

    const pageTitleEl = document.getElementById('page-title');
    const mainTitleEl = document.getElementById('main-title');
    const welcomeMessageEl = document.getElementById('welcome-message');
    const startQuizLinkEl = document.getElementById('start-quiz-link');
    const profileLinkEl = document.getElementById('profile-link');
    const manualLinkEl = document.getElementById('manual-link');
    const adminLinkLiEl = document.getElementById('admin-link-li');
    const adminLinkEl = document.getElementById('admin-link');

    const showLoginModalBtnEl = document.getElementById('show-login-modal-btn');
    const showRegisterModalBtnEl = document.getElementById('show-register-modal-btn');
    const showLoginModalBtnContainerEl = document.getElementById('show-login-modal-btn-container');
    const showRegisterModalBtnContainerEl = document.getElementById('show-register-modal-btn-container');

    const userStatusLiEl = document.getElementById('user-status-li');
    const userGreetingEl = document.getElementById('user-greeting');
    const logoutBtnEl = document.getElementById('logout-btn');

    const loginModal = document.getElementById('login-modal');
    const registerModal = document.getElementById('register-modal');
    const closeLoginModalBtn = document.getElementById('close-login-modal-btn');
    const closeRegisterModalBtn = document.getElementById('close-register-modal-btn');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const loginMessageEl = document.getElementById('login-message');
    const registerMessageEl = document.getElementById('register-message');

    const globalNotificationEl = document.getElementById('global-notification');
    const toggleLangBtn = document.getElementById('toggle-lang-btn');

    const footerTeamNameEl = document.getElementById('footer-team-name');
    const footerRightsEl = document.getElementById('footer-rights');

    // Tieto elementy nemusia byť na každej stránke, preto ich použitie bude podmienené
    const userAuthTitleEl = document.getElementById('user-auth-title');
    const devToolsTitleEl = document.getElementById('dev-tools-title');
    const loadAllQuestionsBtnEl = document.getElementById('load-all-questions-btn');
    // const apiQuestionsOutputEl = document.getElementById('api-questions-output'); // Ak sa používa

    const uiStrings = {
        sk: {
            pageTitle: "Domov - Testy z Matematiky", mainTitle: "Vitajte v Testovacej Aplikácii z Matematiky",
            welcomeMessage: "Otestujte si svoje vedomosti, pripravte sa na prijímacie skúšky alebo si len tak zopakujte učivo!",
            startQuizLink: "Spustiť Nový Test", profileLink: "Môj Profil", manualLink: "Manuál", adminLink: "Administrácia",
            loginBtnText: "Prihlásiť sa", registerBtnText: "Zaregistrovať sa",
            devToolsTitle: "Vývojárske Nástroje", loadAllQuestionsBtn: "Načítať Všetky Otázky (API Test)",
            loadingData: "Načítavam dáta...", errorLoadingData: "Chyba pri načítaní dát.", noDataLoaded: "Žiadne dáta neboli načítané.",
            footerTeamName: "WEBTE2", footerRights: "Všetky práva vyhradené.", switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            loginModalTitle: "Prihlásenie", registerModalTitle: "Registrácia", userAuthTitle: "Prihlásenie / Registrácia", usernameLabel: "Používateľské meno:",
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
            startQuizLink: "Start New Test", profileLink: "My Profile", manualLink: "Manual", adminLink: "Admin",
            loginBtnText: "Login", registerBtnText: "Register",
            devToolsTitle: "Developer Tools", loadAllQuestionsBtn: "Load All Questions (API Test)",
            loadingData: "Loading data...", errorLoadingData: "Error loading data.", noDataLoaded: "No data was loaded.",
            footerTeamName: "WEBTE2", footerRights: "All rights reserved.", switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            loginModalTitle: "Login", registerModalTitle: "Register", userAuthTitle: "Login / Registration", usernameLabel: "Username:",
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
        if (globalNotificationEl) {
            globalNotificationEl.textContent = message;
            globalNotificationEl.className = type;
            globalNotificationEl.style.display = 'block';
            setTimeout(() => {
                globalNotificationEl.style.display = 'none';
            }, duration);
        }
    }

    function updateUIText() {
        document.documentElement.lang = currentLanguage;
        if(pageTitleEl) pageTitleEl.textContent = t('pageTitle');
        if(mainTitleEl) mainTitleEl.textContent = t('mainTitle');
        if(welcomeMessageEl) welcomeMessageEl.textContent = t('welcomeMessage');
        if(startQuizLinkEl) startQuizLinkEl.textContent = t('startQuizLink');
        if(profileLinkEl) profileLinkEl.textContent = t('profileLink');
        if(manualLinkEl) manualLinkEl.textContent = t('manualLink');
        if(adminLinkEl) adminLinkEl.textContent = t('adminLink');

        if(showLoginModalBtnEl) showLoginModalBtnEl.textContent = t('loginBtnText');
        if(showRegisterModalBtnEl) showRegisterModalBtnEl.textContent = t('registerBtnText');

        if(footerTeamNameEl) footerTeamNameEl.textContent = t('footerTeamName');
        if(footerRightsEl) footerRightsEl.textContent = t('footerRights');
        if(toggleLangBtn) toggleLangBtn.textContent = currentLanguage === 'sk' ? t('switchToEnglish') : t('switchToSlovak');

        const loginTitleInModal = document.getElementById('login-modal-title');
        if (loginTitleInModal) loginTitleInModal.textContent = t('loginModalTitle');
        const loginUserLabel = document.getElementById('login-username-label');
        if (loginUserLabel) loginUserLabel.textContent = t('usernameLabel');
        const loginPassLabel = document.getElementById('login-password-label');
        if (loginPassLabel) loginPassLabel.textContent = t('passwordLabel');
        const loginSubmit = document.getElementById('login-submit-btn');
        if (loginSubmit) loginSubmit.textContent = t('loginSubmitBtn');

        const regTitleInModal = document.getElementById('register-modal-title');
        if (regTitleInModal) regTitleInModal.textContent = t('registerModalTitle');
        const regUserLabel = document.getElementById('register-username-label');
        if (regUserLabel) regUserLabel.textContent = t('usernameLabel');
        const regPassLabel = document.getElementById('register-password-label');
        if (regPassLabel) regPassLabel.textContent = t('passwordLabel');
        const regPassConfLabel = document.getElementById('register-password-confirm-label');
        if (regPassConfLabel) regPassConfLabel.textContent = t('passwordConfirmLabel');
        const regSubmit = document.getElementById('register-submit-btn');
        if (regSubmit) regSubmit.textContent = t('registerSubmitBtn');

        const storedUsername = localStorage.getItem('loggedInUsername');
        if (logoutBtnEl && userStatusLiEl && userStatusLiEl.style.display !== 'none') {
            logoutBtnEl.textContent = t('logoutBtn');
        }
        if (userGreetingEl && userStatusLiEl && userStatusLiEl.style.display !== 'none' && storedUsername) {
            userGreetingEl.textContent = `${t('loggedInAs')} ${storedUsername}`;
        }

        if (userAuthTitleEl) userAuthTitleEl.textContent = t('userAuthTitle');
        if (devToolsTitleEl) devToolsTitleEl.textContent = t('devToolsTitle');
        if (loadAllQuestionsBtnEl) loadAllQuestionsBtnEl.textContent = t('loadAllQuestionsBtn');
    }

    async function checkAdminStatus() {
        const token = localStorage.getItem('apiToken');
        if (!token) {
            if (adminLinkLiEl) adminLinkLiEl.style.display = 'none';
            return;
        }

        try {
            const response = await fetch(`${apiBase}is-admin`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });
            if (response.ok) {
                const data = await response.json();
                if (data.admin) {
                    if (adminLinkLiEl) adminLinkLiEl.style.display = 'list-item';
                } else {
                    if (adminLinkLiEl) adminLinkLiEl.style.display = 'none';
                }
            } else {
                console.error('Error checking admin status:', response.statusText);
                if (adminLinkLiEl) adminLinkLiEl.style.display = 'none';
            }
        } catch (error) {
            console.error('Failed to fetch admin status:', error);
            if (adminLinkLiEl) adminLinkLiEl.style.display = 'none';
        }
    }

    function updateUserStatusUI(isLoggedIn, username = '') {
        if (isLoggedIn) {
            if(showLoginModalBtnContainerEl) showLoginModalBtnContainerEl.style.display = 'none';
            if(showRegisterModalBtnContainerEl) showRegisterModalBtnContainerEl.style.display = 'none';
            if(userAuthTitleEl) userAuthTitleEl.style.display = 'none';

            if(userStatusLiEl) userStatusLiEl.style.display = 'flex';
            if(userGreetingEl) userGreetingEl.textContent = `${t('loggedInAs')} ${username}`;
            if(logoutBtnEl) logoutBtnEl.textContent = t('logoutBtn');

            if(profileLinkEl) {
                profileLinkEl.classList.remove('disabled-link');
                profileLinkEl.href = 'profile.php';
            }
            checkAdminStatus();
        } else {
            if(showLoginModalBtnContainerEl) showLoginModalBtnContainerEl.style.display = 'list-item';
            if(showRegisterModalBtnContainerEl) showRegisterModalBtnContainerEl.style.display = 'list-item';
            if(userAuthTitleEl) userAuthTitleEl.style.display = 'block';

            if(userStatusLiEl) userStatusLiEl.style.display = 'none';
            if(adminLinkLiEl) adminLinkLiEl.style.display = 'none';
            localStorage.removeItem('apiToken');
            localStorage.removeItem('loggedInUsername');
            localStorage.removeItem('userId');
            if(profileLinkEl) {
                profileLinkEl.classList.add('disabled-link');
                profileLinkEl.href = '#';
            }
        }
    }

    function openModal(modal) {
        if (modal) {
            modal.style.display = 'block';
            if(loginMessageEl) loginMessageEl.textContent = '';
            if(registerMessageEl) registerMessageEl.textContent = '';
            if(loginMessageEl) loginMessageEl.className = 'form-message';
            if(registerMessageEl) registerMessageEl.className = 'form-message';
            const firstInput = modal.querySelector('input[type="text"], input[type="password"]');
            if (firstInput) { firstInput.focus(); }
        }
    }
    function closeModal(modal) {
        if (modal) modal.style.display = 'none';
    }

    if(showLoginModalBtnEl) showLoginModalBtnEl.onclick = () => openModal(loginModal);
    if(showRegisterModalBtnEl) showRegisterModalBtnEl.onclick = () => openModal(registerModal);
    if(closeLoginModalBtn) closeLoginModalBtn.onclick = () => closeModal(loginModal);
    if(closeRegisterModalBtn) closeRegisterModalBtn.onclick = () => closeModal(registerModal);

    window.onclick = (event) => {
        if (event.target == loginModal) closeModal(loginModal);
        if (event.target == registerModal) closeModal(registerModal);
    }

    if(loginForm) {
        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            if(loginMessageEl) {
                loginMessageEl.textContent = t('loadingData');
                loginMessageEl.className = 'form-message';
            }
            const submitButton = loginForm.querySelector('button[type="submit"]');
            if(submitButton) submitButton.disabled = true;

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
                    if(loginMessageEl) {
                        loginMessageEl.textContent = t('loginSuccess');
                        loginMessageEl.classList.add('success');
                    }
                    if (data.message) { console.log("Login API message:", data.message); }

                    localStorage.setItem('apiToken', data.api_token);
                    localStorage.setItem('loggedInUsername', username);
                    if (data.user_id) { localStorage.setItem('userId', data.user_id); }
                    else { console.warn("API pre login nevrátilo user_id.");}

                    updateUserStatusUI(true, username);
                    setTimeout(() => {
                        closeModal(loginModal);
                        if(loginForm) loginForm.reset();
                    }, 1500);
                } else {
                    if(loginMessageEl) {
                        loginMessageEl.textContent = data.error || data.message || t('generalError');
                        loginMessageEl.classList.add('error');
                    }
                }
            } catch (error) {
                console.error('Login error:', error);
                if(loginMessageEl) {
                    loginMessageEl.textContent = t('generalError');
                    loginMessageEl.classList.add('error');
                }
            } finally {
                if(submitButton) submitButton.disabled = false;
            }
        });
    }

    if(registerForm) {
        registerForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            if(registerMessageEl) {
                registerMessageEl.textContent = t('loadingData');
                registerMessageEl.className = 'form-message';
            }
            const submitButton = registerForm.querySelector('button[type="submit"]');
            if(submitButton) submitButton.disabled = true;

            const username = registerForm.username.value;
            const password = registerForm.password.value;
            const passwordConfirm = registerForm.password_confirm.value;

            if (password !== passwordConfirm) {
                if(registerMessageEl) {
                    registerMessageEl.textContent = t('passwordMismatch');
                    registerMessageEl.classList.add('error');
                }
                if(submitButton) submitButton.disabled = false;
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

                if (response.ok && data.api_token && data.message === "Registrovaný") { // API vracia api_token pri registrácii podľa Auth.class.php
                    if(registerMessageEl) {
                        registerMessageEl.textContent = t('registrationSuccess');
                        registerMessageEl.classList.add('success');
                    }
                    setTimeout(() => {
                        closeModal(registerModal);
                        if(registerForm) registerForm.reset();
                    }, 2000);
                } else {
                    if(registerMessageEl) {
                        registerMessageEl.textContent = data.error || data.message || t('generalError');
                        registerMessageEl.classList.add('error');
                    }
                }
            } catch (error) {
                console.error('Registration error:', error);
                if(registerMessageEl) {
                    registerMessageEl.textContent = t('generalError');
                    registerMessageEl.classList.add('error');
                }
            } finally {
                if(submitButton) submitButton.disabled = false;
            }
        });
    }

    if(logoutBtnEl) {
        logoutBtnEl.addEventListener('click', () => {
            updateUserStatusUI(false);
            showGlobalNotification(t('logoutSuccess'), 'success');
        });
    }

    if (loadAllQuestionsBtnEl) {
        loadAllQuestionsBtnEl.addEventListener('click', async () => {
            const apiOutEl = document.getElementById('api-questions-output'); // Načítanie elementu tu
            if (apiOutEl) {
                apiOutEl.style.display = 'block';
                apiOutEl.textContent = t('loadingData');
                apiOutEl.className = 'loading'; // Predpokladám, že máte CSS pre .loading
            }
            loadAllQuestionsBtnEl.disabled = true;

            try {
                const response = await fetch(apiBase + 'questions');
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status} ${response.statusText}`);
                }
                const data = await response.json();
                if (apiOutEl) {
                    apiOutEl.className = ''; // Odstránenie .loading triedy
                    apiOutEl.textContent = JSON.stringify(data, null, 2);
                }
            } catch (error) {
                console.error("Error fetching questions:", error);
                if (apiOutEl) {
                    apiOutEl.className = 'error-msg'; // Predpokladám CSS pre .error-msg
                    apiOutEl.textContent = `${t('errorLoadingData')} \n${error.message}`;
                }
            } finally {
                loadAllQuestionsBtnEl.disabled = false;
            }
        });
    }


    if(profileLinkEl) {
        profileLinkEl.addEventListener('click', (e) => {
            const token = localStorage.getItem('apiToken');
            if (!token) {
                e.preventDefault();
                showGlobalNotification(t('profileNeedsLogin'), 'info');
            }
        });
    }

    if (toggleLangBtn) {
        toggleLangBtn.addEventListener('click', () => {
            currentLanguage = currentLanguage === 'sk' ? 'en' : 'sk';
            localStorage.setItem('mathTestLanguageHomepage', currentLanguage);
            updateUIText();
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
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
    });

</script>
</body>
</html>