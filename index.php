<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <title>Test API demo</title>
</head>
<body>
  <h2>Testovacie rozhranie k API</h2>

  <h3>Registrácia</h3>
  <input id="regUsername" placeholder="Meno">
  <input id="regPassword" type="password" placeholder="Heslo">
  <button onclick="register()">Registrovať</button>
  <pre id="registerOutput"></pre>

  <h3>Prihlásenie</h3>
  <input id="loginUsername" placeholder="Meno">
  <input id="loginPassword" type="password" placeholder="Heslo">
  <button onclick="login()">Prihlásiť</button>
  <pre id="loginOutput"></pre>

  <h3>Načítanie otázok</h3>
  <button onclick="loadQuestions()">Načítať otázky</button>
  <pre id="questionsOutput"></pre>

  <h3>Odoslanie testu (2 otázky napevno)</h3>
  <button onclick="submitTest()">Odoslať test</button>
  <pre id="submitOutput"></pre>

  <script>
    let token = null;

    const apiBase = 'https://node53.webte.fei.stuba.sk/skuska/api/api.php?route='; 

    function register() {
      const username = document.getElementById('regUsername').value;
      const password = document.getElementById('regPassword').value;

      fetch('https://node53.webte.fei.stuba.sk/skuska/api/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password })
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById('registerOutput').textContent = JSON.stringify(data, null, 2);
      });
    }

    function login() {
      const username = document.getElementById('loginUsername').value;
      const password = document.getElementById('loginPassword').value;

      fetch('https://node53.webte.fei.stuba.sk/skuska/api/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password })
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById('loginOutput').textContent = JSON.stringify(data, null, 2);
        if (data.api_token) token = data.api_token;
      });
    }

    function loadQuestions() {
  fetch(apiBase + 'questions')
    .then(res => res.json())
    .then(data => {
      document.getElementById('questionsOutput').textContent = JSON.stringify(data, null, 2);
    });
}


    function submitTest() {
      const testData = {
        user_id: 1, 
        city: 'Bratislava',
        country: 'Slovensko',
        questions: [
          { question_id: 1, answered_correctly: true, time_taken: 4.2 },
          { question_id: 2, answered_correctly: false, time_taken: 7.6 }
        ]
      };

      fetch(apiBase + 'tests', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(testData)
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById('submitOutput').textContent = JSON.stringify(data, null, 2);
      });
    }
  </script>
</body>
</html>
