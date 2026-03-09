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
                document.querySelector('.mob-fab')?.classList.remove('is-open');
                document.querySelector('.mob-menu')?.classList.remove('is-open');
                document.querySelector('.mob-fab')?.style.setProperty('display', 'none');
                document.getElementById('site-header')?.style.setProperty('display', 'none');
                // Auto-solicitar GPS al abrir el formulario de reporte
                if (modal.id === 'modal-report') {
                    setTimeout(() => document.getElementById('get-location')?.click(), 300);
                }
            }
        });
    });

    // Cerrar modal con botón X (y resetear vistas)
    document.querySelectorAll('.modal-close-trigger').forEach(close => {
        close.addEventListener('click', (e) => {
            e.preventDefault();
            close.closest('.modal').classList.remove('is-active');
            document.body.classList.remove('modal-is-active');
            document.querySelector('.mob-fab')?.style.setProperty('display', '');
            document.getElementById('site-header')?.style.setProperty('display', '');
            setTimeout(() => {
                const formReport = document.getElementById('form-report');
                const repSucc = document.getElementById('report-success');
                const statRes = document.getElementById('status-result');
                const formCons = document.getElementById('form-consult');
                if (formReport) formReport.style.display = 'block';
                if (repSucc) repSucc.style.display = 'none';
                if (statRes) statRes.style.display = 'none';
                if (formCons) formCons.style.display = 'block';
            }, 300);
        });
    });

    // Cerrar modal al hacer click en el fondo
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('is-active');
                document.body.classList.remove('modal-is-active');
                document.querySelector('.mob-fab')?.style.setProperty('display', '');
                document.getElementById('site-header')?.style.setProperty('display', '');
            }
        });
    });
});
