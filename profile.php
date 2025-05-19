<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title-profile">Môj Profil</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; margin: 0; background-color: #f4f7f6; color: #333; padding: 20px; line-height: 1.6; }
        .top-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 15px;
            padding: 0 20px;
            width: 100%;
            max-width: 840px;
            margin-left: auto;
            margin-right: auto;
        }
        .lang-btn { padding: 8px 12px; border: 1px solid #ced4da; background-color: #fff; cursor: pointer; border-radius: 4px; font-size: 0.9em; }
        .lang-btn:hover { background-color: #e9ecef; }
        .container { max-width: 800px; margin: 0 auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); }

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

        nav.main-navigation {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
            align-items: center;
        }

        .profile-section { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .profile-section:last-child { border-bottom: none; margin-bottom: 0; }
        .profile-section h2 { font-size: 1.5em; margin-bottom: 15px; color: #343a40; font-weight: 500;} /* Ensured h2 style */
        .info-pair { margin-bottom: 10px; }
        .info-pair strong { color: #495057; }

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

        .action-btn.primary-action { background-color: #198754; color: white; } /* This is for regenerate */
        .action-btn.primary-action:hover { background-color: #157347; }
        .action-btn.secondary-action { background-color: #6c757d; color: white; } /* This is for Show/Hide and Back to Home */
        .action-btn.secondary-action:hover { background-color: #5a6268; }


        .api-token-display {
            word-break: break-all; background-color: #e9ecef; padding: 8px;
            border-radius: 4px; font-family: monospace; margin-bottom: 10px;
            display: inline-block; max-width: 100%; overflow-x: auto;
        }
        #toggle-token-visibility-btn.action-btn.secondary-action {
            margin-left: 5px; padding: 6px 10px; font-size: 0.9em; min-width: auto;
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
            text-decoration: none; border-radius: 4px; border: none; cursor: pointer; /* Ensure it looks like a button */
        }
        .test-history-list .view-details-btn:hover { background-color: #0b5ed7;}
        .form-message { margin-top: 10px; font-size: 0.9em; font-weight: 500; }
        .form-message.success { color: #198754; }
        .form-message.error { color: #dc3545; }

        /* Pre detail testu v modálnom okne */
        .modal {
            display: none; position: fixed; z-index: 1000; left: 0; top: 0;
            width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);
            padding-top: 50px;
        }
        .modal-content {
            background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888;
            width: 90%; max-width: 700px; border-radius: 8px; position: relative;
        }
        .modal-content h3 { margin-top: 0; text-align: center; color: #343a40; font-weight: 500;} /* Ensured h3 style */
        .modal-content .close-btn {
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
    <button id="toggle-lang-btn" class="lang-btn">English</button>
</div>

<div class="container">
    <header class="page-header">
        <h1 id="profile-main-title">Môj Profil</h1>
    </header>

    <nav class="main-navigation"> <a href="index.php" id="back-to-home-btn-profile" class="action-btn secondary-action">Domov</a>
    </nav>

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
            <button id="toggle-token-visibility-btn" class="action-btn secondary-action" style="margin-left: 5px; padding: 6px 10px; font-size: 0.9em; min-width:auto;">Ukázať</button>
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
    const backToHomeBtnProfileEl = document.getElementById('back-to-home-btn-profile'); // Added
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
            pageTitleProfile: "Môj Profil", profileMainTitle: "Môj Profil",
            backToHomeProfile: "Späť na Domovskú Stránku", // Added
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
            timeTaken: "Čas", correct: "Správne", incorrect: "Nesprávne", secondsSuffix: "s",
            loading: "Načítavam...", generalError: "Vyskytla sa chyba.",
            noDataLoaded: "Žiadne dáta neboli načítané.", // Added for consistency with modal content
            loginRequiredForProfile: "Pre zobrazenie tejto stránky sa musíte prihlásiť.", // Added
            switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            overallScore: "Celkové skóre"
        },
        en: {
            pageTitleProfile: "My Profile", profileMainTitle: "My Profile",
            backToHomeProfile: "Back to Homepage", // Added
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
            timeTaken: "Time", correct: "Correct", incorrect: "Incorrect", secondsSuffix: "s",
            loading: "Loading...", generalError: "An error occurred.",
            noDataLoaded: "No data was loaded.", // Added for consistency with modal content
            loginRequiredForProfile: "You must be logged in to view this page.", // Added
            switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            overallScore: "Overall Score"
        }
    };

    function t(key) { return uiStrings[currentLanguage][key] || key; }

    function updateUIText() {
        document.documentElement.lang = currentLanguage;
        pageTitleProfileEl.textContent = t('pageTitleProfile');
        profileMainTitleEl.textContent = t('profileMainTitle');
        if (backToHomeBtnProfileEl) { // Added
            backToHomeBtnProfileEl.textContent = t('backToHomeProfile'); // Added
        }
        toggleLangBtn.textContent = currentLanguage === 'sk' ? t('switchToEnglish') : t('switchToSlovak');
        userInfoTitleEl.textContent = t('userInfoTitle');
        usernameLabelEl.textContent = t('usernameLabel');
        apiTokenTitleEl.textContent = t('apiTokenTitle');
        apiTokenDescriptionEl.textContent = t('apiTokenDescription');
        apiTokenLabelEl.textContent = t('apiTokenLabel');
        regenerateTokenBtn.textContent = t('regenerateTokenBtn');
        testHistoryTitleEl.textContent = t('testHistoryTitle');
        testDetailModalTitleEl.textContent = t('testDetailModalTitle'); // Also update modal title here
        if (testHistoryLoadingEl && testHistoryLoadingEl.style.display !== 'none' && testHistoryLoadingEl.textContent !== t('noTestsFound') && testHistoryLoadingEl.textContent !== t('generalError')) {
            testHistoryLoadingEl.textContent = t('testHistoryLoading');
        }
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
            const response = await fetch(apiBase + 'token/refresh', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + currentUserApiToken,
                    'Content-Type': 'application/json'
                }
            });
            const data = await response.json();
            if (response.ok && data.api_token) {
                currentUserApiToken = data.api_token;
                localStorage.setItem('apiToken', currentUserApiToken);
                tokenMessageEl.textContent = t('tokenRefreshedSuccess');
                tokenMessageEl.classList.add('success');
                isTokenVisible = false;
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
        if (!currentUserApiToken || !currentUserId) { // Check userId too for fetching history
            testHistoryLoadingEl.textContent = t('noTestsFound');
            testHistoryListEl.innerHTML = ''; // Clear any previous list
            return;
        }
        testHistoryLoadingEl.style.display = 'block';
        testHistoryLoadingEl.textContent = t('testHistoryLoading');
        testHistoryListEl.innerHTML = '';

        try {
            const response = await fetch(`${apiBase}users/${currentUserId}/tests`, {
                headers: { 'Authorization': 'Bearer ' + currentUserApiToken }
            });
            if (!response.ok) {
                if (response.status === 404) { // No tests found
                    testHistoryLoadingEl.textContent = t('noTestsFound');
                    return;
                }
                throw new Error(`Failed to fetch test history. Status: ${response.status}`);
            }
            const tests = await response.json();

            if (tests && tests.length > 0) {
                testHistoryLoadingEl.style.display = 'none';
                tests.sort((a,b) => new Date(b.datetime) - new Date(a.datetime)); // Sort newest first
                tests.forEach(test => {
                    const li = document.createElement('li');
                    const date = new Date(test.datetime).toLocaleString(currentLanguage === 'sk' ? 'sk-SK' : 'en-GB');
                    const scoreInfo = (typeof test.correct_answers !== 'undefined' && typeof test.total_questions !== 'undefined')
                        ? `${test.correct_answers}/${test.total_questions}` : `(${t('loading')}...)`;

                    li.innerHTML = `
                            <div>
                                <span class="test-date">${t('testOnDate')} ${date}</span><br>
                                <span class="test-score">${t('overallScore')}: ${scoreInfo}</span>
                            </div>
                            <button class="view-details-btn action-btn" data-testid="${test.test_id}">${t('viewTestDetails')}</button>
                        `;
                    // Ensure button has action-btn for consistent styling if desired, or keep specific .view-details-btn
                    li.querySelector('.view-details-btn').addEventListener('click', () => showTestDetail(test.test_id));
                    testHistoryListEl.appendChild(li);
                });
            } else {
                testHistoryLoadingEl.textContent = t('noTestsFound');
            }
        } catch (error) {
            console.error("Error fetching test history:", error);
            testHistoryLoadingEl.textContent = t('generalError');
            // testHistoryLoadingEl.classList.add('error'); // Optional: add error class
        }
    }

    async function showTestDetail(testId) {
        testDetailModalTitleEl.textContent = `${t('testDetailModalTitle')} #${testId}`;
        testDetailContentEl.innerHTML = `<p>${t('loading')}...</p>`;
        testDetailInfoEl.innerHTML = '';
        openModal(testDetailModal);

        try {
            const response = await fetch(`${apiBase}tests/${testId}`, { // This needs to be the correct user-specific endpoint
                headers: { 'Authorization': 'Bearer ' + currentUserApiToken }
            });
            if (!response.ok) throw new Error(`Failed to fetch test details. Status: ${response.status}`);
            const testData = await response.json(); // Expecting { test_info: {...}, questions: [...] } or just questions directly

            let questions = testData; // Default to direct questions array
            if (testData && testData.questions && Array.isArray(testData.questions)) { // If API returns object with questions property
                questions = testData.questions;
                // You can use testData.test_info for overall score if API provides it here
                if (testData.test_info && typeof testData.test_info.correct_answers !== 'undefined') {
                    testDetailInfoEl.innerHTML = `<strong>${t('overallScore')}:</strong> ${testData.test_info.correct_answers} / ${testData.test_info.total_questions} (${((testData.test_info.correct_answers/testData.test_info.total_questions)*100).toFixed(0)}%)`;
                }
            }


            if (questions && questions.length > 0) {
                if (!testDetailInfoEl.innerHTML) { // Calculate overall score if not provided by test_info
                    let correctCount = 0;
                    questions.forEach(q => { if (q.answered_correctly) correctCount++; });
                    testDetailInfoEl.innerHTML = `<strong>${t('overallScore')}:</strong> ${correctCount} / ${questions.length} (${((correctCount/questions.length)*100).toFixed(0)}%)`;
                }

                let htmlContent = '<ul>';
                questions.forEach((q, index) => {
                    const questionTextKey = currentLanguage === 'sk' ? 'text_sk' : 'text_en';
                    // Assuming the API provides question text directly for the test questions
                    let displayQText = q[questionTextKey] || q.text_sk || "Text otázky nenájdený"; // Fallback if text keys are missing

                    // Clean MC/WA prefixes if they are present in the stored question text
                    if (displayQText.startsWith("MC:")) displayQText = displayQText.substring(3).split("---")[0].trim();
                    else if (displayQText.startsWith("WA:")) displayQText = displayQText.substring(3).trim();

                    htmlContent += `
                            <li>
                                <strong>${t('question')} ${index + 1}:</strong> ${displayQText}<br>
                                <strong>${t('yourAnswer')}:</strong> ${q.answer_given || "N/A"}
                                <span class="${q.answered_correctly ? 'correct' : 'incorrect'}">
                                    (${q.answered_correctly ? t('correct') : t('incorrect')})
                                </span><br>
                                ${!q.answered_correctly ? `<strong>${t('correctAnswer')}:</strong> ${q.correct_answer || "N/A"}<br>` : ''}
                                <strong>${t('timeTaken')}:</strong> ${q.time_taken || 0}${t('secondsSuffix')}
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

    function openModal(modal) { modal.style.display = 'block'; }
    function closeModal(modal) { modal.style.display = 'none'; }
    if(closeTestDetailModalBtn) closeTestDetailModalBtn.onclick = () => closeModal(testDetailModal);
    window.onclick = (event) => { if (event.target == testDetailModal) closeModal(testDetailModal); };


    document.addEventListener('DOMContentLoaded', () => {
        currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk';
        currentUserApiToken = localStorage.getItem('apiToken');
        currentUserId = localStorage.getItem('userId');
        loggedInUsername = localStorage.getItem('loggedInUsername');

        const body = document.querySelector('body');
        const container = document.querySelector('.container');

        if (!currentUserApiToken || !loggedInUsername) {
            const langForRedirect = currentLanguage;
            const loginRequiredMsg = uiStrings[langForRedirect].loginRequiredForProfile || 'Pre zobrazenie tejto stránky sa musíte prihlásiť.';
            const homeLinkText = uiStrings[langForRedirect].backToHomeProfile || 'Domov'; // Use backToHomeProfile or a general home
            const pageTitleText = uiStrings[langForRedirect].pageTitleProfile || 'Môj Profil';

            if (container) container.style.display = 'none'; // Hide main content
            document.title = pageTitleText; // Set page title even on redirect message

            const messageDiv = document.createElement('div');
            messageDiv.className = 'container'; // Use container for consistent styling of the message box
            messageDiv.style.textAlign = 'center';
            messageDiv.style.padding = '50px 20px';
            messageDiv.innerHTML = `<h1>${pageTitleText}</h1><p>${loginRequiredMsg}</p><br><a href="index.php" class="action-btn secondary-action" style="min-width:150px;">${homeLinkText}</a>`;
            body.appendChild(messageDiv);
            // Ensure lang button still works if it's outside the hidden container
            updateUIText(); // Call to translate lang button if visible
            return;
        }

        if(profileUsernameEl) profileUsernameEl.textContent = loggedInUsername;
        displayToken();
        updateUIText();
        fetchTestHistory();
    });

    if(toggleLangBtn) {
        toggleLangBtn.addEventListener('click', () => {
            currentLanguage = localStorage.getItem('mathTestLanguageHomepage') === 'sk' ? 'en' : 'sk';
            localStorage.setItem('mathTestLanguageHomepage', currentLanguage);
            updateUIText();
            fetchTestHistory();
            // If a modal is open, its content won't be re-translated automatically unless handled
            if (testDetailModal && testDetailModal.style.display === 'block' && testDetailContentEl.dataset.activeTestId) {
                showTestDetail(testDetailContentEl.dataset.activeTestId); // Re-fetch/render detail in new language
            }
        });
    }
</script>
</body>
</html>