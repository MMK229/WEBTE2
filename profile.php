<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title-profile">Môj Profil</title>
    <style>
        /* Použijeme podobné štýly ako v index.html a student_test.html */
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; margin: 0; background-color: #f4f7f6; color: #333; padding: 20px; line-height: 1.6; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding: 0 20px; width: 100%; max-width: 840px; margin-left: auto; margin-right: auto;}
        .top-bar .home-link { text-decoration: none; color: #0d6efd; font-weight: 500; }
        .top-bar .home-link:hover { text-decoration: underline; }
        .lang-btn { padding: 8px 12px; border: 1px solid #ced4da; background-color: #fff; cursor: pointer; border-radius: 4px; font-size: 0.9em; }
        .lang-btn:hover { background-color: #e9ecef; }
        .container { max-width: 800px; margin: 0 auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); }
        h1, h2, h3 { color: #343a40; font-weight: 500; }
        h1 { text-align: center; margin-bottom: 30px; }
        .profile-section { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .profile-section:last-child { border-bottom: none; margin-bottom: 0; }
        .profile-section h2 { font-size: 1.5em; margin-bottom: 15px; }
        .info-pair { margin-bottom: 10px; }
        .info-pair strong { color: #495057; }
        .action-btn { /* Zdedené alebo skopírované štýly z index.html */
            padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 1em;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            text-decoration: none; display: inline-block; text-align: center; border: none; font-weight: 500;
            margin-top: 5px;
        }
        .action-btn.primary-action { background-color: #198754; color: white; }
        .action-btn.primary-action:hover { background-color: #157347; }
        .action-btn.secondary-action { background-color: #6c757d; color: white; }
        .action-btn.secondary-action:hover { background-color: #5a6268; }
        .api-token-display {
            word-break: break-all; background-color: #e9ecef; padding: 8px;
            border-radius: 4px; font-family: monospace; margin-bottom: 10px;
            display: inline-block; max-width: 100%; overflow-x: auto;
        }
        .test-history-list { list-style-type: none; padding: 0; }
        .test-history-list li {
            background-color: #f8f9fa; padding: 12px; margin-bottom: 8px;
            border-radius: 4px; border: 1px solid #dee2e6;
            display: flex; justify-content: space-between; align-items: center;
        }
        .test-history-list li:hover { background-color: #e9ecef; }
        .test-history-list .test-date { font-weight: 500; }
        .test-history-list .test-score { /* Prípadne pre skóre */ }
        .test-history-list .view-details-btn {
            padding: 6px 12px; font-size: 0.9em; background-color: #0d6efd; color: white;
            text-decoration: none; border-radius: 4px;
        }
        .test-history-list .view-details-btn:hover { background-color: #0b5ed7;}
        .form-message { margin-top: 10px; font-size: 0.9em; font-weight: 500; }
        .form-message.success { color: #198754; }
        .form-message.error { color: #dc3545; }

        /* Pre detail testu v modálnom okne */
        .modal { /* Rovnaké štýly ako v index.html */
            display: none; position: fixed; z-index: 1000; left: 0; top: 0;
            width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);
            padding-top: 50px;
        }
        .modal-content {
            background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888;
            width: 90%; max-width: 700px; border-radius: 8px; position: relative;
        }
        .modal-content h3 { margin-top: 0; text-align: center; }
        .modal-content .close-btn { /* Rovnaké ako v index.html */
            color: #aaa; float: right; font-size: 28px; font-weight: bold;
            position: absolute; top: 10px; right: 15px;
        }
        .modal-content .close-btn:hover, .modal-content .close-btn:focus { color: black; text-decoration: none; cursor: pointer; }
        #test-detail-content ul { list-style-type: none; padding: 0;}
        #test-detail-content li { margin-bottom: 8px; padding: 8px; background-color: #f8f9fa; border-radius: 4px;}
        #test-detail-content li strong { color: #495057; }
        #test-detail-content .correct { color: green; }
        #test-detail-content .incorrect { color: red; }
    </style>
</head>
<body>
<div class="top-bar">
    <a href="index.php" id="home-link" class="home-link">Domov</a>
    <button id="toggle-lang-btn" class="lang-btn">English</button>
</div>

<div class="container">
    <h1 id="profile-main-title">Môj Profil</h1>

    <section class="profile-section" id="user-info-section">
        <h2 id="user-info-title">Informácie o používateľovi</h2>
        <div class="info-pair">
            <strong id="username-label">Používateľské meno:</strong> <span id="profile-username">Načítavam...</span>
        </div>
    </section>

    <section class="profile-section" id="api-token-section">
        <h2 id="api-token-title">Môj API Token</h2>
        <p id="api-token-description">Tento token môžete použiť pre priamy prístup k API (ak je to relevantné).</p>
        <div>
            <span id="api-token-label">Aktuálny token:</span>
            <span id="profile-api-token" class="api-token-display">Načítavam...</span>
            <button id="toggle-token-visibility-btn" class="action-btn secondary-action" style="margin-left: 5px; padding: 6px 10px; font-size: 0.9em;"></button>
        </div>
        <button id="regenerate-token-btn" class="action-btn primary-action">Pregenerovať API Token</button>
        <p id="token-message" class="form-message"></p>
    </section>

    <section class="profile-section" id="test-history-section">
        <h2 id="test-history-title">História mojich testov</h2>
        <ul id="test-history-list" class="test-history-list">
            <p id="test-history-loading">Načítavam históriu testov...</p>
        </ul>
    </section>
</div>

<div id="test-detail-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="close-test-detail-modal-btn">&times;</span>
        <h3 id="test-detail-modal-title">Detail Testu</h3>
        <div id="test-detail-info"> </div>
        <div id="test-detail-content">
        </div>
    </div>
</div>

<script>
    const apiBase = 'https://node53.webte.fei.stuba.sk/skuska/api/api.php?route=';
    let currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk';
    let currentUserApiToken = localStorage.getItem('apiToken');
    let currentUserId = localStorage.getItem('userId');
    let loggedInUsername = localStorage.getItem('loggedInUsername');
    let isTokenVisible = false;

    // UI Elementy
    const pageTitleProfileEl = document.getElementById('page-title-profile');
    const profileMainTitleEl = document.getElementById('profile-main-title');
    const homeLinkEl = document.getElementById('home-link');
    const toggleLangBtn = document.getElementById('toggle-lang-btn');
    const profileUsernameEl = document.getElementById('profile-username');
    const userInfoTitleEl = document.getElementById('user-info-title');
    const usernameLabelEl = document.getElementById('username-label');

    const apiTokenTitleEl = document.getElementById('api-token-title');
    const apiTokenDescriptionEl = document.getElementById('api-token-description');
    const apiTokenLabelEl = document.getElementById('api-token-label');
    const profileApiTokenEl = document.getElementById('profile-api-token');
    const toggleTokenVisibilityBtn = document.getElementById('toggle-token-visibility-btn');
    const regenerateTokenBtn = document.getElementById('regenerate-token-btn');
    const tokenMessageEl = document.getElementById('token-message');

    const testHistoryTitleEl = document.getElementById('test-history-title');
    const testHistoryListEl = document.getElementById('test-history-list');
    const testHistoryLoadingEl = document.getElementById('test-history-loading');

    const testDetailModal = document.getElementById('test-detail-modal');
    const closeTestDetailModalBtn = document.getElementById('close-test-detail-modal-btn');
    const testDetailModalTitleEl = document.getElementById('test-detail-modal-title');
    const testDetailInfoEl = document.getElementById('test-detail-info');
    const testDetailContentEl = document.getElementById('test-detail-content');


    const uiStrings = {
        sk: {
            pageTitleProfile: "Môj Profil", profileMainTitle: "Môj Profil", homeLink: "Domov",
            userInfoTitle: "Informácie o používateľovi", usernameLabel: "Používateľské meno:",
            apiTokenTitle: "Môj API Token",
            apiTokenDescription: "Tento token slúži na autentifikáciu pri priamom volaní API.",
            apiTokenLabel: "Aktuálny token:", regenerateTokenBtn: "Pregenerovať API Token",
            tokenRefreshedSuccess: "API token bol úspešne pregenerovaný!",
            tokenRefreshedError: "Nepodarilo sa pregenerovať API token.",
            showToken: "Ukázať token", hideToken: "Skryť token",
            testHistoryTitle: "História mojich testov", testHistoryLoading: "Načítavam históriu testov...",
            noTestsFound: "Zatiaľ ste neabsolvovali žiadne testy.",
            testOnDate: "Test zo dňa:", viewTestDetails: "Zobraziť detaily",
            testDetailModalTitle: "Detail Testu", closeBtnLabel: "Zatvoriť",
            question: "Otázka", yourAnswer: "Vaša odpoveď", correctAnswer: "Správna odpoveď",
            timeTaken: "Čas", correct: "Správne", incorrect: "Nesprávne",
            loading: "Načítavam...", generalError: "Vyskytla sa chyba.",
            switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            overallScore: "Celkové skóre"
        },
        en: {
            pageTitleProfile: "My Profile", profileMainTitle: "My Profile", homeLink: "Home",
            userInfoTitle: "User Information", usernameLabel: "Username:",
            apiTokenTitle: "My API Token",
            apiTokenDescription: "This token can be used for direct API access if relevant.",
            apiTokenLabel: "Current token:", regenerateTokenBtn: "Regenerate API Token",
            tokenRefreshedSuccess: "API token has been successfully regenerated!",
            tokenRefreshedError: "Failed to regenerate API token.",
            showToken: "Show token", hideToken: "Hide token",
            testHistoryTitle: "My Test History", testHistoryLoading: "Loading test history...",
            noTestsFound: "You have not completed any tests yet.",
            testOnDate: "Test from:", viewTestDetails: "View Details",
            testDetailModalTitle: "Test Detail", closeBtnLabel: "Close",
            question: "Question", yourAnswer: "Your answer", correctAnswer: "Correct answer",
            timeTaken: "Time", correct: "Correct", incorrect: "Incorrect",
            loading: "Loading...", generalError: "An error occurred.",
            switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            overallScore: "Overall Score"
        }
    };

    function t(key) { return uiStrings[currentLanguage][key] || key; }

    function updateUIText() {
        document.documentElement.lang = currentLanguage;
        pageTitleProfileEl.textContent = t('pageTitleProfile');
        profileMainTitleEl.textContent = t('profileMainTitle');
        homeLinkEl.textContent = t('homeLink');
        toggleLangBtn.textContent = currentLanguage === 'sk' ? t('switchToEnglish') : t('switchToSlovak');
        userInfoTitleEl.textContent = t('userInfoTitle');
        usernameLabelEl.textContent = t('usernameLabel');
        apiTokenTitleEl.textContent = t('apiTokenTitle');
        apiTokenDescriptionEl.textContent = t('apiTokenDescription');
        apiTokenLabelEl.textContent = t('apiTokenLabel');
        regenerateTokenBtn.textContent = t('regenerateTokenBtn');
        testHistoryTitleEl.textContent = t('testHistoryTitle');
        testDetailModalTitleEl.textContent = t('testDetailModalTitle');
        if (testHistoryLoadingEl.style.display !== 'none') testHistoryLoadingEl.textContent = t('testHistoryLoading');
        // Aktualizácia textu tlačidla pre viditeľnosť tokenu
        toggleTokenVisibilityBtn.textContent = isTokenVisible ? t('hideToken') : t('showToken');
    }

    function displayToken() {
        if (isTokenVisible && currentUserApiToken) {
            profileApiTokenEl.textContent = currentUserApiToken;
        } else if (currentUserApiToken) {
            profileApiTokenEl.textContent = currentUserApiToken.substring(0, 4) + '...' + currentUserApiToken.substring(currentUserApiToken.length - 4);
        } else {
            profileApiTokenEl.textContent = t('loading');
        }
        toggleTokenVisibilityBtn.textContent = isTokenVisible ? t('hideToken') : t('showToken');
    }

    toggleTokenVisibilityBtn.addEventListener('click', () => {
        isTokenVisible = !isTokenVisible;
        displayToken();
    });

    regenerateTokenBtn.addEventListener('click', async () => {
        tokenMessageEl.textContent = t('loading');
        tokenMessageEl.className = 'form-message';
        regenerateTokenBtn.disabled = true;

        if (!currentUserApiToken) {
            tokenMessageEl.textContent = t('generalError');
            tokenMessageEl.classList.add('error');
            regenerateTokenBtn.disabled = false;
            return;
        }

        try {
            const response = await fetch(apiBase + 'token/refresh', { // Podľa Auth.class.php je to POST, ale v api.php nie je
                // špecifikované pre token/refresh, Auth.class.php nemá HTTP metódu definovanú
                // Predpokladajme POST alebo GET, GET je jednoduchší ak netreba telo
                // Váš Auth.class.php pre regenerateToken() očakáva starý token ako argument,
                // ale typicky sa identifikuje používateľ cez Bearer token.
                // API endpoint token/refresh by mal byť chránený.
                method: 'POST', // Alebo GET, podľa implementácie API - Auth.class.php to má ako POST
                headers: {
                    'Authorization': 'Bearer ' + currentUserApiToken,
                    'Content-Type': 'application/json' // Aj keď telo môže byť prázdne pre tento POST
                }
                // body: JSON.stringify({}) // Ak by POST vyžadoval telo
            });
            const data = await response.json();
            if (response.ok && data.api_token) {
                currentUserApiToken = data.api_token;
                localStorage.setItem('apiToken', currentUserApiToken);
                tokenMessageEl.textContent = t('tokenRefreshedSuccess');
                tokenMessageEl.classList.add('success');
                isTokenVisible = false; // Skryť nový token defaultne
                displayToken();
            } else {
                tokenMessageEl.textContent = data.error || data.message || t('tokenRefreshedError');
                tokenMessageEl.classList.add('error');
            }
        } catch (error) {
            console.error("Error regenerating token:", error);
            tokenMessageEl.textContent = t('generalError');
            tokenMessageEl.classList.add('error');
        } finally {
            regenerateTokenBtn.disabled = false;
        }
    });

    async function fetchTestHistory() {
        if (!currentUserApiToken) {
            testHistoryLoadingEl.textContent = t('noTestsFound'); // Alebo "Prosím, prihláste sa"
            return;
        }
        testHistoryLoadingEl.style.display = 'block';
        testHistoryLoadingEl.textContent = t('testHistoryLoading');
        testHistoryListEl.innerHTML = ''; // Vyčistiť starý zoznam

        try {
            // Predpokladáme nový API endpoint: GET api.php?route=tests (alebo tests/myhistory)
            // Váš Test.class.php zatiaľ nemá metódu na vrátenie zoznamu testov pre používateľa.
            // Musí byť pridaná do backendu. Napr. getMyTests($userId)
            // Tento endpoint by mal vrátiť pole testov.
            // Pre ukážku použijem fiktívnu štruktúru odpovede.
            // const response = await fetch(apiBase + 'tests/history', { // Príklad endpointu
            //     headers: { 'Authorization': 'Bearer ' + currentUserApiToken }
            // });
            // if (!response.ok) throw new Error('Failed to fetch test history');
            // const tests = await response.json();

            // --- Začiatok Fiktívnych Dát pre Testovanie ---
            await new Promise(resolve => setTimeout(resolve, 500)); // Simulácia načítania
            const tests = [ // Toto nahraďte skutočným API volaním
                // { test_id: 1, datetime: "2025-05-17 10:30:00", total_questions: 2, correct_answers: 1},
                // { test_id: 4, datetime: "2025-05-18 00:51:14", total_questions: 1, correct_answers: 0}
                // API by malo vracať tieto sumárne info. Váš getTestResult vracia detail.
                // Pre tento zoznam potrebujeme sumár. Ak ho API neposkytuje, musíme načítať každý test detailne, čo nie je ideálne.
            ];
            // Na základe Test.class.php -> getTestResult, zdá sa, že nemáme endpoint na zoznam testov.
            // Pre účely dema, ak je tests prázdne, zobrazí sa "No tests found".
            // Ak by ste mali endpoint, ktorý vracia len ID testov, museli by ste pre každý test volať getTestResult na získanie detailov pre skóre.
            // --- Koniec Fiktívnych Dát ---


            if (tests && tests.length > 0) {
                testHistoryLoadingEl.style.display = 'none';
                tests.forEach(test => {
                    const li = document.createElement('li');
                    const date = new Date(test.datetime).toLocaleString(currentLanguage === 'sk' ? 'sk-SK' : 'en-GB');
                    // Skóre by malo prísť z API, alebo ho musíme vypočítať, ak API vráti len detail otázok
                    const scoreInfo = (typeof test.correct_answers !== 'undefined' && typeof test.total_questions !== 'undefined')
                        ? `${test.correct_answers}/${test.total_questions}` : `(${t('loading')}...)`;

                    li.innerHTML = `
                            <div>
                                <span class="test-date">${t('testOnDate')} ${date}</span><br>
                                <span class="test-score">${t('overallScore')}: ${scoreInfo}</span>
                            </div>
                            <button class="view-details-btn" data-testid="${test.test_id}">${t('viewTestDetails')}</button>
                        `;
                    li.querySelector('.view-details-btn').addEventListener('click', () => showTestDetail(test.test_id));
                    testHistoryListEl.appendChild(li);
                });
            } else {
                testHistoryLoadingEl.textContent = t('noTestsFound');
            }
        } catch (error) {
            console.error("Error fetching test history:", error);
            testHistoryLoadingEl.textContent = t('generalError');
            testHistoryLoadingEl.classList.add('error');
        }
    }

    async function showTestDetail(testId) {
        testDetailModalTitleEl.textContent = `${t('testDetailModalTitle')} #${testId}`;
        testDetailContentEl.innerHTML = `<p>${t('loading')}...</p>`;
        testDetailInfoEl.innerHTML = '';
        openModal(testDetailModal);

        try {
            const response = await fetch(`${apiBase}tests/${testId}`, {
                headers: { 'Authorization': 'Bearer ' + currentUserApiToken }
            });
            if (!response.ok) throw new Error('Failed to fetch test details');
            const questions = await response.json(); // Váš getTestResult vracia pole otázok

            if (questions && questions.length > 0) {
                let correctCount = 0;
                questions.forEach(q => { if (q.answered_correctly) correctCount++; });
                testDetailInfoEl.innerHTML = `<strong>${t('overallScore')}:</strong> ${correctCount} / ${questions.length} (${((correctCount/questions.length)*100).toFixed(0)}%)`;

                let htmlContent = '<ul>';
                questions.forEach((q, index) => {
                    const questionText = q[`text_${currentLanguage}`] || q.text_sk; // Použiť správny jazyk alebo fallback
                    let displayQText = questionText;
                    if (questionText.startsWith("MC:")) displayQText = questionText.substring(3).split("---")[0].trim();
                    else if (questionText.startsWith("WA:")) displayQText = questionText.substring(3).trim();

                    htmlContent += `
                            <li>
                                <strong>${t('question')} ${index + 1}:</strong> ${displayQText}<br>
                                <strong>${t('yourAnswer')}:</strong> ${q.user_answer_from_db_please_add_if_needed} <span class="${q.answered_correctly ? 'correct' : 'incorrect'}">
                                    (${q.answered_correctly ? t('correct') : t('incorrect')})
                                </span><br>
                                <strong>${t('timeTaken')}:</strong> ${q.time_taken}${t('secondsSuffix')}
                            </li>`;
                });
                htmlContent += '</ul>';
                testDetailContentEl.innerHTML = htmlContent;
            } else {
                testDetailContentEl.innerHTML = `<p>${t('noDataLoaded')}</p>`;
            }

        } catch (error) {
            console.error("Error fetching test detail:", error);
            testDetailContentEl.innerHTML = `<p>${t('generalError')}</p>`;
        }
    }

    // --- Funkcie pre modálne okná (rovnaké ako v index.html) ---
    function openModal(modal) { modal.style.display = 'block'; }
    function closeModal(modal) { modal.style.display = 'none'; }
    closeTestDetailModalBtn.onclick = () => closeModal(testDetailModal);
    window.onclick = (event) => { if (event.target == testDetailModal) closeModal(testDetailModal); };


    // --- Inicializácia ---
    document.addEventListener('DOMContentLoaded', () => {
        currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk';
        currentUserApiToken = localStorage.getItem('apiToken');
        currentUserId = localStorage.getItem('userId'); // Načítame userId
        loggedInUsername = localStorage.getItem('loggedInUsername');

        if (!currentUserApiToken || !loggedInUsername) {
            // Ak používateľ nie je prihlásený, presmerujeme ho alebo zobrazíme správu
            document.body.innerHTML = `<div class="container" style="text-align:center;"><h1>${t('pageTitleProfile')}</h1><p>${t('loginRequiredForProfile') || 'Pre zobrazenie tejto stránky sa musíte prihlásiť.'}</p><a href="index.php">${t('homeLink') || 'Domov'}</a></div>`;
            // Aktualizovať titulok stránky aj tak
            const titleTag = document.querySelector('title');
            if(titleTag) titleTag.textContent = t('pageTitleProfile');
            return;
        }

        profileUsernameEl.textContent = loggedInUsername;
        displayToken(); // Zobrazí token (skrytý/plný)
        updateUIText();
        fetchTestHistory(); // Načíta históriu testov
    });

    toggleLangBtn.addEventListener('click', () => {
        currentLanguage = localStorage.getItem('mathTestLanguageHomepage') === 'sk' ? 'en' : 'sk';
        localStorage.setItem('mathTestLanguageHomepage', currentLanguage);
        updateUIText();
        fetchTestHistory(); // Prekresliť históriu v novom jazyku
        // Ak je detail testu otvorený, mali by sme ho tiež prekresliť (zložitejšie, neriešené teraz)
    });

</script>
</body>
</html>