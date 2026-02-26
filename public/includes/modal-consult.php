<!-- MODAL: Consultar Reporte -->
<div id="modal-consult" class="modal modal-custom">
    <div class="modal-inner modal-custom-inner">
        <div class="modal-custom-header">
            <div class="modal-custom-header-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
            </div>
            <div>
                <h3 class="modal-custom-title">Consultar Reporte</h3>
                <p class="modal-custom-subtitle">Ingresa tu folio para ver el estado de tu incidencia.</p>
            </div>
            <button class="modal-custom-close modal-close-trigger" aria-label="Cerrar">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="modal-custom-body">
            <form id="form-consult">
                <div class="modal-form-group">
                    <label class="form-label-custom" for="report-number">ID de Incidencia</label>
                    <input id="report-number" class="form-input-custom" type="number" min="1" placeholder="Ej: 4" required>
                </div>
                <button type="submit" class="btn-submit-modal">Consultar Estatus</button>
            </form>
            <div id="status-result" class="mt-24" style="display:none;">
                <div class="status-result-card">
                    <div class="status-result-header">
                        <span class="status-result-label">Estatus del reporte</span>
                        <span id="status-tag" class="status-result-pill">—</span>
                    </div>
                    <h5 id="status-type" class="status-result-type">—</h5>
                    <p id="status-address" class="status-result-date"></p>
                    <p id="status-date" class="status-result-date"></p>
                    <div class="status-result-divider"></div>
                    <p id="status-reporter" class="status-result-update"></p>
                    <p id="status-desc" class="status-result-update mt-8" style="margin-top:8px"></p>
                    <button id="btn-ver-en-mapa" class="btn-submit-modal"
                        style="margin-top:24px; display:none; align-items:center; justify-content:center; gap:8px;"
                        type="button">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                            <line x1="8" y1="2" x2="8" y2="18"></line>
                            <line x1="16" y1="6" x2="16" y2="22"></line>
                        </svg>
                        Ver en el mapa
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formConsult = document.getElementById('form-consult');
        const btnConsult  = formConsult.querySelector('button[type="submit"]');

        formConsult.addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = document.getElementById('report-number').value.trim();
            if (!id) return;
            btnConsult.textContent = 'Consultando...';
            btnConsult.disabled = true;
            try {
                const resp = await fetch('/api/incidencia.php?id=' + id);
                const data = await resp.json();
                if (!data.ok) { alert(data.error || 'Incidencia no encontrada. Verifica el ID.'); return; }

                const inc = data.row;
                const statusColors = {
                    resuelto: '#22c55e', activo: '#9D1B32',
                    pendiente: '#f59e0b', 'en proceso': '#3b82f6', rechazado: '#ef4444'
                };
                const estatus = (inc.estatus || 'pendiente').toLowerCase();
                const color   = statusColors[estatus] || '#627183';
                const date    = inc.created_at
                    ? new Date(inc.created_at).toLocaleDateString('es-MX', { year: 'numeric', month: 'long', day: 'numeric' })
                    : '—';

                const pill = document.getElementById('status-tag');
                pill.textContent      = inc.estatus || 'pendiente';
                pill.style.background = color;

                const card = document.querySelector('.status-result-card');
                if (card) card.style.borderLeftColor = color;

                document.getElementById('status-type').textContent =
                    (inc.tipo_incidencia || 'Incidencia') + (inc.id ? ' • ID #' + inc.id : '');
                document.getElementById('status-address').innerHTML =
                    '<span style="display:inline-flex;align-items:flex-start;gap:10px"><svg style="flex-shrink:0;margin-top:3px" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9D1B32" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg><span>' + (inc.direccion || 'Sin dirección registrada') + '</span></span>';
                document.getElementById('status-date').innerHTML =
                    '<span style="display:inline-flex;align-items:flex-start;gap:10px;margin-bottom:6px"><svg style="flex-shrink:0;margin-top:2px" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><span>Reportado el: ' + date + '</span></span>';
                document.getElementById('status-reporter').innerHTML =
                    '<span style="color:#0f172a;font-weight:800">Ciudadano:</span> ' + (inc.nombre_ciudadano || 'Anónimo') +
                    (inc.email ? ' — ' + inc.email : '');
                document.getElementById('status-desc').innerHTML = inc.descripcion
                    ? '<span style="color:#0f172a;font-weight:800">Descripción:</span> ' + inc.descripcion
                    : '<em style="color:#94a3b8">Sin descripción adicional.</em>';

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
                                gMap.panTo(pos);
                                gMap.setZoom(16);
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
            } catch (err) {
                alert('Error al conectar con el servidor.');
            } finally {
                btnConsult.textContent = 'Consultar Estatus';
                btnConsult.disabled = false;
            }
        });
    });
</script>