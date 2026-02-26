<!-- MODAL: Reportar incidencia -->
<div id="modal-report" class="modal modal-custom">
    <div class="modal-inner modal-custom-inner">
        <div class="modal-custom-header">
            <div class="modal-custom-header-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
            </div>
            <div>
                <h3 class="modal-custom-title">Reportar una Falla</h3>
                <p class="modal-custom-subtitle">Ayúdanos a mejorar la ciudad reportando incidencias en la vía pública.</p>
            </div>
            <button class="modal-custom-close modal-close-trigger" aria-label="Cerrar">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="modal-custom-body">
            <form id="form-report">
                <div class="modal-form-group">
                    <label class="form-label-custom" for="reporter-name">Tu nombre</label>
                    <input id="reporter-name" class="form-input-custom" type="text" placeholder="Nombre completo" required>
                </div>
                <div class="modal-form-group">
                    <label class="form-label-custom" for="reporter-email">Correo electrónico</label>
                    <input id="reporter-email" class="form-input-custom" type="email" placeholder="tu@correo.com" required>
                </div>
                <div class="modal-form-group">
                    <label class="form-label-custom" for="failure-type">Tipo de falla</label>
                    <select id="failure-type" class="form-input-custom" required>
                        <option value="" disabled selected>Selecciona el tipo de falla</option>
                        <option value="bache">Bache</option>
                        <option value="iluminacion">Iluminación</option>
                        <option value="camaras">Cámara de seguridad</option>
                        <option value="semaforos">Semáforo</option>
                        <option value="coladeras">Coladera</option>
                    </select>
                </div>
                <div class="modal-form-group">
                    <label class="form-label-custom" for="location">Ubicación o Dirección</label>
                    <div class="input-with-btn">
                        <input id="location" class="form-input-custom" type="text"
                            placeholder="Calle, número, colonia..." required>
                        <button type="button" id="get-location" class="btn-geo" title="Usar mi ubicación actual">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </button>
                    </div>
                    <small id="location-status" class="field-hint"></small>
                    <input type="hidden" id="lat">
                    <input type="hidden" id="lng">
                </div>
                <div class="modal-form-group">
                    <label class="form-label-custom" for="photo">Evidencia (Fotografía)</label>
                    <input id="photo" class="form-input-custom form-file" type="file" accept="image/*">
                </div>
                <div class="modal-form-group">
                    <label class="form-label-custom" for="description">Descripción <span class="optional-tag">Opcional</span></label>
                    <textarea id="description" class="form-input-custom" rows="3"
                        placeholder="Detalles sobre el problema..."></textarea>
                </div>
                <button type="submit" class="btn-submit-modal">Enviar Reporte</button>
            </form>
            <div id="report-success" class="modal-success" style="display:none;">
                <div class="modal-success-icon">
                    <svg width="48" height="48" viewBox="0 0 64 64" fill="none">
                        <circle cx="32" cy="32" r="32" fill="#9D1B32" fill-opacity="0.12" />
                        <path d="M44 24L28.875 39.125L21 31.25" stroke="#9D1B32" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h4 class="modal-success-title">¡Reporte Enviado!</h4>
                <p class="modal-success-text">Tu número de folio es:</p>
                <div class="modal-folio-badge"><span id="report-id">#INC-2024-001</span></div>
                <p class="modal-success-hint">Guarda este número para dar seguimiento a tu incidencia.</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnGetLocation = document.getElementById('get-location');
        const inputLocation  = document.getElementById('location');
        const statusLocation = document.getElementById('location-status');

        btnGetLocation.addEventListener('click', () => {
            if (!navigator.geolocation) {
                statusLocation.textContent = 'La geolocalización no es compatible con tu navegador.';
                return;
            }
            statusLocation.textContent = 'Obteniendo ubicación...';
            btnGetLocation.classList.add('is-loading');
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const { latitude, longitude } = position.coords;
                    const latlng = { lat: latitude, lng: longitude };
                    inputLocation.value = `${latitude.toFixed(6)}, ${longitude.toFixed(6)}`;
                    statusLocation.textContent = 'Buscando dirección...';
                    const geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ location: latlng }, (results, status) => {
                        btnGetLocation.classList.remove('is-loading');
                        if (status === 'OK') {
                            if (results[0]) {
                                inputLocation.value = results[0].formatted_address;
                                const loc = results[0].geometry && results[0].geometry.location
                                    ? results[0].geometry.location : latlng;
                                document.getElementById('lat').value = loc.lat();
                                document.getElementById('lng').value = loc.lng();
                                statusLocation.textContent = 'Dirección obtenida.';
                            } else {
                                document.getElementById('lat').value = latitude;
                                document.getElementById('lng').value = longitude;
                                statusLocation.textContent = 'Coordenadas obtenidas.';
                            }
                        } else {
                            statusLocation.textContent = 'Error de dirección: ' + status;
                        }
                    });
                },
                () => {
                    statusLocation.textContent = 'No se pudo obtener la ubicación.';
                    btnGetLocation.classList.remove('is-loading');
                }
            );
        });

        function readFileAsDataURL(file) {
            return new Promise((resolve, reject) => {
                if (!file) return resolve(null);
                const fr = new FileReader();
                fr.onload  = () => resolve(fr.result);
                fr.onerror = reject;
                fr.readAsDataURL(file);
            });
        }

        function geocodeAddress(address) {
            return new Promise((resolve) => {
                if (!window.google || !google.maps || !google.maps.Geocoder) return resolve(null);
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ address }, (results, status) => {
                    if (status === 'OK' && results && results[0]) {
                        const loc = results[0].geometry.location;
                        return resolve({ lat: loc.lat(), lng: loc.lng() });
                    }
                    return resolve(null);
                });
            });
        }

        const formReport = document.getElementById('form-report');
        formReport.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = formReport.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.textContent = 'Enviando...';
            try {
                const nombre    = document.getElementById('reporter-name').value.trim();
                const email     = document.getElementById('reporter-email').value.trim();
                const tipo      = document.getElementById('failure-type').value;
                const direccion = document.getElementById('location').value.trim();
                let lat         = document.getElementById('lat').value;
                let lng         = document.getElementById('lng').value;
                const descripcion = document.getElementById('description').value.trim();
                const photoFile   = document.getElementById('photo').files[0];

                if ((!lat || !lng) && direccion) {
                    const geo = await geocodeAddress(direccion);
                    if (geo) {
                        lat = geo.lat; lng = geo.lng;
                        document.getElementById('lat').value = lat;
                        document.getElementById('lng').value = lng;
                    }
                }

                const fotoData = await readFileAsDataURL(photoFile);
                const payload  = {
                    nombre_ciudadano: nombre     || null,
                    email:            email      || null,
                    direccion:        direccion  || null,
                    latitud:          lat        || null,
                    longitud:         lng        || null,
                    tipo_incidencia:  tipo       || null,
                    descripcion:      descripcion || null,
                    estatus: 'pendiente',
                    foto:    fotoData   || null
                };

                const resp = await fetch('/api/incidencias.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await resp.json();
                if (!data.ok) { alert(data.error || 'No se pudo enviar el reporte.'); return; }

                document.getElementById('report-id').textContent = data.id ? '#INC-' + data.id : '#INC-0000';
                formReport.style.display = 'none';
                document.getElementById('report-success').style.display = 'block';

                if (gMap && data.row && data.row.latitud && data.row.longitud) {
                    gMarkers[data.row.id] = buildMarker(gMap, data.row);
                }
            } catch (err) {
                console.error('Error enviando reporte:', err);
                alert('Error al enviar el reporte. Revisa la consola.');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Enviar Reporte';
            }
        });
    });
</script>
