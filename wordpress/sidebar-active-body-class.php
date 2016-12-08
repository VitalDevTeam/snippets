<?php
/**
 * Add class to body if sidebar is active
 */
function add_body_sidebar_class($classes) {
    if (is_active_sidebar('sidebar')) {
        $classes[] = 'has-sidebar';
    }
    return $classes;
}

add_filter('body_class','add_body_sidebar_class');