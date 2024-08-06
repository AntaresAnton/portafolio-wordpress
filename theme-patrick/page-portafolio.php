<?php
/*
Template Name: Portafolio
*/

get_header();
?>

<section class="title-section text-left text-sm-center pb-3 pt-3 revealator-slideup revealator-once revealator-delay1">
    <h1>Mi <span>Portafolio</span></h1>
    <span class="title-bg">Portafolio</span>
    <br>
    <!-- <a class="button" href="<?php echo esc_url(home_url('/')); ?>">
        <span class="button-text">Volver al inicio</span>
        <span class="button-icon fa fa-arrow-right"></span>
    </a> -->
</section>

<?php echo do_shortcode('[my_portfolio]'); ?>

<div class="espacio pb-3 mb-3"></div>
<?php
get_footer();
?>