<?php
/*
Plugin Name: Portfolio Sections Editor
Description: Edita las secciones del portafolio de forma estructurada
Version: 1.2
Author: Patricio Quintanilla
*/

// Crear menú en el dashboard
function portfolio_sections_menu()
{
    add_menu_page('Portfolio Sections', 'Portfolio Sections', 'manage_options', 'portfolio-sections', 'personal_info_page');
    add_submenu_page('portfolio-sections', 'Información Personal', 'Información Personal', 'manage_options', 'personal-info', 'personal_info_page');
    add_submenu_page('portfolio-sections', 'Estadísticas', 'Estadísticas', 'manage_options', 'statistics', 'statistics_page');
    add_submenu_page('portfolio-sections', 'Habilidades', 'Habilidades', 'manage_options', 'skills', 'skills_page');
}
add_action('admin_menu', 'portfolio_sections_menu');

// Páginas de administración
function personal_info_page()
{
    $personal_info = get_option('portfolio_personal_info', array());
?>
    <div class="wrap">
        <h1>Información Personal</h1>
        <?php settings_errors('portfolio_sections'); ?>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <input type="hidden" name="action" value="save_portfolio_data">
            <input type="hidden" name="section" value="personal_info">
            <table class="form-table">
                <tr>
                    <th><label for="name">Nombre</label></th>
                    <td><input type="text" id="name" name="personal_info[name]" value="<?php echo esc_attr($personal_info['name'] ?? ''); ?>"></td>
                </tr>
                <tr>
                    <th><label for="nationality">Nacionalidad</label></th>
                    <td><input type="text" id="nationality" name="personal_info[nationality]" value="<?php echo esc_attr($personal_info['nationality'] ?? ''); ?>"></td>
                </tr>
                <tr>
                    <th><label for="phone">Teléfono</label></th>
                    <td><input type="text" id="phone" name="personal_info[phone]" value="<?php echo esc_attr($personal_info['phone'] ?? ''); ?>"></td>
                </tr>
                <tr>
                    <th><label for="email">Email</label></th>
                    <td><input type="email" id="email" name="personal_info[email]" value="<?php echo esc_attr($personal_info['email'] ?? ''); ?>"></td>
                </tr>
                <tr>
                    <th><label for="linkedin">LinkedIn</label></th>
                    <td><input type="text" id="linkedin" name="personal_info[linkedin]" value="<?php echo esc_attr($personal_info['linkedin'] ?? ''); ?>"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

function statistics_page()
{
    $statistics = get_option('portfolio_statistics', array());
?>
    <div class="wrap">
        <h1>Estadísticas</h1>
        <?php settings_errors('portfolio_sections'); ?>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <input type="hidden" name="action" value="save_portfolio_data">
            <input type="hidden" name="section" value="statistics">
            <table class="form-table">
                <tr>
                    <th><label for="years_experience">Años de experiencia</label></th>
                    <td><input type="number" id="years_experience" name="statistics[years_experience]" value="<?php echo esc_attr($statistics['years_experience'] ?? ''); ?>"></td>
                </tr>
                <tr>
                    <th><label for="completed_projects">Proyectos completados</label></th>
                    <td><input type="number" id="completed_projects" name="statistics[completed_projects]" value="<?php echo esc_attr($statistics['completed_projects'] ?? ''); ?>"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

function skills_page()
{
    $skills = get_option('portfolio_skills', array());
?>
    <div class="wrap">
        <h1>Habilidades</h1>
        <?php settings_errors('portfolio_sections'); ?>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" id="skills-form">
            <input type="hidden" name="action" value="save_portfolio_data">
            <input type="hidden" name="section" value="skills">
            <table class="form-table" id="skills-table">
                <?php
                if (!empty($skills)) {
                    foreach ($skills as $skill => $percentage) {
                        echo skill_row($skill, $percentage);
                    }
                } else {
                    echo skill_row();
                }
                ?>
            </table>
            <button type="button" id="add-skill" class="button">Añadir Habilidad</button>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
    wp_enqueue_script('jquery');
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#add-skill').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'add_skill_row'
                    },
                    success: function(response) {
                        $('#skills-table').append(response);
                    }
                });
            });

            $(document).on('click', '.remove-skill', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });
        });
    </script>
<?php
}



function skill_row($skill = '', $percentage = '')
{
    ob_start();
?>
    <tr>
        <th><input type="text" name="skills[name][]" value="<?php echo esc_attr($skill); ?>" placeholder="Nombre de la habilidad"></th>
        <td>
            <input type="number" name="skills[percentage][]" value="<?php echo esc_attr($percentage); ?>" min="0" max="100"> %
            <button type="button" class="button remove-skill">Eliminar</button>
        </td>
    </tr>
<?php
    return ob_get_clean();
}


// Guardar datos
function save_portfolio_data()
{
    if (!current_user_can('manage_options')) {
        wp_die('No tienes permiso para realizar esta acción.');
    }

    $section = $_POST['section'];

    switch ($section) {
        case 'personal_info':
            update_option('portfolio_personal_info', $_POST['personal_info']);
            break;
        case 'statistics':
            update_option('portfolio_statistics', $_POST['statistics']);
            break;
        case 'skills':
            $skills = array();
            $names = $_POST['skills']['name'];
            $percentages = $_POST['skills']['percentage'];
            for ($i = 0; $i < count($names); $i++) {
                if (!empty($names[$i]) && !empty($percentages[$i])) {
                    $skills[$names[$i]] = $percentages[$i];
                }
            }
            update_option('portfolio_skills', $skills);
            break;
    }

    add_settings_error('portfolio_sections', 'settings_updated', 'Configuración guardada exitosamente', 'updated');
    set_transient('settings_errors', get_settings_errors(), 30);

    wp_redirect(add_query_arg('settings-updated', 'true', wp_get_referer()));
    exit;
}
add_action('admin_post_save_portfolio_data', 'save_portfolio_data');

// Shortcode para mostrar toda la información
function portfolio_sections_shortcode()
{
    $personal_info = get_option('portfolio_personal_info', array());
    $statistics = get_option('portfolio_statistics', array());
    $skills = get_option('portfolio_skills', array());

    ob_start();
?>
    <section class="main-content revealator-slideup revealator-once revealator-delay1">
        <div class="container">
            <div class="row">
                <!-- Personal Info Starts -->
                <div class="col-12 col-lg-5 col-xl-6">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-uppercase custom-title mb-0 ft-wt-600">Información Personal</h3>
                        </div>
                        <div class="col-12 d-block d-sm-none">
                            <img src="img/patrick-300.jpg" class="img-fluid main-img-mobile" alt="my picture" />
                        </div>
                        <div class="col-6">
                            <ul class="about-list list-unstyled open-sans-font">
                                <li> <span class="title">Nombre :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php echo esc_html($personal_info['name'] ?? ''); ?></span> </li>
                                <li> <span class="title">Nacionalidad :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php echo esc_html($personal_info['nationality'] ?? ''); ?></span> </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="about-list list-unstyled open-sans-font">
                                <li> <span class="title">Fono :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php echo esc_html($personal_info['phone'] ?? ''); ?></span> </li>
                                <li> <span class="title">Email :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php echo esc_html($personal_info['email'] ?? ''); ?></span> </li>
                                <li> <span class="title">Linkedin :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php echo esc_html($personal_info['linkedin'] ?? ''); ?></span> </li>
                            </ul>
                        </div>
                        <div class="col-12 mt-3">
                            <a class="button" href="#">
                                <span class="button-text">Descargar CV</span>
                                <span class="button-icon fa fa-download"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Personal Info Ends -->
                <!-- Boxes Starts -->
                <div class="col-12 col-lg-7 col-xl-6 mt-5 mt-lg-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="box-stats with-margin">
                                <h3 class="poppins-font position-relative"><?php echo esc_html($statistics['years_experience'] ?? ''); ?></h3>
                                <p class="open-sans-font m-0 position-relative text-uppercase">años de <span class="d-block">experiencia</span></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="box-stats with-margin">
                                <h3 class="poppins-font position-relative"><?php echo esc_html($statistics['completed_projects'] ?? ''); ?></h3>
                                <p class="open-sans-font m-0 position-relative text-uppercase">Proyectos <span class="d-block">completados</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Boxes Ends -->
            </div>
            <hr class="separator">
            <!-- Skills Starts -->
            <div class="row">
                <div class="col-12">
                    <h3 class="text-uppercase pb-4 pb-sm-5 mb-3 mb-sm-0 text-left text-sm-center custom-title ft-wt-600">Habilidades</h3>
                </div>
                <?php
                foreach ($skills as $skill => $percentage) {
                ?>
                    <div class="col-6 col-md-3 mb-3 mb-sm-5">
                        <div class="c100 p<?php echo esc_attr($percentage); ?>">
                            <span><?php echo esc_html($percentage); ?>%</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <h6 class="text-uppercase open-sans-font text-center mt-2 mt-sm-4"><?php echo esc_html($skill); ?></h6>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- Skills Ends -->
            <hr class="separator mt-1">
        </div>
    </section>
<?php
    return ob_get_clean();
}

function add_skill_row_callback()
{
    echo skill_row();
    wp_die();
}


add_shortcode('portfolio_sections', 'portfolio_sections_shortcode');
