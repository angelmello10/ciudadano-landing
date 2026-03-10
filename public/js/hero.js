/* ── PARTICLE CANVAS ── */
(function () {
    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let W, H, particles;

    function resize() {
        const hero = canvas.parentElement;
        W = canvas.width = hero.offsetWidth;
        H = canvas.height = hero.offsetHeight;
    }

    function mkParticle() {
        return {
            x: Math.random() * W,
            y: Math.random() * H,
            r: Math.random() * 1.8 + 0.6,
            vx: (Math.random() - 0.5) * 0.45,
            vy: (Math.random() - 0.5) * 0.45,
            a: Math.random() * 0.6 + 0.18
        };
    }

    function init() { resize(); particles = Array.from({ length: 140 }, mkParticle); }

    function draw() {
        ctx.clearRect(0, 0, W, H);
        const dark = document.documentElement.classList.contains('dark');
        const dotRGB = '157,27,50';
        const lineRGB = '157,27,50';
        const lineMul = dark ? 0.12 : 0.36;
        const alphaFac = dark ? 1.4 : 4.0;
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
                const d = Math.sqrt(dx * dx + dy * dy);
                if (d < 140) {
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y); ctx.lineTo(q.x, q.y);
                    ctx.strokeStyle = 'rgba(' + lineRGB + ',' + (lineMul * (1 - d / 140)) + ')';
                    ctx.lineWidth = 0.7; ctx.stroke();
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
    const input = document.getElementById('hero-folio-input');
    const btn = document.querySelector('.hero-folio-btn');
    if (!input || !btn) return;

    function openWithFolio() {
        const val = input.value.trim();
        // Open the consult modal via the existing modal trigger mechanism
        const trigger = document.querySelector('[aria-controls="modal-consult"]');
        if (trigger) trigger.click();
        // Pre-fill + auto-submit after modal opens
        setTimeout(function () {
            const mInput = document.getElementById('report-number');
            const mForm = document.getElementById('form-consult');
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
async function refreshHeroStats() {
    try {
        const r = await fetch('/public/api/stats.php');
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

        function set(id, val) {
            const el = document.getElementById(id);
            if (el) el.textContent = val;
        }

        function setBar(id, pct) {
            const el = document.getElementById(id);
            if (!el) return;
            const target = Math.max(0, Math.min(100, Math.round(pct)));
            el.style.width = target + '%';
        }

        const active = (parseInt(s.en_proceso) || 0) + (parseInt(s.pendientes) || 0);
        const totalNum = parseInt(s.total) || 0;

        function pctOf(val) {
            const n = parseInt(val) || 0;
            return totalNum ? (n / totalNum) * 100 : 0;
        }

        // Animación de barras
        function animateBars() {
            setBar('hs-total-bar', pctOf(s.total));
            setBar('hs-resueltos-bar', pctOf(s.resueltos));
            setBar('hs-en-bar', pctOf(s.en_proceso));
            setBar('hs-pending-bar', pctOf(s.pendientes));
        }

        if (!refreshHeroStats._loaded) {
            // Setup IntersectionObserver so stats don't animate until visible
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        countUp('hs-total', s.total || 0, 1400);
                        countUp('hs-resueltos', s.resueltos || 0, 1600);
                        countUp('en', s.en_proceso || 0, 1500);
                        countUp('hs-pending', s.pendientes || 0, 1700);
                        countUp('hm-active', active || 0, 1500);
                        
                        setTimeout(animateBars, 200);
                        obs.disconnect(); // Only animate once
                    }
                });
            }, { threshold: 0.15 }); // Trigger when 15% of the stats section is visible
            
            const statsElement = document.querySelector('.hero-stats-strip');
            if (statsElement) {
                observer.observe(statsElement);
            } else {
                // Fallback si no lo encuentra (no debería pasar)
                animateBars();
            }
            
            refreshHeroStats._loaded = true;
        } else {
            set('hs-total', s.total || 0);
            set('hs-resueltos', s.resueltos || 0);
            set('en', s.en_proceso || 0);
            set('hs-pending', s.pendientes || 0);
            set('hm-active', active || 0);
            
            animateBars();
        }
    } catch (_) { /* silently ignore */ }
}
refreshHeroStats();
setInterval(refreshHeroStats, 30000); // refresca cada 30s
