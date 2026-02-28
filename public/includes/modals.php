<?php require_once 'modal-report.php'; ?>
<?php require_once 'modal-consult.php'; ?>

<!-- ===== ESTILOS Y JS COMPARTIDOS DE MODALES ===== -->
<style>
    /* ── MODAL SHELL ── */
    .modal-custom-inner {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 48px 96px rgba(0,0,0,0.2), 0 12px 32px rgba(0,0,0,0.08);
        max-width: 540px;
        width: 100%;
        max-height: 92vh;
        display: flex;
        flex-direction: column;
        transform: translateY(32px) scale(0.95);
        opacity: 0;
        transition: transform .5s cubic-bezier(0.16,1,0.3,1), opacity .35s ease;
        margin: auto;
        border: 1px solid rgba(0,0,0,0.06);
    }
    .modal-custom-inner--narrow { max-width: 440px; }
    .modal-custom.is-active .modal-custom-inner {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
    /* Override base .modal overflow:hidden so card isn't clipped */
    .modal-custom { overflow-y: auto !important; }
    .modal-is-active { overflow: hidden; }

    /* ── DARK HEADER ── */
    .modal-custom-header.mh-dark {
        background: linear-gradient(135deg, #0d0f14 0%, #1a0410 50%, #0d0f14 100%);
        padding: 28px 28px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        position: relative;
        flex-shrink: 0;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .modal-custom-header.mh-blue {
        background: linear-gradient(135deg, #0d0f14 0%, #1a0410 50%, #0d0f14 100%);
    }
    .mh-icon-wrap {
        width: 46px; height: 46px; border-radius: 12px; flex-shrink: 0;
        background: linear-gradient(135deg, #9D1B32 0%, #6e1122 100%);
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 6px 20px rgba(157,27,50,0.4);
    }
    .mh-blue .mh-icon-wrap {
        background: linear-gradient(135deg, #334155 0%, #1e293b 100%);
        box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    }
    .mh-text { flex: 1; min-width: 0; }
    .modal-custom-title {
        margin: 0 0 6px;
        font-family: 'Space Grotesk', 'Inter', system-ui, sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.25;
        letter-spacing: -0.02em;
    }
    .modal-custom-subtitle {
        margin: 0;
        font-size: 0.82rem;
        color: rgba(255,255,255,0.55);
        line-height: 1.55;
    }
    .modal-custom-close {
        position: absolute;
        top: 20px; right: 20px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 50%;
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: rgba(255,255,255,0.6);
        transition: background .2s, color .2s, transform .2s;
    }
    .modal-custom-close:hover {
        background: rgba(255,255,255,0.15);
        color: #fff;
        transform: rotate(90deg);
    }

    /* ── BODY ── */
    .modal-custom-body {
        padding: 28px 28px 32px;
        overflow-y: auto;
        flex: 1 1 auto;
        min-height: 0; /* critical: lets flex child shrink so scroll activates */
        scrollbar-width: thin;
        scrollbar-color: #9D1B32 rgba(157,27,50,0.06);
    }
    .modal-custom-body::-webkit-scrollbar { width: 5px; }
    .modal-custom-body::-webkit-scrollbar-track { background: transparent; }
    .modal-custom-body::-webkit-scrollbar-thumb { background: #9D1B32; border-radius: 99px; }

    /* ── FORM ── */
    .mf-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .modal-form-group {
        margin-bottom: 20px;
        display: flex; flex-direction: column; width: 100%;
    }
    .form-label-custom {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.78rem; font-weight: 700; color: #374151;
        margin-bottom: 8px; letter-spacing: 0.01em;
    }
    .form-label-custom svg { opacity: .55; flex-shrink: 0; }
    .optional-tag {
        font-weight: 500; color: #94a3b8; font-size: 0.68rem;
        background: #f1f5f9; padding: 2px 6px; border-radius: 4px; margin-left: 4px;
    }
    .form-input-custom {
        width: 100%; background: #f8fafc;
        border: 1.5px solid #e2e8f0; border-radius: 10px;
        color: #0f172a; font-size: 0.9rem; padding: 11px 14px;
        transition: border-color .2s, box-shadow .2s, background .2s;
        font-family: inherit;
    }
    .form-input-custom:focus {
        outline: none; border-color: #9D1B32;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(157,27,50,0.12);
    }
    .form-input-custom::placeholder { color: #94a3b8; font-size: 0.875rem; }
    .form-input-big {
        font-size: 1.5rem !important; font-weight: 800 !important;
        text-align: center; letter-spacing: 0.05em;
        padding: 16px !important;
    }
    select.form-input-custom { cursor: pointer; }
    textarea.form-input-custom { resize: vertical; min-height: 80px; }

    /* File drop zone */
    .mf-file-drop {
        display: flex; align-items: center; gap: 10px;
        width: 100%; border: 1.5px dashed #cbd5e1; border-radius: 10px;
        padding: 14px 16px; cursor: pointer; position: relative;
        background: #f8fafc; font-size: 0.83rem; color: #64748b;
        transition: border-color .2s, background .2s;
    }
    .mf-file-drop:hover { border-color: #9D1B32; background: rgba(157,27,50,0.03); }
    .mf-file-drop u { color: #9D1B32; }

    /* Geo button */
    .input-with-btn { display: flex; gap: 8px; }
    .input-with-btn .form-input-custom { flex: 1; }
    .btn-geo {
        background: #f1f5f9; border: 1.5px solid #e2e8f0; border-radius: 10px;
        color: #475569; padding: 0 14px; cursor: pointer;
        display: flex; align-items: center; gap: 6px;
        transition: background .2s, border-color .2s; flex-shrink: 0;
        font-size: 0.75rem; font-weight: 700;
    }
    .btn-geo:hover { background: #e2e8f0; border-color: #94a3b8; color: #0f172a; }
    .field-hint { display: block; font-size: 0.72rem; color: #64748b; margin-top: 5px; }

    /* Submit button */
    .btn-submit-modal {
        width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px;
        background: linear-gradient(135deg, #9D1B32 0%, #c42845 100%);
        color: #fff; border: none; border-radius: 12px;
        padding: 15px 24px; font-size: 0.95rem; font-weight: 800;
        cursor: pointer; margin-top: 6px;
        box-shadow: 0 6px 20px rgba(157,27,50,0.3);
        transition: transform .2s, box-shadow .2s;
        font-family: inherit; letter-spacing: 0.01em;
    }
    .btn-submit-modal:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(157,27,50,0.4); }
    .btn-submit-modal:active { transform: translateY(0); }
    .btn-submit-modal:disabled { opacity: .65; pointer-events: none; }
    .btn-map-action {
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
        box-shadow: 0 6px 20px rgba(37,99,235,0.3);
    }
    .btn-map-action:hover { box-shadow: 0 10px 28px rgba(37,99,235,0.4); }

    /* ── SUCCESS STATE ── */
    .modal-success { text-align: center; padding: 20px 8px 8px; }
    .modal-success-ring {
        display: flex; justify-content: center; margin-bottom: 18px;
        animation: success-pop .5s cubic-bezier(0.34,1.56,0.64,1) both;
    }
    @keyframes success-pop {
        from { transform: scale(0.5); opacity: 0; }
        to   { transform: scale(1);   opacity: 1; }
    }
    .modal-success-title { font-size: 1.4rem; font-weight: 900; color: #0f172a; margin: 0 0 8px; letter-spacing: -0.03em; }
    .modal-success-text  { font-size: 0.88rem; color: #64748b; margin: 0 0 14px; }
    .modal-folio-badge {
        display: inline-block; background: #fff;
        color: #0f172a; border-radius: 12px; padding: 12px 28px;
        font-size: 1.5rem; font-weight: 900; letter-spacing: 0.06em;
        border: 1.5px solid #e2e8f0; border-left: 6px solid #9D1B32;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06); margin-bottom: 14px;
    }
    .modal-success-hint { font-size: 0.78rem; color: #94a3b8; margin: 0 0 20px; line-height: 1.6; }
    .modal-success-btn {
        display: inline-flex; align-items: center; justify-content: center;
        background: #f1f5f9; border: none; border-radius: 99px;
        padding: 10px 28px; font-size: 0.85rem; font-weight: 700;
        cursor: pointer; color: #475569; transition: background .2s, color .2s;
        font-family: inherit;
    }
    .modal-success-btn:hover { background: #e2e8f0; color: #0f172a; }

    /* ── CONSULT RESULT ── */
    .status-result-card {
        background: #fff; border-radius: 16px;
        border: 1.5px solid #e2e8f0; border-left: 6px solid #9D1B32;
        padding: 24px; margin-top: 4px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        animation: slide-up .4s cubic-bezier(0.16,1,0.3,1) both;
    }
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .status-result-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
    .status-result-label { font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #94a3b8; }
    .status-result-pill {
        background: #9D1B32; color: #fff;
        font-size: 0.68rem; font-weight: 800; text-transform: uppercase;
        padding: 5px 12px; border-radius: 99px; letter-spacing: 0.06em;
    }
    .status-result-type {
        font-size: 1.2rem; font-weight: 900; color: #0f172a;
        margin: 10px 0 14px; letter-spacing: -0.03em;
    }
    .status-meta-rows { display: flex; flex-direction: column; gap: 6px; margin-bottom: 4px; }
    .status-meta-row { font-size: 0.83rem; color: #475569; margin: 0; }
    .status-result-divider { height: 1px; background: #f1f5f9; margin: 16px 0 14px; }
    .status-result-update { font-size: 0.83rem; color: #334155; margin: 0; line-height: 1.7; }
    .consult-back-btn {
        display: block; width: 100%; margin-top: 12px; text-align: center;
        background: none; border: none; cursor: pointer;
        font-size: 0.8rem; font-weight: 600; color: #64748b;
        padding: 8px; transition: color .2s; font-family: inherit;
    }
    .consult-back-btn:hover { color: #9D1B32; }

    /* ── LEGACY HELPERS ── */
    .form-input { width: 100%; background: #F3F5F8; border: 1px solid #E7ECF2; border-radius: 4px; color: #101D2D; font-size: 16px; padding: 12px 16px; transition: border-color .15s; }
    .form-input:focus { outline: none; border-color: #9D1B32; }
    .tt-u { text-transform: uppercase; }
    .space-between { display: flex; justify-content: space-between; align-items: center; }
    .p-16 { padding: 16px; }

    /* Mobile */
    @media (max-width: 480px) {
        .mf-row { grid-template-columns: 1fr; }
        .modal-custom-inner { border-radius: 18px; }
        .modal-custom-header.mh-dark { padding: 22px 20px 18px; }
        .modal-custom-body { padding: 18px 18px 22px; }
    }
</style>

<script src="/public/js/main.min.js"></script>
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


