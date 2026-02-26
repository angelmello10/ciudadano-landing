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
