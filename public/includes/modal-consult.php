<!-- MODAL: Consultar Reporte -->
<div id="modal-consult" class="modal modal-custom">
    <div class="modal-inner modal-custom-inner modal-custom-inner--narrow" style="max-height:92vh;display:flex;flex-direction:column;">

        <!-- Header -->
        <div class="modal-custom-header mh-dark mh-blue">
            <div class="mh-icon-wrap">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </div>
            <div class="mh-text">
                <h3 class="modal-custom-title">Consultar folio</h3>
                <p class="modal-custom-subtitle">Ingresa el ID de tu reporte para ver su estado actual.</p>
            </div>
            <button class="modal-custom-close modal-close-trigger" aria-label="Cerrar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="modal-custom-body">
            <!-- Search form -->
            <form id="form-consult">
                <div class="modal-form-group">
                    <label class="form-label-custom" for="report-number">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        Número de folio (ID)
                    </label>
                    <input id="report-number" class="form-input-custom form-input-big" type="number" min="1" placeholder="Ej: 42" required>
                </div>
                <button type="submit" class="btn-submit-modal">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Consultar estatus
                </button>
            </form>

            <!-- Result card -->
            <div id="status-result" style="display:none;">

                <!-- Top status banner -->
                <div class="cq-banner" id="cq-banner">
                    <div class="cq-banner-icon" id="cq-banner-icon">
                        <svg id="cq-banner-svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"></svg>
                    </div>
                    <div class="cq-banner-body">
                        <span class="cq-banner-label">Estatus del reporte</span>
                        <span class="cq-banner-status" id="cq-status-text">—</span>
                    </div>
                    <span class="cq-banner-id" id="cq-banner-id">#—</span>
                </div>

                <!-- Info card -->
                <div class="cq-card">
                    <!-- Tipo -->
                    <div class="cq-row cq-row--type">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span id="status-type" class="cq-type-text">—</span>
                    </div>
                    <div class="cq-divider"></div>
                    <!-- Dirección -->
                    <div class="cq-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--primary,#9D1B32)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span id="status-address" class="cq-meta-text">—</span>
                    </div>
                    <!-- Fecha -->
                    <div class="cq-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span id="status-date" class="cq-meta-text">—</span>
                    </div>
                    <!-- Ciudadano -->
                    <div class="cq-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span id="status-reporter" class="cq-meta-text">—</span>
                    </div>
                    <!-- Descripción -->
                    <div class="cq-row cq-row--desc" id="cq-desc-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><line x1="17" y1="10" x2="3" y2="10"/><line x1="21" y1="6" x2="3" y2="6"/><line x1="21" y1="14" x2="3" y2="14"/><line x1="17" y1="18" x2="3" y2="18"/></svg>
                        <span id="status-desc" class="cq-meta-text">—</span>
                    </div>
                </div>

                <!-- Photo -->
                <div id="status-photo-wrap" style="display:none;margin-top:12px;position:relative;">
                    <img id="status-photo" src="" alt="Foto del reporte"
                        style="width:100%;height:200px;border-radius:12px;object-fit:cover;border:1px solid rgba(0,0,0,0.08);box-shadow:0 4px 18px rgba(0,0,0,0.1);">
                    <button id="status-photo-btn" style="position:absolute;right:12px;top:12px;background:rgba(0,0,0,0.6);color:#fff;border:0;padding:8px 10px;border-radius:8px;cursor:pointer;display:none;">Ver foto</button>
                </div>

                <!-- Actions -->
                <button id="btn-ver-en-mapa" class="btn-submit-modal" type="button" style="display:none;margin-top:14px;background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                    Ver en el mapa
                </button>

                <button class="consult-back-btn" type="button"
                    onclick="document.getElementById('status-result').style.display='none';document.getElementById('form-consult').style.display='block';document.getElementById('report-number').value='';">
                    ← Consultar otro folio
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* â”€â”€ Consult modal result â”€â”€ */
    .cq-banner {
        display: flex; align-items: center; gap: 14px;
        border-radius: 14px; padding: 14px 16px;
        margin-bottom: 12px;
        background: #f8fafc; border: 1px solid rgba(0,0,0,0.07);
        transition: background .2s, border-color .2s;
    }
    .cq-banner-icon {
        width: 50px; height: 50px; border-radius: 14px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }
    .cq-banner-body { flex: 1; min-width: 0; }
    .cq-banner-label {
        display: block; font-size: 0.62rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.09em; color: #94a3b8; margin-bottom: 3px;
    }
    .cq-banner-status {
        display: block; font-size: 1.15rem; font-weight: 800; letter-spacing: -0.02em;
    }
    .cq-banner-id {
        font-size: 0.75rem; font-weight: 700; padding: 4px 10px;
        border-radius: 99px; background: rgba(0,0,0,0.05); color: #64748b;
        white-space: nowrap; flex-shrink: 0;
    }
    .cq-card {
        background: #f8fafc; border: 1px solid rgba(0,0,0,0.07);
        border-radius: 14px; overflow: hidden; margin-bottom: 4px;
    }
    .cq-divider { height: 1px; background: rgba(0,0,0,0.06); margin: 0 14px; }
    .cq-row {
        display: flex; align-items: flex-start; gap: 10px;
        padding: 10px 14px; font-size: 0.83rem; color: #334155;
    }
    .cq-row svg { flex-shrink: 0; margin-top: 2px; }
    .cq-row--type { padding: 12px 14px; }
    .cq-type-text { font-size: 0.92rem; font-weight: 700; color: #0f172a; }
    .cq-meta-text { line-height: 1.5; }
    .cq-row--desc .cq-meta-text { color: #64748b; font-style: italic; }

    /* dark */
    html.dark .cq-banner { background: #1e2532; border-color: rgba(255,255,255,0.08); }
    html.dark .cq-banner-id { background: rgba(255,255,255,0.07); color: #94a3b8; }
    html.dark .cq-card { background: #1e2532; border-color: rgba(255,255,255,0.07); }
    html.dark .cq-divider { background: rgba(255,255,255,0.06); }
    html.dark .cq-row { color: #a0b4c8; }
    html.dark .cq-type-text { color: #f1f5f9; }
    html.dark .cq-row--desc .cq-meta-text { color: #64748b; }
    html.dark .cq-banner-id { background: rgba(255,255,255,0.07); color: #94a3b8; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formConsult = document.getElementById('form-consult');
        const btnConsult  = formConsult.querySelector('button[type="submit"]');

        // Status config
        const STATUS_CFG = {
            resuelto:    { color: '#059669', bg: 'rgba(16,185,129,0.15)', label: 'Resuelto',    svg: '<polyline points="20 6 9 17 4 12"/>' },
            pendiente:   { color: '#d97706', bg: 'rgba(245,158,11,0.15)',  label: 'Pendiente',   svg: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>' },
            'en proceso':{ color: '#2563eb', bg: 'rgba(59,130,246,0.15)',  label: 'En Proceso',  svg: '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' },
            activo:      { color: '#2563eb', bg: 'rgba(59,130,246,0.15)',  label: 'Activo',      svg: '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' },
            rechazado:   { color: '#dc2626', bg: 'rgba(239,68,68,0.15)',   label: 'Rechazado',   svg: '<circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>' },
        };

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

                const inc    = data.row;
                const estatus = (inc.estatus || 'pendiente').toLowerCase();
                const cfg    = STATUS_CFG[estatus] || { color: '#64748b', bg: 'rgba(100,116,139,0.15)', label: inc.estatus || 'Desconocido', svg: '' };
                const date   = inc.created_at
                    ? new Date(inc.created_at).toLocaleDateString('es-MX', { year:'numeric', month:'long', day:'numeric' })
                    : '—';

                // Banner
                const banner = document.getElementById('cq-banner');
                banner.style.borderColor = cfg.color + '55';
                banner.style.background  = '';
                const bannerIcon = document.getElementById('cq-banner-icon');
                bannerIcon.style.background = cfg.bg;
                document.getElementById('cq-banner-svg').innerHTML = cfg.svg;
                document.getElementById('cq-banner-svg').style.stroke = cfg.color;
                document.getElementById('cq-status-text').textContent  = cfg.label;
                document.getElementById('cq-status-text').style.color  = cfg.color;
                document.getElementById('cq-banner-id').textContent    = '#' + inc.id;

                // Fields
                document.getElementById('status-type').textContent    = inc.tipo_incidencia || 'Incidencia sin tipo';
                document.getElementById('status-address').textContent = inc.direccion || 'Sin dirección registrada';
                document.getElementById('status-date').textContent    = 'Reportado el: ' + date;
                document.getElementById('status-reporter').textContent = (inc.nombre_ciudadano || 'Anónimo') + (inc.email ? ' — ' + inc.email : '');

                const descEl = document.getElementById('status-desc');
                descEl.textContent = inc.descripcion || 'Sin descripción adicional.';
                document.getElementById('cq-desc-row').style.display = 'flex';

                // Photo (prefer `foto_despues` when status is 'resuelto')
                const photoWrap = document.getElementById('status-photo-wrap');
                const photoEl   = document.getElementById('status-photo');
                const photoBtn  = document.getElementById('status-photo-btn');
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
                            if (gMarkers[inc.id]) {
                                window.verEnMapa(inc.id);
                            } else {
                                const pos = { lat: parseFloat(inc.latitud), lng: parseFloat(inc.longitud) };
                                gMap.panTo(pos); gMap.setZoom(16);
                                const tempMarker = buildMarker(gMap, inc);
                                gMarkers[inc.id] = tempMarker;
                                google.maps.event.trigger(tempMarker, 'click');
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
                } catch(e) {}
            } catch (err) {
                alert('Error al conectar con el servidor.');
            } finally {
                btnConsult.textContent = 'Consultar Estatus';
                btnConsult.disabled = false;
            }
        });
    });
</script>

<!-- Lightbox (scoped to consult modal) -->
<style>
    #lb-consult { position: fixed; inset: 0; display: none; align-items: center; justify-content: center; background: rgba(0,0,0,0.8); z-index: 100000; }
    #lb-consult.active { display: flex; }
    #lb-consult .inner { max-width: 95vw; max-height: 95vh; position: relative; }
    #lb-consult img { display:block; max-width:95vw; max-height:95vh; object-fit:contain; border-radius:10px; box-shadow:0 12px 36px rgba(0,0,0,0.6);} 
    #lb-consult .close { position:absolute; right:-8px; top:-8px; width:36px; height:36px; border-radius:999px; background:rgba(0,0,0,0.5); color:#fff; border:0; cursor:pointer; }
    #lb-consult .caption { margin-top:8px; text-align:center; color:#e6eef8; }
</style>

<div id="lb-consult" aria-hidden="true">
    <div class="inner">
        <button class="close" aria-label="Cerrar">×</button>
        <img id="lb-consult-img" src="" alt="">
        <div class="caption" id="lb-consult-caption"></div>
    </div>
</div>

<script>
    (function(){
        const lb = document.getElementById('lb-consult');
        const img = document.getElementById('lb-consult-img');
        const cap = document.getElementById('lb-consult-caption');
        const btn = lb.querySelector('.close');
        window.openConsultLightbox = function(src, caption){ if(!src) return; img.src = src; cap.textContent = caption || ''; lb.classList.add('active'); lb.setAttribute('aria-hidden','false'); document.body.style.overflow='hidden'; };
        window.closeConsultLightbox = function(){ lb.classList.remove('active'); lb.setAttribute('aria-hidden','true'); img.src=''; cap.textContent=''; document.body.style.overflow=''; };
        lb.addEventListener('click',(e)=>{ if (e.target === lb || e.target === btn) closeConsultLightbox(); });
        document.addEventListener('keydown',(e)=>{ if(e.key==='Escape') closeConsultLightbox(); });
    })();
</script>
