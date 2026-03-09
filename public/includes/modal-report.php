<link rel="stylesheet" href="/public/css/modal-report.css">

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
                        <option value="otro">Otro</option>
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
                            <span class="btn-geo-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><line x1="12" y1="0" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="24"/><line x1="0" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="24" y2="12"/></svg>
                            </span>
                            <span class="btn-geo-label">GPS</span>
                            <span class="btn-geo-spin" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                    <circle cx="12" cy="12" r="9" stroke-opacity="0.25"/>
                                    <path d="M12 3 A9 9 0 0 1 21 12" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <small style="display:block;margin:4px 0 6px;color:#9ca3af;font-size:0.75rem;">Activa el GPS para mayor precisión o toca el mapa.</small>
                    <div id="report-map-container" style="height:230px;border-radius:10px;overflow:hidden;border:1.5px solid #e0e0e0;position:relative;">
                        <div id="report-map" style="width:100%;height:100%;"></div>
                        <div style="position:absolute;bottom:7px;left:50%;transform:translateX(-50%);background:rgba(0,0,0,0.55);color:#fff;font-size:0.7rem;padding:3px 10px;border-radius:20px;pointer-events:none;white-space:nowrap;">Toca el mapa o arrastra el pin para precisar</div>
                    </div>
                    <small id="location-status" class="field-hint" style="margin-top:4px;"></small>
                    <input type="hidden" id="lat">
                    <input type="hidden" id="lng">
                </div>

                <!-- Row 2: photo -->
                <div class="modal-form-group">
                    <label class="form-label-custom" for="photo">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        Evidencia fotográfica <span class="optional-tag">Opcional</span>
                    </label>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:6px;">
                        <!-- Cámara en vivo -->
                        <button type="button" id="btn-open-camera" style="padding:10px 8px;border-radius:8px;font-size:0.85rem;display:flex;align-items:center;justify-content:center;gap:6px;cursor:pointer;background:var(--primary,#9D1B32);color:#fff;border:none;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                            Tomar foto
                        </button>
                        <!-- Subir archivo -->
                        <label for="photo" style="padding:10px 8px;border-radius:8px;font-size:0.85rem;display:flex;align-items:center;justify-content:center;gap:6px;cursor:pointer;background:#f9fafb;color:#374151;border:1.5px dashed #d1d5db;position:relative;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#9D1B32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                            Subir imagen
                            <input id="photo" type="file" accept="image/*" style="position:absolute;inset:0;opacity:0;cursor:pointer;">
                        </label>
                    </div>

                    <small id="photo-name" class="field-hint"></small>
                    <div id="photo-preview-wrap" style="display:none;margin-top:12px;position:relative;">
                        <img id="photo-preview" src="" alt="Vista previa" style="width:100%;height:200px;border-radius:12px;object-fit:cover;border:1px solid rgba(0,0,0,0.08);box-shadow:0 4px 18px rgba(0,0,0,0.06);cursor:zoom-in;">
                        <button id="photo-preview-btn" type="button" style="position:absolute;right:12px;top:12px;background:rgba(0,0,0,0.6);color:#fff;border:0;padding:8px 10px;border-radius:8px;cursor:pointer;display:none;">Ver foto</button>
                    </div>

                    <!-- Overlay cámara en vivo -->
                    <div id="camera-overlay" style="display:none;flex-direction:column;gap:0;margin-top:8px;border-radius:10px;overflow:hidden;border:1px solid #e0e0e0;">
                        <video id="camera-video" autoplay playsinline muted style="width:100%;max-height:240px;object-fit:cover;display:block;background:#000;"></video>
                        <canvas id="camera-canvas" style="display:none;"></canvas>
                        <div style="display:flex;gap:6px;padding:8px;background:#000;">
                            <button type="button" id="btn-snap" style="flex:1;padding:8px;border-radius:6px;background:var(--primary,#9D1B32);color:#fff;border:none;font-size:0.85rem;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:5px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/></svg>
                                Capturar
                            </button>
                            <button type="button" id="btn-close-camera" style="padding:8px 14px;border-radius:6px;background:#1a1a1a;color:#888;border:none;font-size:0.85rem;cursor:pointer;">Cancelar</button>
                        </div>
                    </div>
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
                <div class="modal-folio-badge"><span id="report-id">#0000</span></div>
                <p class="modal-success-hint">Guarda este número para consultar el avance de tu incidencia en cualquier momento.</p>
                <div style="display:flex;gap:8px;justify-content:center;margin-top:12px;">
                    <button id="report-view-link" type="button" class="btn-submit-modal" style="display:none;">Consultar folio</button>
                    <button class="modal-success-btn modal-close-trigger" type="button">Entendido</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox (scoped to report modal) -->
<div id="lb-report" aria-hidden="true">
    <div class="inner">
        <button class="close" aria-label="Cerrar">×</button>
        <img id="lb-report-img" src="" alt="">
        <div class="caption" id="lb-report-caption"></div>
    </div>
</div>

<script src="/public/js/modal-report.js"></script>
