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
    transition: transform 0.65s ease;
}
.cfl-card-active:hover .cfl-img { transform: scale(1.05); }

.cfl-grad {
    position: absolute; inset: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.98) 0%,
        rgba(0,0,0,0.65) 38%,
        rgba(0,0,0,0.15) 68%,
        transparent 100%
    );
    pointer-events: none;
}

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

.cfl-info {
    position: absolute; bottom:0; left:0; right:0;
    padding: 28px 18px 20px; z-index: 4; color: #fff;
}
.cfl-tipo {
    font-size: 0.7rem; font-weight: 700;
    letter-spacing: 0.08em; text-transform: uppercase;
    color: rgba(255,255,255,0.55); margin-bottom: 5px;
}
.cfl-nombre {
    font-size: 1.05rem; font-weight: 800;
    margin: 0 0 14px; white-space: nowrap;
    overflow: hidden; text-overflow: ellipsis;
    text-shadow: 0 2px 10px rgba(0,0,0,0.5);
}
.cfl-row {
    display: flex; align-items: center;
    justify-content: space-between; gap: 8px;
}

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
    padding: 5px 14px; border-radius: 999px;
    background: var(--primary, #9d1b32); color: #fff;
    border: none; cursor: pointer; font-family: inherit;
    letter-spacing: 0.02em; white-space: nowrap;
    transition: filter 0.18s, transform 0.15s;
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
        const mapBtn  = (inc.latitud && inc.longitud)
            ? `<button class="cfl-mapbtn" onclick="typeof verEnMapa==='function'&&verEnMapa(${inc.id});event.stopPropagation()">Ver mapa</button>`
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
                    ${mapBtn}
                </div>
            </div>
            ${imgSrc ? `<div class="cfl-reflection"><img src="${imgSrc}" alt="" aria-hidden="true" loading="lazy" onerror="this.parentElement.style.display='none'"></div>` : ''}
            <div class="cfl-hint">
                <span class="cfl-hint-icon">
                    <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </div>
            <div class="cfl-autoplay-ring" id="cfl-ring-${idx}">
                <svg viewBox="0 0 30 30"><circle cx="15" cy="15" r="12.5"/></svg>
            </div>`;

        card.addEventListener('click', function () {
            const i = parseInt(this.dataset.idx);
            if (i !== current) goTo(i, true);
        });
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

    let touchX0 = 0;
    const stageWrap = stage.parentElement;
    stageWrap.addEventListener('touchstart', e => { touchX0 = e.touches[0].clientX; }, { passive:true });
    stageWrap.addEventListener('touchend',   e => {
        const diff = touchX0 - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 60) goTo(current + (diff > 0 ? 1 : -1), true);
    }, { passive:true });

    stageWrap.addEventListener('mouseenter', () => { paused = true; });
    stageWrap.addEventListener('mouseleave', () => { paused = false; if (!autoTimer) resetAutoplay(); });

    fetch('/public/api/incidencias.php?limit=20')
        .then(r => r.json())
        .then(d => render(d?.ok ? (d.rows || []) : []))
        .catch(() => { stage.innerHTML = '<p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#ef4444">Error al cargar</p>'; });
})();
</script>