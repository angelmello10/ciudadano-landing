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
