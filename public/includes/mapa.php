<section id="mapa" class="mps-section">
    <div class="mps-container">

        <!-- Header -->
        <div class="mps-header">
            <div>
                <div class="mps-eyebrow">
                    <span class="mps-eyebrow-dot"></span>
                    Monitoreo en tiempo real
                </div>
                <h2 class="mps-title">Centro de <span>monitoreo</span> ciudadano</h2>
                <p class="mps-sub">Visualiza incidencias activas, estadísticas de resolución y reportes de tu comunidad.</p>
            </div>
        </div>

        <!-- Stats -->
        <div class="mps-stats">
            <div class="mps-stat mps-stat--total">
                <div class="mps-stat-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="mps-stat-body">
                    <span id="stat-total" class="mps-stat-num">--</span>
                    <span class="mps-stat-lbl">Total Reportes</span>
                </div>
            </div>
            <div class="mps-stat mps-stat--resolved">
                <div class="mps-stat-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div class="mps-stat-body">
                    <span id="stat-resolved" class="mps-stat-num">--</span>
                    <span class="mps-stat-lbl">Resueltos</span>
                </div>
            </div>
            <div class="mps-stat mps-stat--inprogress">
                <div class="mps-stat-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <div class="mps-stat-body">
                    <span id="stat-inprogress" class="mps-stat-num">--</span>
                    <span class="mps-stat-lbl">En Proceso</span>
                </div>
            </div>
            <div class="mps-stat mps-stat--pending">
                <div class="mps-stat-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <div class="mps-stat-body">
                    <span id="stat-pending" class="mps-stat-num">--</span>
                    <span class="mps-stat-lbl">Pendientes</span>
                </div>
            </div>
        </div>

        <!-- Controls bar (outside the map) -->
        <div class="mps-controls-bar" id="mapa-controles">
            <div class="mps-legend">
                <span class="mps-legend-item">
                    <span class="mps-legend-icon mps-legend-icon--pending">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </span>
                    Pendiente
                </span>
                <span class="mps-legend-item">
                    <span class="mps-legend-icon mps-legend-icon--rejected">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    </span>
                    Rechazado
                </span>
                <span class="mps-legend-item">
                    <span class="mps-legend-icon mps-legend-icon--inprogress">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </span>
                    En Proceso
                </span>
                <span class="mps-legend-item">
                    <span class="mps-legend-icon mps-legend-icon--resolved">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    Resuelto
                </span>
            </div>
            <div class="mps-toolbar">
                <span class="map-live-badge" id="map-live-badge">
                    <span class="map-live-dot"></span>
                    <span id="map-live-text">En vivo</span>
                </span>
                <div class="mps-filter" style="display:flex;align-items:center;gap:8px;margin-right:8px;">
                    <label for="map-status-filter" style="font-size:0.85rem;color:#374151;margin-right:6px;">Estado</label>
                    <select id="map-status-filter" class="map-status-filter" aria-label="Filtro de estado">
                        <option value="all">Todos</option>
                        <option value="pending">Pendientes</option>
                        <option value="inprogress">En Proceso</option>
                        <option value="resolved">Resueltos</option>
                        <option value="rejected">Rechazados</option>
                    </select>
                    <button type="button" id="map-filter-prev" class="map-filter-btn" title="Anterior" style="display:none;">◀</button>
                    <button type="button" id="map-filter-next" class="map-filter-btn" title="Siguiente" style="display:none;">▶</button>
                </div>

                <div class="mps-folio">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input id="map-folio-input" type="text" placeholder="N&uacute;m. seguimiento&hellip;" maxlength="20" autocomplete="off" spellcheck="false">
                    <button type="button" id="map-folio-btn">Buscar</button>
                </div>
                <button type="button" class="mps-loc-btn" onclick="verMiUbicacion()">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><line x1="12" y1="0" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="24"/><line x1="0" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="24" y2="12"/></svg>
                    Mi ubicaci&oacute;n
                </button>
            </div>
        </div>

        <!-- Map frame -->
        <div class="mps-frame">

            <!-- Google Map canvas -->
            <div id="map" class="map-mockup"></div>

            <!-- Pin details card -->
            <div id="pin-details" class="pin-details-card">
                <!-- Top accent bar (colored per status) -->
                <div id="pd-accent" class="pd-accent-bar"></div>

                <!-- Header: folio + close -->
                <div class="pd-header">
                    <span class="pd-folio-badge">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Folio&nbsp;<strong id="pd-folio">#--</strong>
                    </span>
                    <button class="pin-details-close" onclick="document.getElementById('pin-details').classList.remove('is-active')" aria-label="Cerrar">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>

                <!-- Status pill + incident type -->
                <div class="pd-title-row">
                    <h6 id="pin-title" class="pd-title"></h6>
                    <span id="pin-status" class="status-pill pd-status-pill"></span>
                </div>

                <!-- Scrollable body -->
                <div class="pd-body">

                <!-- Address -->
                <div class="pd-row" id="pd-address-row">
                    <svg class="pd-row-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span id="pd-address" class="pd-row-text"></span>
                </div>

                <!-- Description -->
                <div class="pd-row pd-desc-row" id="pd-desc-row">
                    <svg class="pd-row-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    <span id="pd-desc" class="pd-row-text pd-desc-text"></span>
                </div>

                <!-- Photo -->
                <div id="pd-photo-row" class="pd-photo-row">
                    <div class="pd-photo-wrap" style="position:relative;">
                        <img id="pd-photo" src="" alt="Foto de la incidencia" class="pd-photo-img" style="display:block;">
                        <button id="pd-photo-btn" class="pd-photo-btn" style="position:absolute;right:10px;top:10px;background:rgba(0,0,0,0.6);color:#fff;border:0;padding:8px 10px;border-radius:8px;cursor:pointer;display:none;">Ver foto</button>
                    </div>
                </div>

                </div><!-- /pd-body -->

                <!-- Footer: reporter + date -->
                <div class="pd-footer">
                    <div class="pd-footer-meta">
                        <span class="pd-footer-item">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span id="pd-reporter"></span>
                        </span>
                        <span class="pd-footer-item">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span id="pd-date"></span>
                        </span>
                    </div>
                    <a id="pd-directions-btn" href="#" target="_blank" rel="noopener" >
                    </a>
                </div>
            </div>

        </div><!-- /mps-frame -->

    </div>
</section>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCchiqlRlOnv6C4pXxh59tYDMRiK501Tmc&libraries=visualization,places&callback=initMap"
    async defer></script>
<script>
    // Global references so the table can interact with the map
    let gMap = null;
    const gMarkers = {};       // keyed by incident id
    const gMarkerStatus = {};  // keyed by incident id → estatus actual

    function statusType(estatus) {
        if (!estatus) return 'pending';
        const s = estatus.toLowerCase();
        if (s === 'resuelto') return 'resolved';
        if (s === 'en proceso' || s === 'activo') return 'inprogress';
        if (s === 'rechazado') return 'rejected';
        return 'pending';
    }

    function statusColor(type) {
        const colors = {
            resolved: '#10b981',
            inprogress: '#3b82f6',
            rejected: '#ef4444',
            pending: '#f59e0b'
        };
        return colors[type] || '#f59e0b';
    }

    function statusPillClass(type) {
        const classes = {
            resolved: 'pill-resuelto',
            inprogress: 'pill-en-proceso',
            rejected: 'pill-rechazado',
            pending: 'pill-pendiente'
        };
        return classes[type] || 'pill-pendiente';
    }

    /* Icon-box SVG markers — same rounded-rect style as legend cards */
    function buildMarkerIcon(type) {
        const cfgs = {
            pending:    { bg: '#f59e0b', border: '#b45309',
                          path: '<circle cx="12" cy="12" r="9.5"/><line x1="12" y1="8" x2="12" y2="12.5"/><circle cx="12" cy="16.5" r="1" fill="white" stroke="none"/>' },
            rejected:   { bg: '#ef4444', border: '#b91c1c',
                          path: '<circle cx="12" cy="12" r="9.5"/><line x1="9" y1="9" x2="15" y2="15"/><line x1="15" y1="9" x2="9" y2="15"/>' },
            inprogress: { bg: '#3b82f6', border: '#1d4ed8',
                          path: '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' },
            resolved:   { bg: '#10b981', border: '#047857',
                          path: '<polyline points="20 6 9 17 4 12"/>' }
        };
        const c = cfgs[type] || cfgs.pending;
        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38">
  <filter id="ds"><feDropShadow dx="0" dy="2" stdDeviation="2.5" flood-color="rgba(0,0,0,0.35)"/></filter>
  <rect x="1" y="1" width="36" height="36" rx="10" fill="${c.bg}" stroke="${c.border}" stroke-width="1.8" filter="url(#ds)"/>
  <rect x="1" y="1" width="36" height="18" rx="10" fill="rgba(255,255,255,0.15)"/>
  <g transform="translate(7,7)" fill="none" stroke="white" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
    ${c.path}
  </g>
</svg>`;
        return 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg);
    }

    function buildMarker(map, inc) {
        const type = statusType(inc.estatus);
        const color = statusColor(type);
        const marker = new google.maps.Marker({
            position: { lat: parseFloat(inc.latitud), lng: parseFloat(inc.longitud) },
            map: map,
            title: inc.tipo_incidencia || 'Incidencia',
            icon: {
                url: buildMarkerIcon(type),
                scaledSize: new google.maps.Size(38, 38),
                anchor: new google.maps.Point(19, 19)
            }
        });

        const details   = document.getElementById('pin-details');
        const pinTitle  = document.getElementById('pin-title');
        const pinStatus = document.getElementById('pin-status');

        marker.addListener('click', () => {
            // Folio
            document.getElementById('pd-folio').textContent = '#' + inc.id;

            // Title
            pinTitle.textContent = inc.tipo_incidencia || 'Incidencia';

            // Status pill
            pinStatus.textContent = inc.estatus || 'pendiente';
            pinStatus.style.background = color;

            // Accent bar
            document.getElementById('pd-accent').style.background = color;

            // Address
            const addrRow  = document.getElementById('pd-address-row');
            const addrSpan = document.getElementById('pd-address');
            if (inc.direccion) {
                addrSpan.textContent = inc.direccion;
                addrRow.style.display = 'flex';
            } else {
                addrRow.style.display = 'none';
            }

            // Description
            const descRow  = document.getElementById('pd-desc-row');
            const descSpan = document.getElementById('pd-desc');
            if (inc.descripcion) {
                const txt = inc.descripcion.trim();
                descSpan.textContent = txt.length > 100 ? txt.slice(0, 100) + '…' : txt;
                descRow.style.display = 'flex';
            } else {
                descRow.style.display = 'none';
            }

            // Photo
            const photoRow = document.getElementById('pd-photo-row');
            const photoImg = document.getElementById('pd-photo');
            const photoBtn = document.getElementById('pd-photo-btn');
            if (inc.foto) {
                const src = 'public/uploads/' + inc.foto;
                photoImg.src = src;
                photoRow.style.display = 'block';
                if (photoBtn) {
                    photoBtn.style.display = 'inline-block';
                    photoBtn.onclick = () => { if (typeof window.openImageLightbox === 'function') window.openImageLightbox(src, 'Foto del reporte #' + inc.id); };
                }
                photoImg.style.cursor = 'zoom-in';
                photoImg.onclick = () => { if (typeof window.openImageLightbox === 'function') window.openImageLightbox(src, 'Foto del reporte #' + inc.id); };
            } else {
                photoRow.style.display = 'none';
                if (photoBtn) photoBtn.style.display = 'none';
                photoImg.src = '';
                photoImg.onclick = null;
                photoImg.style.cursor = '';
            }

            // Reporter + date
            document.getElementById('pd-reporter').textContent = inc.nombre_ciudadano || 'Anónimo';
            document.getElementById('pd-date').textContent = inc.created_at
                ? new Date(inc.created_at).toLocaleDateString('es-MX', { day: '2-digit', month: 'short', year: 'numeric' })
                : '';

            // Directions link
            document.getElementById('pd-directions-btn').href =
                `https://www.google.com/maps/dir/?api=1&destination=${inc.latitud},${inc.longitud}`;

            details.classList.add('is-active');
        });

        return marker;
    }

    function buildTable(rows) {
        const tbody = document.getElementById('incidents-tbody');
        if (!tbody) return;
        tbody.innerHTML = '';
        if (!rows || rows.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:24px;color:#64748b">Aún no hay incidencias registradas.</td></tr>';
            return;
        }
        rows.forEach(inc => {
            const type = statusType(inc.estatus);
            const pillClass = statusPillClass(type);
            const hasLocation = inc.latitud && inc.longitud;
            const date = inc.created_at ? new Date(inc.created_at).toLocaleDateString('es-MX') : '—';
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><strong>${inc.id}</strong></td>
                <td>${inc.tipo_incidencia || '—'}</td>
                <td>${inc.direccion || '—'}</td>
                <td>${inc.nombre_ciudadano || 'Anónimo'}</td>
                <td><span class="status-pill ${pillClass}">${inc.estatus || 'pendiente'}</span></td>
                <td>${date}</td>
                <td>
                    ${hasLocation
                    ? `<button class="button button-primary button-sm" onclick="verEnMapa(${inc.id})">📍 Ver en mapa</button>`
                    : '<span style="color:#aaa;font-size:12px">Sin ubicación</span>'}
                </td>`;
            tbody.appendChild(tr);
        });
    }

    window.verEnMapa = function (id) {
        const marker = gMarkers[id];
        if (!marker || !gMap) return;
        document.getElementById('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
        gMap.panTo(marker.getPosition());
        gMap.setZoom(16);
        google.maps.event.trigger(marker, 'click');
    };

    /* ── MAP FOLIO SEARCH ── */
    (function () {
        const input = document.getElementById('map-folio-input');
        const btn   = document.getElementById('map-folio-btn');
        if (!input || !btn) return;

        function buscarFolio() {
            const id = parseInt(input.value.trim(), 10);
            if (!id || id < 1) { input.focus(); return; }
            if (gMarkers[id]) {
                verEnMapa(id);
                input.value = '';
            } else {
                input.style.borderColor = '#ef4444';
                input.title = 'Folio no encontrado o sin ubicación';
                setTimeout(() => { input.style.borderColor = ''; input.title = ''; }, 2000);
            }
        }

        btn.addEventListener('click', buscarFolio);
        input.addEventListener('keydown', e => { if (e.key === 'Enter') buscarFolio(); });
    })();

    window.verMiUbicacion = function () {
        if (!navigator.geolocation) {
            alert('Tu navegador no soporta geolocalización.');
            return;
        }
        navigator.geolocation.getCurrentPosition(
            pos => {
                const myPos = { lat: pos.coords.latitude, lng: pos.coords.longitude };
                document.getElementById('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
                gMap.panTo(myPos);
                gMap.setZoom(15);
                if (userMarker) userMarker.setMap(null);
                userMarker = new google.maps.Marker({
                    position: myPos,
                    map: gMap,
                    title: 'Mi ubicación',
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillOpacity: 1,
                        fillColor: '#9D1B32',
                        strokeColor: '#fff',
                        strokeWeight: 3,
                        scale: 10
                    },
                    zIndex: 999
                });
                const iw = new google.maps.InfoWindow({ content: '<strong style="color:#9D1B32">Estás aquí</strong>' });
                iw.open(gMap, userMarker);
                userMarker.addListener('click', () => iw.open(gMap, userMarker));
            },
            err => {
                const msgs = {
                    1: 'Permiso de ubicación denegado. Actívalo en la configuración de tu navegador.',
                    2: 'No se pudo obtener tu ubicación.',
                    3: 'Tiempo de espera agotado.'
                };
                alert(msgs[err.code] || 'Error al obtener ubicación.');
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    };

    function initMap() {
        /* PulseOverlay ─ debe definirse aqui, una vez que Maps API esta lista */
        class PulseOverlay extends google.maps.OverlayView {
            constructor(latlng, color) {
                super();
                this._pos   = latlng;
                this._color = color;
                this._div   = null;
            }
            onAdd() {
                this._div = document.createElement('div');
                this._div.className = 'map-pulse';
                this._div.style.setProperty('--pulse-color', this._color);
                /* Stagger aleatorio para que no todos pulsen sincronizados */
                const d = (Math.random() * 2.2).toFixed(2);
                this._div.style.setProperty('--pulse-delay', `-${d}s`);
                /* Bajo los markers (overlayLayer), no encima */
                this.getPanes().overlayLayer.appendChild(this._div);
            }
            draw() {
                const p = this.getProjection().fromLatLngToDivPixel(this._pos);
                if (!p || !this._div) return;
                this._div.style.left = p.x + 'px';
                this._div.style.top  = p.y + 'px';
            }
            onRemove() {
                if (this._div && this._div.parentNode) this._div.parentNode.removeChild(this._div);
                this._div = null;
            }
        }

        const center = { lat: 19.4014, lng: -99.0150 }; // Nezahualcóyotl, Edo. Méx.

        /* ── Map styles: light & dark ── */
        /* Light: estilo por defecto de Google Maps (todos los iconos, restaurantes, etc.) */
        const mapStyleLight = [];

        /* Dark: réplica fiel del modo oscuro de Google Maps — conserva iconos de POI */
        const mapStyleDark = [
            { elementType: 'geometry',            stylers: [{ color: '#242f3e' }] },
            { elementType: 'labels.text.fill',    stylers: [{ color: '#746855' }] },
            { elementType: 'labels.text.stroke',  stylers: [{ color: '#242f3e' }] },
            { featureType: 'administrative.locality', elementType: 'labels.text.fill', stylers: [{ color: '#d59563' }] },
            { featureType: 'poi',                 elementType: 'labels.text.fill', stylers: [{ color: '#d59563' }] },
            { featureType: 'poi.park',            elementType: 'geometry',         stylers: [{ color: '#263c3f' }] },
            { featureType: 'poi.park',            elementType: 'labels.text.fill', stylers: [{ color: '#6b9a76' }] },
            { featureType: 'road',                elementType: 'geometry',         stylers: [{ color: '#38414e' }] },
            { featureType: 'road',                elementType: 'geometry.stroke',  stylers: [{ color: '#212a37' }] },
            { featureType: 'road',                elementType: 'labels.text.fill', stylers: [{ color: '#9ca5b3' }] },
            { featureType: 'road.highway',        elementType: 'geometry',         stylers: [{ color: '#746855' }] },
            { featureType: 'road.highway',        elementType: 'geometry.stroke',  stylers: [{ color: '#1f2835' }] },
            { featureType: 'road.highway',        elementType: 'labels.text.fill', stylers: [{ color: '#f3d19c' }] },
            { featureType: 'transit',             elementType: 'geometry',         stylers: [{ color: '#2f3948' }] },
            { featureType: 'transit.station',     elementType: 'labels.text.fill', stylers: [{ color: '#d59563' }] },
            { featureType: 'water',               elementType: 'geometry',         stylers: [{ color: '#17263c' }] },
            { featureType: 'water',               elementType: 'labels.text.fill', stylers: [{ color: '#515c6d' }] },
            { featureType: 'water',               elementType: 'labels.text.stroke', stylers: [{ color: '#17263c' }] }
        ];

        const isDark = document.documentElement.classList.contains('dark');
        // If you have a Google Maps Map ID (vector basemap from Google Cloud),
        // set it to `window.GOOGLE_MAP_ID = 'your-map-id'` before this script runs.
        // When present, the Map ID will provide Google's official styles including dark mode.
        const mapOptions = {
            zoom: 13,
            center: center,
            styles: isDark ? mapStyleDark : mapStyleLight
        };
        const mapId = (typeof window.GOOGLE_MAP_ID !== 'undefined' && window.GOOGLE_MAP_ID) ? window.GOOGLE_MAP_ID : null;
        if (mapId) mapOptions.mapId = mapId;
        gMap = new google.maps.Map(document.getElementById('map'), mapOptions);

        /* ── Sync map style whenever html.dark class changes ── */
        new MutationObserver(function() {
            const nowDark = document.documentElement.classList.contains('dark');
            gMap.setOptions({ styles: nowDark ? mapStyleDark : mapStyleLight });
        }).observe(document.documentElement, { attributeFilter: ['class'] });

        gMap.addListener('click', () => {
            document.getElementById('pin-details').classList.remove('is-active');
        });

        /* ── LIVE POLLING ── */
        let heatmapLayer = null;
        let lastUpdate   = null;
        let isFirstLoad  = true;
        let liveTimer    = null;

        function actualizarBadge() {
            const el = document.getElementById('map-live-text');
            if (!el || !lastUpdate) return;
            const seg = Math.round((Date.now() - lastUpdate) / 1000);
            el.textContent = seg < 10 ? 'Ahora mismo' :
                             seg < 60 ? `hace ${seg}s` :
                             `hace ${Math.round(seg/60)}m`;
        }

        function cargarIncidencias() {
            fetch('/public/api/incidencias.php?limit=300')
                .then(r => r.json())
                .then(data => {
                    if (!data.ok) return;

                    /* ─ stats ─ */
                    let totales = data.rows.length, resueltos = 0, enProceso = 0, pendientes = 0;
                    data.rows.forEach(inc => {
                        const st = inc.estatus ? inc.estatus.toLowerCase() : '';
                        if (st === 'resuelto') resueltos++;
                        else if (st === 'en proceso' || st === 'activo') enProceso++;
                        else pendientes++;
                    });

                    const elTotal      = document.getElementById('stat-total');
                    const elResolved   = document.getElementById('stat-resolved');
                    const elInprogress = document.getElementById('stat-inprogress');
                    const elPending    = document.getElementById('stat-pending');

                    if (isFirstLoad && elTotal) {
                        let curr = 0;
                        const intv = setInterval(() => {
                            curr = curr + Math.ceil(totales / 10);
                            if (curr >= totales) { curr = totales; clearInterval(intv); }
                            elTotal.textContent = curr;
                        }, 40);
                    } else if (elTotal) {
                        elTotal.textContent = totales;
                    }
                    if (elResolved)   elResolved.textContent   = resueltos;
                    if (elInprogress) elInprogress.textContent = enProceso;
                    if (elPending)    elPending.textContent    = pendientes;

                    /* ─ markers: agrega nuevos y ELIMINA los que ya no existen ─ */
                    const withLocation = data.rows.filter(r => r.latitud && r.longitud);
                    const incomingIds  = new Set(withLocation.map(r => String(r.id)));
                    let hayNuevos = false;

                    // Eliminar marcadores que ya no están en la API
                    let hayEliminados = false;
                    Object.keys(gMarkers).forEach(id => {
                        if (!incomingIds.has(id)) {
                            gMarkers[id].setMap(null);
                            delete gMarkers[id];
                            delete gMarkerStatus[id];
                            hayEliminados = true;
                        }
                    });

                    withLocation.forEach(inc => {
                        const prevStatus = gMarkerStatus[inc.id];
                        const currStatus = inc.estatus ? inc.estatus.toLowerCase() : '';

                        // Si cambió de estatus → eliminar el marcador viejo y recrearlo
                        if (gMarkers[inc.id] && prevStatus !== currStatus) {
                            gMarkers[inc.id].setMap(null);
                            delete gMarkers[inc.id];
                            hayEliminados = true;
                        }

                        if (gMarkers[inc.id]) return; // ya existe y no cambió
                        gMarkers[inc.id]      = buildMarker(gMap, inc);
                        gMarkerStatus[inc.id] = currStatus;
                        const pulse = new PulseOverlay(
                            new google.maps.LatLng(parseFloat(inc.latitud), parseFloat(inc.longitud)),
                            statusColor(statusType(inc.estatus))
                        );
                        pulse.setMap(gMap);
                        hayNuevos = true;
                    });

                    /* ─ heatmap: reconstruye si hay cambios o primer load ─ */
                    if (isFirstLoad || hayNuevos || hayEliminados) {
                        if (heatmapLayer) heatmapLayer.setMap(null);
                        heatmapLayer = new google.maps.visualization.HeatmapLayer({
                            data: withLocation.map(r => new google.maps.LatLng(parseFloat(r.latitud), parseFloat(r.longitud))),
                            map: gMap,
                            radius: 30,
                            gradient: ['rgba(157,27,50,0)', 'rgba(157,27,50,1)', 'rgba(157,27,50,1)']
                        });
                    }

                    /* ─ tabla ─ */
                    buildTable(data.rows);

                    /* ─ badge ─ */
                    lastUpdate = Date.now();
                    actualizarBadge();
                    isFirstLoad = false;
                })
                .catch(err => console.error('Error cargando incidencias:', err));
        }

        cargarIncidencias(); // carga inicial
        setInterval(cargarIncidencias, 30000); // polling cada 30 s
        setInterval(actualizarBadge, 10000);   // actualiza el texto del badge

        // Notifica a otros componentes que el API de Maps ya está lista
        document.dispatchEvent(new Event('googleMapsReady'));
    }
</script>
<style>
    /* Carousel controls styling */
    .map-carousel-controls { position:absolute; left:50%; bottom:24px; transform:translateX(-50%); display:flex; gap:10px; align-items:center; z-index:99999; pointer-events:none; }
    .map-carousel-controls[aria-hidden="false"] { pointer-events:auto; }
    .map-carousel-controls .mc-btn { width:44px; height:44px; border-radius:999px; border:0; background:#ffffff; color:#0f172a; font-size:22px; line-height:1; box-shadow:0 8px 20px rgba(2,6,23,0.12); display:inline-flex; align-items:center; justify-content:center; cursor:pointer; }
    .map-carousel-controls .mc-counter { background:rgba(0,0,0,0.6); color:#fff; padding:6px 12px; border-radius:999px; font-weight:600; font-size:0.95rem; }
    @media (max-width:720px) { .map-carousel-controls { bottom:12px; gap:8px; } .map-carousel-controls .mc-btn { width:40px; height:40px; } }

    /* Filter select and small toolbar buttons styling */
    .map-status-filter { min-width:150px; padding:6px 8px; border-radius:8px; border:1px solid rgba(15,23,42,0.06); background:#fff; font-size:0.95rem; color:#0f172a; }
    .map-filter-btn { padding:6px 8px; border-radius:6px; border:0; background:#fff; box-shadow:0 1px 4px rgba(0,0,0,0.06); cursor:pointer; }

    /* Dark mode adjustments for select and buttons */
    html.dark .map-status-filter { background:#0b1220; color:#e6eef8; border:1px solid rgba(255,255,255,0.06); }
    html.dark .map-filter-btn, html.dark .map-carousel-controls .mc-btn { background:#0f1724; color:#e6eef8; box-shadow:0 6px 18px rgba(2,6,23,0.4); border:1px solid rgba(255,255,255,0.04); }
    html.dark .map-carousel-controls .mc-counter { background:rgba(255,255,255,0.08); color:#e6eef8; }
</style>

<script>
    (function(){
        // Filtered navigation for map incidents
        let filteredIds = [];
        let index = -1;
        const sel = document.getElementById('map-status-filter');
        const btnPrev = document.getElementById('map-filter-prev');
        const btnNext = document.getElementById('map-filter-next');
        const carPrev = document.getElementById('map-carousel-prev');
        const carNext = document.getElementById('map-carousel-next');
        const carCtr  = document.getElementById('map-carousel-counter');
        const carWrap = document.getElementById('map-carousel-controls');

        function normalizeTypeFromMarker(id) {
            if (!gMarkerStatus || !gMarkerStatus[id]) return 'pending';
            return (function(s){
                if (!s) return 'pending';
                const ss = s.toLowerCase();
                if (ss.indexOf('resuelto') !== -1) return 'resolved';
                if (ss.indexOf('en proceso') !== -1 || ss.indexOf('activo') !== -1) return 'inprogress';
                if (ss.indexOf('rechaz') !== -1) return 'rejected';
                return 'pending';
            })(gMarkerStatus[id]);
        }

        function updateFilteredList() {
            if (!sel) return;
            const want = sel.value; // all | pending | inprogress | resolved | rejected
            filteredIds = Object.keys(gMarkers || {}).filter(id => {
                if (!want || want === 'all') return true;
                return normalizeTypeFromMarker(id) === want;
            });
            index = filteredIds.length ? 0 : -1;
            updateControls();
        }

        function updateControls(){
            const show = filteredIds.length > 0 && sel && sel.value !== 'all';
            if (btnPrev) btnPrev.style.display = show ? 'inline-block' : 'none';
            if (btnNext) btnNext.style.display = show ? 'inline-block' : 'none';
            if (carWrap) { carWrap.style.display = show ? 'flex' : 'none'; carWrap.setAttribute('aria-hidden', show ? 'false' : 'true'); }
            if (carCtr) carCtr.textContent = `${index >= 0 ? (index + 1) : 0}/${filteredIds.length || 0}`;
        }

        function focusAt(i) {
            if (!filteredIds.length) return;
            if (i < 0) i = 0; if (i >= filteredIds.length) i = filteredIds.length - 1;
            index = i;
            const id = filteredIds[index];
            const marker = gMarkers[id];
            if (!marker || !gMap) return;
            gMap.panTo(marker.getPosition());
            gMap.setZoom(16);
            google.maps.event.trigger(marker, 'click');
            updateControls();
        }

        function next() { if (!filteredIds.length) return; focusAt((index + 1) % filteredIds.length); }
        function prev() { if (!filteredIds.length) return; focusAt((index - 1 + filteredIds.length) % filteredIds.length); }

        if (sel) sel.addEventListener('change', () => { updateFilteredList(); if (index >= 0) focusAt(index); });
        if (btnNext) btnNext.addEventListener('click', next);
        if (btnPrev) btnPrev.addEventListener('click', prev);
        if (carNext) carNext.addEventListener('click', next);
        if (carPrev) carPrev.addEventListener('click', prev);

        // Periodically refresh filtered list to stay in sync with markers
        setInterval(() => { try { updateFilteredList(); } catch(e){} }, 4000);

        // Expose for debugging
        window.mapFilterUpdate = updateFilteredList;
        window.mapFilterNext = next;
        window.mapFilterPrev = prev;
    })();
</script>