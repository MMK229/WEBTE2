<?php
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title-admin">Administrácia</title>
    <link rel="stylesheet" href="theme.css">
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark-theme');
            }
        })();
    </script>
    <script src="theme.js" defer></script>
</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
        <a href="index.php" class="navbar-brand">Math Test</a>
        <a href="index.php" id="nav-link-home" class="nav-link">Domov</a>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item"><a href="profile.php" id="nav-link-profile" class="nav-link">Môj Profil</a></li>
        <li class="nav-item"><a href="manual.php" id="nav-link-manual" class="nav-link">Manuál</a></li>
        <li class="nav-item"><a href="admin.php" id="nav-link-admin-active" class="nav-link active">Admin</a></li>
        <li class="nav-item"><button id="toggle-lang-btn-admin" class="btn btn-secondary">English</button></li>
        <li class="nav-item"><button id="toggle-theme-btn-admin" class="theme-toggle">🌙</button></li>
        <li class="nav-item" id="user-status-li-admin" style="display: none; align-items: center;">
            <span id="user-greeting-admin" style="margin-right: 10px;"></span>
            <button id="logout-btn-admin" class="btn btn-secondary"></button>
        </li>
    </ul>
</nav>

<div class="container">
    <header class="page-header">
        <h1 id="admin-main-title">Administrátorská Sekcia</h1>
    </header>

    <section id="admin-content">
        <p id="admin-welcome-text">Vitajte v administrátorskej sekcii. Tu budete môcť spravovať obsah aplikácie.</p>
    </section>
</div>

<footer class="page-footer">
    <p>&copy; <span id="current-year-admin"></span> <span id="footer-team-name-admin">WEBTE2</span>. <span id="footer-rights-admin">Všetky práva vyhradené.</span></p>
</footer>

<script>
    let currentLanguageAdmin = localStorage.getItem('mathTestLanguageHomepage') || 'sk';
    const apiBaseAdmin = 'https://node53.webte.fei.stuba.sk/skuska/api/api.php?route=';

    const uiStringsAdmin = {
        sk: {
            pageTitle: "Administrácia", mainTitle: "Administrátorská Sekcia",
            welcomeText: "Vitajte v administrátorskej sekcii. Tu budete môcť spravovať obsah aplikácie.",
            navHome: "Domov", navProfile: "Môj Profil", navManual: "Manuál", navAdmin: "Admin",
            switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            footerTeamName: "WEBTE2", footerRights: "Všetky práva vyhradené.",
            loggedInAs: "Prihlásený ako:", logoutBtn: "Odhlásiť sa"
        },
        en: {
            pageTitle: "Administration", mainTitle: "Administrator Section",
            welcomeText: "Welcome to the admin section. Here you will manage application content.",
            navHome: "Home", navProfile: "My Profile", navManual: "Manual", navAdmin: "Admin",
            switchToEnglish: "Switch to English", switchToSlovak: "Prepnúť na Slovenčinu",
            footerTeamName: "WEBTE2", footerRights: "All rights reserved.",
            loggedInAs: "Logged in as:", logoutBtn: "Logout"
        }
    };

    function tAdmin(key) {
        return uiStringsAdmin[currentLanguageAdmin] ? (uiStringsAdmin[currentLanguageAdmin][key] || key) : key;
    }

    function updateAdminUIText() {
        document.documentElement.lang = currentLanguageAdmin;
        const pageTitleEl = document.getElementById('page-title-admin');
        if(pageTitleEl) pageTitleEl.textContent = tAdmin('pageTitle');

        const mainTitleEl = document.getElementById('admin-main-title');
        if(mainTitleEl) mainTitleEl.textContent = tAdmin('mainTitle');

        const welcomeTextEl = document.getElementById('admin-welcome-text');
        if(welcomeTextEl) welcomeTextEl.textContent = tAdmin('welcomeText');

        const navHomeEl = document.getElementById('nav-link-home');
        if(navHomeEl) navHomeEl.textContent = tAdmin('navHome');
        const navProfileEl = document.getElementById('nav-link-profile');
        if(navProfileEl) navProfileEl.textContent = tAdmin('navProfile');
        const navManualEl = document.getElementById('nav-link-manual');
        if(navManualEl) navManualEl.textContent = tAdmin('navManual');
        const navAdminActiveEl = document.getElementById('nav-link-admin-active');
        if(navAdminActiveEl) navAdminActiveEl.textContent = tAdmin('navAdmin');

        const toggleLangBtnEl = document.getElementById('toggle-lang-btn-admin');
        if(toggleLangBtnEl) toggleLangBtnEl.textContent = currentLanguageAdmin === 'sk' ? tAdmin('switchToEnglish') : tAdmin('switchToSlovak');

        const yearEl = document.getElementById('current-year-admin');
        if (yearEl) yearEl.textContent = new Date().getFullYear();
        const footerTeamNameEl = document.getElementById('footer-team-name-admin');
        if(footerTeamNameEl) footerTeamNameEl.textContent = tAdmin('footerTeamName');
        const footerRightsEl = document.getElementById('footer-rights-admin');
        if(footerRightsEl) footerRightsEl.textContent = tAdmin('footerRights');

        const loggedInUsername = localStorage.getItem('loggedInUsername');
        const userStatusLiAdmin = document.getElementById('user-status-li-admin');
        const userGreetingAdminEl = document.getElementById('user-greeting-admin');
        const logoutBtnAdminEl = document.getElementById('logout-btn-admin');

        if (localStorage.getItem('apiToken') && loggedInUsername) {
            if(userStatusLiAdmin) userStatusLiAdmin.style.display = 'flex';
            if(userGreetingAdminEl) userGreetingAdminEl.textContent = `${tAdmin('loggedInAs')} ${loggedInUsername}`;
            if(logoutBtnAdminEl) logoutBtnAdminEl.textContent = tAdmin('logoutBtn');
        } else {
            if(userStatusLiAdmin) userStatusLiAdmin.style.display = 'none';
        }
    }

    async function verifyAdminAccess() {
        const token = localStorage.getItem('apiToken');
        if (!token) {
            window.location.href = 'index.php';
            return;
        }
        try {
            const response = await fetch(`${apiBaseAdmin}is-admin`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });
            if (response.ok) {
                const data = await response.json();
                if (!data.admin) {
                    window.location.href = 'index.php'; // Presmerovať, ak nie je admin
                } else {
                    updateAdminUIText(); // Teraz aktualizuj UI texty
                }
            } else {
                window.location.href = 'index.php'; // Presmerovať pri chybe
            }
        } catch (error) {
            console.error('Failed to verify admin status:', error);
            // alert("Nepodarilo sa overiť administrátorské oprávnenia.");
            window.location.href = 'index.php';
        }
    }

    const toggleLangBtnAdmin = document.getElementById('toggle-lang-btn-admin');
    if (toggleLangBtnAdmin) {
        toggleLangBtnAdmin.addEventListener('click', () => {
            currentLanguageAdmin = currentLanguageAdmin === 'sk' ? 'en' : 'sk';
            localStorage.setItem('mathTestLanguageHomepage', currentLanguageAdmin);
            updateAdminUIText();
        });
    }

    const logoutBtnAdmin = document.getElementById('logout-btn-admin');
    if(logoutBtnAdmin){
        logoutBtnAdmin.addEventListener('click', () => {
            localStorage.removeItem('apiToken');
            localStorage.removeItem('loggedInUsername');
            localStorage.removeItem('userId');
            window.location.href = 'index.php';
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        verifyAdminAccess();
    });

</script>
</body>
</html>