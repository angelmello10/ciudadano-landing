<footer class="site-footer center-content-mobile invert-color">
    <div class="container">
        <div class="site-footer-inner">
            <div class="footer-top space-between text-xxs">
                <div class="brand">
                    <a href="/index.php"><img src="/public/images/JORDAN.png" alt="Logo" style="height:60px;width:auto;"></a>
                </div>
                <div class="footer-social">
                    <ul class="list-reset">
                        <li><a href="#">
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <title>Facebook</title>
                                <path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z" />
                            </svg>
                        </a></li>
                        <li><a href="#">
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <title>Twitter</title>
                                <path d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z" />
                            </svg>
                        </a></li>
                        <li><a href="#">
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <title>Instagram</title>
                                <g>
                                    <circle cx="12.145" cy="3.892" r="1" />
                                    <path d="M8 12c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4zm0-6c-1.103 0-2 .897-2 2s.897 2 2 2 2-.897 2-2-.897-2-2-2z" />
                                    <path d="M12 16H4c-2.056 0-4-1.944-4-4V4c0-2.056 1.944-4 4-4h8c2.056 0 4 1.944 4 4v8c0 2.056-1.944 4-4 4zM4 2c-.935 0-2 1.065-2 2v8c0 .953 1.047 2 2 2h8c.935 0 2-1.065 2-2V4c0-.935-1.065-2-2-2H4z" />
                                </g>
                            </svg>
                        </a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom space-between text-xxs invert-order-desktop">
                <nav class="footer-nav">
                    <ul class="list-reset">
                        <li><a href="#beneficios">Beneficios</a></li>
                        <li><a href="#mapa">Mapa</a></li>
                        <li><a href="#incidencias">Incidencias</a></li>
                        <li><a class="modal-trigger" aria-controls="modal-consult" href="#0">Consultar folio</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer-copyright">&copy; 2026 Reporte Ciudadano, todos los derechos reservados.</div>
        </div>
    </div>
</footer>

<style>
    .site-footer {
        background: linear-gradient(160deg, #06080c 0%, #0d0e14 100%) !important;
        border-top: 1px solid rgba(157,27,50,0.3);
        padding: 3rem 0 2rem;
    }
    .site-footer, .site-footer .invert-color { color: #64748b !important; }
    .site-footer a { color: #64748b !important; text-decoration: none; transition: color .2s ease; }
    .site-footer a:hover { color: #e2e8f0 !important; }
    .footer-social li { display: inline-block; margin-left: 14px; }
    .footer-social li a svg { fill: currentColor; width: 18px; height: 18px; transition: fill .2s; }
    .footer-social li a:hover svg { fill: var(--primary-light, #c42845); }
    .footer-nav ul { display: flex; flex-wrap: wrap; gap: 6px 20px; list-style: none; margin: 0; padding: 0; }
    .footer-nav li a { font-size: 0.82rem; font-weight: 600; letter-spacing: 0.01em; }
    .footer-copyright {
        color: #475569; font-size: 0.78rem;
        border-top: 1px solid rgba(255,255,255,0.06);
        margin-top: 1.5rem; padding-top: 1.5rem;
        text-align: center;
    }
    .footer-brand-tagline {
        font-size: 0.72rem; color: #374151; margin-top: 4px; font-weight: 500;
    }
</style>
