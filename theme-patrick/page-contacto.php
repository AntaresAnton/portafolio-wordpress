<?php
/*
Template Name: Contact Page
*/

get_header();
?>

<!-- Page Title Starts -->
<section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
    <h1>con<span>tacto</span></h1>
    <span class="title-bg">contacto</span>
</section>
<!-- Page Title Ends -->

<!-- Main Content Starts -->
<section class="main-content revealator-slideup revealator-once revealator-delay1">
    <div class="container">
        <div class="row">
            <!-- Left Side Starts -->
            <div class="col-12 col-lg-4">
                <h3 class="text-uppercase custom-title mb-0 ft-wt-600 pb-3">¿HABLEMOS?</h3>
                <p class="open-sans-font mb-3">Si tienes alguna sugerencia, proyecto o sólo quieres saludar... completa el formulario a continuación y te responderé a la brevedad.</p>
                <p class="open-sans-font custom-span-contact">

                    <span class="d-block"><i class="fa fa-envelope-open "> </i> Correo</span>patricio@pquintanilla.cl
                </p>
                <p class="open-sans-font custom-span-contact">

                    <span class="d-block"><i class="fa fa-phone-square"></i> Fono:</span>+56972386800
                </p>
                <!-- Social media links can be added here if needed -->
            </div>
            <!-- Left Side Ends -->
            <!-- Contact Form Starts -->
            <div class="col-12 col-lg-8">

                <?php echo do_shortcode('[contact-form-7 id="ee14ee5" title="Formulario de contacto 1"]'); ?>

                </form>
            </div>
            <!-- Contact Form Ends -->
        </div>
    </div>
</section>
<!-- Main Content Ends -->

<?php get_footer(); ?>