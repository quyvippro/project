<?php

// -- Include css,js files for Front-End
if ( ! function_exists('gs_youtubegalleries_enqueue_front_scripts') ) {
    function gs_youtubegalleries_enqueue_front_scripts() {

        if (!is_admin()) {
            $media = 'all';

            wp_register_style('gs-ytgalleries-bootstrap-css', GSYOUTUBEGALLERIES_FILES_URI . '/assets/css/gs_youtubegalleries_custom_bootstrap.css','', GSYOUTUBEGALLERIES_VERSION , $media );
            wp_enqueue_style('gs-ytgalleries-bootstrap-css');

            wp_register_style('gs-youtubegalleries-custom-css', GSYOUTUBEGALLERIES_FILES_URI . '/assets/css/gs_youtubegalleries_custom.css','', GSYOUTUBEGALLERIES_VERSION , $media );
            wp_enqueue_style('gs-youtubegalleries-custom-css');
        }
    }
    add_action( 'wp_enqueue_scripts', 'gs_youtubegalleries_enqueue_front_scripts' );
}

// -- Admin css
function gsytgal_enque_admin_style() {
    $media = 'all';
    
    wp_register_style( 'gsytgal-admin-style', GSYOUTUBEGALLERIES_FILES_URI . '/admin/css/gsytgal_admin_style.css', '', GSYOUTUBEGALLERIES_VERSION, $media );
    wp_enqueue_style( 'gsytgal-admin-style' );

    wp_register_style( 'gs-free-plugins-style', GSYOUTUBEGALLERIES_FILES_URI . '/admin/css/gs_free_plugins.css', '', GSYOUTUBEGALLERIES_VERSION, $media );
    wp_enqueue_style( 'gs-free-plugins-style' );
}
add_action( 'admin_enqueue_scripts', 'gsytgal_enque_admin_style' );