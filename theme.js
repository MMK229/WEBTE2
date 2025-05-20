document.addEventListener('DOMContentLoaded', function() {
    // Check for saved theme preference or default to light
    const currentTheme = localStorage.getItem('theme') || 'light';
   
    // Apply the theme
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark-theme');
        document.getElementById('toggle-theme-btn').textContent = '☀️';
    } else {
        document.documentElement.classList.remove('dark-theme');
        document.getElementById('toggle-theme-btn').textContent = '🌙';
    }
   
    // Set up event listener for theme toggle
    const themeToggleBtn = document.getElementById('toggle-theme-btn');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark-theme');
           
            // Save preference to localStorage
            if (document.documentElement.classList.contains('dark-theme')) {
                localStorage.setItem('theme', 'dark');
                this.textContent = '☀️';
            } else {
                localStorage.setItem('theme', 'light');
                this.textContent = '🌙';
            }
        });
    }
});