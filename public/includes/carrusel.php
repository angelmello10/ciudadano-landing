<style>
/* ── CARRUSEL INCIDENCIAS ── */
.rc-section {
    padding: 100px 0 90px;
    background: #f8fafc;
    position: relative;
    overflow: hidden;
    border-top: 1px solid rgba(0,0,0,0.06);
}
html.dark .rc-section {
    background: #0f0a0d;
    border-top-color: rgba(255,255,255,0.05);
}

/* Decorative glow behind header */
.rc-section::before {
    content: '';
    position: absolute;
    top: -80px;
    left: 50%;
    transform: translateX(-50%);
    width: 600px;
    height: 300px;
    background: radial-gradient(ellipse, rgba(157,27,50,0.08) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}
html.dark .rc-section::before {
    background: radial-gradient(ellipse, rgba(157,27,50,0.30) 0%, transparent 70%);
}

.rc-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 32px;
    position: relative;
    z-index: 1;
}

.rc-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 48px;
    flex-wrap: wrap;
}

.rc-header-left {
    flex: 1;
}

.rc-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--primary, #9d1b32);
    margin-bottom: 10px;
}
html.dark .rc-label { color: #f87171; }

.rc-label-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--primary, #9d1b32);
    animation: rcPulse 2s ease-in-out infinite;
}
html.dark .rc-label-dot { background: #f87171; }

@keyframes rcPulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(157,27,50,0.5); }
    50% { box-shadow: 0 0 0 6px rgba(157,27,50,0); }
}

.rc-title {
    font-family: 'Space Grotesk', 'Inter', system-ui, sans-serif;
    font-size: 2.2rem;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.025em;
    margin: 0 0 10px;
    line-height: 1.2;
}
html.dark .rc-title { color: #f1f5f9; }

.rc-subtitle {
    font-size: 0.98rem;
    color: #64748b;
    margin: 0;
    max-width: 520px;
    line-height: 1.65;
}
html.dark .rc-subtitle { color: #94a3b8; }

.rc-header-nav {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-shrink: 0;
}

.rc-carousel-wrapper {
    position: relative;
}

.rc-viewport {
    overflow: hidden;
    border-radius: 18px;
    /* Fade edges for a premium look */
    -webkit-mask-image: linear-gradient(to right, transparent 0px, black 40px, black calc(100% - 40px), transparent 100%);
    mask-image: linear-gradient(to right, transparent 0px, black 40px, black calc(100% - 40px), transparent 100%);
}

.rc-track {
    display: flex;
    gap: 20px;
    transition: transform 0.55s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform;
    padding: 28px 40px;
}

.rc-card {
    flex: 0 0 260px;
    height: 370px;
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    background: #e2e8f0;
    border: 1px solid rgba(0,0,0,0.08);
    box-shadow: 0 4px 20px rgba(0,0,0,0.10);
    transition: transform 0.4s cubic-bezier(0.4,0,0.2,1), box-shadow 0.4s ease;
    cursor: pointer;
}
html.dark .rc-card {
    background: #1a0d12;
    border-color: rgba(157,27,50,0.18);
    box-shadow: 0 8px 32px rgba(0,0,0,0.6);
}

.rc-card:hover {
    transform: translateY(-10px) scale(1.04);
    box-shadow: 0 24px 50px rgba(0,0,0,0.18), 0 0 0 2px rgba(157,27,50,0.3);
    z-index: 10;
}
html.dark .rc-card:hover {
    box-shadow: 0 28px 60px rgba(0,0,0,0.7), 0 0 0 1px rgba(157,27,50,0.5);
}

.rc-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
    display: block;
}

.rc-card:hover .rc-img {
    transform: scale(1.08);
}

.rc-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.95) 0%,
        rgba(0,0,0,0.55) 45%,
        rgba(0,0,0,0.10) 70%,
        transparent 100%
    );
    pointer-events: none;
}

.rc-folio {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(0,0,0,0.55);
    color: rgba(255,255,255,0.75);
    font-size: 0.7rem;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    z-index: 3;
    letter-spacing: 0.04em;
}

.rc-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 26px 18px 20px;
    color: white;
    z-index: 3;
}

.rc-name {
    font-size: 1rem;
    font-weight: 800;
    margin: 0 0 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

.rc-role {
    font-size: 0.80rem;
    opacity: 0.85;
    margin-bottom: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-transform: capitalize;
    letter-spacing: 0.02em;
}

.rc-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
}

/* Status pills with colors */
.rc-pill {
    font-size: 0.68rem;
    font-weight: 800;
    padding: 4px 11px;
    border-radius: 999px;
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.15);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    background: rgba(255,255,255,0.15);
    color: #fff;
}
.rc-pill.s-resuelto   { background: rgba(34,197,94,0.30);  border-color: rgba(34,197,94,0.50);  color: #86efac; }
.rc-pill.s-pendiente  { background: rgba(245,158,11,0.28); border-color: rgba(245,158,11,0.45); color: #fde68a; }
.rc-pill.s-rechazado  { background: rgba(239,68,68,0.28);  border-color: rgba(239,68,68,0.45);  color: #fca5a5; }
.rc-pill.s-proceso    { background: rgba(59,130,246,0.28); border-color: rgba(59,130,246,0.45); color: #93c5fd; }

.rc-map-btn {
    font-size: 0.72rem;
    font-weight: 800;
    padding: 6px 14px;
    background: var(--primary, #9d1b32);
    color: #fff;
    border: none;
    border-radius: 999px;
    cursor: pointer;
    transition: background 0.18s, transform 0.15s;
    font-family: inherit;
    white-space: nowrap;
    letter-spacing: 0.02em;
}
.rc-map-btn:hover { background: #7e1527; transform: translateY(-1px); }

/* Navigation buttons in header now */
.rc-nav-btn {
    width: 40px;
    height: 40px;
    background: #fff;
    color: #334155;
    border: 1px solid rgba(0,0,0,0.10);
    border-radius: 50%;
    font-size: 22px;
    display: grid;
    place-items: center;
    cursor: pointer;
    transition: all 0.2s ease;
    z-index: 10;
    flex-shrink: 0;
    line-height: 1;
    padding: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
html.dark .rc-nav-btn {
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.8);
    border-color: rgba(255,255,255,0.10);
    box-shadow: none;
}

.rc-nav-btn:hover {
    background: var(--primary, #9d1b32);
    border-color: var(--primary, #9d1b32);
    color: #fff;
    transform: scale(1.1);
    box-shadow: 0 4px 14px rgba(157,27,50,0.35);
}

/* Progress dots */
.rc-dots {
    display: flex;
    justify-content: center;
    gap: 6px;
    margin-top: 24px;
}

.rc-dot {
    height: 3px;
    border-radius: 99px;
    background: rgba(0,0,0,0.15);
    transition: width 0.3s ease, background 0.3s ease;
    cursor: pointer;
    width: 20px;
}
html.dark .rc-dot { background: rgba(255,255,255,0.18); }

.rc-dot.active {
    background: var(--primary, #9d1b32);
    width: 36px;
}

/* Responsive */
@media (max-width: 1024px) {
    .rc-card { flex-basis: 230px; height: 340px; }
}
@media (max-width: 640px) {
    .rc-section { padding: 70px 0 60px; }
    .rc-container { padding: 0 16px; }
    .rc-card { flex-basis: 78vw; height: 360px; }
    .rc-title { font-size: 1.8rem; }
    .rc-header { margin-bottom: 28px; }
    .rc-subtitle { font-size: 0.88rem; }
    .rc-track { padding: 16px 24px; gap: 14px; }
}
</style>

<section class="rc-section">
    <div class="rc-container">
        <div class="rc-header">
            <div class="rc-header-left">
                <div class="rc-label">
                    <span class="rc-label-dot"></span>
                    Evidencia Ciudadana
                </div>
                <h2 class="rc-title">Fotos de reportes recientes</h2>
                <p class="rc-subtitle">Imágenes enviadas por ciudadanos de incidencias activas en la ciudad.</p>
            </div>
            <div class="rc-header-nav">
                <button class="rc-nav-btn" id="rc-prev" aria-label="Anterior">‹</button>
                <button class="rc-nav-btn" id="rc-next" aria-label="Siguiente">›</button>
            </div>
        </div>

        <div class="rc-carousel-wrapper">
            <div class="rc-viewport">
                <div class="rc-track" id="rc-track"></div>
            </div>
        </div>
        <div class="rc-dots" id="rc-dots"></div>
    </div>
</section>

<script>
(function(){
    const UPLOADS = '/uploads/';
    let items = [];
    let current = 0;

    const track = document.getElementById('rc-track');
    const btnPrev = document.getElementById('rc-prev');
    const btnNext = document.getElementById('rc-next');

    function escapeHtml(s) {
        return String(s ?? '').replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
    }

    function cardHtml(inc) {
        const name = escapeHtml(inc.nombre_ciudadano || 'Anónimo');
        const tipo = escapeHtml(inc.tipo_incidencia || 'Incidencia');
        const folio = '#' + inc.id;
        const st = (inc.estatus || 'pendiente').toLowerCase();
        
        // Status pill class
        let stClass = 's-pendiente';
        if(st === 'resuelto') stClass = 's-resuelto';
        else if(st === 'rechazado') stClass = 's-rechazado';
        else if(st.includes('proceso') || st === 'activo') stClass = 's-proceso';
        
        const stLabel = st.charAt(0).toUpperCase() + st.slice(1);

        const img = inc.foto 
            ? `<img class="rc-img" src="${UPLOADS}${escapeHtml(inc.foto)}" alt="Incidencia ${folio}" loading="lazy" onerror="this.parentElement.style.background='#1e2937'">` 
            : '';

        const mapBtn = (inc.latitud && inc.longitud) 
            ? `<button class="rc-map-btn" onclick="typeof verEnMapa==='function'&&verEnMapa(${inc.id}); event.stopPropagation();">Ver mapa</button>` 
            : '';

        return `
        <div class="rc-card" data-id="${inc.id}">
            ${img}
            <div class="rc-overlay"></div>
            <div class="rc-folio">${folio}</div>
            <div class="rc-info">
                <p class="rc-name">${name}</p>
                <p class="rc-role">${tipo}</p>
                <div class="rc-meta">
                    <span class="rc-pill ${stClass}">${stLabel}</span>
                    ${mapBtn}
                </div>
            </div>
        </div>`;
    }

    const dotsEl = document.getElementById('rc-dots');

    function getStep() {
        const card = track.querySelector('.rc-card');
        if(!card) return 278;
        const gap = parseInt(getComputedStyle(track).gap) || 18;
        return card.offsetWidth + gap;
    }

    function buildDots() {
        if(!dotsEl) return;
        const total = Math.min(items.length, 10); // max dots
        dotsEl.innerHTML = Array.from({length: total}, (_,i) =>
            `<div class="rc-dot${i===0?' active':''}" data-i="${i}"></div>`
        ).join('');
        dotsEl.querySelectorAll('.rc-dot').forEach(d => {
            d.onclick = () => goTo(+d.dataset.i);
        });
    }

    function updateDots() {
        if(!dotsEl) return;
        dotsEl.querySelectorAll('.rc-dot').forEach((d, i) => {
            d.classList.toggle('active', i === current);
        });
    }

    function goTo(idx) {
        current = Math.max(0, Math.min(idx, items.length - 1));
        track.style.transform = `translateX(-${current * getStep()}px)`;
        updateDots();
    }

    function render(rows) {
        items = rows.filter(r => r && r.foto).slice(0, 20);
        if (!items.length) {
            track.innerHTML = `<div style="padding:100px 40px;text-align:center;color:#64748b;font-size:1rem;">No hay fotos disponibles aún.</div>`;
            return;
        }
        track.innerHTML = items.map(cardHtml).join('');
        buildDots();
        goTo(0);
    }

    btnPrev.onclick = () => goTo(current - 1);
    btnNext.onclick = () => goTo(current + 1);

    // Swipe táctil
    let touchStartX = 0;
    track.addEventListener('touchstart', e => touchStartX = e.touches[0].clientX, {passive: true});
    track.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 70) goTo(current + (diff > 0 ? 1 : -1));
    }, {passive: true});

    window.addEventListener('resize', () => goTo(current));

    // Cargar datos
    fetch('/api/incidencias.php?limit=20')
        .then(r => r.json())
        .then(d => d?.ok ? render(d.rows || []) : render([]))
        .catch(() => {
            track.innerHTML = `<div style="padding:120px 40px;text-align:center;color:#ef4444;">Error al cargar</div>`;
        });
})();
</script>