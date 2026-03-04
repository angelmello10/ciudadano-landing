<style>
/* ═══════════════════════════════════
   COVERFLOW 3D — Carrusel innovador
═══════════════════════════════════ */
.cfl-section {
    padding: 110px 0 100px;
    background: #f8fafc;
    position: relative;
    overflow: hidden;
}
html.dark .cfl-section {
    background: #08060a;
}

.cfl-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 700px 350px at 20% 50%, rgba(157,27,50,0.06) 0%, transparent 70%),
        radial-gradient(ellipse 500px 250px at 80% 30%, rgba(157,27,50,0.04) 0%, transparent 60%);
    pointer-events: none;
}
html.dark .cfl-section::before {
    background:
        radial-gradient(ellipse 700px 350px at 20% 50%, rgba(157,27,50,0.22) 0%, transparent 70%),
        radial-gradient(ellipse 500px 250px at 80% 30%, rgba(157,27,50,0.12) 0%, transparent 60%);
}

.cfl-container {
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 40px;
    position: relative;
    z-index: 1;
}

.cfl-header {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: end;
    gap: 32px;
    margin-bottom: 60px;
}

.cfl-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.71rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--primary, #9d1b32);
    margin-bottom: 12px;
}
html.dark .cfl-eyebrow { color: #fb7185; }

.cfl-eyebrow-pulse {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--primary, #9d1b32);
    animation: cflPulse 2.4s ease-in-out infinite;
}
html.dark .cfl-eyebrow-pulse { background: #fb7185; }

@keyframes cflPulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(157,27,50,0.55); }
    50%       { box-shadow: 0 0 0 8px rgba(157,27,50,0); }
}

.cfl-title {
    font-size: clamp(2rem, 3.5vw, 2.8rem);
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.03em;
    line-height: 1.15;
    margin: 0 0 10px;
}
html.dark .cfl-title { color: #f8fafc; }

.cfl-title span {
    background: linear-gradient(120deg, var(--primary, #9d1b32), #e11d48);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.cfl-sub {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.65;
    margin: 0;
    max-width: 480px;
}
html.dark .cfl-sub { color: #94a3b8; }

.cfl-controls {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

.cfl-count {
    font-size: 0.78rem;
    font-weight: 700;
    color: #94a3b8;
    margin-right: 4px;
    font-variant-numeric: tabular-nums;
    min-width: 42px;
    text-align: right;
}
html.dark .cfl-count { color: #64748b; }

.cfl-btn {
    width: 42px; height: 42px;
    border-radius: 50%;
    border: 1.5px solid rgba(0,0,0,0.10);
    background: #fff;
    color: #334155;
    display: grid;
    place-items: center;
    cursor: pointer;
    transition: all 0.22s ease;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    flex-shrink: 0;
    padding: 0;
}
html.dark .cfl-btn {
    background: rgba(255,255,255,0.06);
    border-color: rgba(255,255,255,0.10);
    color: rgba(255,255,255,0.75);
    box-shadow: none;
}
.cfl-btn:hover:not(:disabled) {
    background: var(--primary, #9d1b32);
    border-color: var(--primary, #9d1b32);
    color: #fff;
    transform: scale(1.1);
    box-shadow: 0 4px 16px rgba(157,27,50,0.4);
}
.cfl-btn:disabled { opacity: 0.3; cursor: not-allowed; }
.cfl-btn svg {
    width: 18px; height: 18px;
    stroke: currentColor; stroke-width: 2.3;
    fill: none; stroke-linecap: round; stroke-linejoin: round;
}

/* ── Stage 3D ── */
.cfl-stage-wrap {
    perspective: 1400px;
    perspective-origin: 50% 65%;
    height: 430px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.cfl-stage {
    position: relative;
    width: 300px;
    height: 400px;
    transform-style: preserve-3d;
}

/* ── Cartas ── */
.cfl-card {
    position: absolute;
    width: 280px; height: 390px;
    left: 50%; top: 50%;
    margin-left: -140px;
    margin-top: -195px;
    border-radius: 20px;
    overflow: hidden;
    background: #1e293b;
    box-shadow:
        0 30px 70px rgba(0,0,0,0.25),
        0 6px 20px rgba(0,0,0,0.15),
        0 0 0 1px rgba(255,255,255,0.06);
    cursor: pointer;
    will-change: transform, opacity;
    transition: transform 0.58s cubic-bezier(0.4,0,0.2,1),
                opacity   0.48s ease,
                filter    0.48s ease;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}
html.dark .cfl-card {
    box-shadow: 0 30px 70px rgba(0,0,0,0.65), 0 0 0 1px rgba(255,255,255,0.05);
}
.cfl-card-active { cursor: default; }

.cfl-img {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
    transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
    will-change: transform;
}
.cfl-card-active.cfl-expanded .cfl-img { transform: scale(1.07); }

/* Gradiente base via pseudo-element para animar con opacity */
.cfl-grad {
    position: absolute; inset: 0;
    pointer-events: none;
    z-index: 2;
}
.cfl-grad::before,
.cfl-grad::after {
    content: '';
    position: absolute; inset: 0;
    transition: opacity 0.45s ease;
}
/* base: ligero */
.cfl-grad::before {
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.90) 0%,
        rgba(0,0,0,0.45) 22%,
        transparent 50%
    );
    opacity: 1;
}
/* expandido: oscuro — se desvanece encima */
.cfl-grad::after {
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.97) 0%,
        rgba(0,0,0,0.88) 32%,
        rgba(0,0,0,0.62) 56%,
        rgba(0,0,0,0.20) 80%,
        transparent 100%
    );
    opacity: 0;
}
.cfl-card-active.cfl-expanded .cfl-grad::after { opacity: 1; }

/* Reflexion espejo */
.cfl-reflection {
    position: absolute;
    bottom: -395px; left: 0; right: 0;
    height: 390px;
    border-radius: 0 0 20px 20px;
    overflow: hidden;
    pointer-events: none;
    opacity: 0;
    transform: scaleY(-1);
    -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,0.22) 0%, transparent 65%);
    mask-image: linear-gradient(to bottom, rgba(0,0,0,0.22) 0%, transparent 65%);
    transition: opacity 0.4s ease;
}
.cfl-card-active .cfl-reflection { opacity: 1; }
.cfl-reflection img { width:100%; height:100%; object-fit:cover; display:block; }

.cfl-folio {
    position: absolute; top: 14px; left: 14px;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
    color: rgba(255,255,255,0.80);
    font-size: 0.68rem; font-weight: 800; letter-spacing: 0.05em;
    padding: 4px 10px; border-radius: 7px;
    border: 1px solid rgba(255,255,255,0.14);
    z-index: 4;
}

/* Info base: siempre visible, compacta */
.cfl-info {
    position: absolute; bottom: 0; left: 0; right: 0;
    padding: 16px 16px 52px; z-index: 4; color: #fff;
    transform: translateY(0);
    transition: transform 0.42s cubic-bezier(0.4,0,0.2,1);
    will-change: transform;
}
.cfl-tipo {
    font-size: 0.68rem; font-weight: 700;
    letter-spacing: 0.08em; text-transform: uppercase;
    color: rgba(255,255,255,0.55); margin-bottom: 3px;
}
.cfl-nombre {
    font-size: 1rem; font-weight: 800;
    margin: 0 0 8px; white-space: nowrap;
    overflow: hidden; text-overflow: ellipsis;
    text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}
.cfl-row {
    display: flex; align-items: center;
    justify-content: flex-start; gap: 8px;
}

/* Panel expandible — grid-template-rows es mucho más fluido que max-height */
.cfl-details {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.45s cubic-bezier(0.4,0,0.2,1);
}
.cfl-card-active.cfl-expanded .cfl-details {
    grid-template-rows: 1fr;
}
.cfl-details-inner {
    overflow: hidden;
    opacity: 0;
    transform: translateY(10px);
    transition: opacity 0.32s ease 0.10s,
                transform 0.38s cubic-bezier(0.4,0,0.2,1) 0.08s;
    will-change: opacity, transform;
    /* padding interno para que las primeras letras no se corten */
    padding-top: 12px;
}
.cfl-card-active.cfl-expanded .cfl-details-inner {
    opacity: 1;
    transform: translateY(0);
}
.cfl-details-addr {
    font-size: 0.67rem; font-weight: 500;
    color: rgba(255,255,255,0.65);
    display: flex; align-items: flex-start; gap: 5px;
    margin-bottom: 7px; line-height: 1.45;
}
.cfl-details-addr svg {
    flex-shrink: 0; width: 11px; height: 11px; margin-top: 2px;
    stroke: #fb7185; fill: rgba(251,113,133,0.18);
    stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
}
.cfl-details-desc {
    font-size: 0.67rem; color: rgba(255,255,255,0.52);
    line-height: 1.5; margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* touch-action: manipulation elimina el retraso de 300ms en iOS */
.cfl-toggle-btn {
    position: absolute; bottom: 0; left: 0; right: 0;
    z-index: 7; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    height: 44px; gap: 5px;
    background: rgba(0,0,0,0.0);
    border: none; color: rgba(255,255,255,0.55);
    font-family: inherit; font-size: 0.62rem; font-weight: 700;
    letter-spacing: 0.07em; text-transform: uppercase;
    transition: color 0.2s, background 0.2s;
    border-radius: 0 0 20px 20px;
    padding: 0;
    opacity: 0; pointer-events: none;
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
    -webkit-user-select: none; user-select: none;
}
.cfl-card-active .cfl-toggle-btn {
    opacity: 1; pointer-events: auto;
}
.cfl-toggle-btn:hover { color: rgba(255,255,255,0.85); background: rgba(0,0,0,0.18); }
.cfl-toggle-btn svg {
    width: 13px; height: 13px;
    stroke: currentColor; fill: none;
    stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    transition: transform 0.35s ease;
}
.cfl-card-active.cfl-expanded .cfl-toggle-btn svg { transform: rotate(180deg); }
.cfl-toggle-btn .t-open  { display: inline; }
.cfl-toggle-btn .t-close { display: none; }
.cfl-card-active.cfl-expanded .cfl-toggle-btn .t-open  { display: none; }
.cfl-card-active.cfl-expanded .cfl-toggle-btn .t-close { display: inline; }

.cfl-pill {
    font-size: 0.64rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 0.04em;
    padding: 4px 11px; border-radius: 999px;
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.15);
    background: rgba(255,255,255,0.14); color: #fff;
}
.cfl-pill.s-resuelto  { background: rgba(34,197,94,0.28);  border-color: rgba(34,197,94,0.5);   color: #86efac; }
.cfl-pill.s-pendiente { background: rgba(245,158,11,0.26); border-color: rgba(245,158,11,0.45); color: #fde68a; }
.cfl-pill.s-rechazado { background: rgba(239,68,68,0.26);  border-color: rgba(239,68,68,0.45);  color: #fca5a5; }
.cfl-pill.s-proceso   { background: rgba(59,130,246,0.26); border-color: rgba(59,130,246,0.45); color: #93c5fd; }

.cfl-mapbtn {
    font-size: 0.7rem; font-weight: 800;
    padding: 6px 14px; border-radius: 999px;
    background: var(--primary, #9d1b32); color: #fff;
    border: none; cursor: pointer; font-family: inherit;
    letter-spacing: 0.02em; white-space: nowrap;
    display: block; width: 100%; text-align: center;
    transition: filter 0.18s, transform 0.15s;
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
    -webkit-user-select: none; user-select: none;
}
.cfl-mapbtn:hover { filter: brightness(1.12); transform: translateY(-1px); }

/* Hint de clic en cartas laterales */
.cfl-hint {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
    z-index: 5; opacity: 0; transition: opacity 0.2s;
    border-radius: 20px; pointer-events: none;
}
.cfl-card:not(.cfl-card-active):hover .cfl-hint { opacity: 1; }
.cfl-hint-icon {
    width: 48px; height: 48px;
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(10px); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 1.5px solid rgba(255,255,255,0.3);
}
.cfl-hint-icon svg { width:22px; height:22px; stroke:white; stroke-width:2.2; fill:none; }

/* Barra de progreso */
.cfl-progress-wrap {
    margin-top: 36px; display: flex; align-items: center; gap: 16px;
}
.cfl-progress-bar {
    flex: 1; height: 3px;
    background: rgba(0,0,0,0.10); border-radius: 99px; overflow: hidden;
}
html.dark .cfl-progress-bar { background: rgba(255,255,255,0.10); }
.cfl-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary, #9d1b32), #e11d48);
    border-radius: 99px;
    transition: width 0.5s cubic-bezier(0.4,0,0.2,1);
    box-shadow: 0 0 8px rgba(157,27,50,0.5);
}
.cfl-progress-label {
    font-size: 0.72rem; font-weight: 700; color: #94a3b8;
    font-variant-numeric: tabular-nums; white-space: nowrap;
}
html.dark .cfl-progress-label { color: #475569; }

/* Ring de autoplay */
.cfl-autoplay-ring {
    position: absolute; top: 14px; right: 14px;
    width: 30px; height: 30px; z-index: 5;
}
.cfl-autoplay-ring svg { width:30px; height:30px; transform:rotate(-90deg); }
.cfl-autoplay-ring circle {
    fill: none; stroke: rgba(255,255,255,0.85); stroke-width: 2;
    stroke-linecap: round; stroke-dasharray: 78.5; stroke-dashoffset: 78.5;
    transition: stroke-dashoffset 0.1s linear;
}

/* Responsive */
@media (max-width: 1024px) {
    .cfl-stage-wrap { height: 390px; }
    .cfl-card { width:255px; height:355px; margin-left:-127px; margin-top:-178px; }
    .cfl-reflection { bottom:-360px; height:355px; }
}
@media (max-width: 768px) {
    .cfl-container { padding: 0 20px; }
    .cfl-header { grid-template-columns: 1fr; gap: 20px; margin-bottom: 36px; }
    .cfl-controls { justify-content: flex-start; }
    .cfl-stage-wrap { height: 360px; }
}
@media (max-width: 480px) {
    .cfl-section { padding: 80px 0 70px; }
    .cfl-card { width:82vw; margin-left:calc(-41vw); height:340px; margin-top:-170px; }
    .cfl-reflection { bottom:-345px; height:340px; }
}
</style>

<section class="cfl-section" id="incidencias">
    <div class="cfl-container">

        <div class="cfl-header">
            <div>
                <div class="cfl-eyebrow">
                    <span class="cfl-eyebrow-pulse"></span>
                    Evidencia Ciudadana
                </div>
                <h2 class="cfl-title">Fotos de <span>reportes recientes</span></h2>
                <p class="cfl-sub">Imágenes enviadas por ciudadanos que documentan incidencias activas en la ciudad.</p>
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

<script>
(function () {
    'use strict';

    const UPLOADS = '/public/uploads/';
    const AUTO_MS = 4500;

    let items   = [];
    let current = 0;
    let paused  = false;
    let autoTimer = null;
    let ringRaf   = null;
    let ringStart = null;

    const stage    = document.getElementById('cfl-stage');
    const btnPrev  = document.getElementById('cfl-prev');
    const btnNext  = document.getElementById('cfl-next');
    const countEl  = document.getElementById('cfl-count');
    const progFill = document.getElementById('cfl-prog');
    const progLbl  = document.getElementById('cfl-prog-label');

    function esc(s) {
        return String(s ?? '').replace(/[&<>"']/g, m =>
            ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])
        );
    }

    function pillClass(st) {
        st = (st || '').toLowerCase();
        if (st === 'resuelto')  return 's-resuelto';
        if (st === 'rechazado') return 's-rechazado';
        if (st.includes('proceso') || st === 'activo') return 's-proceso';
        return 's-pendiente';
    }

    function buildCard(inc, idx) {
        const name    = esc(inc.nombre_ciudadano || 'Anonimo');
        const tipo    = esc(inc.tipo_incidencia  || 'Incidencia');
        const folio   = '#' + inc.id;
        const stClass = pillClass(inc.estatus);
        const stRaw   = inc.estatus || 'pendiente';
        const stLabel = esc(stRaw.charAt(0).toUpperCase() + stRaw.slice(1));
        const imgSrc  = inc.foto ? `${UPLOADS}${esc(inc.foto)}` : '';
        const addr    = esc(inc.direccion || '');
        const desc    = esc(inc.descripcion || '');
        const mapBtn  = (inc.latitud && inc.longitud)
            ? `<button class="cfl-mapbtn" data-id="${inc.id}">Ver en mapa</button>`
            : '';

        const card = document.createElement('div');
        card.className   = 'cfl-card';
        card.dataset.idx = idx;
        card.innerHTML = `
            ${imgSrc ? `<img class="cfl-img" src="${imgSrc}" alt="Incidencia ${folio}" loading="lazy" onerror="this.style.display='none'">` : ''}
            <div class="cfl-grad"></div>
            <div class="cfl-folio">${folio}</div>
            <div class="cfl-info">
                <p class="cfl-tipo">${tipo}</p>
                <p class="cfl-nombre">${name}</p>
                <div class="cfl-row">
                    <span class="cfl-pill ${stClass}">${stLabel}</span>
                </div>
                <div class="cfl-details">
                    <div class="cfl-details-inner">
                        ${addr ? `<p class="cfl-details-addr"><svg viewBox="0 0 24 24"><path d="M12 21s-8-7.5-8-12a8 8 0 1 1 16 0c0 4.5-8 12-8 12z"/><circle cx="12" cy="9" r="2.5"/></svg>${addr}</p>` : ''}
                        ${desc ? `<p class="cfl-details-desc">${desc}</p>` : ''}
                        ${mapBtn}
                    </div>
                </div>
            </div>
            <button class="cfl-toggle-btn" type="button">
                <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                <span class="t-open">Ver info</span>
                <span class="t-close">Cerrar</span>
            </button>
            ${imgSrc ? `<div class="cfl-reflection"><img src="${imgSrc}" alt="" aria-hidden="true" loading="lazy" onerror="this.parentElement.style.display='none'"></div>` : ''}
            <div class="cfl-hint">
                <span class="cfl-hint-icon">
                    <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </div>
            <div class="cfl-autoplay-ring" id="cfl-ring-${idx}">
                <svg viewBox="0 0 30 30"><circle cx="15" cy="15" r="12.5"/></svg>
            </div>`;

        // Clic en carta lateral → navega; clic en carta activa → toggle info
        card.addEventListener('click', function () {
            const i = parseInt(this.dataset.idx);
            if (i !== current) goTo(i, true);
            else this.classList.toggle('cfl-expanded');
        });

        // Toggle expandir — touchend ADICIONAL para iOS Safari (preserve-3d bug)
        function toggleExpand(e) {
            e.stopPropagation();
            card.classList.toggle('cfl-expanded');
        }
        const toggleBtn = card.querySelector('.cfl-toggle-btn');
        if (toggleBtn) {
            toggleBtn.addEventListener('click',    toggleExpand);
            // iOS: touchend + preventDefault evita que después dispare el click (toggle doble)
            toggleBtn.addEventListener('touchend', function(e) {
                e.preventDefault();
                toggleExpand(e);
            }, { passive: false });
        }
        // Boton Ver en mapa — mismo fix iOS
        const mapBtnEl = card.querySelector('.cfl-mapbtn');
        if (mapBtnEl) {
            function openMap(e) {
                e.stopPropagation();
                const id = parseInt(mapBtnEl.dataset.id);
                if (typeof verEnMapa === 'function') verEnMapa(id);
            }
            mapBtnEl.addEventListener('click',    openMap);
            mapBtnEl.addEventListener('touchend', function(e) {
                e.preventDefault();
                openMap(e);
            }, { passive: false });
        }
        return card;
    }

    function getTransform(offset) {
        const abs = Math.abs(offset);
        if (abs === 0) return { tx:0,      ry:0,            scl:1,    tz:80,   op:1,    filt:'' };
        if (abs === 1) return { tx:offset*270, ry:-offset*44, scl:0.80, tz:-30,  op:0.82, filt:'' };
        if (abs === 2) return { tx:offset*320, ry:-offset*62, scl:0.64, tz:-110, op:0.50, filt:'blur(1px)' };
        return               { tx:offset*360, ry:-offset*78, scl:0.5,  tz:-180, op:0,    filt:'blur(3px)' };
    }

    function positionAll() {
        stage.querySelectorAll('.cfl-card').forEach(card => {
            const i      = parseInt(card.dataset.idx);
            const offset = i - current;
            const abs    = Math.abs(offset);
            if (abs !== 0) card.classList.remove('cfl-expanded');
            const t      = getTransform(offset);
            card.style.transform    = `translateX(${t.tx}px) rotateY(${t.ry}deg) scale(${t.scl}) translateZ(${t.tz}px)`;
            card.style.opacity      = t.op;
            card.style.filter       = t.filt;
            card.style.zIndex       = 20 - abs;
            card.style.pointerEvents = abs <= 2 ? 'auto' : 'none';
            card.classList.toggle('cfl-card-active', abs === 0);
            // update hint arrow direction
            const poly = card.querySelector('.cfl-hint-icon svg polyline');
            if (poly) poly.setAttribute('points', offset < 0 ? '15 18 9 12 15 6' : '9 18 15 12 9 6');
        });
    }

    function updateUI() {
        if (!items.length) return;
        const n = items.length;
        if (countEl)  countEl.textContent  = `${current+1} / ${n}`;
        if (progFill) progFill.style.width = `${((current+1)/n)*100}%`;
        if (progLbl)  progLbl.textContent  = `${current+1} de ${n}`;
        if (btnPrev)  btnPrev.disabled = current === 0;
        if (btnNext)  btnNext.disabled = current === n-1;
    }

    function goTo(idx, userAction) {
        if (!items.length) return;
        current = Math.max(0, Math.min(idx, items.length-1));
        positionAll();
        updateUI();
        if (userAction) resetAutoplay();
    }

    /* ring SVG de autoplay */
    function drawRing(progress) {
        const ringEl = document.getElementById(`cfl-ring-${current}`);
        if (!ringEl) return;
        const circle = ringEl.querySelector('circle');
        if (circle) circle.style.strokeDashoffset = 78.5 * (1 - progress);
    }
    function clearAllRings() {
        stage.querySelectorAll('.cfl-autoplay-ring circle').forEach(c => {
            c.style.strokeDashoffset = '78.5';
        });
    }
    function startRingAnim() {
        if (ringRaf) cancelAnimationFrame(ringRaf);
        ringStart = null;
        function raf(ts) {
            if (!ringStart) ringStart = ts;
            if (paused) { ringStart = ts - ((ts - ringStart)); ringRaf = requestAnimationFrame(raf); return; }
            const progress = Math.min((ts - ringStart) / AUTO_MS, 1);
            drawRing(progress);
            if (progress < 1) ringRaf = requestAnimationFrame(raf);
        }
        ringRaf = requestAnimationFrame(raf);
    }
    function resetAutoplay() {
        clearTimeout(autoTimer);
        clearAllRings();
        if (ringRaf) { cancelAnimationFrame(ringRaf); ringRaf = null; }
        if (paused) return;
        startRingAnim();
        autoTimer = setTimeout(() => {
            goTo(current+1 < items.length ? current+1 : 0, false);
            resetAutoplay();
        }, AUTO_MS);
    }

    function render(rows) {
        stage.innerHTML = '';
        items = rows.filter(r => r && r.foto).slice(0, 20);
        if (!items.length) {
            stage.innerHTML = '<p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#64748b;white-space:nowrap">No hay fotos disponibles.</p>';
            return;
        }
        items.forEach((inc, i) => stage.appendChild(buildCard(inc, i)));
        current = 0;
        positionAll();
        updateUI();
        resetAutoplay();
    }

    if (btnPrev) btnPrev.addEventListener('click', () => goTo(current-1, true));
    if (btnNext) btnNext.addEventListener('click', () => goTo(current+1, true));

    document.addEventListener('keydown', e => {
        if (!items.length) return;
        if (e.key === 'ArrowLeft')  goTo(current-1, true);
        if (e.key === 'ArrowRight') goTo(current+1, true);
    });

    const stageWrap = stage.parentElement;
    stageWrap.addEventListener('mouseenter', () => { paused = true; });
    stageWrap.addEventListener('mouseleave', () => { paused = false; if (!autoTimer) resetAutoplay(); });

    fetch('/public/api/incidencias.php?limit=20')
        .then(r => r.json())
        .then(d => render(d?.ok ? (d.rows || []) : []))
        .catch(() => { stage.innerHTML = '<p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#ef4444">Error al cargar</p>'; });
})();
</script>