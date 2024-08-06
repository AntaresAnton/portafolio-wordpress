<?php
/*
Template Name: Acerca de
*/

get_header();
?>

<body class="about">
    <header class="header" id="navbar-collapse-toggle">
        <?php include('includes/menu.php'); ?>
    </header>

    <!-- Page Title Starts -->
    <section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
        <h1>Acerca <span>de</span></h1>
        <span class="title-bg">Acerca de</span>
    </section>
    <!-- Page Title Ends -->

    <!-- Main Content Starts -->
    <section class="main-content revealator-slideup revealator-once revealator-delay1">
        <?php echo do_shortcode('[portfolio_sections]'); ?>
    </section>
    <!-- Main Content Ends -->

    <?php get_footer(); ?>