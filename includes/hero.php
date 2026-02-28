<section class="hero section has-bg-color invert-color">
    <!-- Particle canvas -->
    <canvas id="hero-canvas" aria-hidden="true"></canvas>
    <div class="hero-grid-overlay"></div>
    <div class="container">
        <div class="hero-inner section-inner">
            <div class="split-wrap">
                <div class="split-item">
                    <div class="hero-content split-item-content center-content-mobile reveal-from-top">
                        <span class="hero-eyebrow">Plataforma ciudadana 24/7</span>
                        <h1 class="mt-0 mb-16">Reporta incidencias y mejora tu <span class="hero-accent">ciudad</span> en minutos</h1>
                        <p class="mt-0 mb-32">Conecta con tu municipio de forma rápida, transparente y
                            desde cualquier dispositivo. Tu reporte se registra al instante y puedes darle
                            seguimiento en tiempo real.</p>
                        <div class="button-group">
                            <a class="button button-primary button-wide-mobile modal-trigger"
                                aria-controls="modal-report" href="#0">
                                <svg class="hero-btn-icon" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                Crear reporte ahora
                            </a>
                            <a class="button button-dark button-wide-mobile modal-trigger"
                                aria-controls="modal-consult" href="#0">Consultar mi folio</a>
                        </div>
                        
                    </div>
                    <!-- ── MINI-MAPA EN VIVO ── -->
                    <div class="hero-figure split-item-image split-item-image-fill illustration-element-01 reveal-from-bottom">
                        <div class="hero-map-card">
                            <!-- Card header bar -->
                            <div class="hero-map-header">
                                <div class="hero-map-header-title">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    Mapa en vivo
                                </div>
                                <div class="hero-map-header-right">
                                    <span class="hero-map-header-dot"></span>
                                    <span class="hero-map-header-badge">NEZA</span>
                                </div>
                            </div>
                            <!-- Floating notification pill -->
                            <div class="hero-map-notif">
                                <div class="hero-map-notif-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div>
                                    <div class="hero-map-notif-title">Nuevo reporte</div>
                                    <div class="hero-map-notif-sub">Hace 2 min &middot; Pendiente</div>
                                </div>
                            </div>
                            <!-- Map iframe -->
                            <div class="hero-map-wrap">
                                <iframe
                                    class="hero-map-iframe"
                                    src="https://www.google.com/maps?q=19.4326,-99.1332&hl=es&z=13&output=embed"
                                    loading="lazy"
                                    allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                                <div class="hero-map-tint"></div>
                                <!-- Interaction blocker: map is decorative only -->
                                <a href="#mapa-controles" class="hero-map-blocker smooth-scroll" aria-label="Ver mapa completo">
                                    <span class="hero-map-blocker-hint">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                        Ver mapa completo
                                    </span>
                                </a>
                            </div>
                            <!-- Live footer bar -->
                            <div class="hero-map-footer">
                                <span class="hero-map-live-dot"></span>
                                <span class="hero-map-live-text">En vivo &mdash; <strong id="hm-active">—</strong> reportes activos</span>
                                <a href="#mapa-controles" class="hero-map-view-btn smooth-scroll">
                                    Ver completo
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats strip — loaded from API -->
            <div class="hero-stats-strip">
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="--si:157,27,50">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    </div>
                    <span class="hero-stat-num" id="hs-total">—</span>
                    <span class="hero-stat-label">Total reportes</span>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="--si:5,150,105">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <span class="hero-stat-num" id="hs-resueltos">—</span>
                    <span class="hero-stat-label">Resueltos</span>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="--si:37,99,235">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <span class="hero-stat-num" id="en">—</span>
                    <span class="hero-stat-label">En proceso</span>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="--si:217,119,6">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    </div>
                    <span class="hero-stat-num" id="hs-pending">—</span>
                    <span class="hero-stat-label">Pendientes</span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    /* ── PARTICLE CANVAS ── */
    (function () {
        const canvas = document.getElementById('hero-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let W, H, particles;

        function resize() {
            const hero = canvas.parentElement;
            W = canvas.width  = hero.offsetWidth;
            H = canvas.height = hero.offsetHeight;
        }

        function mkParticle() {
            return {
                x:  Math.random() * W,
                y:  Math.random() * H,
                r:  Math.random() * 1.5 + 0.4,
                vx: (Math.random() - 0.5) * 0.35,
                vy: (Math.random() - 0.5) * 0.35,
                a:  Math.random() * 0.4 + 0.08
            };
        }

        function init() { resize(); particles = Array.from({ length: 70 }, mkParticle); }

        function draw() {
            ctx.clearRect(0, 0, W, H);
            const dark      = document.documentElement.classList.contains('dark');
            const dotRGB   = dark ? '255,255,255' : '157,27,50';
            const lineRGB  = dark ? '255,255,255' : '157,27,50';
            const lineMul  = dark ? 0.055 : 0.18;
            const alphaFac = dark ? 1 : 2.8;
            for (let i = 0; i < particles.length; i++) {
                const p = particles[i];
                p.x += p.vx; p.y += p.vy;
                if (p.x < 0) p.x = W; else if (p.x > W) p.x = 0;
                if (p.y < 0) p.y = H; else if (p.y > H) p.y = 0;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(' + dotRGB + ',' + Math.min(p.a * alphaFac, 0.75) + ')';
                ctx.fill();
                for (let j = i + 1; j < particles.length; j++) {
                    const q = particles[j];
                    const dx = p.x - q.x, dy = p.y - q.y;
                    const d  = Math.sqrt(dx * dx + dy * dy);
                    if (d < 110) {
                        ctx.beginPath();
                        ctx.moveTo(p.x, p.y); ctx.lineTo(q.x, q.y);
                        ctx.strokeStyle = 'rgba(' + lineRGB + ',' + (lineMul * (1 - d / 110)) + ')';
                        ctx.lineWidth = 0.6; ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(draw);
        }

        init(); draw();
        window.addEventListener('resize', resize);
    })();

    /* ── FOLIO QUICK-SEARCH: pass value to modal and auto-submit ── */
    (function () {
        const input  = document.getElementById('hero-folio-input');
        const btn    = document.querySelector('.hero-folio-btn');
        if (!input || !btn) return;

        function openWithFolio() {
            const val = input.value.trim();
            // Open the consult modal via the existing modal trigger mechanism
            const trigger = document.querySelector('[aria-controls="modal-consult"]');
            if (trigger) trigger.click();
            // Pre-fill + auto-submit after modal opens
            setTimeout(function () {
                const mInput = document.getElementById('report-number');
                const mForm  = document.getElementById('form-consult');
                if (mInput && val) {
                    mInput.value = val;
                    if (mForm) mForm.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
                }
            }, 80);
        }

        btn.addEventListener('click', openWithFolio);
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') openWithFolio();
        });
    })();

    /* ── LIVE STATS + MAP COUNT ── */
    (async () => {
        try {
            const r = await fetch('/api/stats.php');
            const d = await r.json();
            if (!d.ok) return;
            const s = d.stats || {};

            function countUp(id, target, duration) {
                const el = document.getElementById(id);
                if (!el || !target) return;
                const start = performance.now();
                function step(now) {
                    const progress = Math.min((now - start) / duration, 1);
                    /* ease-out cubic */
                    const ease = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.round(ease * target);
                    if (progress < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }

            const active = (parseInt(s.en_proceso) || 0) + (parseInt(s.pendientes) || 0);
            countUp('hs-total',     s.total      || 0, 1400);
            countUp('hs-resueltos', s.resueltos  || 0, 1600);
            countUp('en',           s.en_proceso || 0, 1500);
            countUp('hs-pending',   s.pendientes || 0, 1700);
            countUp('hm-active',    active       || 0, 1500);
        } catch (_) { /* silently ignore */ }
    })();
</script>
