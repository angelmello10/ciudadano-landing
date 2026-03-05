<?php require_once __DIR__ . '/public/includes/head.php'; ?>

<body class="has-animations">
<div class="body-wrap">

    <?php require_once __DIR__ . '/public/includes/header.php'; ?>
    <?php require_once __DIR__ . '/public/includes/hamburger-mobile.php'; ?>

    <main class="site-content">
        <?php require_once __DIR__ . '/public/includes/hero.php'; ?>
        <?php require_once __DIR__ . '/public/includes/features.php'; ?>
        <?php require_once __DIR__ . '/public/includes/mapa.php'; ?>
        <?php require_once __DIR__ . '/public/includes/carrusel.php'; ?>
        <?php require_once __DIR__ . '/public/includes/tabla.php'; ?>
        <?php require_once __DIR__ . '/public/includes/cta.php'; ?>
    </main>

    <?php require_once __DIR__ . '/public/includes/footer.php'; ?>

</div>

<?php require_once __DIR__ . '/public/includes/modals.php'; ?>

<!-- Back to top button -->
<button class="back-to-top" id="back-to-top" aria-label="Volver arriba" title="Volver arriba">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"></polyline>
    </svg>
</button>
<script>
(function(){
    var btn = document.getElementById('back-to-top');
    if(!btn) return;
    var shown = false;
    function check(){
        var shouldShow = window.scrollY > 600;
        if(shouldShow !== shown){
            shown = shouldShow;
            btn.classList.toggle('is-visible', shown);
        }
    }
    window.addEventListener('scroll', check, {passive:true});
    btn.addEventListener('click', function(){
        window.scrollTo({top:0, behavior:'smooth'});
    });
    check();
})();
</script>

</body>
</html>

<!-- Global lightbox placed at end of body to avoid stacking-context issues -->
<style>
    #global-lightbox{position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,0.85);z-index:2147483647}
    #global-lightbox.active{display:flex}
    #global-lightbox .inner{max-width:95vw;max-height:95vh;position:relative}
    #global-lightbox img{display:block;max-width:95vw;max-height:95vh;object-fit:contain;border-radius:12px;box-shadow:0 20px 60px rgba(0,0,0,0.7)}
    #global-lightbox .close{position:absolute;right:-10px;top:-10px;width:40px;height:40px;border-radius:50%;background:rgba(0,0,0,0.6);color:#fff;border:0;cursor:pointer}
    #global-lightbox .caption{margin-top:8px;text-align:center;color:#e6eef8}
</style>
<div id="global-lightbox" aria-hidden="true">
    <div class="inner">
        <button class="close" aria-label="Cerrar">×</button>
        <img id="global-lightbox-img" src="" alt="">
        <div class="caption" id="global-lightbox-caption"></div>
    </div>
</div>
<script>
    (function(){
        const lb = document.getElementById('global-lightbox');
        const img = document.getElementById('global-lightbox-img');
        const cap = document.getElementById('global-lightbox-caption');
        const btn = lb.querySelector('.close');
        function openGlobal(src, caption){ if(!src) return; img.src=src; cap.textContent=caption||''; lb.classList.add('active'); lb.setAttribute('aria-hidden','false'); document.body.style.overflow='hidden'; }
        function closeGlobal(){ lb.classList.remove('active'); lb.setAttribute('aria-hidden','true'); img.src=''; cap.textContent=''; document.body.style.overflow=''; }
        // expose helper names used by modals
        window.openConsultLightbox = openGlobal;
        window.openReportLightbox = openGlobal;
        window.openImageLightbox = openGlobal;
        window.closeImageLightbox = closeGlobal;
        btn.addEventListener('click', closeGlobal);
        lb.addEventListener('click', (e)=>{ if(e.target===lb) closeGlobal(); });
        document.addEventListener('keydown',(e)=>{ if(e.key==='Escape') closeGlobal(); });
    })();
</script>
