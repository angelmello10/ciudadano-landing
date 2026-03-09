(function () {
    var fab = document.getElementById('mob-fab');
    var menu = document.getElementById('mob-menu');
    var overlay = document.getElementById('mob-overlay');
    if (!fab || !menu) return;

    function open() {
        menu.classList.add('is-open');
        overlay.classList.add('is-open');
        fab.classList.add('is-open');
        fab.setAttribute('aria-expanded', 'true');
    }
    function close() {
        menu.classList.remove('is-open');
        overlay.classList.remove('is-open');
        fab.classList.remove('is-open');
        fab.setAttribute('aria-expanded', 'false');
    }

    fab.addEventListener('click', function (e) {
        e.stopPropagation();
        menu.classList.contains('is-open') ? close() : open();
    });
    overlay.addEventListener('click', close);

    menu.querySelectorAll('.mob-nav-link').forEach(function (link) {
        link.addEventListener('click', function () { setTimeout(close, 150); });
    });

    // Dark mode
    var darkBtn = document.getElementById('mob-dark-toggle');
    var iconMoon = document.getElementById('mob-icon-moon');
    var iconSun = document.getElementById('mob-icon-sun');
    var darkLabel = document.getElementById('mob-dark-label');

    function syncDark() {
        var dark = document.documentElement.classList.contains('dark');
        iconMoon.style.display = dark ? 'none' : '';
        iconSun.style.display = dark ? '' : 'none';
        darkLabel.textContent = dark ? 'Modo claro' : 'Modo oscuro';
    }
    syncDark();

    darkBtn.addEventListener('click', function () {
        var isDark = document.documentElement.classList.toggle('dark');
        try { localStorage.setItem('rc-theme', isDark ? 'dark' : 'light'); } catch (e) { }
        syncDark();
        setTimeout(close, 200);
    });
})();
