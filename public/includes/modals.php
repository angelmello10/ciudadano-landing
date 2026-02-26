<?php require_once 'modal-report.php'; ?>
<?php require_once 'modal-consult.php'; ?>

<!-- ===== ESTILOS Y JS COMPARTIDOS DE MODALES ===== -->
<style>
    /* ===== MODAL CUSTOM STYLES ===== */
    .modal-custom-inner {
        background: #ffffff;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 40px 80px rgba(0,0,0,0.15), 0 10px 30px rgba(0,0,0,0.05);
        max-width: 520px;
        width: 100%;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        transform: translateY(30px) scale(0.96);
        opacity: 0;
        transition: transform .45s cubic-bezier(0.16,1,0.3,1), opacity .3s ease;
        margin: auto;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .modal-custom.is-active .modal-custom-inner {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
    .modal-custom-header {
        background: #ffffff;
        padding: 36px 36px 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        border-bottom: 2px solid #f8fafc;
        flex-shrink: 0;
    }
    .modal-custom-header-icon {
        background: rgba(157,27,50,0.1);
        color: #9D1B32;
        border-radius: 12px;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .modal-custom-header-icon svg { stroke: #9D1B32; }
    .modal-custom-title {
        margin: 0 0 6px;
        font-size: 26px;
        font-weight: 900;
        color: #0f172a;
        line-height: 1.1;
        letter-spacing: -0.03em;
    }
    .modal-custom-subtitle {
        margin: 0;
        font-size: 15px;
        color: #64748b;
        line-height: 1.6;
    }
    .modal-custom-close {
        position: absolute;
        top: 24px;
        right: 24px;
        background: #f8fafc;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #64748b;
        transition: all .2s;
    }
    .modal-custom-close:hover {
        background: #e2e8f0;
        color: #0f172a;
        transform: rotate(90deg);
    }
    .modal-custom-body {
        padding: 24px 30px 30px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        flex: 1 1 auto;
        max-height: calc(90vh - 140px);
    }
    .modal-is-active { overflow: hidden; height: 100%; }
    /* Scrollbar guinda */
    .modal-custom-body {
        scrollbar-width: thin;
        scrollbar-color: #9D1B32 rgba(157,27,50,0.08);
    }
    .modal-custom-body::-webkit-scrollbar { width: 8px; }
    .modal-custom-body::-webkit-scrollbar-track { background: rgba(157,27,50,0.06); border-radius: 999px; }
    .modal-custom-body::-webkit-scrollbar-thumb { background-color: #9D1B32; border-radius: 999px; box-shadow: inset 0 0 0 2px rgba(255,255,255,0.06); }
    .modal-custom-body::-webkit-scrollbar-thumb:hover { background-color: #7d1528; }
    /* Form */
    .modal-form-group { margin-bottom: 24px; display: flex; flex-direction: column; align-items: flex-start; width: 100%; }
    .form-label-custom { display: inline-flex; align-items: center; font-size: 14px; font-weight: 800; color: #0f172a; margin-bottom: 10px; width: 100%; text-align: left; line-height: 1.4; }
    .optional-tag { font-weight: 500; color: #94a3b8; font-size: 11px; background: #f1f5f9; padding: 2px 6px; border-radius: 4px; margin-left: 6px; }
    .form-input-custom { width: 100%; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; color: #0f172a; font-size: 15px; padding: 12px 16px; transition: all .2s; box-shadow: 0 1px 2px rgba(0,0,0,0.02) inset; }
    .form-input-custom:focus { outline: none; border-color: #9D1B32; box-shadow: 0 0 0 4px rgba(157,27,50,0.1); background: #fff; }
    .form-input-custom::placeholder { color: #94a3b8; }
    .form-file { padding: 10px 14px; cursor: pointer; background: #f8fafc; }
    .input-with-btn { display: flex; gap: 10px; }
    .input-with-btn .form-input-custom { flex: 1; }
    .btn-geo { background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 10px; color: #475569; padding: 0 16px; cursor: pointer; display: flex; align-items: center; transition: all .2s; flex-shrink: 0; }
    .btn-geo:hover { background: #e2e8f0; color: #0f172a; border-color: #94a3b8; }
    .field-hint { display: block; font-size: 12px; color: #64748b; margin-top: 6px; }
    .btn-submit-modal { width: 100%; background: linear-gradient(135deg, #9D1B32 0%, #7d1528 100%); color: #fff; border: none; border-radius: 10px; padding: 16px 24px; font-size: 16px; font-weight: 800; cursor: pointer; transition: all .2s; margin-top: 10px; box-shadow: 0 4px 12px rgba(157,27,50,0.25); }
    .btn-submit-modal:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(157,27,50,0.35); }
    .btn-submit-modal:active { transform: translateY(0); }
    /* Success */
    .modal-success { text-align: center; padding: 16px 0 8px; }
    .modal-success-icon { display: flex; justify-content: center; margin-bottom: 20px; }
    .modal-success-title { font-size: 24px; font-weight: 800; color: #0f172a; margin: 0 0 10px; }
    .modal-success-text { font-size: 15px; color: #64748b; margin: 0 0 16px; }
    .modal-folio-badge { display: inline-block; background: #f8fafc; color: #0f172a; border-radius: 12px; padding: 12px 28px; font-size: 22px; font-weight: 900; letter-spacing: 0.05em; margin-bottom: 16px; border: 1px solid #e2e8f0; border-left: 6px solid #10b981; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .modal-success-hint { font-size: 13px; color: #9ca3af; margin: 0; }
    /* Consult result */
    .status-result-card { background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; border-left: 8px solid #9D1B32; padding: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.05), 0 2px 10px rgba(0,0,0,0.02); transition: transform 0.4s cubic-bezier(0.16,1,0.3,1), box-shadow 0.4s ease; }
    .status-result-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.06); transform: translateY(-2px); }
    .status-result-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
    .status-result-label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; }
    .status-result-pill { background: #9D1B32; color: #fff; font-size: 12px; font-weight: 900; text-transform: uppercase; padding: 6px 14px; border-radius: 30px; letter-spacing: 0.06em; box-shadow: 0 4px 12px rgba(157,27,50,0.2); }
    .status-result-type { font-size: 24px; font-weight: 900; color: #0f172a; margin: 16px 0 20px; letter-spacing: -0.04em; }
    .status-result-date { font-size: 15px; color: #475569; margin: 0 0 20px; }
    .status-result-divider { height: 2px; background: #f1f5f9; margin: 24px 0 20px; width: 100%; }
    .status-result-update { font-size: 15px; color: #334155; margin: 0; line-height: 1.7; }
    /* Legacy helpers */
    .form-input { width: 100%; background-color: #F3F5F8; border: 1px solid #E7ECF2; border-radius: 4px; color: #101D2D; font-size: 16px; padding: 12px 16px; transition: border-color .15s ease-in-out; }
    .form-input:focus { outline: none; border-color: #9D1B32; }
    .form-label { display: block; color: #627183; }
    .tt-u { text-transform: uppercase; }
    .space-between { display: flex; justify-content: space-between; align-items: center; }
    .p-16 { padding: 16px; }
</style>

<script src="js/main.min.js"></script>
<script src="js/main.min.js"></script>
<script>
    // ── Lógica compartida: abrir modales, cerrar y click en fondo ──
    document.addEventListener('DOMContentLoaded', () => {
        // Abrir modal
        document.querySelectorAll('.modal-trigger').forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const modal = document.getElementById(trigger.getAttribute('aria-controls'));
                if (modal) {
                    modal.classList.add('is-active');
                    document.body.classList.add('modal-is-active');
                }
            });
        });

        // Cerrar modal con botón X (y resetear vistas)
        document.querySelectorAll('.modal-close-trigger').forEach(close => {
            close.addEventListener('click', (e) => {
                e.preventDefault();
                close.closest('.modal').classList.remove('is-active');
                document.body.classList.remove('modal-is-active');
                setTimeout(() => {
                    document.getElementById('form-report').style.display    = 'block';
                    document.getElementById('report-success').style.display  = 'none';
                    document.getElementById('status-result').style.display   = 'none';
                    document.getElementById('form-consult').style.display    = 'block';
                }, 300);
            });
        });

        // Cerrar modal al hacer click en el fondo
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('is-active');
                    document.body.classList.remove('modal-is-active');
                }
            });
        });
    });
</script>


