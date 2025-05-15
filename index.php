<!DOCTYPE html>
<html lang="sk"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Domovská Stránka</title>
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
            max-width: 840px; /* Align with container */
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
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .action-btn.primary-action {
            background-color: #198754; /* Zelená ako Start Test v teste */
            color: white;
        }
        .action-btn.primary-action:hover { background-color: #157347; }

        .action-btn.secondary-action {
            background-color: #6c757d; /* Sivá pre menej dôležité akcie */
            color: white;
        }
        .action-btn.secondary-action:hover { background-color: #5a6268; }

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
        }
        .action-btn.auth-btn {
            background-color: #0d6efd; /* Modrá pre login/register */
            color: white;
            min-width: 150px;
        }
        .action-btn.auth-btn:hover { background-color: #0b5ed7; }

        .developer-tests {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
        }
        .action-btn.dev-btn {
            background-color: #ffc107; /* Žltá ako Confirm v teste */
            color: #000;
        }
        .action-btn.dev-btn:hover { background-color: #e0a800; }

        #api-questions-output {
            display:none;
            background-color: #282c34; /* Tmavšie pozadie pre kód */
            color: #abb2bf; /* Svetlejší text pre kód */
            padding: 15px;
            border-radius: 4px;
            max-height: 300px;
            overflow-y: auto;
            margin-top:15px;
            text-align: left;
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace;
            font-size: 0.85em;
            white-space: pre-wrap; /* Zalomenie dlhých riadkov */
            word-break: break-all;
        }
        #api-questions-output.loading {
            color: #6c757d;
            font-style: italic;
        }

        footer.page-footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #6c757d;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<div class="top-bar">
    <button id="toggle-lang-btn" class="lang-btn">English</button>
</div>

<div class="container">
    <header class="page-header">
        <h1 id="main-title">Vitajte v Testovacej Aplikácii z Matematiky</h1>
        <p id="welcome-message" class="welcome-message">Otestujte si svoje vedomosti a pripravte sa na prijímacie skúšky alebo si len tak zopakujte učivo!</p>
    </header>

    <nav class="main-navigation">
        <a href="test.php" id="start-quiz-link" class="action-btn primary-action">Spustiť Nový Test</a>
        <a href="#" id="profile-link" class="action-btn secondary-action">Môj Profil (čoskoro)</a>
    </nav>

    <section class="user-actions">
        <h2 id="user-auth-title">Prihlásenie / Registrácia</h2>
        <div class="button-group">
            <button id="login-btn" class="action-btn auth-btn">Prihlásiť sa</button>
            <button id="register-btn" class="action-btn auth-btn">Zaregistrovať sa</button>
        </div>
    </section>

    <section class="developer-tests">
        <h3 id="dev-tools-title">Vývojárske Nástroje</h3>
        <button id="load-all-questions-btn" class="action-btn dev-btn">Načítať Všetky Otázky (API Test)</button>
        <pre id="api-questions-output"></pre>
    </section>

</div>
<footer class="page-footer">
    <p>&copy; <span id="current-year"></span> <span id="footer-team-name">WEBTE2</span></p>
</footer>

<script>
    // --- Globálne premenné a konštanty ---
    const currentYearEl = document.getElementById('current-year');
    const toggleLangBtn = document.getElementById('toggle-lang-btn');
    const apiBase = 'https://node53.webte.fei.stuba.sk/skuska/api/api.php?route='; // Použité pre API test
    let currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk'; // Odlišný kľúč pre homepage

    // --- UI Elementy pre preklad ---
    const pageTitleEl = document.getElementById('page-title');
    const mainTitleEl = document.getElementById('main-title');
    const welcomeMessageEl = document.getElementById('welcome-message');
    const startQuizLinkEl = document.getElementById('start-quiz-link');
    const profileLinkEl = document.getElementById('profile-link');
    const userAuthTitleEl = document.getElementById('user-auth-title');
    const loginBtnEl = document.getElementById('login-btn');
    const registerBtnEl = document.getElementById('register-btn');
    const devToolsTitleEl = document.getElementById('dev-tools-title');
    const loadAllQuestionsBtnEl = document.getElementById('load-all-questions-btn');
    const apiQuestionsOutputEl = document.getElementById('api-questions-output');
    const footerTeamNameEl = document.getElementById('footer-team-name');
    const footerRightsEl = document.getElementById('footer-rights');


    // PREKLADY
    const uiStrings = {
        sk: {
            pageTitle: "Domov - Testy z Matematiky",
            mainTitle: "Vitajte v Testovacej Aplikácii z Matematiky",
            welcomeMessage: "Otestujte si svoje vedomosti, pripravte sa na prijímacie skúšky alebo si len tak zopakujte učivo!",
            startQuizLink: "Spustiť Nový Test",
            profileLink: "Môj Profil (čoskoro)",
            userAuthTitle: "Prihlásenie / Registrácia",
            loginBtn: "Prihlásiť sa",
            registerBtn: "Zaregistrovať sa",
            devToolsTitle: "Vývojárske Nástroje",
            loadAllQuestionsBtn: "Načítať Všetky Otázky (API Test)",
            loadingData: "Načítavam dáta...",
            errorLoadingData: "Chyba pri načítaní dát.",
            noDataLoaded: "Žiadne dáta neboli načítané.",
            footerTeamName: "WEBTE2, Zdravím :)",
            footerRights: "Všetky práva vyhradené.",
            switchToEnglish: "English",
            switchToSlovak: "Slovenčina"
        },
        en: {
            pageTitle: "Home - Mathematics Tests",
            mainTitle: "Welcome to the Mathematics Test Application",
            welcomeMessage: "Test your knowledge, prepare for entrance exams, or just review the material!",
            startQuizLink: "Start New Test",
            profileLink: "My Profile (coming soon)",
            userAuthTitle: "Login / Registration",
            loginBtn: "Login",
            registerBtn: "Register",
            devToolsTitle: "Developer Tools",
            loadAllQuestionsBtn: "Load All Questions (API Test)",
            loadingData: "Loading data...",
            errorLoadingData: "Error loading data.",
            noDataLoaded: "No data was loaded.",
            footerTeamName: "WEBTE2, Hello :)",
            footerRights: "All rights reserved.",
            switchToEnglish: "English",
            switchToSlovak: "Slovak"
        }
    };

    function t(key) {
        return uiStrings[currentLanguage][key] || key;
    }

    function updateUIText() {
        document.documentElement.lang = currentLanguage;
        pageTitleEl.textContent = t('pageTitle');
        mainTitleEl.textContent = t('mainTitle');
        welcomeMessageEl.textContent = t('welcomeMessage');
        startQuizLinkEl.textContent = t('startQuizLink');
        profileLinkEl.textContent = t('profileLink');
        userAuthTitleEl.textContent = t('userAuthTitle');
        loginBtnEl.textContent = t('loginBtn');
        registerBtnEl.textContent = t('registerBtn');
        devToolsTitleEl.textContent = t('devToolsTitle');
        loadAllQuestionsBtnEl.textContent = t('loadAllQuestionsBtn');
        footerTeamNameEl.textContent = t('footerTeamName');
        footerRightsEl.textContent = t('footerRights');
        toggleLangBtn.textContent = currentLanguage === 'sk' ? t('switchToEnglish') : t('switchToSlovak');
    }

    // --- Event Listeners ---
    toggleLangBtn.addEventListener('click', () => {
        currentLanguage = currentLanguage === 'sk' ? 'en' : 'sk';
        localStorage.setItem('mathTestLanguageHomepage', currentLanguage);
        updateUIText();
    });

    loadAllQuestionsBtnEl.addEventListener('click', async () => {
        apiQuestionsOutputEl.style.display = 'block';
        apiQuestionsOutputEl.textContent = t('loadingData');
        apiQuestionsOutputEl.classList.add('loading');
        loadAllQuestionsBtnEl.disabled = true;

        try {
            const response = await fetch(apiBase + 'questions');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            apiQuestionsOutputEl.classList.remove('loading');
            apiQuestionsOutputEl.textContent = JSON.stringify(data, null, 2);
        } catch (error) {
            console.error("Error fetching questions:", error);
            apiQuestionsOutputEl.classList.remove('loading');
            apiQuestionsOutputEl.textContent = `<span class="math-inline">\{t\('errorLoadingData'\)\} \\n</span>{error.message}`;
        } finally {
            loadAllQuestionsBtnEl.disabled = false;
        }
    });

    // Placeholder pre budúce funkcie
    profileLinkEl.addEventListener('click', (e) => {
        e.preventDefault(); // Zastaví predvolenú akciu odkazu
        alert(currentLanguage === 'sk' ? 'Funkcia Profilu bude dostupná čoskoro!' : 'Profile functionality will be available soon!');
    });
    loginBtnEl.addEventListener('click', () => {
        alert(currentLanguage === 'sk' ? 'Funkcia Prihlásenia bude dostupná čoskoro!' : 'Login functionality will be available soon!');
    });
    registerBtnEl.addEventListener('click', () => {
        alert(currentLanguage === 'sk' ? 'Funkcia Registrácie bude dostupná čoskoro!' : 'Registration functionality will be available soon!');
    });


    // --- Inicializácia ---
    if (currentYearEl) {
        currentYearEl.textContent = new Date().getFullYear();
    }
    updateUIText(); // Preloží texty pri načítaní stránky

</script>
</body>
</html>