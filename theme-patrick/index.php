<?php get_header(); ?>

<!-- Main Content Starts -->
<section class="container-fluid main-container container-home p-0 revealator-slideup revealator-once revealator-delay1">
    <div class="color-block d-none d-lg-block"></div>
    <div class="row home-details-container align-items-center">
        <div class="col-lg-4 bg position-fixed d-none d-lg-block"></div>
        <div class="col-12 col-lg-8 offset-lg-4 home-details text-left text-sm-center text-lg-left">
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/patrick-300.jpg" class="img-fluid main-img-mobile d-none d-sm-block d-lg-none" alt="<?php echo get_theme_mod('main_image_alt', 'my picture'); ?>" />

                <h1 class="text-uppercase poppins-font">Patricio Quintanilla<span class="display-6">Diseñador gráfico | web</span></h1>
                <p class="open-sans-font">Hola, soy Patricio, estudiante de informática y diseñador gráfico/web. Actualmente, me desempeño en proyectos de diseño web con Wordpress y Ecommerce, mientras exploro el mundo de JumpSeller, Python, SQL y JS. Me encanta crear proyectos web desde cero y tengo conocimientos intermedios en Office, Bsale, HTML, CSS y herramientas de diseño. Además, soy un gran fan de <span class="verde">Bootstrap.</span></p>
                <div class="center-mobile text-center">
                    <a class="button mb-2 mx-1" href="<?php echo get_permalink(get_page_by_path('acerca-de')); ?>">
                        <span class="button-text">Más info :)</span>
                        <span class="button-icon fa fa-arrow-right"></span>
                    </a>
                    <a class="button mx-1" href="<?php echo get_permalink(get_page_by_path('portafolio')); ?>">
                        <span class="button-text">Portafolio</span>
                        <span class="button-icon fa fa-folder-open"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main Content Ends -->

<?php get_footer(); ?>