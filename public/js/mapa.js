// Global references so the table can interact with the map
let gMap = null;
const gMarkers = {};       // keyed by incident id
const gMarkerStatus = {};  // keyed by incident id → estatus actual
let currentMapIncidentId = null;

function syncCurrentIncidentButton() {
    const btn = document.getElementById('map-open-incident-btn');
    const label = document.getElementById('map-open-incident-label');
    if (!btn || !label) return;
    const hasIncident = !!(currentMapIncidentId && gMarkers[currentMapIncidentId]);
    btn.disabled = !hasIncident;
    label.textContent = hasIncident ? `Ver incidencia #${currentMapIncidentId}` : 'Ver incidencia';
}

function setCurrentMapIncident(id) {
    currentMapIncidentId = id ? String(id) : null;
    syncCurrentIncidentButton();
}

window.openCurrentMapIncident = function () {
    if (!currentMapIncidentId || !gMarkers[currentMapIncidentId]) return;
    google.maps.event.trigger(gMarkers[currentMapIncidentId], 'click');
};

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
        pending: {
            bg: '#f59e0b', border: '#b45309',
            path: '<circle cx="12" cy="12" r="9.5"/><line x1="12" y1="8" x2="12" y2="12.5"/><circle cx="12" cy="16.5" r="1" fill="white" stroke="none"/>'
        },
        rejected: {
            bg: '#ef4444', border: '#b91c1c',
            path: '<circle cx="12" cy="12" r="9.5"/><line x1="9" y1="9" x2="15" y2="15"/><line x1="15" y1="9" x2="9" y2="15"/>'
        },
        inprogress: {
            bg: '#3b82f6', border: '#1d4ed8',
            path: '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>'
        },
        resolved: {
            bg: '#10b981', border: '#047857',
            path: '<polyline points="20 6 9 17 4 12"/>'
        }
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
    const pinStatus = document.getElementById('pin-status');

    marker.addListener('click', () => {
        setCurrentMapIncident(inc.id);
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
        const addrRow = document.getElementById('pd-address-row');
        const addrSpan = document.getElementById('pd-address');
        if (inc.direccion) {
            addrSpan.textContent = inc.direccion;
            addrRow.style.display = 'flex';
        } else {
            addrRow.style.display = 'none';
        }

        // Description
        const descRow = document.getElementById('pd-desc-row');
        const descSpan = document.getElementById('pd-desc');
        if (inc.descripcion) {
            const txt = inc.descripcion.trim();
            descSpan.textContent = txt.length > 100 ? txt.slice(0, 100) + '…' : txt;
            descRow.style.display = 'flex';
        } else {
            descRow.style.display = 'none';
        }

        // Photo (prefer `foto_despues` when status is 'resuelto')
        const photoRow = document.getElementById('pd-photo-row');
        const photoImg = document.getElementById('pd-photo');
        const photoBtn = document.getElementById('pd-photo-btn');
        const estLower = inc.estatus ? inc.estatus.toLowerCase() : '';
        let photoSrc = '';
        if (estLower === 'resuelto' && inc.foto_despues) {
            photoSrc = 'public/uploads/' + inc.foto_despues;
        } else if (inc.foto) {
            photoSrc = 'public/uploads/' + inc.foto;
        }

        if (photoSrc) {
            photoImg.src = photoSrc;
            photoRow.style.display = 'block';
            if (photoBtn) {
                photoBtn.style.display = 'inline-block';
                photoBtn.onclick = () => { if (typeof window.openImageLightbox === 'function') window.openImageLightbox(photoSrc, 'Foto del reporte #' + inc.id); };
            }
            photoImg.style.cursor = 'zoom-in';
            photoImg.onclick = () => { if (typeof window.openImageLightbox === 'function') window.openImageLightbox(photoSrc, 'Foto del reporte #' + inc.id); };
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
                ? `<button class="button button-primary button-sm" onclick="verEnMapa(${inc.id})">Ver en mapa</button>`
                : '<span style="color:#aaa;font-size:12px">Sin ubicación</span>'}
                </td>`;
        tbody.appendChild(tr);
    });
}

/* ── Smooth fly-to: zoom out → pan → zoom in ── */
function smoothNavigateTo(position, targetZoom, onArrival) {
    if (!gMap) return;
    const bounds = gMap.getBounds();
    if (bounds && bounds.contains(position)) {
        // Already visible — just pan smoothly then adjust zoom
        gMap.panTo(position);
        const doZoom = () => { gMap.setZoom(targetZoom); if (onArrival) onArrival(); };
        if (gMap.getZoom() !== targetZoom) setTimeout(doZoom, 350);
        else { if (onArrival) onArrival(); }
        return;
    }
    // Out of view — zoom out, fly, zoom back in
    const outZoom = Math.min(gMap.getZoom(), 12);
    gMap.setZoom(outZoom);
    google.maps.event.addListenerOnce(gMap, 'idle', () => {
        gMap.panTo(position);
        google.maps.event.addListenerOnce(gMap, 'idle', () => {
            gMap.setZoom(targetZoom);
            if (onArrival) google.maps.event.addListenerOnce(gMap, 'idle', onArrival);
        });
    });
}

window.verEnMapa = function (id) {
    const marker = gMarkers[id];
    if (!marker || !gMap) return;
    setCurrentMapIncident(id);
    document.getElementById('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
    smoothNavigateTo(marker.getPosition(), 16, () => {
        google.maps.event.trigger(marker, 'click');
    });
};

/* ── MAP FOLIO SEARCH ── */
(function () {
    const input = document.getElementById('map-folio-input');
    const btn = document.getElementById('map-folio-btn');
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

let userMarker = null;
let userInfoWindow = null;

window.verMiUbicacion = function () {
    if (!navigator.geolocation) {
        alert('Tu navegador no soporta geolocalización.');
        return;
    }
    // Show loading state on button
    const btn = document.getElementById('map-loc-btn');
    const icon = document.getElementById('map-loc-icon');
    const spinner = document.getElementById('map-loc-spinner');
    const label = document.getElementById('map-loc-label');
    if (btn) btn.disabled = true;
    if (icon) icon.style.display = 'none';
    if (spinner) spinner.style.display = 'inline-block';
    if (label) label.textContent = 'Buscando…';

    function restoreBtn() {
        if (btn) btn.disabled = false;
        if (icon) icon.style.display = 'inline-block';
        if (spinner) spinner.style.display = 'none';
        if (label) label.textContent = 'Mi ubicación';
    }

    navigator.geolocation.getCurrentPosition(
        pos => {
            restoreBtn();
            const myPos = { lat: pos.coords.latitude, lng: pos.coords.longitude };
            document.getElementById('map').scrollIntoView({ behavior: 'smooth', block: 'center' });

            if (userMarker) userMarker.setMap(null);
            if (userInfoWindow) userInfoWindow.close();

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
                animation: google.maps.Animation.DROP,
                zIndex: 999
            });

            userInfoWindow = new google.maps.InfoWindow({
                content: `<div style="font-family:system-ui,sans-serif;padding:2px 4px;">
                        <div style="display:flex;align-items:center;gap:6px;">
                            <span style="width:10px;height:10px;border-radius:50%;background:#9D1B32;flex-shrink:0;"></span>
                            <strong style="color:#9D1B32;font-size:13px;">¡Estás aquí!</strong>
                        </div>
                        <p style="margin:4px 0 0;font-size:11px;color:#64748b;">Tu ubicación actual</p>
                    </div>`
            });

            smoothNavigateTo(myPos, 15, () => {
                userInfoWindow.open(gMap, userMarker);
            });

            userMarker.addListener('click', () => userInfoWindow.open(gMap, userMarker));
        },
        err => {
            restoreBtn();
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
            this._pos = latlng;
            this._color = color;
            this._div = null;
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
            this._div.style.top = p.y + 'px';
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
        { elementType: 'geometry', stylers: [{ color: '#242f3e' }] },
        { elementType: 'labels.text.fill', stylers: [{ color: '#746855' }] },
        { elementType: 'labels.text.stroke', stylers: [{ color: '#242f3e' }] },
        { featureType: 'administrative.locality', elementType: 'labels.text.fill', stylers: [{ color: '#d59563' }] },
        { featureType: 'poi', elementType: 'labels.text.fill', stylers: [{ color: '#d59563' }] },
        { featureType: 'poi.park', elementType: 'geometry', stylers: [{ color: '#263c3f' }] },
        { featureType: 'poi.park', elementType: 'labels.text.fill', stylers: [{ color: '#6b9a76' }] },
        { featureType: 'road', elementType: 'geometry', stylers: [{ color: '#38414e' }] },
        { featureType: 'road', elementType: 'geometry.stroke', stylers: [{ color: '#212a37' }] },
        { featureType: 'road', elementType: 'labels.text.fill', stylers: [{ color: '#9ca5b3' }] },
        { featureType: 'road.highway', elementType: 'geometry', stylers: [{ color: '#746855' }] },
        { featureType: 'road.highway', elementType: 'geometry.stroke', stylers: [{ color: '#1f2835' }] },
        { featureType: 'road.highway', elementType: 'labels.text.fill', stylers: [{ color: '#f3d19c' }] },
        { featureType: 'transit', elementType: 'geometry', stylers: [{ color: '#2f3948' }] },
        { featureType: 'transit.station', elementType: 'labels.text.fill', stylers: [{ color: '#d59563' }] },
        { featureType: 'water', elementType: 'geometry', stylers: [{ color: '#17263c' }] },
        { featureType: 'water', elementType: 'labels.text.fill', stylers: [{ color: '#515c6d' }] },
        { featureType: 'water', elementType: 'labels.text.stroke', stylers: [{ color: '#17263c' }] }
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
    new MutationObserver(function () {
        const nowDark = document.documentElement.classList.contains('dark');
        gMap.setOptions({ styles: nowDark ? mapStyleDark : mapStyleLight });
    }).observe(document.documentElement, { attributeFilter: ['class'] });

    gMap.addListener('click', () => {
        document.getElementById('pin-details').classList.remove('is-active');
    });

    /* ── LIVE POLLING ── */
    let heatmapLayer = null;
    let lastUpdate = null;
    let isFirstLoad = true;
    let liveTimer = null;

    function actualizarBadge() {
        const el = document.getElementById('map-live-text');
        if (!el || !lastUpdate) return;
        const seg = Math.round((Date.now() - lastUpdate) / 1000);
        el.textContent = seg < 10 ? 'Ahora mismo' :
            seg < 60 ? `hace ${seg}s` :
                `hace ${Math.round(seg / 60)}m`;
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

                const elTotal = document.getElementById('stat-total');
                const elResolved = document.getElementById('stat-resolved');
                const elInprogress = document.getElementById('stat-inprogress');
                const elPending = document.getElementById('stat-pending');

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
                if (elResolved) elResolved.textContent = resueltos;
                if (elInprogress) elInprogress.textContent = enProceso;
                if (elPending) elPending.textContent = pendientes;

                /* ─ markers: agrega nuevos y ELIMINA los que ya no existen ─ */
                const withLocation = data.rows.filter(r => r.latitud && r.longitud);
                const incomingIds = new Set(withLocation.map(r => String(r.id)));
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
                    gMarkers[inc.id] = buildMarker(gMap, inc);
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

(function () {
    // Filtered navigation for map incidents
    let filteredIds = [];
    let index = -1;
    const sel = document.getElementById('map-status-filter');
    const btnPrev = document.getElementById('map-filter-prev');
    const btnNext = document.getElementById('map-filter-next');
    const carPrev = document.getElementById('map-carousel-prev');
    const carNext = document.getElementById('map-carousel-next');
    const carCtr = document.getElementById('map-carousel-counter');
    const carWrap = document.getElementById('map-carousel-controls');

    function normalizeTypeFromMarker(id) {
        if (!gMarkerStatus || !gMarkerStatus[id]) return 'pending';
        return (function (s) {
            if (!s) return 'pending';
            const ss = s.toLowerCase();
            if (ss.indexOf('resuelto') !== -1) return 'resolved';
            if (ss.indexOf('en proceso') !== -1 || ss.indexOf('activo') !== -1) return 'inprogress';
            if (ss.indexOf('rechaz') !== -1) return 'rejected';
            return 'pending';
        })(gMarkerStatus[id]);
    }

    function updateFilteredList(resetIndex) {
        if (!sel) return;
        const want = sel.value; // all | pending | inprogress | resolved | rejected
        filteredIds = Object.keys(gMarkers || {}).filter(id => {
            if (!want || want === 'all') return true;
            return normalizeTypeFromMarker(id) === want;
        }).sort((a, b) => parseInt(a, 10) - parseInt(b, 10));
        // Only reset to 0 when explicitly requested (e.g. filter change)
        // or when the current index is out of range — NOT on periodic refresh
        if (resetIndex || index < 0 || index >= filteredIds.length) {
            index = filteredIds.length ? 0 : -1;
        }
        updateControls();
    }

    function updateControls() {
        const show = filteredIds.length > 0 && sel && sel.value !== 'all';
        if (btnPrev) btnPrev.style.display = show ? 'inline-block' : 'none';
        if (btnNext) btnNext.style.display = show ? 'inline-block' : 'none';
        if (carWrap) { carWrap.style.display = show ? 'flex' : 'none'; carWrap.setAttribute('aria-hidden', show ? 'false' : 'true'); }
        if (carCtr) carCtr.textContent = `${index >= 0 ? (index + 1) : 0}/${filteredIds.length || 0}`;
        if (!filteredIds.length && sel && sel.value !== 'all') setCurrentMapIncident(null);
    }

    function focusAt(i) {
        if (!filteredIds.length) return;
        if (i < 0) i = 0; if (i >= filteredIds.length) i = filteredIds.length - 1;
        index = i;
        const id = filteredIds[index];
        const marker = gMarkers[id];
        if (!marker || !gMap) return;
        setCurrentMapIncident(id);
        smoothNavigateTo(marker.getPosition(), 16, () => {
            marker.setAnimation(google.maps.Animation.BOUNCE);
            setTimeout(() => marker.setAnimation(null), 1400);
        });
        updateControls();
    }

    function next() { if (!filteredIds.length) return; focusAt((index + 1) % filteredIds.length); }
    function prev() { if (!filteredIds.length) return; focusAt((index - 1 + filteredIds.length) % filteredIds.length); }

    if (sel) sel.addEventListener('change', () => { updateFilteredList(true); if (index >= 0) focusAt(index); });
    if (btnNext) btnNext.addEventListener('click', next);
    if (btnPrev) btnPrev.addEventListener('click', prev);
    if (carNext) carNext.addEventListener('click', next);
    if (carPrev) carPrev.addEventListener('click', prev);

    // Periodically refresh filtered list to stay in sync with markers
    // Pass no argument so the current navigation index is preserved
    setInterval(() => { try { updateFilteredList(false); } catch (e) { } }, 4000);

    // Expose for debugging
    window.mapFilterUpdate = updateFilteredList;
    window.mapFilterNext = next;
    window.mapFilterPrev = prev;
})();
