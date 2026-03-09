<link rel="stylesheet" href="/public/css/mapa.css">

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
                <button type="button" id="map-loc-btn" class="mps-loc-btn" onclick="verMiUbicacion()">
                    <svg id="map-loc-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><line x1="12" y1="0" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="24"/><line x1="0" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="24" y2="12"/></svg>
                    <svg id="map-loc-spinner" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:none;animation:map-spin 0.8s linear infinite"><path d="M12 2a10 10 0 0 1 10 10"/></svg>
                    <span id="map-loc-label">Mi ubicaci&oacute;n</span>
                </button>
                <button type="button" id="map-open-incident-btn" class="mps-open-incident-btn" onclick="openCurrentMapIncident()" disabled>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span id="map-open-incident-label">Ver incidencia</span>
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
<script src="/public/js/mapa.js"></script>