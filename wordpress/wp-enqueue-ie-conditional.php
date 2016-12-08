<?php
function ie_enqueuer() {

    global $wp_styles;

    /**
     * Load our IE-only stylesheet for all versions of IE:
     * <!--[if IE]> ... <![endif]-->
     *
     * NOTE: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
     * calling the wp_enqueue_style() function.  If you are trying to load a stylesheet for all browsers
     * EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
     * properly handle non-IE conditional comments.
     */
    wp_enqueue_style('my-theme-ie', get_stylesheet_directory_uri() . "/css/ie.css", array('my-theme'));
    $wp_styles->add_data('my-theme-ie', 'conditional', 'IE');

    /**
     * Load our IE version-specific stylesheet:
     * <!--[if IE 7]> ... <![endif]-->
     */
    wp_enqueue_style('my-theme-ie7', get_stylesheet_directory_uri() . "/css/ie7.css", array('my-theme'));
    $wp_styles->add_data('my-theme-ie7', 'conditional', 'IE 7');

    /**
     * Load our IE specific stylesheet for a range of older versions:
     * <!--[if lt IE 9]> ... <![endif]-->
     * <!--[if lte IE 8]> ... <![endif]-->
     * NOTE: You can use the 'less than' or the 'less than or equal to' syntax here interchangeably.
     */
    wp_enqueue_style('my-theme-old-ie', get_stylesheet_directory_uri() . "/css/ie-sucks.css", array('my-theme'));
    $wp_styles->add_data('my-theme-old-ie', 'conditional', 'lt IE 9');

    /**
     * Load our IE specific stylesheet for a range of newer versions:
     * <!--[if gt IE 8]> ... <![endif]-->
     * <!--[if gte IE 9]> ... <![endif]-->
     * NOTE: You can use the 'greater than' or the 'greater than or equal to' syntax here interchangeably.
     */
    wp_enqueue_style('my-theme-new-ie', get_stylesheet_directory_uri() . "/css/ie-sucks.css", array('my-theme'));
    $wp_styles->add_data('my-theme-new-ie', 'conditional', 'gt IE 8');
}
add_action('wp_enqueue_scripts', 'ie_enqueuer');
