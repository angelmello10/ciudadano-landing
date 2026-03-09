<link rel="stylesheet" href="/public/css/modal-consult.css">
<!-- MODAL: Consultar Reporte -->
<div id="modal-consult" class="modal modal-custom">
    <div class="modal-inner modal-custom-inner modal-custom-inner--narrow" style="max-height:92vh;display:flex;flex-direction:column;">

        <!-- Header -->
        <div class="modal-custom-header mh-dark mh-blue">
            <div class="mh-icon-wrap">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </div>
            <div class="mh-text">
                <h3 class="modal-custom-title">Consultar folio</h3>
                <p class="modal-custom-subtitle">Ingresa el ID de tu reporte para ver su estado actual.</p>
            </div>
            <button class="modal-custom-close modal-close-trigger" aria-label="Cerrar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="modal-custom-body">
            <!-- Search form -->
            <form id="form-consult">
                <div class="modal-form-group">
                    <label class="form-label-custom" for="report-number">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        Número de folio (ID)
                    </label>
                    <input id="report-number" class="form-input-custom form-input-big" type="number" min="1" placeholder="Ej: 42" required>
                </div>
                <button type="submit" class="btn-submit-modal">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Consultar estatus
                </button>
            </form>

            <!-- Result card -->
            <div id="status-result" style="display:none;">

                <!-- Top status banner -->
                <div class="cq-banner" id="cq-banner">
                    <div class="cq-banner-icon" id="cq-banner-icon">
                        <svg id="cq-banner-svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"></svg>
                    </div>
                    <div class="cq-banner-body">
                        <span class="cq-banner-label">Estatus del reporte</span>
                        <span class="cq-banner-status" id="cq-status-text">—</span>
                    </div>
                    <span class="cq-banner-id" id="cq-banner-id">#—</span>
                </div>

                <!-- Info card -->
                <div class="cq-card">
                    <!-- Tipo -->
                    <div class="cq-row cq-row--type">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span id="status-type" class="cq-type-text">—</span>
                    </div>
                    <div class="cq-divider"></div>
                    <!-- Dirección -->
                    <div class="cq-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--primary,#9D1B32)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span id="status-address" class="cq-meta-text">—</span>
                    </div>
                    <!-- Fecha -->
                    <div class="cq-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span id="status-date" class="cq-meta-text">—</span>
                    </div>
                    <!-- Ciudadano -->
                    <div class="cq-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span id="status-reporter" class="cq-meta-text">—</span>
                    </div>
                    <!-- Descripción -->
                    <div class="cq-row cq-row--desc" id="cq-desc-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><line x1="17" y1="10" x2="3" y2="10"/><line x1="21" y1="6" x2="3" y2="6"/><line x1="21" y1="14" x2="3" y2="14"/><line x1="17" y1="18" x2="3" y2="18"/></svg>
                        <span id="status-desc" class="cq-meta-text">—</span>
                    </div>
                </div>

                <!-- Photo -->
                <div id="status-photo-wrap" style="display:none;margin-top:12px;position:relative;">
                    <img id="status-photo" src="" alt="Foto del reporte"
                        style="width:100%;height:200px;border-radius:12px;object-fit:cover;border:1px solid rgba(0,0,0,0.08);box-shadow:0 4px 18px rgba(0,0,0,0.1);">
                    <button id="status-photo-btn" style="position:absolute;right:12px;top:12px;background:rgba(0,0,0,0.6);color:#fff;border:0;padding:8px 10px;border-radius:8px;cursor:pointer;display:none;">Ver foto</button>
                </div>

                <!-- Actions -->
                <button id="btn-ver-en-mapa" class="btn-submit-modal" type="button" style="display:none;margin-top:14px;background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                    Ver en el mapa
                </button>

                <button class="consult-back-btn" type="button"
                    onclick="document.getElementById('status-result').style.display='none';document.getElementById('form-consult').style.display='block';document.getElementById('report-number').value='';">
                    ← Consultar otro folio
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox (scoped to consult modal) -->
<div id="lb-consult" aria-hidden="true">
    <div class="inner">
        <button class="close" aria-label="Cerrar">×</button>
        <img id="lb-consult-img" src="" alt="">
        <div class="caption" id="lb-consult-caption"></div>
    </div>
</div>

<script src="/public/js/modal-consult.js"></script>
