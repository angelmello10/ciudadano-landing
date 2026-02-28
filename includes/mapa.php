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

            <!-- Pin details tooltip -->
            <div id="pin-details" class="pin-details-card">
                <button class="pin-details-close" onclick="document.getElementById('pin-details').classList.remove('is-active')" aria-label="Cerrar">&times;</button>
                <h6 id="pin-title" class="m-0"></h6>
                <p id="pin-meta" class="pin-meta"></p>
                <span id="pin-status" class="status-pill"></span>
            </div>

        </div><!-- /mps-frame -->

    </div>
</section>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCchiqlRlOnv6C4pXxh59tYDMRiK501Tmc&libraries=visualization&callback=initMap"
    async defer></script>
<script>
    // Global references so the table can interact with the map
    let gMap = null;
    const gMarkers = {}; // keyed by incident id

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

        const details = document.getElementById('pin-details');
        const pinTitle = document.getElementById('pin-title');
        const pinMeta = document.getElementById('pin-meta');
        const pinStatus = document.getElementById('pin-status');

        marker.addListener('click', () => {
            pinTitle.textContent = (inc.tipo_incidencia || 'Incidencia') + (inc.direccion ? ' — ' + inc.direccion : '');
            pinMeta.textContent = 'Reportado por: ' + (inc.nombre_ciudadano || 'Anónimo') + ' | ' + (inc.created_at ? new Date(inc.created_at).toLocaleDateString('es-MX') : '');
            pinStatus.textContent = inc.estatus || 'pendiente';
            pinStatus.style.background = color;
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
                this.getPanes().overlayMouseTarget.appendChild(this._div);
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
        gMap = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: center,
            styles: [
                { elementType: 'geometry', stylers: [{ color: '#f5f5f5' }] },
                { elementType: 'labels.icon', stylers: [{ visibility: 'off' }] },
                { elementType: 'labels.text.fill', stylers: [{ color: '#616161' }] },
                { elementType: 'labels.text.stroke', stylers: [{ color: '#f5f5f5' }] },
                { featureType: 'road', elementType: 'geometry', stylers: [{ color: '#ffffff' }] },
                { featureType: 'water', elementType: 'geometry', stylers: [{ color: '#e9e9e9' }] }
            ]
        });

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
            fetch('/api/incidencias.php?limit=300')
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

                    /* ─ markers: solo agrega los nuevos ─ */
                    const withLocation = data.rows.filter(r => r.latitud && r.longitud);
                    let hayNuevos = false;

                    withLocation.forEach(inc => {
                        if (gMarkers[inc.id]) return; // ya existe
                        gMarkers[inc.id] = buildMarker(gMap, inc);
                        const pulse = new PulseOverlay(
                            new google.maps.LatLng(parseFloat(inc.latitud), parseFloat(inc.longitud)),
                            statusColor(statusType(inc.estatus))
                        );
                        pulse.setMap(gMap);
                        hayNuevos = true;
                    });

                    /* ─ heatmap: solo reconstruye si hay datos nuevos o primer load ─ */
                    if (isFirstLoad || hayNuevos) {
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
    }
</script>