<footer class="ft">

    <!-- Top accent line -->
    <div class="ft-accent-line"></div>

    <div class="ft-container">

        <!-- Main grid -->
        <div class="ft-grid">

            <!-- Brand -->
            <div class="ft-col ft-col--brand">
                <a href="/index.php" class="ft-logo-link">
                    <img src="/public/images/logo.png" alt="Reporte Ciudadano" class="ft-logo">
                </a>
                <p class="ft-desc">
                    Plataforma ciudadana para reportar y dar seguimiento a incidencias en tu comunidad de forma rápida y transparente.
                </p>
                <div class="ft-social">
                    <a href="#" class="ft-social-btn" aria-label="Facebook">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z"/></svg>
                    </a>
                    <a href="#" class="ft-social-btn" aria-label="Twitter / X">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z"/></svg>
                    </a>
                    <a href="#" class="ft-social-btn" aria-label="Instagram">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><circle cx="12.145" cy="3.892" r="1"/><path d="M8 12c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4zm0-6c-1.103 0-2 .897-2 2s.897 2 2 2 2-.897 2-2-.897-2-2-2z"/><path d="M12 16H4c-2.056 0-4-1.944-4-4V4c0-2.056 1.944-4 4-4h8c2.056 0 4 1.944 4 4v8c0 2.056-1.944 4-4 4zM4 2c-.935 0-2 1.065-2 2v8c0 .953 1.047 2 2 2h8c.935 0 2-1.065 2-2V4c0-.935-1.065-2-2-2H4z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Navegación -->
            <div class="ft-col">
                <h4 class="ft-heading">Navegación</h4>
                <ul class="ft-links">
                    <li><a href="#hero">Inicio</a></li>
                    <li><a href="#beneficios">Beneficios</a></li>
                    <li><a href="#mapa">Mapa en vivo</a></li>
                    <li><a href="#incidencias">Fotos Incidencias</a></li>
                </ul>
            </div>

            <!-- Acciones -->
            <div class="ft-col">
                <h4 class="ft-heading">Acciones</h4>
                <ul class="ft-links">
                    <li><a href="#0" class="modal-trigger" aria-controls="modal-report">Crear reporte</a></li>
                    <li><a href="#0" class="modal-trigger" aria-controls="modal-consult">Consultar folio</a></li>
                    <li><a href="#mapa">Ver incidencias activas</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="ft-col">
                <h4 class="ft-heading">Contacto</h4>
                <ul class="ft-contact-list">
                    <li>
                        <span class="ft-contact-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        Nezahualcóyotl, Estado de México
                    </li>
                    <li>
                        <span class="ft-contact-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        contacto@reporteciudadano.mx
                    </li>
                   
                </ul>
            </div>

        </div><!-- /ft-grid -->

        <!-- Bottom bar -->
        <div class="ft-bottom">
            <p class="ft-copy">&copy; 2026 Reporte Ciudadano &mdash; Todos los derechos reservados.</p>
            <p class="ft-made">Hecho con <span class="ft-heart">&#9829;</span> para la comunidad</p>
        </div>

    </div><!-- /ft-container -->
</footer>

<style>
    /* ── Footer ── */
    .ft {
        background: linear-gradient(170deg, #07090f 0%, #0d0f18 60%, #100a10 100%);
        border-top: 1px solid rgba(157,27,50,0.22);
        position: relative;
    }
    .ft-accent-line {
        height: 2px;
        background: linear-gradient(90deg,
            transparent 0%, rgba(157,27,50,0.55) 25%,
            rgba(196,40,69,0.9) 50%,
            rgba(157,27,50,0.55) 75%, transparent 100%);
    }
    .ft-container {
        max-width: 1200px; margin: 0 auto; padding: 64px 32px 0;
    }
    .ft-grid {
        display: grid;
        grid-template-columns: 1.8fr 1fr 1fr 1.3fr;
        gap: 48px;
        padding-bottom: 52px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    /* Brand */
    .ft-logo { height: 52px; width: auto; display: block; margin-bottom: 16px; }
    .ft-logo-link { display: inline-block; }
    .ft-desc { font-size: 0.82rem; line-height: 1.7; color: #475569; margin: 0 0 20px; max-width: 280px; }
    /* Social */
    .ft-social { display: flex; gap: 8px; }
    .ft-social-btn {
        display: flex; align-items: center; justify-content: center;
        width: 34px; height: 34px; border-radius: 10px;
        background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
        color: #64748b; text-decoration: none;
        transition: background .2s, color .2s, border-color .2s, transform .2s;
    }
    .ft-social-btn:hover {
        background: rgba(157,27,50,0.2); border-color: rgba(157,27,50,0.5);
        color: #f87171; transform: translateY(-2px);
    }
    /* Column headings */
    .ft-heading {
        font-size: 0.7rem; font-weight: 800; letter-spacing: 0.1em;
        text-transform: uppercase; color: #f1f5f9;
        margin: 0 0 18px; padding-bottom: 10px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        position: relative;
    }
    .ft-heading::after {
        content: ''; position: absolute; bottom: -1px; left: 0;
        width: 24px; height: 1px; background: #9D1B32;
    }
    /* Nav links */
    .ft-links { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 10px; }
    .ft-links a {
        font-size: 0.82rem; font-weight: 500; color: #475569;
        text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        transition: color .2s, gap .2s;
    }
    .ft-links a::before {
        content: ''; display: inline-block; width: 0; height: 1px;
        background: #9D1B32; transition: width .2s; flex-shrink: 0;
    }
    .ft-links a:hover { color: #f1f5f9; gap: 10px; }
    .ft-links a:hover::before { width: 10px; }
    /* Contact */
    .ft-contact-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 13px; }
    .ft-contact-list li { display: flex; align-items: flex-start; gap: 9px; font-size: 0.8rem; color: #475569; line-height: 1.5; }
    .ft-contact-icon { flex-shrink: 0; margin-top: 1px; color: #9D1B32; }
    /* Bottom */
    .ft-bottom {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 0; gap: 12px; flex-wrap: wrap;
    }
    .ft-copy, .ft-made { font-size: 0.76rem; color: #334155; margin: 0; }
    .ft-heart { color: #9D1B32; }
    /* Responsive */
    @media (max-width: 1024px) {
        .ft-grid { grid-template-columns: 1.5fr 1fr 1fr; }
        .ft-col--brand { grid-column: 1 / -1; }
        .ft-desc { max-width: 100%; }
    }
    @media (max-width: 640px) {
        .ft-container { padding: 48px 20px 0; }
        .ft-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
        .ft-col--brand { grid-column: 1 / -1; }
        .ft-bottom { flex-direction: column; text-align: center; gap: 6px; }
    }
    @media (max-width: 420px) {
        .ft-grid { grid-template-columns: 1fr; }
    }
</style>
