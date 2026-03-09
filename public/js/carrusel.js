(function () {
    'use strict';

    const UPLOADS = '/public/uploads/';
    const AUTO_MS = 5000; // Aumentado un poco para dar tiempo de jugar con el slider

    let items = [];
    let current = 0;
    let paused = false;
    let autoTimer = null;
    let ringRaf = null;
    let ringStart = null;

    const stage = document.getElementById('cfl-stage');
    const btnPrev = document.getElementById('cfl-prev');
    const btnNext = document.getElementById('cfl-next');
    const countEl = document.getElementById('cfl-count');
    const progFill = document.getElementById('cfl-prog');
    const progLbl = document.getElementById('cfl-prog-label');

    function esc(s) {
        return String(s ?? '').replace(/[&<>"']/g, m =>
            ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[m])
        );
    }

    function pillClass(st) {
        st = (st || '').toLowerCase();
        if (st === 'resuelto') return 's-resuelto';
        if (st === 'rechazado') return 's-rechazado';
        if (st.includes('proceso') || st === 'activo') return 's-proceso';
        return 's-pendiente';
    }

    function buildCard(inc, idx) {
        const tipo = esc(inc.tipo_incidencia || 'Incidencia');
        const folio = '#' + inc.id;
        const stClass = pillClass(inc.estatus);
        const stRaw = inc.estatus || 'pendiente';
        const stLabel = esc(stRaw.charAt(0).toUpperCase() + stRaw.slice(1));
        const imgBefore = `${UPLOADS}${esc(inc.foto)}`;
        const imgAfter = `${UPLOADS}${esc(inc.foto_despues)}`;

        const card = document.createElement('div');
        card.className = 'cfl-card';
        card.dataset.idx = idx;
        card.innerHTML = `
            <!-- Comparador Antes/Después -->
            <div class="cfl-comparer" data-comparer="${idx}">
                <img src="${imgBefore}" alt="Antes" class="cfl-comparer-img cfl-comparer-before" loading="lazy" onerror="this.style.opacity=0.3">
                <img src="${imgAfter}" alt="Después" class="cfl-comparer-img cfl-comparer-after" loading="lazy" onerror="this.style.opacity=0.3">
                
                <span class="cfl-comparer-label before">Antes</span>
                <span class="cfl-comparer-label after">Después</span>
                
                <div class="cfl-slider" style="left: 50%">
                    <div class="cfl-slider-handle">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="cfl-grad"></div>
            
            <div class="cfl-folio">${folio}</div>
            
            <div class="cfl-info">
                <p class="cfl-tipo">${tipo}</p>
                <p class="cfl-nombre">${esc(inc.direccion || 'Sin dirección')}</p>
                <div class="cfl-row">
                    <span class="cfl-pill ${stClass}">${stLabel}</span>
                </div>
            </div>
            
            <div class="cfl-hint">
                <span class="cfl-hint-icon">
                    <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </div>
            
            <div class="cfl-autoplay-ring" id="cfl-ring-${idx}">
                <svg viewBox="0 0 30 30"><circle cx="15" cy="15" r="12.5"/></svg>
            </div>`;

        // Inicializar el comparador en esta tarjeta
        initComparer(card.querySelector('.cfl-comparer'));

        // Clic en carta lateral → navega a ella
        card.addEventListener('click', function (e) {
            // No navegar si se está arrastrando el slider
            if (e.target.closest('.cfl-comparer')) return;

            const i = parseInt(this.dataset.idx);
            if (i !== current) goTo(i, true);
        });

        return card;
    }

    // Inicializar el slider del comparador
    function initComparer(container) {
        if (!container) return;

        let isDragging = false;
        const afterImg = container.querySelector('.cfl-comparer-after');
        const slider = container.querySelector('.cfl-slider');

        function updateSlider(x) {
            const rect = container.getBoundingClientRect();
            let percentage = ((x - rect.left) / rect.width) * 100;
            percentage = Math.max(5, Math.min(95, percentage));

            afterImg.style.clipPath = `inset(0 0 0 ${percentage}%)`;
            slider.style.left = `${percentage}%`;
        }

        // Mouse events
        container.addEventListener('mousedown', (e) => {
            isDragging = true;
            updateSlider(e.clientX);
            container.style.cursor = 'grabbing';
            e.stopPropagation(); // Evitar que se active el clic de la tarjeta
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            updateSlider(e.clientX);
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            container.style.cursor = 'col-resize';
        });

        // Touch events
        container.addEventListener('touchstart', (e) => {
            isDragging = true;
            updateSlider(e.touches[0].clientX);
            e.stopPropagation();
        }, { passive: true });

        container.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            updateSlider(e.touches[0].clientX);
        }, { passive: true });

        container.addEventListener('touchend', () => {
            isDragging = false;
        });

        // Click para saltar
        container.addEventListener('click', (e) => {
            if (e.target.closest('.cfl-slider-handle')) return;
            updateSlider(e.clientX);
            e.stopPropagation();
        });
    }

    function getTransform(offset) {
        const abs = Math.abs(offset);
        if (abs === 0) return { tx: 0, ry: 0, scl: 1, tz: 80, op: 1, filt: '' };
        if (abs === 1) return { tx: offset * 270, ry: -offset * 44, scl: 0.80, tz: -30, op: 0.82, filt: '' };
        if (abs === 2) return { tx: offset * 320, ry: -offset * 62, scl: 0.64, tz: -110, op: 0.50, filt: 'blur(1px)' };
        return { tx: offset * 360, ry: -offset * 78, scl: 0.5, tz: -180, op: 0, filt: 'blur(3px)' };
    }

    function positionAll() {
        stage.querySelectorAll('.cfl-card').forEach(card => {
            const i = parseInt(card.dataset.idx);
            const offset = i - current;
            const abs = Math.abs(offset);
            const t = getTransform(offset);
            card.style.transform = `translateX(${t.tx}px) rotateY(${t.ry}deg) scale(${t.scl}) translateZ(${t.tz}px)`;
            card.style.opacity = t.op;
            card.style.filter = t.filt;
            card.style.zIndex = 20 - abs;
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
        if (countEl) countEl.textContent = `${current + 1} / ${n}`;
        if (progFill) progFill.style.width = `${((current + 1) / n) * 100}%`;
        if (progLbl) progLbl.textContent = `${current + 1} de ${n}`;
        if (btnPrev) btnPrev.disabled = current === 0;
        if (btnNext) btnNext.disabled = current === n - 1;
    }

    function goTo(idx, userAction) {
        if (!items.length) return;
        current = Math.max(0, Math.min(idx, items.length - 1));
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
            goTo(current + 1 < items.length ? current + 1 : 0, false);
            resetAutoplay();
        }, AUTO_MS);
    }

    function render(rows) {
        stage.innerHTML = '';
        items = rows.filter(r => r && r.foto && r.foto_despues).slice(0, 20);
        if (!items.length) {
            stage.innerHTML = '<p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#64748b;white-space:nowrap">No hay reportes con fotos de antes y despu&eacute;s.</p>';
            return;
        }
        items.forEach((inc, i) => stage.appendChild(buildCard(inc, i)));
        current = 0;
        positionAll();
        updateUI();
        resetAutoplay();
    }

    if (btnPrev) btnPrev.addEventListener('click', () => goTo(current - 1, true));
    if (btnNext) btnNext.addEventListener('click', () => goTo(current + 1, true));

    document.addEventListener('keydown', e => {
        if (!items.length) return;
        if (e.key === 'ArrowLeft') goTo(current - 1, true);
        if (e.key === 'ArrowRight') goTo(current + 1, true);
    });

    const stageWrap = stage.parentElement;
    stageWrap.addEventListener('mouseenter', () => { paused = true; });
    stageWrap.addEventListener('mouseleave', () => { paused = false; if (!autoTimer) resetAutoplay(); });

    fetch('/public/api/incidencias.php?limit=20')
        .then(r => r.json())
        .then(d => render(d?.ok ? (d.rows || []) : []))
        .catch(() => { stage.innerHTML = '<p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#ef4444">Error al cargar</p>'; });
})();
