<?php
/**
 * Custom Gravity Forms AJAX spinner
 */
function custom_gforms_spinner($src) {
    return get_stylesheet_directory_uri() . '/images/loading.gif';
}

add_filter('gform_ajax_spinner_url', 'vtl_custom_gforms_spinner');