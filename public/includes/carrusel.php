<link rel="stylesheet" href="/public/css/carrusel.css">

<section class="cfl-section" id="incidencias">
    <div class="cfl-container">

        <div class="cfl-header">
            <div>
                <div class="cfl-eyebrow">
                    <span class="cfl-eyebrow-pulse"></span>
                    Evidencia Fotográfica
                </div>
                <h2 class="cfl-title">Antes y <span>Después</span></h2>
                <p class="cfl-sub">Desliza la línea en cada imagen para comparar el estado antes y después de nuestra intervención.</p>
            </div>
            <div class="cfl-controls">
                <span class="cfl-count" id="cfl-count">0 / 0</span>
                <button class="cfl-btn" id="cfl-prev" aria-label="Anterior" disabled>
                    <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <button class="cfl-btn" id="cfl-next" aria-label="Siguiente" disabled>
                    <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
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