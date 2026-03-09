<!-- Scroll progress bar -->
<div id="nav-progress" aria-hidden="true"></div>

<link rel="stylesheet" href="/public/css/header.css">

<header class="site-header invert-color" id="site-header">
    <div class="container">
        <div class="site-header-inner">

            <!-- Brand -->
            <div class="brand">
                <a href="/index.php" class="brand-link" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
                    <img src="/public/images/logo.png" alt="Logo SIGIU" class="brand-logo-img">
                    <span class="brand-divider"></span>
                    <span class="brand-text-wrap">
                        <span class="brand-sigiu">SIGIU</span>
                        <span class="brand-tagline">Reporta tu ciudad</span>
                    </span>
                </a>
            </div>

            <!-- Nav -->
            <nav id="header-nav" class="header-nav">
                <div class="header-nav-inner">
                    <div class="nav-links">
                        <a class="header-link smooth-scroll" href="#mapa-controles">Mapa en vivo</a>
                        <a class="header-link smooth-scroll" href="#como-funciona">Cómo funciona</a>
                        <a class="header-link smooth-scroll" href="#incidencias">Fotos / Reportes</a>
                    </div>
                </div>
            </nav>

            <!-- Dark mode toggle -->
            <button id="dark-toggle" class="dark-toggle" aria-label="Cambiar tema" title="Modo oscuro / claro">
                <!-- Sun (shown in dark mode) -->
                <svg class="icon-sun" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"/>
                    <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
                <!-- Moon (shown in light mode) -->
                <svg class="icon-moon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                </svg>
            </button>

        </div>
    </div>
</header>

<script src="/public/js/header.js"></script>
