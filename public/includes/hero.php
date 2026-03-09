<section class="hero section has-bg-color invert-color">
    <!-- Particle canvas -->
    <canvas id="hero-canvas" aria-hidden="true"></canvas>
    <div class="hero-grid-overlay"></div>
    <div class="container">
        <div class="hero-inner section-inner">
            <div class="split-wrap">
                <div class="split-item">
                    <div class="hero-content split-item-content center-content-mobile reveal-from-top">
                        <!-- <span class="hero-eyebrow">Plataforma ciudadana 24/7</span> -->
                        <h1 class="mt-0 mb-16">Reporta incidencias y mejora tu <span class="hero-accent">ciudad</span> en minutos</h1>
                        <p class="mt-0 mb-32">Conecta con tu municipio de forma rápida, transparente y
                            desde cualquier dispositivo. Tu reporte se registra al instante y puedes darle
                            seguimiento en tiempo real.</p>
                        <div class="button-group">
                            <a class="button button-primary button-wide-mobile modal-trigger"
                                aria-controls="modal-report" href="#0">
                                <svg class="hero-btn-icon" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                Crear reporte ahora
                            </a>
                            <a class="button button-dark button-wide-mobile modal-trigger"
                                aria-controls="modal-consult" href="#0">Ver estatus de mi reporte</a>
                        </div>
                        
                    </div>
                    <!-- ── MINI-MAPA EN VIVO ── -->
                    <div class="hero-figure split-item-image split-item-image-fill illustration-element-01 reveal-from-bottom">
                        <div class="hero-map-card">
                            <!-- Card header bar -->
                            <div class="hero-map-header">
                                <div class="hero-map-header-title">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    Mapa en vivo
                                </div>
                                <div class="hero-map-header-right">
                                    <span class="hero-map-header-dot"></span>
                                    <span class="hero-map-header-badge">NEZA</span>
                                </div>
                            </div>
                            <!-- Floating notification pill -->
                            <div class="hero-map-notif">
                                <div class="hero-map-notif-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div>
                                    <div class="hero-map-notif-title">Nuevo reporte</div>
                                    <div class="hero-map-notif-sub">Hace 2 min &middot; Pendiente</div>
                                </div>
                            </div>
                            <!-- Map iframe -->
                            <div class="hero-map-wrap">
                                <iframe
                                    class="hero-map-iframe"
                                    src="https://www.google.com/maps?q=19.4326,-99.1332&hl=es&z=13&output=embed"
                                    loading="lazy"
                                    allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                                <div class="hero-map-tint"></div>
                                <!-- Interaction blocker: map is decorative only -->
                                <a href="#mapa-controles" class="hero-map-blocker smooth-scroll" aria-label="Ver mapa completo">
                                    <span class="hero-map-blocker-hint">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                        Ver mapa completo
                                    </span>
                                </a>
                            </div>
                            <!-- Live footer bar -->
                            <div class="hero-map-footer">
                                <span class="hero-map-live-dot"></span>
                                <span class="hero-map-live-text">En vivo &mdash; <strong id="hm-active">—</strong> reportes activos</span>
                                <a href="#mapa-controles" class="hero-map-view-btn smooth-scroll">
                                    Ver completo
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats strip — loaded from API -->
            <div class="hero-stats-strip">
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="--si:157,27,50">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    </div>
                    <span class="hero-stat-num" id="hs-total">—</span>
                    <span class="hero-stat-label">Total reportes</span>
                    <div class="hero-stat-bar" aria-hidden="true">
                        <div class="hero-stat-bar-fill" id="hs-total-bar" style="width:0%"></div>
                    </div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="--si:5,150,105">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <span class="hero-stat-num" id="hs-resueltos">—</span>
                    <span class="hero-stat-label">Resueltos</span>
                    <div class="hero-stat-bar" aria-hidden="true">
                        <div class="hero-stat-bar-fill" id="hs-resueltos-bar" style="width:0%"></div>
                    </div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="--si:37,99,235">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <span class="hero-stat-num" id="en">—</span>
                    <span class="hero-stat-label">En proceso</span>
                    <div class="hero-stat-bar" aria-hidden="true">
                        <div class="hero-stat-bar-fill" id="hs-en-bar" style="width:0%"></div>
                    </div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="--si:217,119,6">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    </div>
                    <span class="hero-stat-num" id="hs-pending">—</span>
                    <span class="hero-stat-label">Pendientes</span>
                    <div class="hero-stat-bar" aria-hidden="true">
                        <div class="hero-stat-bar-fill" id="hs-pending-bar" style="width:0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="/public/js/hero.js"></script>
