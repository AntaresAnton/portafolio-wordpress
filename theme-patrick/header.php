 <!DOCTYPE html>
 <html <?php language_attributes(); ?>>

 <head>
     <meta charset="<?php bloginfo('charset'); ?>">
     <title><?php wp_title('|', true, 'right'); ?></title>
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <?php wp_head(); ?>
 </head>

 <body <?php body_class(); ?>>
     <!-- Header Starts -->
     <header class="header" id="navbar-collapse-toggle">
         <!-- Fixed Navigation Starts -->
         <ul class="icon-menu d-none d-lg-block revealator-slideup revealator-once revealator-delay1">
             <?php
                wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'walker' => new Custom_Walker_Nav_Menu()
                ));
                ?>
         </ul>
         <!-- Fixed Navigation Ends -->
         <!-- Mobile Menu Starts -->
         <nav role="navigation" class="d-block d-lg-none">
             <div id="menuToggle">
                 <input type="checkbox" />
                 <span></span>
                 <span></span>
                 <span></span>
                 <ul class="list-unstyled" id="menu">
                     <?php
                        wp_nav_menu(array(
                            'theme_location' => 'mobile-menu',
                            'container' => false,
                            'items_wrap' => '%3$s',
                            'walker' => new Custom_Walker_Mobile_Nav_Menu()
                        ));
                        ?>
                 </ul>
             </div>
         </nav>
         <!-- Mobile Menu Ends -->
     </header>
     <!-- Header Ends -->