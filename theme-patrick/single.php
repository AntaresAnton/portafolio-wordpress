<style>
    li {
        color: fff;
    }

    body.single-post {
        background-color: #1a1a1a;
        color: #f0f0f0;
    }

    .single-post .main-content {
        background-color: #2c2c2c;
        padding: 30px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }

    .single-post h1,
    .single-post h2,
    .single-post h3 {

        color: #72b626 !important;
        background-color: #2c2c2c !important;
    }


    .single-post .meta {
        color: #b0b0b0;
    }

    .single-post .entry-content p {
        color: #d0d0d0;
        line-height: 1.6;
    }

    p {
        color: #fff;
    }

    /* Add more custom styles as needed */
</style>


<?php get_header(); ?>

<body class="blog-post">
    <!-- Header Starts -->
    <?php get_template_part('template-parts/header'); ?>
    <!-- Header Ends -->

    <!-- Page Title Starts -->
    <section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
        <h1><?php the_title(); ?></h1>
        <span class="title-bg"><?php echo wp_trim_words(get_the_title(), 2, ''); ?></span>
    </section>

    <!-- Page Title Ends -->

    <!-- Main Content Starts -->
    <section class="main-content revealator-slideup revealator-once revealator-delay1">
        <div class="container">
            <div class="row">
                <!-- Article Starts -->
                <article class="col-12">
                    <?php while (have_posts()) : the_post(); ?>
                        <!-- Meta Starts -->
                        <div class="meta open-sans-font pb-3">
                            <span class="mr-3"><i class="fa fa-user"></i> <?php the_author(); ?></span>
                            <span class="date mr-3"><i class="fa fa-calendar"></i> <?php the_date(); ?></span>
                            <span><i class="fa fa-tags"></i> <?php the_tags('', ', '); ?></span>
                        </div>
                        <!-- Meta Ends -->

                        <!-- Article Content Starts -->
                        <!-- <h1 class="text-uppercase text-capitalize"><?php the_title(); ?></h1> -->
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => get_the_title())); ?>
                        <?php endif; ?>
                        <div class="blog-excerpt open-sans-font pb-5">
                            <?php the_content(); ?>
                        </div>
                        <!-- Article Content Ends -->
                    <?php endwhile; ?>
                </article>
                <!-- Article Ends -->

                <!-- <?php get_sidebar(); ?> -->
            </div>
        </div>
    </section>
    <!-- Main Content Ends -->

    <?php get_footer(); ?>