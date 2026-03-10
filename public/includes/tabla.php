<section id="incidencias" class="incidents-table-section section has-top-divider">
    <div class="container">
        <div class="section-inner">
            <div class="section-header center-content mb-48">
                <div class="container-xs">
                    <span class="section-label">Transparencia ciudadana</span>
                    <h2 class="mt-0 mb-16">Tabla de <span class="hero-accent">Incidencias</span></h2>
                    <p class="m-0">Consulta y da seguimiento a los reportes ciudadanos registrados en el portal.</p>
                </div>
            </div>

            <!-- Table Toolbar: Search + Status Filter + Live Count -->
            <div class="incidents-toolbar">
                <div class="it-search-box">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="table-search" placeholder="Buscar por folio o dirección..." onkeyup="filterIncidentsTable()">
                </div>

                <div class="it-filters">
                    <select id="table-status-filter" onchange="filterIncidentsTable()" class="it-select">
                        <option value="all">Todos los estados</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="en proceso">En Proceso</option>
                        <option value="resuelto">Resuelto</option>
                        <option value="rechazado">Rechazado</option>
                    </select>
                </div>

                <div class="it-stats">
                    <div class="it-live-badge">
                        <span class="it-live-dot"></span>
                        <span id="it-count-text">Cargando...</span>
                    </div>
                </div>
            </div>

            <div class="incidents-table-wrap" style="overflow-x: auto">
                <table class="incidents-table">
                    <thead>
                        <tr>
                            <th style="width: 80px; cursor: pointer; white-space: nowrap" onclick="sortTable('id')">Folio <span class="sort-icon">⇅</span></th>
                            <th style="cursor: pointer; white-space: nowrap" onclick="sortTable('tipo_incidencia')">Tipo <span class="sort-icon">⇅</span></th>
                            <th>Dirección</th>
                            <th>Ciudadano</th>
                            <th style="white-space: nowrap">Estatus</th>
                            <th style="white-space: nowrap">Fecha</th>
                            <th style="text-align: right; white-space: nowrap">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="incidents-tbody">
                        <!-- Skeleton loading rows -->
                        <tr class="skeleton-row"><td><span class="skeleton-bar" style="width:40px"></span></td><td><span class="skeleton-bar" style="width:90px"></span></td><td><span class="skeleton-bar" style="width:150px"></span></td><td><span class="skeleton-bar" style="width:100px"></span></td><td><span class="skeleton-bar" style="width:78px"></span></td><td><span class="skeleton-bar" style="width:60px"></span></td><td><span class="skeleton-bar" style="width:60px"></span></td></tr>
                        <tr class="skeleton-row"><td><span class="skeleton-bar" style="width:40px"></span></td><td><span class="skeleton-bar" style="width:75px"></span></td><td><span class="skeleton-bar" style="width:130px"></span></td><td><span class="skeleton-bar" style="width:100px"></span></td><td><span class="skeleton-bar" style="width:75px"></span></td><td><span class="skeleton-bar" style="width:60px"></span></td><td><span class="skeleton-bar" style="width:60px"></span></td></tr>
                        <tr class="skeleton-row"><td><span class="skeleton-bar" style="width:40px"></span></td><td><span class="skeleton-bar" style="width:100px"></span></td><td><span class="skeleton-bar" style="width:140px"></span></td><td><span class="skeleton-bar" style="width:95px"></span></td><td><span class="skeleton-bar" style="width:78px"></span></td><td><span class="skeleton-bar" style="width:60px"></span></td><td><span class="skeleton-bar" style="width:60px"></span></td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination -->
            <div id="table-pagination" class="table-pagination" style="display: none">
                <div class="tp-info"><span id="tp-range"></span></div>
                <div class="tp-controls">
                    <button id="tp-prev" onclick="prevTablePage()" class="tp-btn" disabled>&larr; Anterior</button>
                    <div id="tp-pages" class="tp-page-numbers"></div>
                    <button id="tp-next" onclick="nextTablePage()" class="tp-btn">Siguiente &rarr;</button>
                </div>
            </div>

            <div id="table-no-results" class="table-empty-state" style="display:none">
                <div class="tes-icon">🔎</div>
                <p>No se encontraron resultados para tu búsqueda.</p>
                <button class="button button-sm" onclick="clearTableSearch()">Limpiar filtros</button>
            </div>
        </div>
    </div>
</section>
