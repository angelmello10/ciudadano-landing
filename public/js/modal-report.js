document.addEventListener('DOMContentLoaded', () => {
    const btnGetLocation = document.getElementById('get-location');
    const inputLocation = document.getElementById('location');
    const statusLocation = document.getElementById('location-status');

    if (!btnGetLocation) return; // fail fast
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
                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
                inputLocation.value = place.formatted_address || inputLocation.value;
                statusLocation.textContent = 'Dirección seleccionada.';
                statusLocation.style.color = 'green';
                syncPickerMap(lat, lng);
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

    // ── FOTO: input normal (galería/archivo) ────────────────────
    const photoInput = document.getElementById('photo');
    const photoName = document.getElementById('photo-name');
    const photoPreviewWrap = document.getElementById('photo-preview-wrap');
    const photoPreview = document.getElementById('photo-preview');

    // Variable global que guarda el File capturado por la cámara
    let cameraFile = null;

    // Muestra preview de un File (ya sea de input o de cámara)
    async function showPhotoPreview(file) {
        if (!file) return;
        photoName.textContent = '\u2714 Foto lista';
        try {
            const data = await readFileAsDataURL(file);
            photoPreview.src = data || '';
            photoPreviewWrap.style.display = data ? 'block' : 'none';
            const previewBtn = document.getElementById('photo-preview-btn');
            if (previewBtn) {
                previewBtn.style.display = data ? 'inline-block' : 'none';
                previewBtn.onclick = () => { if (typeof openImageLightbox === 'function') openImageLightbox(photoPreview.src, 'Foto'); };
            }
            photoPreview.onclick = () => { if (typeof openImageLightbox === 'function') openImageLightbox(photoPreview.src, 'Foto'); };
        } catch (e) {
            photoPreviewWrap.style.display = 'none';
        }
    }

    if (photoInput) {
        photoInput.addEventListener('change', () => {
            cameraFile = null; // borra foto de cámara si elige archivo
            const f = photoInput.files && photoInput.files[0];
            if (f) showPhotoPreview(f);
            else { photoPreviewWrap.style.display = 'none'; photoName.textContent = ''; }
        });
    }

    // ── CÁMARA getUserMedia ───────────────────────────────────────
    const cameraOverlay = document.getElementById('camera-overlay');
    const cameraVideo = document.getElementById('camera-video');
    const cameraCanvas = document.getElementById('camera-canvas');
    const btnOpenCamera = document.getElementById('btn-open-camera');
    const btnSnap = document.getElementById('btn-snap');
    const btnCloseCamera = document.getElementById('btn-close-camera');
    let cameraStream = null;

    function stopCamera() {
        if (cameraStream) {
            cameraStream.getTracks().forEach(t => t.stop());
            cameraStream = null;
        }
        if (cameraOverlay) cameraOverlay.style.display = 'none';
    }

    if (btnOpenCamera) {
        btnOpenCamera.addEventListener('click', async () => {
            try {
                // Pide permiso y abre la cámara trasera (facingMode: environment)
                cameraStream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: { ideal: 'environment' } },
                    audio: false
                });
                cameraVideo.srcObject = cameraStream;
                cameraOverlay.style.display = 'flex';
                // limpia selección previa de archivo
                if (photoInput) photoInput.value = '';
                cameraFile = null;
                photoPreviewWrap.style.display = 'none';
                photoName.textContent = '';
            } catch (err) {
                if (err.name === 'NotAllowedError') {
                    alert('Permiso de cámara denegado. Actívalo en la configuración de tu navegador y vuelve a intentarlo.');
                } else {
                    alert('No se pudo acceder a la cámara: ' + err.message);
                }
            }
        });
    }

    if (btnSnap) {
        btnSnap.addEventListener('click', () => {
            if (!cameraVideo || !cameraCanvas) return;
            cameraCanvas.width = cameraVideo.videoWidth;
            cameraCanvas.height = cameraVideo.videoHeight;
            cameraCanvas.getContext('2d').drawImage(cameraVideo, 0, 0);
            cameraCanvas.toBlob(blob => {
                if (!blob) return;
                cameraFile = new File([blob], 'foto-camara-' + Date.now() + '.jpg', { type: 'image/jpeg' });
                stopCamera();
                showPhotoPreview(cameraFile);
            }, 'image/jpeg', 0.92);
        });
    }

    if (btnCloseCamera) {
        btnCloseCamera.addEventListener('click', stopCamera);
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
                            syncPickerMap(loc.lat(), loc.lng());
                        } else {
                            document.getElementById('lat').value = latitude;
                            document.getElementById('lng').value = longitude;
                            statusLocation.textContent = 'Coordenadas obtenidas.';
                            syncPickerMap(latitude, longitude);
                        }
                    } else {
                        statusLocation.textContent = 'Error de dirección: ' + status;
                    }
                });
            },
            (err) => {
                btnGetLocation.classList.remove('is-loading');
                statusLocation.textContent = 'Es necesario activar la ubicación en tu dispositivo.';
                statusLocation.style.color = '#c0392b';
            }
        );
    });

    function readFileAsDataURL(file) {
        return new Promise((resolve, reject) => {
            if (!file) return resolve(null);
            const fr = new FileReader();
            fr.onload = () => resolve(fr.result);
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

    // ── MAP PICKER ────────────────────────────────────────────────
    let pickerMap = null;
    let pickerMarker = null;

    function initPickerMap() {
        if (pickerMap) return;
        const defaultCenter = { lat: 19.4014, lng: -99.0150 }; // Nezahualcóyotl

        const pickerStyleLight = [
            { elementType: 'geometry', stylers: [{ color: '#f5f5f5' }] },
            { elementType: 'labels.icon', stylers: [{ visibility: 'off' }] },
            { elementType: 'labels.text.fill', stylers: [{ color: '#616161' }] },
            { elementType: 'labels.text.stroke', stylers: [{ color: '#f5f5f5' }] },
            { featureType: 'road', elementType: 'geometry', stylers: [{ color: '#ffffff' }] },
            { featureType: 'water', elementType: 'geometry', stylers: [{ color: '#e9e9e9' }] }
        ];
        const pickerStyleDark = [
            { elementType: 'geometry', stylers: [{ color: '#1a1a2e' }] },
            { elementType: 'labels.text.fill', stylers: [{ color: '#8a8a9a' }] },
            { elementType: 'labels.text.stroke', stylers: [{ color: '#1a1a2e' }] },
            { elementType: 'labels.icon', stylers: [{ visibility: 'off' }] },
            { featureType: 'road', elementType: 'geometry', stylers: [{ color: '#2a2a3e' }] },
            { featureType: 'road', elementType: 'geometry.stroke', stylers: [{ color: '#1a1a2e' }] },
            { featureType: 'road.highway', elementType: 'geometry', stylers: [{ color: '#3a2a3e' }] },
            { featureType: 'water', elementType: 'geometry', stylers: [{ color: '#0e0e1a' }] },
            { featureType: 'poi', elementType: 'geometry', stylers: [{ color: '#1e1e32' }] },
            { featureType: 'poi.park', elementType: 'geometry', stylers: [{ color: '#1a2e1a' }] },
            { featureType: 'transit', elementType: 'geometry', stylers: [{ color: '#1e1e30' }] },
            { featureType: 'administrative', elementType: 'geometry.stroke', stylers: [{ color: '#2a2a40' }] }
        ];

        const isDark = document.documentElement.classList.contains('dark');
        pickerMap = new google.maps.Map(document.getElementById('report-map'), {
            center: defaultCenter,
            zoom: 13,
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: false,
            styles: isDark ? pickerStyleDark : pickerStyleLight
        });

        /* Sync picker map whenever html.dark class changes */
        new MutationObserver(function () {
            if (!pickerMap) return;
            const nowDark = document.documentElement.classList.contains('dark');
            pickerMap.setOptions({ styles: nowDark ? pickerStyleDark : pickerStyleLight });
        }).observe(document.documentElement, { attributeFilter: ['class'] });
        pickerMarker = new google.maps.Marker({
            map: pickerMap,
            draggable: true,
            visible: false,
            animation: google.maps.Animation.DROP
        });
        pickerMap.addListener('click', (e) => {
            placeAndGeocode(e.latLng.lat(), e.latLng.lng());
        });
        pickerMarker.addListener('dragend', () => {
            const pos = pickerMarker.getPosition();
            placeAndGeocode(pos.lat(), pos.lng());
        });
    }

    function placeAndGeocode(lat, lng) {
        const latLng = new google.maps.LatLng(lat, lng);
        pickerMarker.setPosition(latLng);
        pickerMarker.setVisible(true);
        pickerMap.panTo(latLng);
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ location: { lat, lng } }, (results, status) => {
            if (status === 'OK' && results[0]) {
                inputLocation.value = results[0].formatted_address;
                statusLocation.textContent = 'Ubicación seleccionada en el mapa.';
                statusLocation.style.color = 'green';
            } else {
                inputLocation.value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                statusLocation.textContent = 'Coordenadas seleccionadas.';
            }
        });
    }

    function syncPickerMap(lat, lng) {
        if (!pickerMap) return;
        const latLng = new google.maps.LatLng(lat, lng);
        pickerMarker.setPosition(latLng);
        pickerMarker.setVisible(true);
        pickerMap.panTo(latLng);
        pickerMap.setZoom(16);
    }

    // ── Auto-init map when modal opens ────────────────────────────
    function tryAutoGPS() {
        if (!navigator.geolocation) {
            statusLocation.textContent = 'GPS no disponible. Selecciona tu ubicación directo en el mapa.';
            return;
        }
        if (document.getElementById('lat').value) return; // already have coords
        statusLocation.textContent = 'Detectando tu ubicación...';
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
                    if (status === 'OK' && results[0]) {
                        inputLocation.value = results[0].formatted_address;
                        const loc = results[0].geometry && results[0].geometry.location ? results[0].geometry.location : latlng;
                        document.getElementById('lat').value = loc.lat();
                        document.getElementById('lng').value = loc.lng();
                        statusLocation.textContent = 'Ubícate en el mapa y ajusta el pin si hace falta.';
                        statusLocation.style.color = 'green';
                        syncPickerMap(loc.lat(), loc.lng());
                    } else {
                        document.getElementById('lat').value = latitude;
                        document.getElementById('lng').value = longitude;
                        statusLocation.textContent = 'Ajusta el pin en el mapa para precisar.';
                        syncPickerMap(latitude, longitude);
                    }
                });
            },
            () => {
                btnGetLocation.classList.remove('is-loading');
                statusLocation.textContent = 'Toca el mapa para marcar la ubicación del problema.';
                statusLocation.style.color = '';
                // Keep map visible at default center — user can tap to place pin
            },
            { timeout: 8000, maximumAge: 30000 }
        );
    }

    function startPickerMap() {
        if (typeof google === 'undefined' || !google.maps) return;
        initPickerMap();

        const mapContainer = document.getElementById('report-map-container');

        function doResize() {
            google.maps.event.trigger(pickerMap, 'resize');
            // Remove skeleton once map is presumably ready
            if (mapContainer) mapContainer.classList.remove('skeleton');
            
            // Second resize after animation completes to ensure tiles paint
            setTimeout(() => google.maps.event.trigger(pickerMap, 'resize'), 350);
            const lat = parseFloat(document.getElementById('lat').value);
            const lng = parseFloat(document.getElementById('lng').value);
            if (lat && lng) syncPickerMap(lat, lng);
            else tryAutoGPS();
        }

        // ResizeObserver: se dispara exactamente cuando el contenedor
        // tiene dimensiones reales — funciona en iOS, Android y desktop.
        if (window.ResizeObserver && mapContainer) {
            const ro = new ResizeObserver((entries) => {
                for (const entry of entries) {
                    const h = entry.contentRect.height;
                    if (h > 10) {
                        ro.disconnect(); // solo necesitamos el primer resize útil
                        doResize();
                    }
                }
            });
            ro.observe(mapContainer);
            // Fallback: si ya tiene altura (modal ya estaba abierto), disparar ya
            if (mapContainer.offsetHeight > 10) doResize();
        } else {
            // Fallback para browsers muy viejos sin ResizeObserver
            setTimeout(doResize, 150);
            setTimeout(doResize, 600);
        }
    }

    // Observe when the modal becomes visible
    const modalReportEl = document.getElementById('modal-report');
    if (modalReportEl) {
        new MutationObserver(() => {
            if (modalReportEl.classList.contains('is-active')) {
                startPickerMap();
            }
        }).observe(modalReportEl, { attributes: true, attributeFilter: ['class'] });
    }
    // Init if Maps API loads after DOMContentLoaded
    document.addEventListener('googleMapsReady', startPickerMap);
    // Also try immediately in case API is already loaded
    startPickerMap();
    // ── END MAP PICKER ────────────────────────────────────────────

    // ── STEPPER LOGIC ───────────────────────────────────────────
    const ftSelect = document.getElementById('failure-type');
    const ftOtherWrap = document.getElementById('failure-type-other-wrap');
    if (ftSelect && ftOtherWrap) {
        ftSelect.addEventListener('change', () => {
            ftOtherWrap.style.display = ftSelect.value === 'otro' ? 'block' : 'none';
        });
    }

    let currentStep = 1;
    const totalSteps = 3;
    const steps = document.querySelectorAll('.modal-step');
    const indicators = document.querySelectorAll('.step-indicator');
    const btnNext = document.querySelector('.btn-next-step');
    const btnPrev = document.querySelector('.btn-prev-step');
    const btnSubmit = document.querySelector('.btn-submit-modal');

    function updateStepper() {
        steps.forEach(s => s.classList.remove('is-active'));
        indicators.forEach(ind => {
            const stepNum = parseInt(ind.dataset.step);
            ind.classList.remove('active', 'completed');
            if (stepNum === currentStep) ind.classList.add('active');
            if (stepNum < currentStep) ind.classList.add('completed');
        });

        const activeStep = document.querySelector(`.modal-step[data-step="${currentStep}"]`);
        if (activeStep) activeStep.classList.add('is-active');

        btnPrev.style.display = currentStep === 1 ? 'none' : 'flex';
        
        if (currentStep === totalSteps) {
            btnNext.style.display = 'none';
            btnSubmit.style.display = 'flex';
        } else {
            btnNext.style.display = 'flex';
            btnSubmit.style.display = 'none';
        }
    }

    function validateStep(n) {
        if (n === 1) {
            const type = document.getElementById('failure-type').value;
            if (!type) { alert('Por favor selecciona el tipo de falla.'); return false; }
        }
        if (n === 2) {
            const lat = document.getElementById('lat').value;
            if (!lat) { alert('Por favor selecciona la ubicación en el mapa.'); return false; }
        }
        return true;
    }

    if (btnNext) {
        btnNext.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                updateStepper();
            }
        });
    }

    if (btnPrev) {
        btnPrev.addEventListener('click', () => {
            currentStep--;
            updateStepper();
        });
    }

    // Reset stepper when modal closes/opens
    const modalObserver = new MutationObserver(() => {
        if (!modalReportEl.classList.contains('is-active')) {
            currentStep = 1;
            updateStepper();
        }
    });
    if (modalReportEl) modalObserver.observe(modalReportEl, { attributes: true, attributeFilter: ['class'] });

    // ── END STEPPER LOGIC ───────────────────────────────────────

    const formReport = document.getElementById('form-report');
    if (formReport) {
        formReport.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = btnSubmit;
            btn.disabled = true;
            btn.textContent = 'Enviando...';
            try {
                const nombre = document.getElementById('reporter-name').value.trim();
                const email = document.getElementById('reporter-email').value.trim();
                let tipo = document.getElementById('failure-type').value;
                const direccion = document.getElementById('location').value.trim();
                let lat = document.getElementById('lat').value;
                let lng = document.getElementById('lng').value;
                const descripcion = document.getElementById('description').value.trim();
                // If user selected "Otro", use the custom text field value
                if (tipo === 'otro') {
                    const other = document.getElementById('failure-type-other') && document.getElementById('failure-type-other').value.trim();
                    if (other) tipo = other;
                }

                let photoFile = null;
                const photoInputNormal = document.getElementById('photo');
                // Prioridad: foto tomada con la cámara (getUserMedia) → archivo de galería
                if (typeof cameraFile !== 'undefined' && cameraFile) {
                    photoFile = cameraFile;
                } else if (photoInputNormal && photoInputNormal.files && photoInputNormal.files.length > 0) {
                    photoFile = photoInputNormal.files[0];
                }

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
                const payload = {
                    nombre_ciudadano: nombre || null,
                    email: email || null,
                    direccion: direccion || null,
                    latitud: lat || null,
                    longitud: lng || null,
                    tipo_incidencia: tipo || null,
                    descripcion: descripcion || null,
                    estatus: 'pendiente',
                    foto: fotoData || null
                };

                const resp = await fetch('/public/api/incidencias.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await resp.json();
                if (!data.ok) { alert(data.error || 'No se pudo enviar el reporte.'); return; }

                document.getElementById('report-id').textContent = data.id ? '' + data.id : '#0000';
                // show quick consult button and wire it to open modal-consult prefilled
                try {
                    const viewBtn = document.getElementById('report-view-link');
                    if (viewBtn && data.id) {
                        viewBtn.style.display = 'inline-block';
                        viewBtn.onclick = () => {
                            try {
                                const consultModal = document.getElementById('modal-consult');
                                const reportModal = document.getElementById('modal-report');
                                const input = document.getElementById('report-number');
                                const form = document.getElementById('form-consult');
                                if (reportModal) reportModal.classList.remove('is-active');
                                if (consultModal) { consultModal.classList.add('is-active'); document.body.classList.add('modal-is-active'); }
                                if (input) { input.value = data.id; input.focus(); }
                                if (form) {
                                    // trigger the consult form submit programmatically
                                    form.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
                                }
                            } catch (e) { console.warn('No se pudo abrir el modal de consulta', e); }
                        };
                    }
                } catch (e) { console.warn(e); }
                formReport.style.display = 'none';
                document.getElementById('report-success').style.display = 'block';

                if (typeof gMap !== 'undefined' && gMap && data.row && data.row.latitud && data.row.longitud) {
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
    }
});

(function () {
    const lb = document.getElementById('lb-report');
    const img = document.getElementById('lb-report-img');
    const cap = document.getElementById('lb-report-caption');
    if (!lb) return;
    const btn = lb.querySelector('.close');
    window.openReportLightbox = function (src, caption) { if (!src) return; img.src = src; cap.textContent = caption || ''; lb.classList.add('active'); lb.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; };
    window.closeReportLightbox = function () { lb.classList.remove('active'); lb.setAttribute('aria-hidden', 'true'); img.src = ''; cap.textContent = ''; document.body.style.overflow = ''; };
    lb.addEventListener('click', (e) => { if (e.target === lb || e.target === btn) closeReportLightbox(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeReportLightbox(); });
})();
