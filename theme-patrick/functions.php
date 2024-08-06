 
<?php
function theme_enqueue_styles()
{
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,400,400i,600,600i,700');
  wp_enqueue_style('fm-revealator', get_template_directory_uri() . '/assets/css/fm.revealator.jquery.min.css', array(), null, 100);
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
  wp_enqueue_style('preloader', get_template_directory_uri() . '/assets/css/preloader.min.css');
  wp_enqueue_style('circle', get_template_directory_uri() . '/assets/css/circle.css');
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');

  // wp_enqueue_style('fm-revealator', get_template_directory_uri() . '/assets/css/fm.revealator.jquery.min.css');
  wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css');
  wp_enqueue_style('skin-green', get_template_directory_uri() . '/assets/css/skins/green.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_scripts()
{
  wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.js', array(), null, false);
  wp_enqueue_script('jquery');
  wp_enqueue_script('preloader', get_template_directory_uri() . '/assets/js/preloader.min.js', array('jquery'), null, true);
  wp_enqueue_script('fm-revealator', get_template_directory_uri() . '/assets/js/fm.revealator.jquery.min.js', array('jquery'), null, true);
  wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array('jquery'), null, true);
  wp_enqueue_script('masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array('jquery'), null, true);
  wp_enqueue_script('classie', get_template_directory_uri() . '/assets/js/classie.js', array(), null, true);
  wp_enqueue_script('cbpGridGallery', get_template_directory_uri() . '/assets/js/cbpGridGallery.js', array(), null, true);
  wp_enqueue_script('jquery-hoverdir', get_template_directory_uri() . '/assets/js/jquery.hoverdir.js', array('jquery'), null, true);
  wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), null, true);
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), null, true);
  wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


function register_my_menus()
{
  register_nav_menus(
    array(
      'header-menu' => __('Header Menu'),
      'mobile-menu' => __('Mobile Menu')
    )
  );
}
add_action('init', 'register_my_menus');


class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    $icon_class = '';
    switch ($item->title) {
      case 'Inicio':
        $icon_class = 'fa-home';
        break;
      case 'Acerca':
        $icon_class = 'fa-user';
        break;
      case 'Portafolio':
        $icon_class = 'fa-briefcase';
        break;
      case 'Contacto':
        $icon_class = 'fa-envelope-open';
        break;
        // Añade más casos según sea necesario
    }
    $output .= "<li class='icon-box" . ($item->current ? ' active' : '') . "'>";
    $output .= "<i class='fa " . $icon_class . "'></i>";
    $output .= "<a href='" . $item->url . "'><h2>" . $item->title . "</h2></a>";
  }
}

class Custom_Walker_Mobile_Nav_Menu extends Walker_Nav_Menu
{
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    $icon_class = '';
    switch ($item->title) {
      case 'Inicio':
        $icon_class = 'fa-home';
        break;
      case 'Acerca':
        $icon_class = 'fa-user';
        break;
      case 'Portafolio':
        $icon_class = 'fa-briefcase';
        break;
      case 'Contacto':
        $icon_class = 'fa-envelope-open';
        break;
        // Añade más casos según sea necesario
    }
    $output .= "<li class='icon-box" . ($item->current ? ' active' : '') . "'>";
    $output .= "<i class='fa " . $icon_class . "'></i>";
    $output .= "<a href='" . $item->url . "'><h2>" . $item->title . "</h2></a>";
  }
}

function theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
  add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'theme_setup');

function theme_widgets_init()
{
  register_sidebar(array(
    'name'          => __('Sidebar', 'your-theme-textdomain'),
    'id'            => 'sidebar-1',
    'description'   => __('Add widgets here to appear in your sidebar.', 'your-theme-textdomain'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}
add_action('widgets_init', 'theme_widgets_init');

function load_template_part($template_name)
{
  if (locate_template($template_name . '.php')) {
    get_template_part($template_name);
  } else {
    get_template_part('template-parts/' . $template_name);
  }
}

if (!isset($content_width)) {
  $content_width = 1140;
}

function add_sidebar_message_option()
{
  add_option('sidebar_custom_message', 'Welcome to my blog!');
}
add_action('admin_init', 'add_sidebar_message_option');

function sidebar_message_setting()
{
  register_setting('general', 'sidebar_custom_message');
  add_settings_field('sidebar_custom_message', 'Sidebar Custom Message', 'sidebar_message_callback', 'general');
}
add_action('admin_init', 'sidebar_message_setting');

function sidebar_message_callback()
{
  $message = get_option('sidebar_custom_message');
  echo "<textarea name='sidebar_custom_message' rows='5' cols='50'>" . esc_textarea($message) . "</textarea>";
}
