<section id="mapa" class="dashboard section has-top-divider">
    <div class="container">
        <div class="dashboard-inner section-inner">
            <div class="section-header center-content">
                <div class="container-xs">
                    <h2 class="mt-0 mb-16">Monitoreo de incidencias en tiempo real</h2>
                    <p class="m-0">Monitorea el estado de tu comunidad. Mira los reportes activos y las
                        estadísticas de resolución en tu zona.</p>
                </div>
            </div>
            <div class="split-wrap">
                <div class="split-item" style="align-items: flex-start;">
                    <div class="split-item-content center-content-mobile reveal-from-left">
                        <h3 class="mt-0 mb-16">Mapa de Incidencias</h3>
                        <p class="mb-32 text-sm">Explora el mapa para ver qué problemas se han reportado
                            cerca de ti. Selecciona un pin para ver más detalles.</p>

                        <div class="stats-grid mb-32">
                            <div class="stat-card reveal-from-bottom" data-reveal-delay="100">
                                <div id="stat-total" class="stat-value h3">0</div>
                                <div class="stat-label text-xxs tt-u fw-600">Total Reportes</div>
                            </div>
                            <div class="stat-card reveal-from-bottom" data-reveal-delay="200">
                                <div id="stat-resolved" class="stat-value h3 text-color-success">0</div>
                                <div class="stat-label text-xxs tt-u fw-600">Resueltos</div>
                            </div>
                            <div class="stat-card reveal-from-bottom" data-reveal-delay="300">
                                <div id="stat-inprogress" class="stat-value h3 text-color-primary">0</div>
                                <div class="stat-label text-xxs tt-u fw-600">En Proceso</div>
                            </div>
                            <div class="stat-card reveal-from-bottom" data-reveal-delay="400">
                                <div id="stat-pending" class="stat-value h3" style="color: #f59e0b;">0</div>
                                <div class="stat-label text-xxs tt-u fw-600">Pendiente</div>
                            </div>
                        </div>

                        <div class="legend mt-24">
                            <div class="legend-item"><span class="dot bg-pending"></span> Pendiente</div>
                            <div class="legend-item"><span class="dot bg-error"></span> Rechazado</div>
                            <div class="legend-item"><span class="dot bg-primary"></span> En Proceso</div>
                            <div class="legend-item"><span class="dot bg-success"></span> Resuelto</div>
                        </div>

                        <button type="button" class="button button-primary btn-my-location mt-24"
                            onclick="verMiUbicacion()">Ver mi ubicación en el mapa</button>
                    </div>
                    <div class="split-item-image reveal-from-right" style="position: relative;">
                        <div id="map" class="map-mockup"></div>

                        <!-- Pin Details Tooltip -->
                        <div id="pin-details" class="pin-details-card">
                            <h6 id="pin-title" class="m-0 text-sm"></h6>
                            <p id="pin-meta" class="text-xxs mb-0"></p>
                            <span id="pin-status" class="status-pill mt-8"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    function buildMarker(map, inc) {
        const type = statusType(inc.estatus);
        const color = statusColor(type);
        const marker = new google.maps.Marker({
            position: { lat: parseFloat(inc.latitud), lng: parseFloat(inc.longitud) },
            map: map,
            title: inc.tipo_incidencia || 'Incidencia',
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                fillOpacity: 1,
                fillColor: color,
                strokeColor: '#fff',
                strokeWeight: 2,
                scale: 8
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

    let userMarker = null;
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
                const iw = new google.maps.InfoWindow({ content: '<strong style="color:#9D1B32">📍 Estás aquí</strong>' });
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
        const center = { lat: 19.4326, lng: -99.1332 };
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

        fetch('/api/incidencias.php?limit=100')
            .then(r => r.json())
            .then(data => {
                if (!data.ok) return;

                let totales = data.rows.length;
                let resueltos = 0;
                let enProceso = 0;
                let pendientes = 0;

                data.rows.forEach(inc => {
                    let st = inc.estatus ? inc.estatus.toLowerCase() : '';
                    if (st === 'resuelto') resueltos++;
                    else if (st === 'en proceso' || st === 'activo') enProceso++;
                    else if (st === 'pendiente' || st === '') pendientes++;
                });

                const elTotal = document.getElementById('stat-total');
                const elResolved = document.getElementById('stat-resolved');
                const elInprogress = document.getElementById('stat-inprogress');
                const elPending = document.getElementById('stat-pending');

                if (elTotal) {
                    let max = totales;
                    let curr = 0;
                    let intv = setInterval(() => {
                        curr = curr + Math.ceil(max / 10);
                        if (curr >= max) { curr = max; clearInterval(intv); }
                        elTotal.textContent = curr;
                    }, 40);
                }
                if (elResolved) elResolved.textContent = resueltos;
                if (elInprogress) elInprogress.textContent = enProceso;
                if (elPending) elPending.textContent = pendientes;

                const withLocation = data.rows.filter(r => r.latitud && r.longitud);

                const heatmapData = withLocation.map(r => new google.maps.LatLng(parseFloat(r.latitud), parseFloat(r.longitud)));
                new google.maps.visualization.HeatmapLayer({
                    data: heatmapData,
                    map: gMap,
                    radius: 30,
                    gradient: ['rgba(157,27,50,0)', 'rgba(157,27,50,1)', 'rgba(157,27,50,1)']
                });

                withLocation.forEach(inc => {
                    gMarkers[inc.id] = buildMarker(gMap, inc);
                });

                buildTable(data.rows);
            })
            .catch(err => console.error('Error cargando incidencias:', err));
    }
</script>
