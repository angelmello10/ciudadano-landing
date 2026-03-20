(function () {
    'use strict';

    const UPLOADS = '/public/uploads/';

    let items = [];
    let current = 0;

    const stage = document.getElementById('cfl-stage');
    if (!stage) return;
    const btnPrev = document.getElementById('cfl-prev');
    const btnNext = document.getElementById('cfl-next');
    const countEl = document.getElementById('cfl-count');
    const progFill = document.getElementById('cfl-prog');

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
        const direccion = esc(inc.direccion || 'Sin dirección');

        const card = document.createElement('div');
        card.className = 'cfl-card';
        card.dataset.idx = idx;
        card.innerHTML = `
            <div class="cfl-comparer">
                <!-- Se añaden onerrors para evitar mostrar links rotos si falta la imagen -->
                <img src="${imgBefore}" alt="Antes" class="cfl-img-before" draggable="false" loading="lazy" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxIiBoZWlnaHQ9IjEiPjwvc3ZnPg=='">
                <div class="cfl-img-after-wrapper">
                    <img src="${imgAfter}" alt="Después" class="cfl-img-after" draggable="false" loading="lazy" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxIiBoZWlnaHQ9IjEiPjwvc3ZnPg=='">
                </div>
                
                <div class="cfl-label cfl-label-before">Antes</div>
                <div class="cfl-label cfl-label-after">Después</div>
                
                <div class="cfl-slider-container">
                    <div class="cfl-slider-line"></div>
                    <div class="cfl-slider-button">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 16l-4-4 4-4"/>
                            <path d="M11 16l4-4-4-4"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="cfl-card-content">
                <div class="cfl-card-header">
                    <span class="cfl-folio">${folio}</span>
                    <span class="cfl-status ${stClass}">${stLabel}</span>
                </div>
                <h3 class="cfl-category">${tipo}</h3>
                <p class="cfl-address">${direccion}</p>
            </div>
            
            <div class="cfl-hint">
                <div class="cfl-hint-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </div>
        `;

        initComparer(card.querySelector('.cfl-comparer'));

        card.addEventListener('click', function (e) {
            if (e.target.closest('.cfl-slider-container')) return;
            const i = parseInt(this.dataset.idx);
            if (i !== current) goTo(i);
        });

        return card;
    }

    function initComparer(container) {
        if (!container) return;

        let isDragging = false;
        let isAutoAnimating = true;
        let autoAnimFrame;
        let p = 50;
        let animDirection = 1; // 1 = right, -1 = left

        const wrapper = container.querySelector('.cfl-img-after-wrapper');
        const slider = container.querySelector('.cfl-slider-container');
        const labelBefore = container.querySelector('.cfl-label-before');
        const labelAfter = container.querySelector('.cfl-label-after');

        function _setSliderState(pct) {
            pct = Math.max(0, Math.min(100, pct));
            wrapper.style.clipPath = `inset(0 0 0 ${pct}%)`;
            slider.style.left = `${pct}%`;

            if (labelBefore) labelBefore.style.opacity = pct < 25 ? '0' : '1';
            if (labelAfter) labelAfter.style.opacity = pct > 75 ? '0' : '1';
        }

        function autoAnimate() {
            if (!isAutoAnimating) return;
            
            const card = container.closest('.cfl-card');
            // Sólo deslizar si es la tarjeta actual al frente
            if (card && card.classList.contains('cfl-card-active')) {
                p += 0.35 * animDirection;
                if (p > 85) animDirection = -1;
                if (p < 15) animDirection = 1;
                _setSliderState(p);
            }
            autoAnimFrame = requestAnimationFrame(autoAnimate);
        }

        let interactTimeout;

        function resumeAutoDelayed() {
            clearTimeout(interactTimeout);
            interactTimeout = setTimeout(() => {
                const card = container.closest('.cfl-card');
                if (card && card.classList.contains('cfl-card-active') && !isDragging) {
                    if (!isAutoAnimating) {
                        isAutoAnimating = true;
                        autoAnimFrame = requestAnimationFrame(autoAnimate);
                    }
                }
            }, 2500);
        }

        function stopAuto() {
            clearTimeout(interactTimeout);
            if (isAutoAnimating) {
                isAutoAnimating = false;
                cancelAnimationFrame(autoAnimFrame);
            }
        }

        function updateSlider(x) {
            const rect = container.getBoundingClientRect();
            let pct = ((x - rect.left) / rect.width) * 100;
            _setSliderState(pct);
        }

        function onStart(e) {
            stopAuto();
            isDragging = true;
            updateSlider(e.touches ? e.touches[0].clientX : e.clientX);
            if (e.cancelable) e.preventDefault();
        }
        function onMove(e) {
            if (!isDragging) return;
            updateSlider(e.touches ? e.touches[0].clientX : e.clientX);
        }
        function onEnd() { 
            isDragging = false; 
            resumeAutoDelayed();
        }

        slider.addEventListener('mousedown', onStart);
        container.addEventListener('touchstart', onStart, { passive: false });

        document.addEventListener('mousemove', onMove);
        document.addEventListener('touchmove', onMove, { passive: false });

        document.addEventListener('mouseup', onEnd);
        document.addEventListener('touchend', onEnd);

        container.addEventListener('mousedown', (e) => {
            if (!e.target.closest('.cfl-slider-container')) {
                const card = container.closest('.cfl-card');
                if (card && card.classList.contains('cfl-card-active')) {
                    stopAuto();
                    isDragging = true;
                    updateSlider(e.clientX);
                }
            }
        });

        container.addEventListener('mouseleave', () => {
             if (!isDragging) resumeAutoDelayed();
        });

        autoAnimFrame = requestAnimationFrame(autoAnimate);
    }

    function getTransform(offset, isMobile) {
        const abs = Math.abs(offset);
        const sign = Math.sign(offset);

        if (abs === 0) return { tx: 0, scale: 1, tz: 0, ry: 0, op: 1, filt: 'none' };

        let gap = isMobile ? 65 : 130;
        let zGap = isMobile ? 80 : 180;
        let rot = isMobile ? 35 : 55;
        let sc = isMobile ? 0.85 : 0.8;

        const tx = sign * (gap + (abs * 35));
        const tz = -abs * zGap;
        const ry = -sign * rot;
        const scale = Math.pow(sc, abs);
        const op = abs > 2 ? 0 : 1 - (abs * 0.25);
        const filt = abs > 0 ? `blur(${abs * 2}px)` : 'none';

        return { tx, scale, tz, ry, op, filt };
    }

    let autoRotateTimer;
    const ROTATION_INTERVAL = 5000; // 5 segundos por tarjeta

    function startAutoRotation() {
        stopAutoRotation();
        autoRotateTimer = setInterval(() => {
            if (!items.length) return;
            goTo((current + 1) % items.length);
        }, ROTATION_INTERVAL);
    }

    function stopAutoRotation() {
        clearInterval(autoRotateTimer);
    }

    function positionCards() {
        const cards = stage.querySelectorAll('.cfl-card');
        const isMobile = window.innerWidth <= 768;

        cards.forEach((card) => {
            const i = parseInt(card.dataset.idx);
            let offset = i - current;
            
            // Lógica para bucle visual más suave (opcional para 3D, pero mejor manual por ahora)
            const n = items.length;
            const abs = Math.abs(offset);

            const t = getTransform(offset, isMobile);
            card.style.transform = `translateX(${t.tx}px) translateZ(${t.tz}px) rotateY(${t.ry}deg) scale(${t.scale})`;
            card.style.zIndex = 100 - abs;
            card.style.opacity = t.op;
            card.style.filter = t.filt;

            if (abs === 0) {
                card.classList.add('cfl-card-active');
                card.style.pointerEvents = 'auto';
            } else {
                card.classList.remove('cfl-card-active');
                card.style.pointerEvents = abs <= 2 ? 'auto' : 'none';
            }

            const hintArrow = card.querySelector('.cfl-hint-icon polyline');
            if (hintArrow) {
                hintArrow.setAttribute('points', offset < 0 ? '15 18 9 12 15 6' : '9 18 15 12 9 6');
            }
        });
    }

    function updateUI() {
        if (!items.length) return;
        const n = items.length;
        if (countEl) countEl.textContent = `${current + 1} / ${n}`;
        if (progFill) progFill.style.width = `${((current + 1) / n) * 100}%`;
        
        // Los botones ya no se desactivan para permitir el bucle infinito
        if (btnPrev) btnPrev.disabled = false;
        if (btnNext) btnNext.disabled = false;
    }

    function goTo(idx) {
        if (!items.length) return;
        const n = items.length;
        // Bucle infinito circular
        current = (idx + n) % n;
        positionCards();
        updateUI();
    }

    function render(rows) {
        if (!stage) return;
        stage.innerHTML = '';
        items = rows.filter(r => r && r.foto && r.foto_despues).slice(0, 15);
        if (!items.length) {
            stage.innerHTML = '<p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#64748b;font-weight:600;">No hay reportes con fotos de antes y despu&eacute;s para mostrar.</p>';
            return;
        }

        items.forEach((inc, i) => stage.appendChild(buildCard(inc, i)));
        current = 0;

        void stage.offsetWidth;
        positionCards();
        updateUI();
        startAutoRotation(); // Iniciar giro al cargar
    }

    if (btnPrev) btnPrev.addEventListener('click', () => {
        stopAutoRotation();
        goTo(current - 1);
        startAutoRotation();
    });

    if (btnNext) btnNext.addEventListener('click', () => {
        stopAutoRotation();
        goTo(current + 1);
        startAutoRotation();
    });

    // Pausar al pasar el mouse por el carrusel
    stage.addEventListener('mouseenter', stopAutoRotation);
    stage.addEventListener('mouseleave', () => {
        // Solo reanudar si no estamos arrastrando nada
        startAutoRotation();
    });

    document.addEventListener('keydown', e => {
        if (!items.length) return;
        const rect = stage.getBoundingClientRect();
        if (rect.top >= -200 && rect.bottom <= window.innerHeight + 200) {
            if (e.key === 'ArrowLeft') {
                stopAutoRotation();
                goTo(current - 1);
                startAutoRotation();
            }
            if (e.key === 'ArrowRight') {
                stopAutoRotation();
                goTo(current + 1);
                startAutoRotation();
            }
        }
    });

    window.addEventListener('resize', () => {
        if (items.length) positionCards();
    });

    fetch('/public/api/incidencias.php?limit=20')
        .then(r => r.json())
        .then(d => render(d?.ok ? (d.rows || []) : []))
        .catch(() => { if (stage) stage.innerHTML = '<p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#ef4444;font-weight:600;">Error al cargar datos</p>'; });

})();
