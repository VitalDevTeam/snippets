<?php
function add_favicons() {
    echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/images/favicon.ico">'."\n";
    echo '<link rel="apple-touch-icon-precomposed" href="' . get_stylesheet_directory_uri() . '/images/apple-touch-icon-precomposed.png" />'."\n";
}
add_action('wp_head', 'add_favicons');