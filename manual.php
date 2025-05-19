<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title-manual">Používateľská Príručka</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        .action-btn.primary-action {
            background-color: #198754; /* Green for primary actions */
            color: white;
        }
        .action-btn.primary-action:hover:not(:disabled) { background-color: #157347; }

        .action-btn.secondary-action {
            background-color: #6c757d; /* Gray for secondary actions */
            color: white;
        }
        .action-btn.secondary-action:hover:not(:disabled) { background-color: #5a6268; }

        #manual-content-body h2 {
            font-weight: 500;
            color: #343a40;
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 1.6em;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        #manual-content-body h3 {
            font-weight: 500;
            color: #495057;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 1.3em;
        }
        #manual-content-body p, #manual-content-body li {
            color: #495057;
            margin-bottom: 10px;
        }
        #manual-content-body ul {
            padding-left: 20px;
            list-style-type: disc;
        }
        #manual-content-body strong { /* For emphasized button names etc. */
            color: #0d6efd;
        }
        #manual-content-body code { /* If you use <code> for anything specific */
            background-color: #e9ecef;
            padding: 2px 4px;
            border-radius: 3px;
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace;
        }

        .download-button-container {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        footer.page-footer {
            text-align: center;
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #6c757d;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <button id="toggle-lang-btn-manual" class="lang-btn">English</button>
</div>

<div class="container">
    <header class="page-header">
        <h1 id="manual-main-title">Používateľská Príručka</h1>
    </header>

    <nav class="main-navigation">
        <a href="index.php" id="back-to-home-btn" class="action-btn secondary-action">Späť na Domovskú Stránku</a>
    </nav>

    <div id="manual-content-body">
        <h2 id="manual-intro-heading"></h2>
        <p id="manual-intro-text"></p>

        <h2 id="manual-reglog-heading"></h2>
        <p id="manual-reglog-text"></p>
        <h3 id="manual-reg-heading"></h3>
        <p id="manual-reg-text1"></p>
        <ul>
            <li id="manual-reg-username"></li>
            <li id="manual-reg-password"></li>
            <li id="manual-reg-passconfirm"></li>
        </ul>
        <p id="manual-reg-text2"></p>
        <h3 id="manual-login-heading"></h3>
        <p id="manual-login-text1"></p>
        <p id="manual-login-text2"></p>

        <h2 id="manual-starttest-heading"></h2>
        <p id="manual-starttest-text1"></p>
        <p id="manual-starttest-text2"></p>
        <p id="manual-starttest-text3"></p>

        <h2 id="manual-testprocess-heading"></h2>
        <p id="manual-testprocess-text1"></p>
        <h3 id="manual-testprocess-qdisplay-heading"></h3>
        <p id="manual-testprocess-qdisplay-text"></p>
        <h3 id="manual-testprocess-qtypes-heading"></h3>
        <ul>
            <li id="manual-testprocess-mctype"></li>
            <li id="manual-testprocess-watype"></li>
        </ul>
        <h3 id="manual-testprocess-confirm-heading"></h3>
        <p id="manual-testprocess-confirm-text"></p>
        <h3 id="manual-testprocess-feedback-heading"></h3>
        <p id="manual-testprocess-feedback-text"></p>
        <h3 id="manual-testprocess-nextq-heading"></h3>
        <p id="manual-testprocess-nextq-text"></p>

        <h2 id="manual-results-heading"></h2>
        <p id="manual-results-text1"></p>
        <h3 id="manual-results-contain-heading"></h3>
        <ul>
            <li id="manual-results-overallscore"></li>
            <li>
                <span id="manual-results-statsbyarea-heading"></span>
                <ul>
                    <li id="manual-results-statsbyarea-text1"></li>
                    <li id="manual-results-statsbyarea-text2"></li>
                    <li id="manual-results-statsbyarea-text3"></li>
                    <li id="manual-results-statsbyarea-text4"></li>
                </ul>
            </li>
            <li>
                <span id="manual-results-listofanswers-heading"></span>
                <ul>
                    <li id="manual-results-listofanswers-text1"></li>
                    <li id="manual-results-listofanswers-text2"></li>
                    <li id="manual-results-listofanswers-text3"></li>
                    <li id="manual-results-listofanswers-text4"></li>
                </ul>
            </li>
        </ul>
        <p id="manual-results-savetext"></p>
        <p id="manual-results-nextbutton"></p>

        <h2 id="manual-profile-heading"></h2>
        <p id="manual-profile-text1"></p>
        <h3 id="manual-profile-contains-heading"></h3>
        <ul>
            <li id="manual-profile-userinfo"></li>
            <li id="manual-profile-apitoken"></li>
            <li id="manual-profile-regeneratetoken"></li>
            <li id="manual-profile-testhistory"></li>
            <li id="manual-profile-viewdetails"></li>
        </ul>
        <p id="manual-profile-historyempty"></p>

        <h2 id="manual-langchange-heading"></h2>
        <p id="manual-langchange-text1"></p>
        <p id="manual-langchange-text2"></p>

        <h2 id="manual-pdfdownload-heading"></h2>
        <p id="manual-pdfdownload-text1"></p>
        <p id="manual-pdfdownload-text2"></p>
        <p id="manual-pdfdownload-text3"></p>
    </div>

    <div class="download-button-container">
        <button id="download-pdf-btn" class="action-btn primary-action">Stiahnuť Príručku ako PDF</button>
    </div>

</div> <footer class="page-footer">
    <p>&copy; <span id="current-year-manual"></span> <span id="footer-team-name-manual">WEBTE2</span>. <span id="footer-rights-manual">Všetky práva vyhradené.</span></p>
</footer>

<script>
    const currentYearElManual = document.getElementById('current-year-manual');
    const toggleLangBtnManual = document.getElementById('toggle-lang-btn-manual');
    const downloadPdfBtn = document.getElementById('download-pdf-btn');
    let currentLanguage = localStorage.getItem('mathTestLanguageHomepage') || 'sk';

    const uiStringsManual = {
        sk: {
            pageTitle: "Používateľská Príručka - Testy z Matematiky",
            mainTitle: "Používateľská Príručka",
            backToHome: "Späť na Domovskú Stránku",
            downloadPdfBtnText: "Stiahnuť Príručku ako PDF",

            introHeading: "Úvod",
            introText: "Vitajte v príručke pre aplikáciu Testy z Matematiky. Pomôže vám používať všetky funkcie, od registrácie po výsledky testov.",

            regLogHeading: "Registrácia a Prihlásenie",
            regLogText: "Pre ukladanie histórie testov a prístup k profilu je potrebná registrácia a prihlásenie.",
            regHeading: "Registrácia",
            regText1: "Na domovskej stránke kliknite na <strong>Zaregistrovať sa</strong> a v okne zadajte:",
            regUsername: "Používateľské meno",
            regPassword: "Heslo",
            regPassConfirm: "Potvrdenie hesla",
            regText2: "Po úspešnej registrácii sa prihláste.",
            loginHeading: "Prihlásenie",
            loginText1: "Tlačidlo <strong>Prihlásiť sa</strong> otvorí okno pre zadanie mena a hesla.",
            loginText2: "Po prihlásení sa zobrazí vaše meno a tlačidlo <strong>Odhlásiť sa</strong>; pôvodné tlačidlá sa skryjú.",

            startTestHeading: "Spustenie Testu",
            startTestText1: "Nový test spustíte tlačidlom <strong>Spustiť Nový Test</strong> na domovskej stránke, čím prejdete na stránku testu.",
            startTestText2: "Na stránke testu kliknite na <strong>Začať Test</strong>. Systém vyberie 10 unikátnych otázok. Ak ich je málo, ponúkne doplnenie už zodpovedanými, alebo opakovanie všetkých zodpovedaných.",
            startTestText3: "Prihláseným používateľom sa test inicializuje na serveri pre uloženie výsledkov. Neprihláseným sa výsledky neuložia na server (zobrazia sa len lokálne).",

            testProcessHeading: "Priebeh Testu",
            testProcessText1: "Po spustení sa zobrazí prvá otázka.",
            testProcessQDisplayHeading: "Zobrazenie otázky:",
            testProcessQDisplayText: "Zobrazí sa text otázky, kategória, pokus a postup v teste (napr. Otázka 1 z 10).",
            testProcessQTypesHeading: "Typy otázok:",
            testProcessMCType: "<strong>Multiple Choice (MC):</strong> Vyberte jednu správnu odpoveď kliknutím. Vybraná možnosť sa farebne označí.",
            testProcessWAType: "<strong>Written Answer (WA):</strong> Vpíšte odpoveď do textového poľa.",
            testProcessConfirmHeading: "Potvrdenie odpovede:",
            testProcessConfirmText: "Kliknite na <strong>Potvrdiť</strong>. Bez odpovede sa zobrazí upozornenie.",
            testProcessFeedbackHeading: "Spätná väzba:",
            testProcessFeedbackText: "Po potvrdení sa odpoveď vyhodnotí (správnosť, čas). <strong>MC:</strong> Vaša voľba sa odlíši (zelená/červená). Pri nesprávnej sa zvýrazní správna. <strong>WA:</strong> Textové pole sa odlíši. Pri nesprávnej sa zobrazí správna odpoveď.",
            testProcessNextQHeading: "Ďalšia otázka:",
            testProcessNextQText: "Kliknite na <strong>Ďalšia Otázka</strong> pre pokračovanie.",

            resultsHeading: "Výsledky Testu",
            resultsText1: "Po zodpovedaní všetkých otázok sa zobrazia výsledky.",
            resultsContainHeading: "Výsledky obsahujú:",
            resultsOverallScore: "<strong>Celkové skóre:</strong> Celkový počet správnych odpovedí z celkového počtu (napr. 7 z 10).",
            resultsStatsByAreaHeading: "Štatistika podľa oblastí:",
            resultsStatsByAreaText1: "V karuseli, každá snímka je matematická oblasť (kategória) z testu.",
            resultsStatsByAreaText2: "Pre každú oblasť: názov, počet správnych/celkový počet otázok, percentuálna úspešnosť (progress bar).",
            resultsStatsByAreaText3: "Pri nesprávnych odpovediach v oblasti sa zobrazí zoznam otázok na opakovanie.",
            resultsStatsByAreaText4: "Pri všetkých správnych odpovediach v oblasti sa zobrazí gratulácia.",
            resultsListOfAnswersHeading: "Zoznam vašich odpovedí:",
            resultsListOfAnswersText1: "Pre každú otázku v teste sa zobrazí: Text otázky a kategória.",
            resultsListOfAnswersText2: "Vaša odpoveď (správna/nesprávna).",
            resultsListOfAnswersText3: "Pri nesprávnej odpovedi aj správna.",
            resultsListOfAnswersText4: "Čas odpovede.",
            resultsSaveText: "Ak ste prihlásený a test inicializovaný, výsledky sa uložia do profilu (zobrazí sa správa).",
            resultsNextButton: "Po výsledkoch sa objaví tlačidlo <strong>Výsledky</strong>.",

            profileHeading: "Používateľský Profil",
            profileText1: "Pre prístup k profilu buďte prihlásený a kliknite na <strong>Môj Profil</strong>.",
            profileContainsHeading: "V profile nájdete:",
            profileUserInfo: "<strong>Informácie o používateľovi:</strong> Vaše meno.",
            profileApiToken: "<strong>Môj API Token:</strong> Váš API token (čiastočne skrytý). Tlačidlami <strong>Ukázať Token</strong> / <strong>Skryť Token</strong> ho zobrazíte/skryjete.",
            profileRegenerateToken: "Tlačidlom <strong>Pregenerovať API Token</strong> vygenerujete nový (starý prestane platiť).",
            profileTestHistory: "<strong>História mojich testov:</strong> Zoznam vašich serverom uložených testov. Každý test: dátum, čas, celkové skóre.",
            profileHistoryEmpty: "Ak história nie je implementovaná alebo je prázdna, zobrazí sa správa.",

            langChangeHeading: "Zmena Jazyka",
            langChangeText1: "Vpravo hore na väčšine stránok je tlačidlo na prepínanie jazyka (napr. <strong>Switch to English</strong> / <strong>Prepnúť na Slovenčinu</strong>).",
            langChangeText2: "Kliknutím prepnete jazyk (SK/EN). Preferencia sa uloží pre ďalšie návštevy.",

            pdfDownloadHeading: "Stiahnutie Príručky ako PDF",
            pdfDownloadText1: "Túto príručku si môžete stiahnuť ako PDF.",
            pdfDownloadText2: "Kliknite na tlačidlo <strong>Stiahnuť Príručku ako PDF</strong> nižšie.",
            pdfDownloadText3: "PDF bude obsahovať aktuálnu verziu príručky v zvolenom jazyku.",

            footerTeamName: "WEBTE2",
            footerRights: "Všetky práva vyhradené.",
            switchToEnglish: "Switch to English",
            switchToSlovak: "Prepnúť na Slovenčinu"
        },
        en: {
            pageTitle: "User Manual - Mathematics Tests",
            mainTitle: "User Manual",
            backToHome: "Back to Homepage",
            downloadPdfBtnText: "Download Manual as PDF",

            introHeading: "Introduction",
            introText: "Welcome to the user manual for the Mathematics Tests application. This guide will help you use all the features, from registration to viewing test results.",

            regLogHeading: "Registration and Login",
            regLogText: "To save your test history and access your profile, registration and login are required.",
            regHeading: "Registration",
            regText1: "On the homepage, click <strong>Register</strong>. In the window that appears, enter:",
            regUsername: "Username",
            regPassword: "Password",
            regPassConfirm: "Password Confirmation",
            regText2: "After successful registration, please log in.",
            loginHeading: "Login",
            loginText1: "The <strong>Login</strong> button opens a window to enter your username and password.",
            loginText2: "After logging in, your name and a <strong>Logout</strong> button will be displayed; the original buttons will be hidden.",

            startTestHeading: "Starting a Test",
            startTestText1: "Start a new test by clicking the <strong>Start New Test</strong> button on the homepage, which will take you to the test page.",
            startTestText2: "On the test page, click <strong>Start Test</strong>. The system will select 10 unique questions. If there are too few, it will offer to supplement with already answered questions, or to repeat all answered questions.",
            startTestText3: "For logged-in users, the test is initialized on the server to save results. For users who are not logged in, results are not saved on the server (they are only displayed locally).",

            testProcessHeading: "Test Process",
            testProcessText1: "After starting, the first question will be displayed.",
            testProcessQDisplayHeading: "Question Display:",
            testProcessQDisplayText: "The question text, category, attempt number, and test progress (e.g., Question 1 of 10) will be shown.",
            testProcessQTypesHeading: "Question Types:",
            testProcessMCType: "<strong>Multiple Choice (MC):</strong> Select one correct answer by clicking on it. The selected option will be highlighted.",
            testProcessWAType: "<strong>Written Answer (WA):</strong> Type your answer into the text field.",
            testProcessConfirmHeading: "Confirming an Answer:",
            testProcessConfirmText: "Click the <strong>Confirm</strong> button. If no answer is provided, a warning will be displayed.",
            testProcessFeedbackHeading: "Feedback:",
            testProcessFeedbackText: "After confirmation, the answer is evaluated (correctness, time). For <strong>MC:</strong> Your choice will be distinguished (green/red). If incorrect, the correct answer will be highlighted. For <strong>WA:</strong> The text field will be distinguished. If incorrect, the correct answer will be displayed.",
            testProcessNextQHeading: "Next Question:",
            testProcessNextQText: "Click the <strong>Next Question</strong> button to continue.",

            resultsHeading: "Test Results",
            resultsText1: "After answering all questions, the results will be displayed.",
            resultsContainHeading: "Results include:",
            resultsOverallScore: "<strong>Overall Score:</strong> Total number of correct answers out of the total number of questions (e.g., 7 out of 10).",
            resultsStatsByAreaHeading: "Statistics by Area:",
            resultsStatsByAreaText1: "In a carousel, each slide represents a mathematical area (category) from the test.",
            resultsStatsByAreaText2: "For each area: name, number of correct/total questions, percentage success rate (progress bar).",
            resultsStatsByAreaText3: "If there are incorrect answers in an area, a list of questions for review will be displayed.",
            resultsStatsByAreaText4: "If all answers in an area are correct, a congratulatory message will be shown.",
            resultsListOfAnswersHeading: "List of Your Answers:",
            resultsListOfAnswersText1: "For each question in the test, the following will be displayed: Question text and category.",
            resultsListOfAnswersText2: "Your answer (correct/incorrect).",
            resultsListOfAnswersText3: "If incorrect, the correct answer will also be shown.",
            resultsListOfAnswersText4: "Response time.",
            resultsSaveText: "If you are logged in and the test was initialized, the results will be saved to your profile (a message will be displayed).",
            resultsNextButton: "After the results, the <strong>Results</strong> button will appear.",

            profileHeading: "User Profile",
            profileText1: "To access your profile, be logged in and click <strong>My Profile</strong>.",
            profileContainsHeading: "In your profile, you will find:",
            profileUserInfo: "<strong>User Information:</strong> Your name.",
            profileApiToken: "<strong>My API Token:</strong> Your API token (partially hidden). Use the <strong>Show Token</strong> / <strong>Hide Token</strong> buttons to show/hide it.",
            profileRegenerateToken: "Use the <strong>Regenerate Token</strong> button to generate a new one (the old one will become invalid).",
            profileTestHistory: "<strong>My Test History:</strong> A list of your tests saved on the server. Each test: date, time, overall score.",
            profileHistoryEmpty: "If history is not implemented or is empty, a message will be displayed.",

            langChangeHeading: "Language Change",
            langChangeText1: "At the top right of most pages, there is a button to switch the language (e.g., <strong>Switch to English</strong> / <strong>Prepnúť na Slovenčinu</strong>).",
            langChangeText2: "Clicking it switches the language (SK/EN). Your preference will be saved for future visits.",

            pdfDownloadHeading: "Download Manual as PDF",
            pdfDownloadText1: "You can download this manual as a PDF.",
            pdfDownloadText2: "Click the <strong>Download Manual as PDF</strong> button below.",
            pdfDownloadText3: "The PDF will contain the current version of the manual in the selected language.",

            footerTeamName: "WEBTE2",
            footerRights: "All rights reserved.",
            switchToEnglish: "Switch to English",
            switchToSlovak: "Prepnúť na Slovenčinu"
        }
    };

    function tManual(key) {
        return uiStringsManual[currentLanguage][key] || key;
    }

    function updateUITextManual() {
        document.documentElement.lang = currentLanguage;
        document.getElementById('page-title-manual').textContent = tManual('pageTitle');
        document.getElementById('manual-main-title').textContent = tManual('mainTitle');
        document.getElementById('back-to-home-btn').textContent = tManual('backToHome');
        downloadPdfBtn.textContent = tManual('downloadPdfBtnText');

        // Populate manual content
        document.getElementById('manual-intro-heading').innerHTML = tManual('introHeading');
        document.getElementById('manual-intro-text').innerHTML = tManual('introText');
        document.getElementById('manual-reglog-heading').innerHTML = tManual('regLogHeading');
        document.getElementById('manual-reglog-text').innerHTML = tManual('regLogText');
        document.getElementById('manual-reg-heading').innerHTML = tManual('regHeading');
        document.getElementById('manual-reg-text1').innerHTML = tManual('regText1');
        document.getElementById('manual-reg-username').innerHTML = tManual('regUsername');
        document.getElementById('manual-reg-password').innerHTML = tManual('regPassword');
        document.getElementById('manual-reg-passconfirm').innerHTML = tManual('regPassConfirm');
        document.getElementById('manual-reg-text2').innerHTML = tManual('regText2');
        document.getElementById('manual-login-heading').innerHTML = tManual('loginHeading');
        document.getElementById('manual-login-text1').innerHTML = tManual('loginText1');
        document.getElementById('manual-login-text2').innerHTML = tManual('loginText2');
        document.getElementById('manual-starttest-heading').innerHTML = tManual('startTestHeading');
        document.getElementById('manual-starttest-text1').innerHTML = tManual('startTestText1');
        document.getElementById('manual-starttest-text2').innerHTML = tManual('startTestText2');
        document.getElementById('manual-starttest-text3').innerHTML = tManual('startTestText3');
        document.getElementById('manual-testprocess-heading').innerHTML = tManual('testProcessHeading');
        document.getElementById('manual-testprocess-text1').innerHTML = tManual('testProcessText1');
        document.getElementById('manual-testprocess-qdisplay-heading').innerHTML = tManual('testProcessQDisplayHeading');
        document.getElementById('manual-testprocess-qdisplay-text').innerHTML = tManual('testProcessQDisplayText');
        document.getElementById('manual-testprocess-qtypes-heading').innerHTML = tManual('testProcessQTypesHeading');
        document.getElementById('manual-testprocess-mctype').innerHTML = tManual('testProcessMCType');
        document.getElementById('manual-testprocess-watype').innerHTML = tManual('testProcessWAType');
        document.getElementById('manual-testprocess-confirm-heading').innerHTML = tManual('testProcessConfirmHeading');
        document.getElementById('manual-testprocess-confirm-text').innerHTML = tManual('testProcessConfirmText');
        document.getElementById('manual-testprocess-feedback-heading').innerHTML = tManual('testProcessFeedbackHeading');
        document.getElementById('manual-testprocess-feedback-text').innerHTML = tManual('testProcessFeedbackText');
        document.getElementById('manual-testprocess-nextq-heading').innerHTML = tManual('testProcessNextQHeading');
        document.getElementById('manual-testprocess-nextq-text').innerHTML = tManual('testProcessNextQText');
        document.getElementById('manual-results-heading').innerHTML = tManual('resultsHeading');
        document.getElementById('manual-results-text1').innerHTML = tManual('resultsText1');
        document.getElementById('manual-results-contain-heading').innerHTML = tManual('resultsContainHeading');
        document.getElementById('manual-results-overallscore').innerHTML = tManual('resultsOverallScore');
        document.getElementById('manual-results-statsbyarea-heading').innerHTML = tManual('resultsStatsByAreaHeading');
        document.getElementById('manual-results-statsbyarea-text1').innerHTML = tManual('resultsStatsByAreaText1');
        document.getElementById('manual-results-statsbyarea-text2').innerHTML = tManual('resultsStatsByAreaText2');
        document.getElementById('manual-results-statsbyarea-text3').innerHTML = tManual('resultsStatsByAreaText3');
        document.getElementById('manual-results-statsbyarea-text4').innerHTML = tManual('resultsStatsByAreaText4');
        document.getElementById('manual-results-listofanswers-heading').innerHTML = tManual('resultsListOfAnswersHeading');
        document.getElementById('manual-results-listofanswers-text1').innerHTML = tManual('resultsListOfAnswersText1');
        document.getElementById('manual-results-listofanswers-text2').innerHTML = tManual('resultsListOfAnswersText2');
        document.getElementById('manual-results-listofanswers-text3').innerHTML = tManual('resultsListOfAnswersText3');
        document.getElementById('manual-results-listofanswers-text4').innerHTML = tManual('resultsListOfAnswersText4');
        document.getElementById('manual-results-savetext').innerHTML = tManual('resultsSaveText');
        document.getElementById('manual-results-nextbutton').innerHTML = tManual('resultsNextButton');
        document.getElementById('manual-profile-heading').innerHTML = tManual('profileHeading');
        document.getElementById('manual-profile-text1').innerHTML = tManual('profileText1');
        document.getElementById('manual-profile-contains-heading').innerHTML = tManual('profileContainsHeading');
        document.getElementById('manual-profile-userinfo').innerHTML = tManual('profileUserInfo');
        document.getElementById('manual-profile-apitoken').innerHTML = tManual('profileApiToken');
        document.getElementById('manual-profile-regeneratetoken').innerHTML = tManual('profileRegenerateToken');
        document.getElementById('manual-profile-testhistory').innerHTML = tManual('profileTestHistory');
        document.getElementById('manual-profile-viewdetails').innerHTML = tManual('profileViewDetails');
        document.getElementById('manual-profile-historyempty').innerHTML = tManual('profileHistoryEmpty');
        document.getElementById('manual-langchange-heading').innerHTML = tManual('langChangeHeading');
        document.getElementById('manual-langchange-text1').innerHTML = tManual('langChangeText1');
        document.getElementById('manual-langchange-text2').innerHTML = tManual('langChangeText2');
        document.getElementById('manual-pdfdownload-heading').innerHTML = tManual('pdfDownloadHeading');
        document.getElementById('manual-pdfdownload-text1').innerHTML = tManual('pdfDownloadText1');
        document.getElementById('manual-pdfdownload-text2').innerHTML = tManual('pdfDownloadText2');
        document.getElementById('manual-pdfdownload-text3').innerHTML = tManual('pdfDownloadText3');

        // Footer
        document.getElementById('footer-team-name-manual').textContent = tManual('footerTeamName');
        document.getElementById('footer-rights-manual').textContent = tManual('footerRights');
        toggleLangBtnManual.textContent = currentLanguage === 'sk' ? tManual('switchToEnglish') : tManual('switchToSlovak');
    }

    toggleLangBtnManual.addEventListener('click', () => {
        currentLanguage = currentLanguage === 'sk' ? 'en' : 'sk';
        localStorage.setItem('mathTestLanguageHomepage', currentLanguage);
        updateUITextManual();
    });

    downloadPdfBtn.addEventListener('click', () => {
        const element = document.getElementById('manual-content-body');
        const pdfFileName = `Pouzivatelska_Prirucka_Testy_Matematika_${currentLanguage.toUpperCase()}.pdf`;

        downloadPdfBtn.disabled = true;
        const originalButtonText = downloadPdfBtn.textContent;
        downloadPdfBtn.textContent = currentLanguage === 'sk' ? "Generujem PDF..." : "Generating PDF...";

        if (!element) {
            console.error("Element pre tlač PDF sa nenašiel (#manual-content-body)!");
            downloadPdfBtn.disabled = false;
            downloadPdfBtn.textContent = originalButtonText;
            return;
        }

        // Odskrolujeme hlavné okno úplne hore
        window.scrollTo(0, 0);

        // Použijeme requestAnimationFrame pre synchronizáciu s prekreslením prehliadača
        requestAnimationFrame(() => {
            console.log("--- Debugging Widths/Heights (pred PDF generovaním) ---");
            console.log("Element (#manual-content-body):");
            console.log(`  clientWidth: ${element.clientWidth}, offsetWidth: ${element.offsetWidth}, scrollWidth: ${element.scrollWidth}`);
            console.log(`  clientHeight: ${element.clientHeight}, offsetHeight: ${element.offsetHeight}, scrollHeight: ${element.scrollHeight}`);
            console.log("  Computed Style Width (element):", window.getComputedStyle(element).width);
            console.log("  Computed Style Height (element):", window.getComputedStyle(element).height);

            const container = element.closest('.container');
            if (container) {
                console.log("Container (.container):");
                console.log(`  clientWidth: ${container.clientWidth}, offsetWidth: ${container.offsetWidth}, scrollWidth: ${container.scrollWidth}`);
                console.log("  Computed Style Width (container):", window.getComputedStyle(container).width);
                console.log("  Computed Style max-width (container):", window.getComputedStyle(container).maxWidth);
            }
            console.log(`Window: innerWidth: ${window.innerWidth}, innerHeight: ${window.innerHeight}`);
            console.log(`Window scroll: pageXOffset: ${window.pageXOffset}, pageYOffset: ${window.pageYOffset}`);
            console.log("--- End Debugging ---");

            const opt = {
                margin: [10, 12, 10, 12], // Okraje PDF stránky [H, VĽ, D, VP] v mm
                filename: pdfFileName,
                image: { type: 'jpeg', quality: 0.95 },
                html2canvas: {
                    scale: 1.5,
                    useCORS: true,
                    logging: true,
                    letterRendering: false,
                    x: 0,
                    y: 0,

                    width: element.scrollWidth,
                    height: element.scrollHeight + 500,
                    windowWidth: element.scrollWidth,
                    windowHeight: element.scrollHeight,
                },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] },
                enableLinks: true
            };

            console.log("Použité nastavenia pre html2pdf:", JSON.stringify(opt, null, 2));

            html2pdf().from(element).set(opt).save()
                .then(() => {
                    console.log("Generovanie PDF úspešne dokončené.");
                    downloadPdfBtn.disabled = false;
                    downloadPdfBtn.textContent = originalButtonText;
                })
                .catch(err => {
                    console.error("Generovanie PDF zlyhalo:", err);
                    downloadPdfBtn.disabled = false;
                    downloadPdfBtn.textContent = originalButtonText;
                });
        }); // Koniec requestAnimationFrame
    });

    // Initialization
    if (currentYearElManual) {
        currentYearElManual.textContent = new Date().getFullYear();
    }
    updateUITextManual();

</script>
</body>
</html>