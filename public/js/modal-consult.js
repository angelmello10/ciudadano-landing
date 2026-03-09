document.addEventListener('DOMContentLoaded', () => {
    const formConsult = document.getElementById('form-consult');
    const btnConsult = formConsult.querySelector('button[type="submit"]');

    // Status config
    const STATUS_CFG = {
        resuelto: { color: '#059669', bg: 'rgba(16,185,129,0.15)', label: 'Resuelto', svg: '<polyline points="20 6 9 17 4 12"/>' },
        pendiente: { color: '#d97706', bg: 'rgba(245,158,11,0.15)', label: 'Pendiente', svg: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>' },
        'en proceso': { color: '#2563eb', bg: 'rgba(59,130,246,0.15)', label: 'En Proceso', svg: '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' },
        activo: { color: '#2563eb', bg: 'rgba(59,130,246,0.15)', label: 'Activo', svg: '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' },
        rechazado: { color: '#dc2626', bg: 'rgba(239,68,68,0.15)', label: 'Rechazado', svg: '<circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>' },
    };

    if (formConsult) {
        formConsult.addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = document.getElementById('report-number').value.trim();
            if (!id) return;
            btnConsult.textContent = 'Consultando...';
            btnConsult.disabled = true;
            try {
                const resp = await fetch('/public/api/incidencia.php?id=' + id);
                const data = await resp.json();
                if (!data.ok) { alert(data.error || 'Incidencia no encontrada. Verifica el ID.'); return; }

                const inc = data.row;
                const estatus = (inc.estatus || 'pendiente').toLowerCase();
                const cfg = STATUS_CFG[estatus] || { color: '#64748b', bg: 'rgba(100,116,139,0.15)', label: inc.estatus || 'Desconocido', svg: '' };
                const date = inc.created_at
                    ? new Date(inc.created_at).toLocaleDateString('es-MX', { year: 'numeric', month: 'long', day: 'numeric' })
                    : '—';

                // Banner
                const banner = document.getElementById('cq-banner');
                banner.style.borderColor = cfg.color + '55';
                banner.style.background = '';
                const bannerIcon = document.getElementById('cq-banner-icon');
                bannerIcon.style.background = cfg.bg;
                document.getElementById('cq-banner-svg').innerHTML = cfg.svg;
                document.getElementById('cq-banner-svg').style.stroke = cfg.color;
                document.getElementById('cq-status-text').textContent = cfg.label;
                document.getElementById('cq-status-text').style.color = cfg.color;
                document.getElementById('cq-banner-id').textContent = '#' + inc.id;

                // Fields
                document.getElementById('status-type').textContent = inc.tipo_incidencia || 'Incidencia sin tipo';
                document.getElementById('status-address').textContent = inc.direccion || 'Sin dirección registrada';
                document.getElementById('status-date').textContent = 'Reportado el: ' + date;
                document.getElementById('status-reporter').textContent = (inc.nombre_ciudadano || 'Anónimo') + (inc.email ? ' — ' + inc.email : '');

                const descEl = document.getElementById('status-desc');
                descEl.textContent = inc.descripcion || 'Sin descripción adicional.';
                document.getElementById('cq-desc-row').style.display = 'flex';

                // Photo (prefer `foto_despues` when status is 'resuelto')
                const photoWrap = document.getElementById('status-photo-wrap');
                const photoEl = document.getElementById('status-photo');
                const photoBtn = document.getElementById('status-photo-btn');
                const estLower2 = estatus || '';
                let src = '';
                if (estLower2 === 'resuelto' && inc.foto_despues) {
                    src = '/public/uploads/' + inc.foto_despues;
                } else if (inc.foto) {
                    src = '/public/uploads/' + inc.foto;
                }

                if (src) {
                    photoEl.src = src;
                    photoWrap.style.display = 'block';
                    if (photoBtn) { photoBtn.style.display = 'inline-block'; photoBtn.onclick = () => { if (typeof window.openImageLightbox === 'function') window.openImageLightbox(src, 'Foto del reporte #' + inc.id); } }
                    photoEl.style.cursor = 'zoom-in';
                    photoEl.onclick = () => { if (typeof window.openImageLightbox === 'function') window.openImageLightbox(src, 'Foto del reporte #' + inc.id); };
                } else {
                    photoWrap.style.display = 'none';
                    photoEl.src = '';
                    if (photoBtn) photoBtn.style.display = 'none';
                    photoEl.onclick = null;
                    photoEl.style.cursor = '';
                }

                // Map button
                const btnVerMapa = document.getElementById('btn-ver-en-mapa');
                if (inc.latitud && inc.longitud) {
                    btnVerMapa.style.display = 'block';
                    btnVerMapa.onclick = () => {
                        document.getElementById('modal-consult').classList.remove('is-active');
                        document.body.classList.remove('modal-is-active');
                        document.getElementById('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
                        setTimeout(() => {
                            if (typeof gMarkers !== 'undefined' && gMarkers[inc.id]) {
                                if (typeof window.verEnMapa === 'function') window.verEnMapa(inc.id);
                            } else {
                                if (typeof gMap !== 'undefined' && gMap) {
                                    const pos = { lat: parseFloat(inc.latitud), lng: parseFloat(inc.longitud) };
                                    gMap.panTo(pos); gMap.setZoom(16);
                                    if (typeof buildMarker === 'function') {
                                        const tempMarker = buildMarker(gMap, inc);
                                        gMarkers[inc.id] = tempMarker;
                                        google.maps.event.trigger(tempMarker, 'click');
                                    }
                                }
                            }
                        }, 600);
                    };
                } else {
                    btnVerMapa.style.display = 'none';
                }

                formConsult.style.display = 'none';
                document.getElementById('status-result').style.display = 'block';

                // click handler: abrir lightbox definido en este archivo
                try {
                    const pEl = document.getElementById('status-photo');
                    if (pEl && pEl.src) {
                        pEl.onclick = () => { if (typeof openConsultLightbox === 'function') openConsultLightbox(pEl.src, 'Foto del reporte #' + inc.id); };
                    }
                } catch (e) { }
            } catch (err) {
                alert('Error al conectar con el servidor.');
            } finally {
                btnConsult.textContent = 'Consultar Estatus';
                btnConsult.disabled = false;
            }
        });
    }
});

(function () {
    const lb = document.getElementById('lb-consult');
    const img = document.getElementById('lb-consult-img');
    const cap = document.getElementById('lb-consult-caption');
    if (!lb) return;
    const btn = lb.querySelector('.close');
    window.openConsultLightbox = function (src, caption) { if (!src) return; img.src = src; cap.textContent = caption || ''; lb.classList.add('active'); lb.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; };
    window.closeConsultLightbox = function () { lb.classList.remove('active'); lb.setAttribute('aria-hidden', 'true'); img.src = ''; cap.textContent = ''; document.body.style.overflow = ''; };
    lb.addEventListener('click', (e) => { if (e.target === lb || e.target === btn) closeConsultLightbox(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeConsultLightbox(); });
})();
