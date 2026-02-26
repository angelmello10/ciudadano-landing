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
