<!-- MODAL: Reportar incidencia -->
<div id="modal-report" class="modal modal-custom">
    <div class="modal-inner modal-custom-inner" style="max-height:92vh;display:flex;flex-direction:column;">

        <!-- Dark header -->
        <div class="modal-custom-header mh-dark">
            <div class="mh-icon-wrap">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    <line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
            <div class="mh-text">
                <h3 class="modal-custom-title">Crear Reporte</h3>
                <p class="modal-custom-subtitle">Completa los datos y tu incidencia queda registrada al instante.</p>
            </div>
            <button class="modal-custom-close modal-close-trigger" aria-label="Cerrar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="modal-custom-body">
            <form id="form-report">
                <!-- Row 1: name + email -->
                <div class="mf-row">
                    <div class="modal-form-group">
                        <label class="form-label-custom" for="reporter-name">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Tu nombre
                        </label>
                        <input id="reporter-name" class="form-input-custom" type="text" placeholder="Nombre completo" required>
                    </div>
                    <div class="modal-form-group">
                        <label class="form-label-custom" for="reporter-email">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Correo
                        </label>
                        <input id="reporter-email" class="form-input-custom" type="email" placeholder="tu@correo.com" required>
                    </div>
                </div>

                <div class="modal-form-group">
                    <label class="form-label-custom" for="failure-type">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Tipo de falla
                    </label>
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
                    <label class="form-label-custom" for="location">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Ubicación o Dirección <span style="color:var(--primary);font-size:0.7rem;">(requiere GPS)</span>
                    </label>
                    <div class="input-with-btn">
                        <input id="location" class="form-input-custom" type="text" placeholder="Escribe una dirección o usa GPS..." autocomplete="off">
                        <button type="button" id="get-location" class="btn-geo" title="Usar mi ubicación actual">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><line x1="12" y1="0" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="24"/><line x1="0" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="24" y2="12"/></svg>
                            <span class="btn-geo-label">GPS</span>
                        </button>
                    </div>
                    <small id="location-status" class="field-hint"></small>
                    <input type="hidden" id="lat">
                    <input type="hidden" id="lng">
                </div>

                <!-- Row 2: photo -->
                <div class="modal-form-group">
                    <label class="form-label-custom" for="photo">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        Evidencia fotográfica <span class="optional-tag">Opcional</span>
                    </label>
                    <label class="mf-file-drop" for="photo">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9D1B32" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                        <span>Arrastra o <u>selecciona</u> una imagen</span>
                        <input id="photo" type="file" accept="image/*" style="position:absolute;inset:0;opacity:0;cursor:pointer;">
                    </label>
                    <small id="photo-name" class="field-hint"></small>
                </div>

                <div class="modal-form-group">
                    <label class="form-label-custom" for="description">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="17" y1="10" x2="3" y2="10"/><line x1="21" y1="6" x2="3" y2="6"/><line x1="21" y1="14" x2="3" y2="14"/><line x1="17" y1="18" x2="3" y2="18"/></svg>
                        Descripción <span class="optional-tag">Opcional</span>
                    </label>
                    <textarea id="description" class="form-input-custom" rows="3" placeholder="Detalles adicionales sobre el problema..."></textarea>
                </div>

                <button type="submit" class="btn-submit-modal">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Enviar Reporte
                </button>
            </form>

            <!-- Success state -->
            <div id="report-success" class="modal-success" style="display:none;">
                <div class="modal-success-ring">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                        <circle cx="28" cy="28" r="26" stroke="#9D1B32" stroke-width="1.5" stroke-dasharray="163" stroke-dashoffset="0" opacity="0.15"/>
                        <circle cx="28" cy="28" r="18" fill="rgba(157,27,50,0.1)"/>
                        <path d="M19 28l6 6 12-12" stroke="#9D1B32" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4 class="modal-success-title">¡Reporte enviado!</h4>
                <p class="modal-success-text">Tu folio de seguimiento:</p>
                <div class="modal-folio-badge"><span id="report-id">#INC-0000</span></div>
                <p class="modal-success-hint">Guarda este número para consultar el avance de tu incidencia en cualquier momento.</p>
                <button class="modal-success-btn modal-close-trigger" type="button">Entendido</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnGetLocation = document.getElementById('get-location');
        const inputLocation  = document.getElementById('location');
        const statusLocation = document.getElementById('location-status');

        // Google Places Autocomplete
        function initPlacesAutocomplete() {
            if (typeof google === 'undefined' || !google.maps || !google.maps.places) return;
            const ac = new google.maps.places.Autocomplete(inputLocation, {
                types: ['geocode', 'establishment'],
                fields: ['formatted_address', 'geometry']
            });
            ac.addListener('place_changed', () => {
                const place = ac.getPlace();
                if (place.geometry && place.geometry.location) {
                    document.getElementById('lat').value = place.geometry.location.lat();
                    document.getElementById('lng').value  = place.geometry.location.lng();
                    inputLocation.value = place.formatted_address || inputLocation.value;
                    statusLocation.textContent = 'Dirección seleccionada.';
                    statusLocation.style.color = 'green';
                } else {
                    statusLocation.textContent = 'Selecciona una sugerencia de la lista.';
                    statusLocation.style.color = '';
                }
            });
        }
        // Espera a que Google Maps esté listo
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            initPlacesAutocomplete();
        } else {
            document.addEventListener('googleMapsReady', initPlacesAutocomplete);
            window.addEventListener('load', () => {
                setTimeout(initPlacesAutocomplete, 800);
            });
        }

        // Photo name preview
        const photoInput = document.getElementById('photo');
        const photoName  = document.getElementById('photo-name');
        if (photoInput && photoName) {
            photoInput.addEventListener('change', () => {
                const f = photoInput.files && photoInput.files[0];
                photoName.textContent = f ? '\u2714 ' + f.name : '';
            });
        }

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

                if (!lat || !lng) {
                    alert('Por favor usa el botón GPS para obtener tu ubicación antes de enviar.');
                    btn.disabled = false;
                    btn.textContent = 'Enviar Reporte';
                    return;
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

                const resp = await fetch('/public/api/incidencias.php', {
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
