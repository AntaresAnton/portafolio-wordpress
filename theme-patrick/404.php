<?php get_header(); ?>

<section class="container-fluid main-container container-404 p-0 revealator-slideup revealator-once revealator-delay1 d-flex align-items-center justify-content-center min-vh-100">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 text-center">
            <div>
                <h1 class="text-uppercase poppins-font">404
                    <hr><span class="display-6">Página no encontrada</span>
                </h1>
                <p class="open-sans-font">Lo sentimos, la página que estás buscando no existe o ha sido movida. Pero no te preocupes, aún hay mucho que explorar en mi sitio.</p>
                <div class="mt-4">
                    <a class="button mb-2 mx-2" href="<?php echo home_url(); ?>">
                        <span class="button-text">Volver al inicio</span>
                        <span class="button-icon fa fa-home"></span>
                    </a>
                    <a class="button mb-2 mx-2" href="<?php echo home_url('/portafolio'); ?>">
                        <span class="button-text">Ver portafolio</span>
                        <span class="button-icon fa fa-folder-open"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>