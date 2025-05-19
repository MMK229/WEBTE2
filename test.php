<!DOCTYPE html>
<html lang="sk"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematický Test</title>

    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; margin: 0; background-color: #f4f7f6; color: #333; padding: 20px; line-height: 1.5; }
        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 0 20px;
        }
        .lang-btn { padding: 8px 12px; border: 1px solid #ced4da; background-color: #fff; cursor: pointer; border-radius: 4px; font-size: 0.9em; }
        .lang-btn:hover { background-color: #e9ecef; }
        .container { max-width: 800px; margin: 0 auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #343a40; margin-bottom: 25px; font-weight: 500;}
        .question-container { border: 1px solid #dee2e6; padding: 20px; margin-bottom: 20px; background-color: #ffffff; border-radius: 5px;}
        .question-text { font-size: 1.25em; margin-bottom: 10px; min-height: 40px; line-height: 1.6; color: #495057; }
        .question-category-text { font-size: 0.9em; color: #6c757d; margin-bottom: 15px; font-style: italic; }
        .answer-section-wa label { display: block; margin-bottom: 8px; font-weight: 500; color: #495057; }
        .answer-input { width: 100%; padding: 10px; margin-bottom:15px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; font-size: 1em;}

        .mc-options-container button {
            display: block; width: 100%; text-align: left; padding: 12px 15px; margin-bottom: 8px;
            background-color: #f8f9fa; border: 1px solid #ced4da; border-radius: 4px; cursor: pointer;
            font-size: 1em; transition: background-color 0.2s ease, border-color 0.2s ease; color: #495057;
        }
        .mc-options-container button:not(:disabled):hover { /* Všeobecný hover pre neoznačené a neaktívne tlačidlá */
            background-color: #e9ecef;
            border-color: #adb5bd;
        }
        .mc-options-container button.marked {
            background-color: #0d6efd;
            border-color: #0a58ca;
            color: white;
            font-weight: 500;
        }

        .mc-options-container button.marked:not(:disabled):hover {
            background-color: #0b5ed7;
            border-color: #0a53be;
            color: white;
        }
        .mc-options-container button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .mc-options-container button.user-correct, .answer-input.user-correct {
            background-color: #d1e7dd !important; border-color: #badbcc !important; color: #0f5132 !important; font-weight: 500;
        }
        .mc-options-container button.user-incorrect, .answer-input.user-incorrect {
            background-color: #f8d7da !important; border-color: #f5c2c7 !important; color: #842029 !important; font-weight: 500;
        }
        .mc-options-container button.actual-correct {
            background-color: #d1e7dd !important; border: 2px solid #198754 !important; color: #0f5132 !important; font-weight: bold;
        }
        .answer-input.user-correct { border: 2px solid #198754; background-color: #d1e7dd; }
        .answer-input.user-incorrect { border: 2px solid #dc3545; background-color: #f8d7da; }

        #correct-answer-wa-display {
            margin-top: 10px; padding: 10px; border: 1px solid #198754;
            background-color: #d1e7dd; color: #0f5132; border-radius: 4px;
            font-size: 1em; line-height: 1.5; font-weight: 500;
        }

        #start-test-btn { background-color: #198754; color: white; }
        #start-test-btn:hover { background-color: #157347; }
        .submit-btn { background-color: #ffc107; color: #000; border: 1px solid #ffc107; }
        .submit-btn:hover:not(:disabled) { background-color: #ffca2c; border-color: #ffc720;} /* Hover len pre aktívne */
        .next-question-btn { background-color: #0d6efd; color: white; }
        .next-question-btn:hover:not(:disabled) { background-color: #0b5ed7; } /* Hover len pre aktívne */

        #start-test-btn, .submit-btn, .next-question-btn {
            padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 1em;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            display: block; margin: 20px auto 0 auto; min-width: 160px; text-align: center; border: none; font-weight: 500;
        }
        .submit-btn:disabled, .next-question-btn:disabled { /* Štýl pre deaktivované potvrdzovacie/ďalšie tlačidlá */
            background-color: #ced4da;
            border-color: #ced4da;
            color: #6c757d;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .progress-info, .attempt-info { text-align: center; margin-bottom: 15px; font-size: 0.95em; color: #6c757d; }
        .feedback { margin-top: 20px; font-style: normal; padding: 12px; border-radius: 4px; text-align: center; line-height: 1.6; font-size: 0.95em;}
        .feedback.correct { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
        .feedback.incorrect { background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }
        .feedback.info { background-color: #cfe2ff; color: #084298; border: 1px solid #b6d4fe;}


        #test-results-area { padding: 20px; margin-top: 20px; background-color: #ffffff; border-radius: 5px; }
        #test-results-area h2 { text-align: center; margin-bottom: 20px; font-weight: 500; }
        #test-results-area ul#results-list { list-style-type: none; padding-left: 0; margin-top: 25px;}
        #test-results-area li { background-color: #f8f9fa; margin-bottom: 10px; padding: 12px; border-radius: 4px; border: 1px solid #dee2e6; font-size: 0.95em;}
        #test-results-area .correct-answer-display { font-weight: bold; color: #198754;}

        #category-stats-title { font-weight: 500; color: #343a40; text-align: center; }
        #category-stats-carousel {
            border: 1px solid #e0e0e0; border-radius: 5px; padding: 20px;
            background-color: #f8f9fa; margin-bottom: 25px;
        }
        .carousel-controls {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;
        }
        .stat-nav-btn {
            background-color: #6c757d; color: white; border: none;
            padding: 8px 15px; border-radius: 4px; cursor: pointer;
            font-size: 1.1em; line-height: 1; font-weight: bold;
        }
        .stat-nav-btn:hover:not(:disabled) { background-color: #5a6268; }
        .stat-nav-btn:disabled { background-color: #ced4da; cursor: not-allowed; opacity: 0.7; }
        #stat-slide-indicator { font-size: 0.95em; color: #495057; font-weight: 500; }
        #category-stats-slide-content .category-stat-item {
            margin-bottom: 0; border: none; background-color: transparent; padding: 0;
        }
        .category-stat-item h4 { margin-top: 0; margin-bottom: 10px; font-size: 1.2em; color: #333; font-weight: 500; text-align: center;}
        .category-stat-summary { font-size: 0.95em; margin-bottom: 10px; text-align: center;}
        .progress-bar-container {
            width: 100%; background-color: #e9ecef; border-radius: .35rem;
            height: 22px; margin-bottom: 12px; overflow: hidden;
        }
        .progress-bar-correct {
            background-color: #28a745; height: 100%; float: left;
            text-align: center; color: white; line-height: 22px;
            font-size: 0.85em; white-space: nowrap; padding: 0 5px;
            box-sizing: border-box; transition: width 0.5s ease-in-out;
        }
        .category-stat-item .revise-questions-list {
            font-size: 0.9em; padding-left: 20px; margin-top: 8px;
            list-style-type: disc; color: #555;
        }
        .category-stat-item .revise-questions-list li {
            margin-bottom: 4px; background-color: transparent;
            padding: 0; border: none;
        }
        .category-stat-item .all-correct-message {
            color: #0f5132; font-weight: 500; margin-top: 8px; font-size: 0.95em;
        }
        .answer-section-wa, .mc-options-container, .submit-btn, .next-question-btn { display: none; }

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

        /* Štýly pre modálne okno */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000; /* Malo by byť nad ostatným obsahom */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5); /* Polopriehľadné pozadie */
            padding-top: 60px; /* Odsadenie zhora */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* Centrovanie a odsadenie */
            padding: 25px 30px;
            border: 1px solid #888;
            width: 90%; /* Šírka pre menšie obrazovky */
            max-width: 500px; /* Maximálna šírka */
            border-radius: 8px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .modal-content h3 { /* Titulok v modálnom okne */
            text-align: center;
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: 500;
            color: #343a40;
        }
        .modal-content p { /* Text v modálnom okne */
            margin-bottom: 25px;
            font-size: 1em;
            line-height: 1.6;
            text-align: center; /* Centrovanie textu varovania */
        }
        .modal .button-group { /* Skupina tlačidiel v modále */
            display: flex;
            justify-content: flex-end; /* Tlačidlá napravo */
            gap: 10px; /* Medzera medzi tlačidlami */
        }
        .modal .action-btn { /* Tlačidlá v modále */
            min-width: 100px;
        }
        .modal .action-btn.secondary-action { /* Špeciálny štýl pre "Cancel" tlačidlo */
            background-color: #6c757d;
            color: white;
        }
        .modal .action-btn.secondary-action:hover:not(:disabled) {
            background-color: #5a6268;
        }

    </style>

</head>
<body>
<div class="top-bar">
    <a href="index.php" id="back-to-home-btn" class="action-btn">Späť</a>
    <button id="toggle-lang-btn" class="lang-btn">English</button>
</div>
<div class="container">
    <h1 id="main-title-test">Matematický Test</h1>
    <div class="attempt-info" id="attempt-info-display" style="display: none;"></div>
    <div class="progress-info" id="progress-info-display" style="display: none;">
        <span id="question-label">Otázka</span> <span id="current-question-number">0</span> <span id="of-label">z</span> <span id="total-questions">0</span>
    </div>

    <div id="test-area">
        <div class="question-container" style="display: none;">
            <div id="question-text" class="question-text">Načítavam otázku...</div>
            <div id="question-category-display" class="question-category-text" style="display: none;"></div>
            <div class="answer-section-wa">
                <label for="answer-input" id="your-answer-label">Vaša odpoveď:</label>
                <input type="text" id="answer-input" class="answer-input">
                <div id="correct-answer-wa-display" style="display: none;"></div>
            </div>
            <div id="mc-options-container" class="mc-options-container"></div>
            <button id="submit-answer-btn" class="submit-btn" style="display: none;">Potvrdiť</button>
            <button id="next-question-btn" class="next-question-btn" style="display: none;">Ďalšia otázka</button>
            <div id="question-feedback" class="feedback" style="display: none;"></div>
        </div>

        <div id="test-results-area" style="display: none;">
            <h2 id="results-title">Výsledky Testu</h2>
            <div id="results-summary"></div>

            <h3 id="category-stats-title" style="display: none; margin-top: 0; margin-bottom:10px;">Štatistika podľa oblastí:</h3>
            <div id="category-stats-carousel" style="display: none;">
                <div class="carousel-controls">
                    <button id="prev-stat-btn" class="stat-nav-btn">&lt;</button>
                    <span id="stat-slide-indicator"></span>
                    <button id="next-stat-btn" class="stat-nav-btn">&gt;</button>
                </div>
                <div id="category-stats-slide-content"></div>
            </div>
            <ul id="results-list"></ul>
        </div>
    </div>
    <button id="start-test-btn">Začať Test</button>
</div>

<div id="warning-modal" class="modal">
    <div class="modal-content">
        <h3 id="warning-modal-title"></h3>
        <p id="warning-modal-text"></p>
        <div class="button-group">
            <button id="warning-cancel-btn" class="action-btn secondary-action"></button>
            <button id="warning-confirm-btn" class="action-btn primary-action"></button>
        </div>
    </div>
</div>


<script>
    const apiBase = 'https://node53.webte.fei.stuba.sk/skuska/api/api.php?route=';
    const localStorageKeyAttempts = 'mathTestAttempts';
    const localStorageKeyAnsweredQuestions = 'mathTestAnsweredQuestions';
    const MAX_QUESTIONS_PER_TEST = 10;

    let currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk';

    let allQuestionsFromApi = []; // Všetky otázky načítané z API
    let allQuestions = [];      // Otázky pre aktuálny test (max. 10)
    let currentQuestionIndex = 0;
    let userAnswers = [];
    let questionStartTime;
    let testAttemptNumber = 0;

    let selectedMcOptionValue = null;
    let selectedMcOptionElement = null;

    let currentTestId = null;
    let currentUserApiToken = null;
    let currentUserId = null;

    // UI Elementy
    const mainTitleElTest = document.getElementById('main-title-test');
    const toggleLangBtn = document.getElementById('toggle-lang-btn');
    const backBtn = document.getElementById('back-to-home-btn');
    const startTestBtn = document.getElementById('start-test-btn');
    const questionContainer = document.querySelector('.question-container');
    const questionTextEl = document.getElementById('question-text');
    const questionCategoryDisplayEl = document.getElementById('question-category-display');
    const answerSectionWA = document.querySelector('.answer-section-wa');
    const yourAnswerLabelEl = document.getElementById('your-answer-label');
    const answerInputEl = document.getElementById('answer-input');
    const correctAnswerWaDisplayEl = document.getElementById('correct-answer-wa-display');
    const mcOptionsContainer = document.getElementById('mc-options-container');
    const confirmAnswerBtn = document.getElementById('submit-answer-btn');
    const nextQuestionBtn = document.getElementById('next-question-btn');
    const progressInfoDisplayEl = document.getElementById('progress-info-display');
    const questionLabelEl = document.getElementById('question-label');
    const currentQuestionNumberEl = document.getElementById('current-question-number');
    const ofLabelEl = document.getElementById('of-label');
    const totalQuestionsEl = document.getElementById('total-questions');
    const attemptInfoDisplayEl = document.getElementById('attempt-info-display');
    const testResultsArea = document.getElementById('test-results-area');
    const resultsTitleEl = document.getElementById('results-title');
    const resultsSummaryEl = document.getElementById('results-summary');
    const resultsListEl = document.getElementById('results-list');
    const questionFeedbackEl = document.getElementById('question-feedback');

    const categoryStatsTitleEl = document.getElementById('category-stats-title');
    const categoryStatsCarouselEl = document.getElementById('category-stats-carousel');
    const prevStatBtn = document.getElementById('prev-stat-btn');
    const nextStatBtn = document.getElementById('next-stat-btn');
    const statSlideIndicatorEl = document.getElementById('stat-slide-indicator');
    const categoryStatsSlideContentEl = document.getElementById('category-stats-slide-content');

    // Elementy pre varovné modálne okno
    const warningModal = document.getElementById('warning-modal');
    const warningModalTitle = document.getElementById('warning-modal-title');
    const warningModalText = document.getElementById('warning-modal-text');
    const warningConfirmBtn = document.getElementById('warning-confirm-btn');
    const warningCancelBtn = document.getElementById('warning-cancel-btn');


    let areaStatsGlobal = {};
    let categoryStatKeys = [];
    let currentCategoryStatIndex = 0;

    const uiStrings = {
        sk: {
            pageTitleTest: "Test z Matematiky", mainTitleTest: "Matematický Test",
            startTest: "Začať Test", loadingTest: "Načítavam...", loadingQuestions: "Načítavam otázky...",
            errorLoadingQuestions: "Chyba pri načítaní otázok. Skúste to znova neskôr.", noQuestions: "Nepodarilo sa načítať žiadne otázky alebo sú prázdne.",
            yourAttempt: "Toto je váš pokus č.", question: "Otázka", of: "z", yourAnswer: "Vaša odpoveď:",
            pleaseAnswer: "Prosím, zadajte odpoveď.", answerCorrect: "Vaša odpoveď je SPRÁVNA.", answerIncorrect: "Vaša odpoveď je NESPRÁVNA.",
            correctAnswerIs: "Správna odpoveď:", timeTaken: "Čas:", secondsSuffix: "s.", resultsTitle: "Výsledky Testu",
            totalScore: "Celkové skóre:", questionsSuffix: "otázok", startNewTest: "Začať Nový Test", switchToEnglish: "Switch to English",
            switchToSlovak: "Slovenčina", questionTextLabel: "Otázka:", yourAnswerLabel: "Vaša odpoveď:", correctAnswerLabel: "Správna odpoveď:",
            correctTag: "(Správne)", incorrectTag: "(Nesprávne)", timeLabel: "Čas:",
            confirmAnswer: "Potvrdiť", nextQuestion: "Ďalšia otázka",
            pleaseSelectAnswer: "Prosím, vyberte jednu z možností.", pleaseWriteAnswer: "Prosím, vpíšte odpoveď.",
            categoryStatsTitle: "Štatistika podľa oblastí:", correctOutOfInArea: "Správne",
            questionsInAreaShort: "otázok", reviseFollowing: "Odporúčame zopakovať z tejto oblasti:",
            allCorrectInArea: "Výborne! Všetky otázky z tejto oblasti boli zodpovedané správne.",
            statCarouselIndicatorText: "Oblasť",
            errorInitializingTest: "Chyba: Nepodarilo sa inicializovať test na serveri. Výsledky nebudú uložené.",
            errorCommunicationInitializingTest: "Chyba komunikácie pri inicializácii testu.",
            notLoggedInNoSave: "Používateľ nie je prihlásený, test nebude ukladaný na server.",
            testResultsSaved: "Výsledky testu úspešne uložené na server.",
            errorSavingTestResults: "Nepodarilo sa uložiť výsledky testu na server.",
            errorCommunicationSavingTest: "Chyba komunikácie pri ukladaní výsledkov testu.",
            categoryLabel: "Kategória:",
            backBtn: "Opustiť test",
            uncategorizedArea: "Neurčená kategória",
            warningModalTitle: "Upozornenie",
            warningConfirmBtn: "Pokračovať",
            warningCancelBtn: "Zrušiť",
            warningRepeatingQuestionsAll: `Všetky dostupné otázky už boli zodpovedané. Test bude obsahovať ${MAX_QUESTIONS_PER_TEST} opakovaných otázok. Prajete si pokračovať?`,
            warningRepeatingQuestionsPartial: `Nie je dostatok nových otázok na zostavenie testu (${MAX_QUESTIONS_PER_TEST} otázok). Prajete si doplniť test o už zodpovedané otázky?`,
            noQuestionsWillingly: "Test nemôže začať, pretože neboli vybrané žiadne otázky podľa vašej voľby.",
            noNewQuestionsAvailable: "Momentálne nie sú k dispozícii žiadne nové otázky, ktoré by ste ešte nezodpovedali."
        },
        en: {
            pageTitleTest: "Mathematics Test", mainTitleTest: "Mathematics Test",
            startTest: "Start Test", loadingTest: "Loading...", loadingQuestions: "Loading questions...",
            errorLoadingQuestions: "Error loading questions. Please try again later.", noQuestions: "No questions found or questions are empty.",
            yourAttempt: "This is your attempt no.", question: "Question", of: "of", yourAnswer: "Your answer:",
            pleaseAnswer: "Please enter an answer.", answerCorrect: "Your answer is CORRECT.", answerIncorrect: "Your answer is INCORRECT.",
            correctAnswerIs: "Correct answer:", timeTaken: "Time:", secondsSuffix: "s.", resultsTitle: "Test Results",
            totalScore: "Total score:", questionsSuffix: "questions", startNewTest: "Start New Test", switchToEnglish: "English",
            switchToSlovak: "Prepnúť na Slovenčinu", questionTextLabel: "Question:", yourAnswerLabel: "Your answer:", correctAnswerLabel: "Correct answer:",
            correctTag: "(Correct)", incorrectTag: "(Incorrect)", timeLabel: "Time:",
            confirmAnswer: "Confirm", nextQuestion: "Next Question",
            pleaseSelectAnswer: "Please select an option.", pleaseWriteAnswer: "Please write your answer.",
            categoryStatsTitle: "Statistics by Area:", correctOutOfInArea: "Correct",
            questionsInAreaShort: "questions", reviseFollowing: "We recommend revising the following from this area:",
            allCorrectInArea: "Excellent! All questions in this area were answered correctly.",
            statCarouselIndicatorText: "Area",
            errorInitializingTest: "Error: Could not initialize test on the server. Results will not be saved.",
            errorCommunicationInitializingTest: "Communication error during test initialization.",
            notLoggedInNoSave: "User not logged in, test results will not be saved to the server.",
            testResultsSaved: "Test results successfully saved to the server.",
            errorSavingTestResults: "Failed to save test results to the server.",
            errorCommunicationSavingTest: "Communication error when saving test results.",
            categoryLabel: "Category:",
            backBtn: "Abandon Test",
            uncategorizedArea: "Uncategorized",
            warningModalTitle: "Warning",
            warningConfirmBtn: "Continue",
            warningCancelBtn: "Cancel",
            warningRepeatingQuestionsAll: `All available questions have been answered. The test will contain ${MAX_QUESTIONS_PER_TEST} repeated questions. Do you wish to continue?`,
            warningRepeatingQuestionsPartial: `Not enough new questions to make a test of ${MAX_QUESTIONS_PER_TEST} questions. Do you want to fill the test with previously answered questions?`,
            noQuestionsWillingly: "The test cannot start as no questions were selected based on your choice.",
            noNewQuestionsAvailable: "There are currently no new questions available that you haven't answered yet."
        }
    };

    function t(key) { return uiStrings[currentLanguage][key] || key; }

    function updateUIText() {
        document.documentElement.lang = currentLanguage;
        document.title = t('pageTitleTest');
        mainTitleElTest.textContent = t('mainTitleTest');
        if (toggleLangBtn) {
            toggleLangBtn.textContent = currentLanguage === 'sk' ? t('switchToEnglish') : t('switchToSlovak');
        }
        if (startTestBtn.style.display !== 'none') startTestBtn.textContent = t('startTest');
        confirmAnswerBtn.textContent = t('confirmAnswer');
        backBtn.textContent = t('backBtn');
        nextQuestionBtn.textContent = t('nextQuestion');
        questionLabelEl.textContent = t('question');
        ofLabelEl.textContent = t('of');
        yourAnswerLabelEl.textContent = t('yourAnswer');
        resultsTitleEl.textContent = t('resultsTitle');
        if (categoryStatsCarouselEl.style.display !== 'none') {
            categoryStatsTitleEl.textContent = t('categoryStatsTitle');
        }
        // Dynamické texty pre warning modál (ak by sa menili počas zobrazenia, čo nie je bežné)
        // warningConfirmBtn a warningCancelBtn texty sa nastavujú pri zobrazení modálu
        // Texty pre warningRepeatingQuestionsAll/Partial sa aktualizujú tu, aby mali správny MAX_QUESTIONS_PER_TEST
        uiStrings.sk.warningRepeatingQuestionsAll = `Všetky dostupné otázky už boli zodpovedané. Test bude obsahovať ${MAX_QUESTIONS_PER_TEST} opakovaných otázok. Prajete si pokračovať?`;
        uiStrings.sk.warningRepeatingQuestionsPartial = `Nie je dostatok nových otázok na zostavenie testu (${MAX_QUESTIONS_PER_TEST} otázok). Prajete si doplniť test o už zodpovedané otázky?`;
        uiStrings.en.warningRepeatingQuestionsAll = `All available questions have been answered. The test will contain ${MAX_QUESTIONS_PER_TEST} repeated questions. Do you wish to continue?`;
        uiStrings.en.warningRepeatingQuestionsPartial = `Not enough new questions to make a test of ${MAX_QUESTIONS_PER_TEST} questions. Do you want to fill the test with previously answered questions?`;

    }

    function getUserLocation() {
        return new Promise(resolve => {
            resolve({ city: "Nezistené", country: "Nezistené" });
        });
    }

    function loadTestAttempts() { return localStorage.getItem(localStorageKeyAttempts) ? parseInt(localStorage.getItem(localStorageKeyAttempts)) : 0; }
    function saveTestAttempts(attempts) { localStorage.setItem(localStorageKeyAttempts, attempts); }

    function loadAnsweredQuestionIds() {
        const stored = localStorage.getItem(localStorageKeyAnsweredQuestions);
        return stored ? new Set(JSON.parse(stored).map(String)) : new Set();
    }

    function saveAnsweredQuestionIds(answeredIdsSet) {
        localStorage.setItem(localStorageKeyAnsweredQuestions, JSON.stringify(Array.from(answeredIdsSet)));
    }

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function showAsyncWarningModal(message, title) {
        return new Promise((resolve) => {
            const confirmButtonInModal = document.getElementById('warning-confirm-btn');
            const cancelButtonInModal = document.getElementById('warning-cancel-btn');

            warningModalTitle.textContent = title;
            warningModalText.textContent = message;
            confirmButtonInModal.textContent = t('warningConfirmBtn');
            cancelButtonInModal.textContent = t('warningCancelBtn');
            const confirmClickHandler = () => {
                warningModal.style.display = 'none';
                confirmButtonInModal.removeEventListener('click', confirmClickHandler);
                cancelButtonInModal.removeEventListener('click', cancelClickHandler);
                resolve(true);
            };

            const cancelClickHandler = () => {
                warningModal.style.display = 'none';
                confirmButtonInModal.removeEventListener('click', confirmClickHandler);
                cancelButtonInModal.removeEventListener('click', cancelClickHandler);
                resolve(false);
            };

            const newConfirmBtn = confirmButtonInModal.cloneNode(true); // Klonujeme text tlačidla tiež
            confirmButtonInModal.parentNode.replaceChild(newConfirmBtn, confirmButtonInModal);

            const newCancelBtn = cancelButtonInModal.cloneNode(true); // Klonujeme text tlačidla tiež
            cancelButtonInModal.parentNode.replaceChild(newCancelBtn, cancelButtonInModal);
            newConfirmBtn.addEventListener('click', confirmClickHandler);
            newCancelBtn.addEventListener('click', cancelClickHandler);
            warningModal.style.display = 'block';
        });
    }


    startTestBtn.addEventListener('click', async () => {
        startTestBtn.disabled = true;
        startTestBtn.textContent = t('loadingQuestions');
        questionFeedbackEl.style.display = 'none';
        questionFeedbackEl.className = 'feedback';

        currentUserApiToken = localStorage.getItem('apiToken');
        currentUserId = localStorage.getItem('userId'); // Načítame userId pre prípadné použitie

        try {
            if (allQuestionsFromApi.length === 0) {
                const response = await fetch(apiBase + 'questions');
                if (!response.ok) throw new Error(`${t('errorLoadingQuestions')} Status: ${response.status}`);
                allQuestionsFromApi = await response.json();
            }

            if (!allQuestionsFromApi || allQuestionsFromApi.length === 0) {
                questionFeedbackEl.textContent = t('noQuestions');
                questionFeedbackEl.className = 'feedback info';
                questionFeedbackEl.style.display = 'block';
                startTestBtn.disabled = false;
                startTestBtn.textContent = t('startTest');
                return;
            }

            let answeredQuestionIds = loadAnsweredQuestionIds();
            let uniqueQuestions = allQuestionsFromApi.filter(q => !answeredQuestionIds.has(String(q.id)));
            let questionsForThisTest = [];

            if (uniqueQuestions.length >= MAX_QUESTIONS_PER_TEST) {
                shuffleArray(uniqueQuestions);
                questionsForThisTest = uniqueQuestions.slice(0, MAX_QUESTIONS_PER_TEST);
            } else {
                if (uniqueQuestions.length > 0) {
                    shuffleArray(uniqueQuestions);
                    questionsForThisTest.push(...uniqueQuestions);
                }

                const remainingNeeded = MAX_QUESTIONS_PER_TEST - questionsForThisTest.length;
                if (remainingNeeded > 0) {
                    let needsWarning = false;
                    let warningMessageKey = '';

                    if (uniqueQuestions.length === 0 && allQuestionsFromApi.length > 0 && answeredQuestionIds.size >= allQuestionsFromApi.length) {
                        needsWarning = true;
                        warningMessageKey = 'warningRepeatingQuestionsAll';
                    } else if (questionsForThisTest.length < MAX_QUESTIONS_PER_TEST && allQuestionsFromApi.length > questionsForThisTest.length && allQuestionsFromApi.length > uniqueQuestions.length) {
                        needsWarning = true;
                        warningMessageKey = 'warningRepeatingQuestionsPartial';
                    }

                    if (needsWarning) {
                        const userConfirmed = await showAsyncWarningModal(t(warningMessageKey), t('warningModalTitle'));
                        if (userConfirmed) {
                            let poolForRepetition = allQuestionsFromApi.filter(q =>
                                !questionsForThisTest.map(qt => String(qt.id)).includes(String(q.id))
                            );
                            shuffleArray(poolForRepetition);
                            questionsForThisTest.push(...poolForRepetition.slice(0, remainingNeeded));
                        } else {
                            if (questionsForThisTest.length === 0) {
                                questionFeedbackEl.textContent = t('noQuestionsWillingly');
                                questionFeedbackEl.className = 'feedback info';
                                questionFeedbackEl.style.display = 'block';
                                startTestBtn.disabled = false;
                                startTestBtn.textContent = t('startTest');
                                questionContainer.style.display = 'none';
                                return;
                            }
                        }
                    } else if (remainingNeeded > 0) { // Automaticky doplniť ak varovanie nebolo potrebné
                        let poolForCompletion = allQuestionsFromApi.filter(q =>
                            !questionsForThisTest.map(qt => String(qt.id)).includes(String(q.id))
                        );
                        shuffleArray(poolForCompletion);
                        questionsForThisTest.push(...poolForCompletion.slice(0, remainingNeeded));
                    }
                }
            }

            // Deduplikácia a finálna kontrola
            const finalQuestionIds = new Set();
            allQuestions = questionsForThisTest.filter(q => {
                if (q && q.id && !finalQuestionIds.has(String(q.id))) { // Kontrola, či q a q.id existujú
                    finalQuestionIds.add(String(q.id));
                    return true;
                }
                return false;
            });


            if (allQuestions.length === 0) {
                questionFeedbackEl.textContent = (uniqueQuestions.length === 0 && answeredQuestionIds.size > 0 && answeredQuestionIds.size >= allQuestionsFromApi.length) ? t('noNewQuestionsAvailable') : t('noQuestions');
                questionFeedbackEl.className = 'feedback info';
                questionFeedbackEl.style.display = 'block';
                startTestBtn.disabled = false;
                startTestBtn.textContent = t('startTest');
                questionContainer.style.display = 'none';
                return;
            }

            currentTestId = null;
            if (currentUserApiToken && currentUserId) { // Stále kontrolujeme currentUserId pre logiku klienta
                const location = await getUserLocation();
                try {
                    // Predpokladáme, že API (/tests/start) berie user_id z tokenu, nie z tela
                    const startTestResponse = await fetch(apiBase + 'tests/start', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + currentUserApiToken
                        },
                        body: JSON.stringify({ city: location.city, country: location.country }) // Bez user_id v tele
                    });
                    const startTestData = await startTestResponse.json();
                    if (startTestResponse.ok && startTestData.test_id) {
                        currentTestId = startTestData.test_id;
                        console.log('Test inicializovaný s ID:', currentTestId);
                        questionFeedbackEl.style.display = 'none'; // Skryť predchádzajúce info správy
                    } else {
                        console.error('Nepodarilo sa inicializovať test na backende:', startTestData.error || startTestData.message || 'Neznáma chyba API');
                        questionFeedbackEl.textContent = t('errorInitializingTest') + ` (${startTestData.error || startTestData.message || ''})`;
                        questionFeedbackEl.className = 'feedback error';
                        questionFeedbackEl.style.display = 'block';
                    }
                } catch (initError) {
                    console.error('Chyba pri komunikácii pre inicializáciu testu:', initError);
                    questionFeedbackEl.textContent = t('errorCommunicationInitializingTest');
                    questionFeedbackEl.className = 'feedback error';
                    questionFeedbackEl.style.display = 'block';
                }
            } else {
                console.log(t('notLoggedInNoSave'));
                questionFeedbackEl.textContent = t('notLoggedInNoSave');
                questionFeedbackEl.className = 'feedback info';
                questionFeedbackEl.style.display = 'block';
            }

            testAttemptNumber = loadTestAttempts() + 1;
            saveTestAttempts(testAttemptNumber);
            attemptInfoDisplayEl.textContent = `${t('yourAttempt')} ${testAttemptNumber}.`;
            attemptInfoDisplayEl.style.display = 'block';
            currentQuestionIndex = 0;
            userAnswers = [];
            totalQuestionsEl.textContent = allQuestions.length;
            startTestBtn.style.display = 'none';
            testResultsArea.style.display = 'none';
            resultsListEl.innerHTML = '';
            resultsSummaryEl.innerHTML = '';
            questionContainer.style.display = 'block';
            progressInfoDisplayEl.style.display = 'block';
            categoryStatsCarouselEl.style.display = 'none';
            categoryStatsTitleEl.style.display = 'none';
            categoryStatsSlideContentEl.innerHTML = '';

            displayQuestion();

        } catch (error) {
            console.error("Error loading or preparing questions:", error);
            questionTextEl.textContent = `${error.message || t('errorLoadingQuestions')}`;
            startTestBtn.disabled = false;
            startTestBtn.textContent = t('startTest');
            questionContainer.style.display = 'none';
        }
    });

    function displayQuestion() {
        if (currentQuestionIndex < allQuestions.length) {
            const question = allQuestions[currentQuestionIndex];
            const questionTextKey = currentLanguage === 'sk' ? 'text_sk' : 'text_en';
            let rawText = question[questionTextKey] || question['text_sk'];
            let questionType = "WA";
            if (rawText.startsWith("MC:")) { questionType = "MC"; rawText = rawText.substring(3).trim(); }
            else if (rawText.startsWith("WA:")) { questionType = "WA"; rawText = rawText.substring(3).trim(); }

            let categoryNameToDisplay;
            if (currentLanguage === 'en' && question.area_en) {
                categoryNameToDisplay = question.area_en;
            } else if (currentLanguage === 'sk' && question.area) {
                categoryNameToDisplay = question.area;
            } else {
                categoryNameToDisplay = question.area || question.area_en || t('uncategorizedArea');
            }
            questionCategoryDisplayEl.textContent = `${t('categoryLabel')} ${categoryNameToDisplay}`;
            questionCategoryDisplayEl.style.display = 'block';

            selectedMcOptionValue = null; selectedMcOptionElement = null;
            mcOptionsContainer.innerHTML = '';
            answerSectionWA.style.display = 'none';
            mcOptionsContainer.style.display = 'none';
            confirmAnswerBtn.style.display = 'block';
            nextQuestionBtn.style.display = 'none';

            if(!(questionFeedbackEl.classList.contains('error') && questionFeedbackEl.textContent.startsWith(t('errorInitializingTest'))) &&
                !(questionFeedbackEl.classList.contains('info') && questionFeedbackEl.textContent === t('notLoggedInNoSave'))) {
                questionFeedbackEl.style.display = 'none';
                questionFeedbackEl.textContent = '';
                questionFeedbackEl.className = 'feedback';
            }

            correctAnswerWaDisplayEl.style.display = 'none'; correctAnswerWaDisplayEl.textContent = '';
            answerInputEl.value = ''; answerInputEl.disabled = false;
            answerInputEl.classList.remove('user-correct', 'user-incorrect');
            confirmAnswerBtn.disabled = false; confirmAnswerBtn.textContent = t('confirmAnswer');

            if (questionType === "MC") {
                const parts = rawText.split("---");
                questionTextEl.innerHTML = parts[0].trim();
                if (parts.length > 1) {
                    const options = parts[1].trim().split(/[\r\n]+(?=[A-Z]\))/).map(opt => opt.trim()).filter(opt => opt.length > 0);
                    options.forEach(optionText => {
                        const optionButton = document.createElement('button');
                        const match = optionText.match(/^([A-Z])\)\s*(.*)/s);
                        if (match) {
                            optionButton.dataset.value = match[1]; optionButton.innerHTML = optionText;
                            optionButton.classList.add('mc-option-button');
                            optionButton.onclick = () => selectMcOption(optionButton, match[1]);
                            mcOptionsContainer.appendChild(optionButton);
                        }
                    });
                }
                mcOptionsContainer.style.display = 'block';
            } else {
                questionTextEl.innerHTML = rawText.trim();
                answerSectionWA.style.display = 'block';
                answerInputEl.focus();
            }
            currentQuestionNumberEl.textContent = currentQuestionIndex + 1;
            questionStartTime = new Date();
        } else {
            finishTest(true);
        }
    }

    function selectMcOption(buttonElement, optionValue) {
        if (confirmAnswerBtn.disabled) return;
        if (selectedMcOptionElement) { selectedMcOptionElement.classList.remove('marked'); }
        buttonElement.classList.add('marked');
        selectedMcOptionValue = optionValue; selectedMcOptionElement = buttonElement;
    }

    confirmAnswerBtn.addEventListener('click', () => {
        const timeTaken = (new Date() - questionStartTime) / 1000;
        let userAnswer, questionType;
        const currentQuestion = allQuestions[currentQuestionIndex];
        const questionTextKey = currentLanguage === 'sk' ? 'text_sk' : 'text_en';
        let questionIdentifierText = currentQuestion[questionTextKey] || currentQuestion['text_sk'];

        if (questionIdentifierText.startsWith("MC:")) {
            questionType = "MC";
            if (!selectedMcOptionValue) {
                if (!questionFeedbackEl.textContent.startsWith(t('errorInitializingTest'))) { // Aby sa neprepisala chyba inicializacie
                    questionFeedbackEl.textContent = t('pleaseSelectAnswer');
                    questionFeedbackEl.className = 'feedback info'; questionFeedbackEl.style.display = 'block';
                }
                return;
            }
            userAnswer = selectedMcOptionValue;
        } else {
            questionType = "WA"; userAnswer = answerInputEl.value.trim();
            if (userAnswer === "") {
                if (!questionFeedbackEl.textContent.startsWith(t('errorInitializingTest'))) {
                    questionFeedbackEl.textContent = t('pleaseWriteAnswer');
                    questionFeedbackEl.className = 'feedback info'; questionFeedbackEl.style.display = 'block';
                }
                return;
            }
        }

        // Ak bola predtým zobrazená globálna správa (napr. o neprihlásení), skryjeme ju pred zobrazením spätnej väzby k odpovedi
        if (questionFeedbackEl.classList.contains('info') &&
            (questionFeedbackEl.textContent === t('notLoggedInNoSave') || questionFeedbackEl.textContent.startsWith(t('errorInitializingTest')) )) {
            // Ponecháme tieto dôležité správy, ale ďalšia spätná väzba sa zobrazí pod nimi alebo ich nahradí, ak to tak má byť.
            // Pre teraz, odpoveď k otázke bude prioritná.
        }


        confirmAnswerBtn.disabled = true; answerInputEl.disabled = true;
        Array.from(mcOptionsContainer.children).forEach(btn => btn.disabled = true);

        const correctAnswerOriginal = String(currentQuestion.correct_answer).trim();
        let userAnswerNormalized = String(userAnswer).trim().replace(',', '.');
        let isCorrect = false;

        if (questionType === "MC") {
            isCorrect = userAnswerNormalized.toLowerCase() === correctAnswerOriginal.toLowerCase();
        } else {
            const correctAnswerNormalizedForWA = correctAnswerOriginal.replace(',', '.');
            const userAnswerNum = parseFloat(userAnswerNormalized);
            const correctAnswerNum = parseFloat(correctAnswerNormalizedForWA);

            if (!isNaN(userAnswerNum) && !isNaN(correctAnswerNum)) {
                const userAnswerRounded = Number(userAnswerNum.toFixed(2));
                const correctAnswerRounded = Number(correctAnswerNum.toFixed(2));
                isCorrect = userAnswerRounded === correctAnswerRounded;
            } else {
                isCorrect = userAnswerNormalized.toLowerCase() === correctAnswerNormalizedForWA.toLowerCase();
            }
        }

        userAnswers.push({
            question_id: String(currentQuestion.id),
            text_sk: currentQuestion.text_sk, text_en: currentQuestion.text_en,
            area: currentQuestion.area, area_en: currentQuestion.area_en, // Uložíme obe verzie kategórie
            answer_given: userAnswer, time_taken: timeTaken.toFixed(2),
            correct_answer: currentQuestion.correct_answer, is_correct: isCorrect
        });

        correctAnswerWaDisplayEl.style.display = 'none';
        if (questionType === "MC") {
            if (selectedMcOptionElement) {
                selectedMcOptionElement.classList.remove('marked');
                selectedMcOptionElement.classList.add(isCorrect ? 'user-correct' : 'user-incorrect');
            }
            if (!isCorrect) {
                Array.from(mcOptionsContainer.children).forEach(btn => {
                    if (btn.dataset.value === currentQuestion.correct_answer) { btn.classList.add('actual-correct'); }
                });
            }
        } else {
            answerInputEl.classList.add(isCorrect ? 'user-correct' : 'user-incorrect');
            if (!isCorrect) {
                correctAnswerWaDisplayEl.textContent = `${currentQuestion.correct_answer}`;
                correctAnswerWaDisplayEl.style.display = 'block';
            }
        }

        let feedbackText = `${isCorrect ? t('answerCorrect') : t('answerIncorrect')} <br>`;
        if (!isCorrect && questionType === "MC") { feedbackText += `${t('correctAnswerIs')} ${currentQuestion.correct_answer}.<br>`; }
        feedbackText += `${t('timeTaken')} ${timeTaken.toFixed(2)}${t('secondsSuffix')}`;

        // Zobraziť feedback k odpovedi. Ak bola predtým chyba inicializácie, tá zostane viditeľná.
        if (questionFeedbackEl.classList.contains('error') && questionFeedbackEl.textContent.startsWith(t('errorInitializingTest'))) {
            const existingError = questionFeedbackEl.innerHTML;
            questionFeedbackEl.innerHTML = existingError + "<hr>" + feedbackText; // Pridať feedback pod chybu
        } else {
            questionFeedbackEl.innerHTML = feedbackText;
        }
        questionFeedbackEl.className = `feedback ${isCorrect ? 'correct' : 'incorrect'}`;
        questionFeedbackEl.style.display = 'block';


        confirmAnswerBtn.style.display = 'none';
        nextQuestionBtn.style.display = 'block';
        nextQuestionBtn.textContent = t('nextQuestion');
        nextQuestionBtn.focus();
    });

    nextQuestionBtn.addEventListener('click', () => {
        currentQuestionIndex++;
        // Skryť feedback k predchádzajúcej otázke, iba ak to nebola trvalá chyba alebo info o neprihlásení
        if (!questionFeedbackEl.classList.contains('error') && !questionFeedbackEl.classList.contains('info')) {
            questionFeedbackEl.style.display = 'none';
        } else if (questionFeedbackEl.classList.contains('correct') || questionFeedbackEl.classList.contains('incorrect')) {
            // Ak to bol feedback k odpovedi (correct/incorrect), skryjeme ho.
            // Trvalé error/info správy (napr. o inicializácii, neprihlásení) by mali zostať,
            // alebo by sa mali explicitne manažovať, ak ich chceme skryť.
            // Pre jednoduchosť, ak to nie je globálny error/info, skryjeme.
            if (questionFeedbackEl.textContent.startsWith(t('answerCorrect')) || questionFeedbackEl.textContent.startsWith(t('answerIncorrect'))){
                questionFeedbackEl.style.display = 'none';
            }
        }
        displayQuestion();
    });

    function getDisplayedAreaName(area, area_en) {
        let name;
        if (currentLanguage === 'en' && area_en) {
            name = area_en;
        } else if (currentLanguage === 'sk' && area) {
            name = area;
        } else {
            name = area || area_en || t('uncategorizedArea');
        }
        return name;
    }


    function createCategoryStatElement(areaKey, stats) { // areaKey je napr. slovenský názov
        const itemDiv = document.createElement('div'); itemDiv.classList.add('category-stat-item');

        // Nájdeme prvú otázku s týmto areaKey, aby sme získali area_en pre zobrazenie
        const sampleQuestionForArea = allQuestionsFromApi.find(q => q.area === areaKey);
        const areaForDisplay = getDisplayedAreaName(areaKey, sampleQuestionForArea?.area_en);

        const titleH4 = document.createElement('h4'); titleH4.textContent = areaForDisplay; itemDiv.appendChild(titleH4);
        const summaryP = document.createElement('p'); summaryP.classList.add('category-stat-summary');
        summaryP.textContent = `${t('correctOutOfInArea')} ${stats.correct} ${t('of')} ${stats.total} ${t('questionsInAreaShort')}.`;
        itemDiv.appendChild(summaryP);
        const progressBarContainer = document.createElement('div'); progressBarContainer.classList.add('progress-bar-container');
        const progressBarCorrect = document.createElement('div'); progressBarCorrect.classList.add('progress-bar-correct');
        const percentageCorrect = (stats.total > 0) ? (stats.correct / stats.total) * 100 : 0;
        setTimeout(() => { progressBarCorrect.style.width = percentageCorrect.toFixed(1) + '%'; }, 50);
        progressBarCorrect.textContent = `${percentageCorrect.toFixed(0)}% (${stats.correct}/${stats.total})`;
        progressBarContainer.appendChild(progressBarCorrect); itemDiv.appendChild(progressBarContainer);
        if (stats.questionsToReviseText.length > 0) {
            const reviseTitleP = document.createElement('p'); reviseTitleP.innerHTML = `<strong>${t('reviseFollowing')}</strong>`; itemDiv.appendChild(reviseTitleP);
            const reviseListUl = document.createElement('ul'); reviseListUl.classList.add('revise-questions-list');
            stats.questionsToReviseText.forEach(qTextInfo => { // qTextInfo je teraz objekt
                const li = document.createElement('li');
                li.textContent = (currentLanguage === 'en' && qTextInfo.en) ? qTextInfo.en : qTextInfo.sk;
                reviseListUl.appendChild(li);
            });
            itemDiv.appendChild(reviseListUl);
        } else if (stats.total > 0) {
            const allCorrectP = document.createElement('p'); allCorrectP.classList.add('all-correct-message');
            allCorrectP.textContent = t('allCorrectInArea'); itemDiv.appendChild(allCorrectP);
        }
        return itemDiv;
    }

    function displayCurrentCategoryStat() {
        if (categoryStatKeys.length === 0) {
            categoryStatsCarouselEl.style.display = 'none'; categoryStatsTitleEl.style.display = 'none'; return;
        }
        categoryStatsCarouselEl.style.display = 'block'; categoryStatsTitleEl.style.display = 'block';
        categoryStatsTitleEl.textContent = t('categoryStatsTitle');
        const currentAreaKey = categoryStatKeys[currentCategoryStatIndex];
        const stats = areaStatsGlobal[currentAreaKey];
        categoryStatsSlideContentEl.innerHTML = '';
        if (stats) {
            categoryStatsSlideContentEl.appendChild(createCategoryStatElement(currentAreaKey, stats));
        }
        statSlideIndicatorEl.textContent = `${t('statCarouselIndicatorText')} ${currentCategoryStatIndex + 1} / ${categoryStatKeys.length}`;
        prevStatBtn.disabled = currentCategoryStatIndex === 0;
        nextStatBtn.disabled = currentCategoryStatIndex === categoryStatKeys.length - 1;
    }

    prevStatBtn.addEventListener('click', () => { if (currentCategoryStatIndex > 0) { currentCategoryStatIndex--; displayCurrentCategoryStat(); }});
    nextStatBtn.addEventListener('click', () => { if (currentCategoryStatIndex < categoryStatKeys.length - 1) { currentCategoryStatIndex++; displayCurrentCategoryStat(); }});

    async function finishTest(isNewCompletion) {
        questionContainer.style.display = 'none'; progressInfoDisplayEl.style.display = 'none';
        confirmAnswerBtn.style.display = 'none'; nextQuestionBtn.style.display = 'none';
        questionCategoryDisplayEl.style.display = 'none';

        if (questionFeedbackEl.classList.contains('correct') || questionFeedbackEl.classList.contains('incorrect')) {
            if (questionFeedbackEl.textContent.startsWith(t('answerCorrect')) || questionFeedbackEl.textContent.startsWith(t('answerIncorrect'))){
                questionFeedbackEl.style.display = 'none'; // Skryť feedback k poslednej odpovedi
            }
        }


        testResultsArea.style.display = 'block'; resultsListEl.innerHTML = '';

        let correctCount = 0;
        let answeredQuestionIdsThisTest = loadAnsweredQuestionIds();

        userAnswers.forEach(ans => {
            if(ans.is_correct) correctCount++;
            answeredQuestionIdsThisTest.add(String(ans.question_id));

            const listItem = document.createElement('li');
            let qTextInCurrentLang = (currentLanguage === 'en' && ans.text_en) ? ans.text_en : ans.text_sk;
            const displayedAreaNameInResults = getDisplayedAreaName(ans.area, ans.area_en);


            if (qTextInCurrentLang.startsWith("MC:")) qTextInCurrentLang = qTextInCurrentLang.substring(3).split("---")[0].trim();
            else if (qTextInCurrentLang.startsWith("WA:")) qTextInCurrentLang = qTextInCurrentLang.substring(3).trim();

            listItem.innerHTML = `<strong>${t('questionTextLabel')}</strong> ${qTextInCurrentLang}<br><small style="color:#555;"><em>${t('categoryLabel')} ${displayedAreaNameInResults}</em></small><br><strong>${t('yourAnswerLabel')}</strong> ${ans.answer_given} ${ans.is_correct ? `<span style="color:green;">${t('correctTag')}</span>` : `<span style="color:red;">${t('incorrectTag')}</span>`}<br>${!ans.is_correct ? `<strong>${t('correctAnswerLabel')}</strong> <span class="correct-answer-display">${ans.correct_answer}</span><br>` : ''}<strong>${t('timeLabel')}</strong> ${ans.time_taken}${t('secondsSuffix')}`;
            resultsListEl.appendChild(listItem);
        });
        saveAnsweredQuestionIds(answeredQuestionIdsThisTest);

        resultsSummaryEl.innerHTML = `<p><strong>${t('totalScore')} ${correctCount} ${t('of')} ${allQuestions.length} ${t('questionsSuffix')}.</strong></p>`;

        if (currentUserApiToken && currentUserId && currentTestId && userAnswers.length > 0) {
            const questionsForApi = userAnswers.map(ans => ({
                question_id: parseInt(ans.question_id),
                answered_correctly: ans.is_correct,
                time_taken: parseFloat(ans.time_taken)
            }));
            const location = await getUserLocation();
            const testDataPayload = {
                test_id: currentTestId, // Predpokladáme, že backend použije toto ID na finalizáciu testu
                city: location.city,
                country: location.country,
                questions: questionsForApi
                // Ak backend stále vyžaduje user_id v tele, treba ho pridať:
                // user_id: parseInt(currentUserId)
            };

            try {
                console.log("Odosielam výsledky testu:", JSON.stringify(testDataPayload, null, 2));
                const storeTestResponse = await fetch(apiBase + 'tests', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Authorization': 'Bearer ' + currentUserApiToken },
                    body: JSON.stringify(testDataPayload)
                });
                const storeTestData = await storeTestResponse.json();
                // API môže vracať rôzne success správy, prispôsobiť podľa potreby
                if (storeTestResponse.ok && (storeTestData.test_id || storeTestData.message === "Test and answers stored successfully.")) {
                    console.log(t('testResultsSaved'), storeTestData);
                    questionFeedbackEl.textContent = t('testResultsSaved');
                    questionFeedbackEl.className = 'feedback correct'; // Zmena na correct pre úspešné uloženie
                    questionFeedbackEl.style.display = 'block';
                } else {
                    console.error(t('errorSavingTestResults'), storeTestData.error || storeTestData.message || 'Neznáma chyba API');
                    if (!questionFeedbackEl.textContent.startsWith(t('errorInitializingTest'))) { // Aby sme neprepisovali pôvodnú chybu
                        questionFeedbackEl.textContent = `${t('errorSavingTestResults')}: ${storeTestData.error || storeTestData.message || ''}`;
                        questionFeedbackEl.className = 'feedback error';
                        questionFeedbackEl.style.display = 'block';
                    }
                }
            } catch (storeError) {
                console.error(t('errorCommunicationSavingTest'), storeError);
                if (!questionFeedbackEl.textContent.startsWith(t('errorInitializingTest'))) {
                    questionFeedbackEl.textContent = t('errorCommunicationSavingTest');
                    questionFeedbackEl.className = 'feedback error';
                    questionFeedbackEl.style.display = 'block';
                }
            }
        } else if (userAnswers.length > 0 && !(currentUserApiToken && currentUserId)) {
            // Správa o neprihlásení by už mala byť zobrazená
            console.log(t('notLoggedInNoSave'));
        }


        areaStatsGlobal = {};
        if (userAnswers.length > 0) {
            userAnswers.forEach(ans => {
                const area = ans.area; // Použijeme SK verziu ako kľúč pre areaStatsGlobal
                if (!areaStatsGlobal[area]) { areaStatsGlobal[area] = { correct: 0, total: 0, questionsToReviseText: [] };}
                areaStatsGlobal[area].total++;
                if (ans.is_correct) { areaStatsGlobal[area].correct++; }
                else {
                    let qTextSk = ans.text_sk;
                    if (qTextSk.startsWith("MC:")) qTextSk = qTextSk.substring(3).split("---")[0].trim();
                    else if (qTextSk.startsWith("WA:")) qTextSk = qTextSk.substring(3).trim();
                    qTextSk = qTextSk.length > 70 ? qTextSk.substring(0, 67) + "..." : qTextSk;

                    let qTextEn = ans.text_en;
                    if (qTextEn && qTextEn.startsWith("MC:")) qTextEn = qTextEn.substring(3).split("---")[0].trim();
                    else if (qTextEn && qTextEn.startsWith("WA:")) qTextEn = qTextEn.substring(3).trim();
                    qTextEn = qTextEn && qTextEn.length > 70 ? qTextEn.substring(0, 67) + "..." : qTextEn;

                    areaStatsGlobal[area].questionsToReviseText.push({sk: qTextSk, en: qTextEn});
                }
            });
        }
        categoryStatKeys = Object.keys(areaStatsGlobal);
        if (categoryStatKeys.length > 0) {
            currentCategoryStatIndex = 0;
            displayCurrentCategoryStat();
        } else {
            categoryStatsCarouselEl.style.display = 'none';
            categoryStatsTitleEl.style.display = 'none';
        }

        if(isNewCompletion){
            startTestBtn.style.display = 'block';
            startTestBtn.disabled = false;
            startTestBtn.textContent = t('startNewTest');
            attemptInfoDisplayEl.style.display = 'none';
            // Skryť aj globálne info/error správy pri začatí nového testu, ak nie sú kritické
            if (questionFeedbackEl.classList.contains('info') || questionFeedbackEl.classList.contains('error')) {
                if (questionFeedbackEl.textContent === t('notLoggedInNoSave') ||
                    questionFeedbackEl.textContent.startsWith(t('errorSavingTestResults')) ||
                    questionFeedbackEl.textContent.startsWith(t('errorCommunicationSavingTest')) ||
                    questionFeedbackEl.textContent.startsWith(t('testResultsSaved'))) {
                    questionFeedbackEl.style.display = 'none';
                }
                // Chyby inicializácie necháme, ak by bránili ďalšiemu testu
            }
            console.log("Final answers for this test:", userAnswers);
        }
    }

    toggleLangBtn.addEventListener('click', () => {
        currentLanguage = currentLanguage === 'sk' ? 'en' : 'sk';
        localStorage.setItem('mathTestLanguageHomepage', currentLanguage);
        updateUIText();

        const isQuestionVisible = questionContainer.style.display === 'block' && allQuestions.length > 0 && currentQuestionIndex < allQuestions.length;
        const areResultsVisible = testResultsArea.style.display === 'block';

        if (isQuestionVisible && !areResultsVisible) {
            displayQuestion(); // Prekreslí otázku s novým jazykom kategórie
            // Ak je feedback k odpovedi viditeľný, mohol by sa tiež preložiť, ale je jednoduchšie, že zmizne s ďalšou otázkou
            if (questionFeedbackEl.style.display !== 'none' &&
                (questionFeedbackEl.classList.contains('correct') || questionFeedbackEl.classList.contains('incorrect'))) {
                // Simulujeme klik na next, aby sa zobrazil nový feedback alebo prešlo ďalej,
                // alebo jednoducho preložíme existujúci text, ak je to len "správne/nesprávne"
                // Zatiaľ necháme tak, používateľ aj tak prejde na ďalšiu otázku alebo test dokončí.
            } else if (questionFeedbackEl.style.display !== 'none' && questionFeedbackEl.classList.contains('info')){
                // Preložiť informačné správy ako 'pleaseSelectAnswer' atď.
                // Toto je zložitejšie, lebo by sme museli vedieť, aký kľúč bol použitý.
                // Jednoduchšie je, že tieto správy sú dočasné.
            }


        } else if (areResultsVisible) {
            finishTest(false); // Prekreslí výsledky s novým jazykom
        }
        if (warningModal.style.display === 'block') {
            warningModalTitle.textContent = t('warningModalTitle');
            warningConfirmBtn.textContent = t('warningConfirmBtn');
            warningCancelBtn.textContent = t('warningCancelBtn');
        }
    });

    currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk';
    currentUserApiToken = localStorage.getItem('apiToken');
    currentUserId = localStorage.getItem('userId');
    updateUIText();

</script>
</body>
</html>