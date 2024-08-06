<?php
/*
Plugin Name: My Portfolio Plugin
Description: Añade proyectos personales a tu sitio web.
Version: 1.0
Author: Patricio Quintanilla
*/

function create_portfolio_post_type()
{
    register_post_type(
        'portfolio_item',
        array(
            'labels' => array(
                'name' => __('Portfolio Items'),
                'singular_name' => __('Portfolio Item')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
        )
    );
}
add_action('init', 'create_portfolio_post_type');


function portfolio_shortcode($atts)
{
    $args = array(
        'post_type' => 'portfolio_item',
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);

    $output = '<div class="portfolio-grid container">';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $project_url = get_permalink();
            $output .= '<div class="portfolio-item">';
            $output .= '<div class="portfolio-item-inner">';
            $output .= '<a href="' . esc_url($project_url) . '" class="project-link">';
            $output .= '<div class="portfolio-item-image">' . get_the_post_thumbnail(null, 'medium') . '</div>';
            $output .= '<h3 class="portfolio-item-title text-center pb-2 px-2 mb-2 font-weight-bold t-portfolio">' . get_the_title() . ' <i class="fa fa-chevron-down"></i></h3>';
            $output .= '</a>';
            $output .= '<div class="portfolio-item-details">';

            $clients = wp_get_object_terms(get_the_ID(), 'client');
            if (!empty($clients)) {
                $output .= '<p><i class="t-portfolio fa fa-user pr-2"></i><strong>Cliente:</strong> ' . $clients[0]->name . '</p>';
            }

            $technologies = wp_get_object_terms(get_the_ID(), 'technology');
            if (!empty($technologies)) {
                $output .= '<p><i class="t-portfolio fa fa-cogs pr-2"></i><strong>Tecnologías Utilizadas:</strong> ';
                $tech_names = array_map(function ($tech) {
                    return $tech->name;
                }, $technologies);
                $output .= implode(', ', $tech_names);
                $output .= '</p>';
            }

            $output .= '<p><i class="t-portfolio fa fa-globe pr-2"></i><strong>Sitio Web:</strong> <a href="' . esc_url(get_post_meta(get_the_ID(), '_website', true)) . '" target="_blank">' . get_post_meta(get_the_ID(), '_website', true) . '</a></p>';

            $start_date = get_post_meta(get_the_ID(), '_start_date', true);
            $end_date = get_post_meta(get_the_ID(), '_end_date', true);

            if ($start_date) {
                $start_date_formatted = date_i18n('F Y', strtotime($start_date));
                $output .= '<p><i class="t-portfolio fa fa-calendar pr-2"></i><strong>Fecha de Inicio:</strong> ' . $start_date_formatted . '</p>';
            }

            if ($end_date) {
                $end_date_formatted = date_i18n('F Y', strtotime($end_date));
                $output .= '<p><i class="t-portfolio fa fa-calendar-check pr-2"></i><strong>Fecha de Término:</strong> ' . $end_date_formatted . '</p>';
            }

            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
    }


    // Add JavaScript for accordion functionality
    $output .= '<script>
    jQuery(document).ready(function($) {
        $(".project-link").click(function(e) {
            e.preventDefault();
            $(this).siblings(".portfolio-item-details").slideToggle();
        });
    });
</script>';


    wp_reset_postdata();

    // JavaScript for accordion functionality remains unchanged

    return $output;
}
add_shortcode('my_portfolio', 'portfolio_shortcode');


add_shortcode('my_portfolio', 'portfolio_shortcode');
function add_portfolio_meta_boxes()
{
    add_meta_box('portfolio_details', 'Project Details', 'portfolio_details_callback', 'portfolio_item', 'normal', 'default');
}
add_action('add_meta_boxes', 'add_portfolio_meta_boxes');

function portfolio_details_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'portfolio_details_nonce');
    $website = get_post_meta($post->ID, '_website', true);
    $start_date = get_post_meta($post->ID, '_start_date', true);
    $end_date = get_post_meta($post->ID, '_end_date', true);

    echo '<p><label for="client">Cliente: </label>';
    $clients = get_terms(array(
        'taxonomy' => 'client',
        'hide_empty' => false,
    ));
    $post_client = wp_get_object_terms($post->ID, 'client', array('fields' => 'ids'));
    echo '<select name="client">';
    echo '<option value="">Seleccionar Cliente</option>';
    foreach ($clients as $client) {
        echo '<option value="' . $client->term_id . '"' . (in_array($client->term_id, $post_client) ? ' selected' : '') . '>' . $client->name . '</option>';
    }
    echo '</select></p>';

    echo '<p><label for="website">Sitio Web: </label>';
    echo '<input type="url" name="website" value="' . esc_url($website) . '"></p>';

    echo '<p><label for="start_date">Fecha de Inicio: </label>';
    echo '<input type="date" name="start_date" value="' . esc_attr($start_date) . '"></p>';

    echo '<p><label for="end_date">Fecha de Término: </label>';
    echo '<input type="date" name="end_date" value="' . esc_attr($end_date) . '"></p>';
}


function save_portfolio_details($post_id)
{
    if (!isset($_POST['portfolio_details_nonce']) || !wp_verify_nonce($_POST['portfolio_details_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    $fields = ['website', 'start_date', 'end_date'];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }

    if (isset($_POST['technologies'])) {
        $tech_names = array_map('get_term', $_POST['technologies']);
        $tech_names = array_map(function ($term) {
            return $term->name;
        }, $tech_names);
        wp_set_object_terms($post_id, $tech_names, 'technology');
    }

    if (isset($_POST['client'])) {
        $client_term = get_term($_POST['client'], 'client');
        if ($client_term && !is_wp_error($client_term)) {
            wp_set_object_terms($post_id, $client_term->name, 'client');
        }
    }
}



add_action('save_post', 'save_portfolio_details');

function create_technology_taxonomy()
{
    register_taxonomy(
        'technology',
        'portfolio_item',
        array(
            'label' => __('Technologies'),
            'rewrite' => array('slug' => 'technology'),
            'hierarchical' => false,
        )
    );
}
add_action('init', 'create_technology_taxonomy', 0);


function create_client_taxonomy()
{
    register_taxonomy(
        'client',
        'portfolio_item',
        array(
            'label' => __('Clients'),
            'rewrite' => array('slug' => 'client'),
            'hierarchical' => false,
        )
    );
}
add_action('init', 'create_client_taxonomy', 0);
