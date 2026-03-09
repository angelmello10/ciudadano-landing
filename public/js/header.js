/* Scroll progress + header shrink */
(function () {
    const bar = document.getElementById('nav-progress');
    const header = document.getElementById('site-header');
    let ticking = false;
    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(() => {
                const scrolled = window.scrollY;
                const total = document.documentElement.scrollHeight - window.innerHeight;
                if (bar) bar.style.width = (total > 0 ? (scrolled / total) * 100 : 0) + '%';
                if (header) header.classList.toggle('is-scrolled', scrolled > 40);
                ticking = false;
            });
            ticking = true;
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
})();

/* Dark mode toggle */
document.getElementById('dark-toggle').addEventListener('click', function () {
    var isDark = document.documentElement.classList.toggle('dark');
    try { localStorage.setItem('rc-theme', isDark ? 'dark' : 'light'); } catch (e) { }
});

/* ── MOBILE NAV TOGGLE (propio, no depende de main.min.js) ── */
(function () {
    var btn = document.getElementById('header-nav-toggle');
    var nav = document.getElementById('header-nav');
    if (!btn || !nav) return;

    function openNav() {
        nav.classList.add('mob-open');
        btn.setAttribute('aria-expanded', 'true');
        // también activa la animación de la hamburguesa del framework
        nav.classList.add('is-active');
    }
    function closeNav() {
        nav.classList.remove('mob-open', 'is-active');
        btn.setAttribute('aria-expanded', 'false');
    }
    function isOpen() { return nav.classList.contains('mob-open'); }

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        isOpen() ? closeNav() : openNav();
    });

    // cerrar al tocar un link
    nav.querySelectorAll('.header-link').forEach(function (link) {
        link.addEventListener('click', closeNav);
    });

    // cerrar al tocar fuera
    document.addEventListener('click', function (e) {
        if (isOpen() && !nav.contains(e.target) && e.target !== btn) closeNav();
    });
})();
