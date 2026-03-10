<link rel="stylesheet" href="/public/css/carrusel.css">

<section class="cfl-section" id="incidencias">
    <!-- Decoración de fondo premium -->
    <div class="cfl-bg-glow"></div>
    <div class="cfl-bg-grid"></div>

    <div class="cfl-container">

        <div class="section-header reveal-from-bottom mb-48" style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 24px;">
            <div class="container-xs" style="margin: 0; text-align: left;">
                <span class="section-label">Transparencia y Acción</span>
                <h2 class="mt-0 mb-16">El poder del <span class="hero-accent">Antes y Después</span></h2>
                <p class="m-0">Desliza el separador para visualizar el cambio logrado gracias al reporte ciudadano.</p>
            </div>
            <div class="cfl-controls">
                <span class="cfl-count" id="cfl-count">0 / 0</span>
                <button class="cfl-btn" id="cfl-prev" aria-label="Anterior" disabled>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <button class="cfl-btn" id="cfl-next" aria-label="Siguiente" disabled>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>
        </div>

        <div class="cfl-stage-wrap">
            <div class="cfl-stage" id="cfl-stage"></div>
        </div>

        <div class="cfl-progress-wrap">
            <div class="cfl-progress-bar">
                <div class="cfl-progress-fill" id="cfl-prog" style="width:0%"></div>
            </div>
            <span class="cfl-progress-label" id="cfl-prog-label">-- / --</span>
        </div>

    </div>
</section>

<script src="/public/js/carrusel.js"></script>