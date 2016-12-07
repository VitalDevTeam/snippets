<?php
/**
 * Add current language body element as class
 * @param  [array] $classes Body classes
 */
function append_language_class($classes) {
    $classes[] = 'lang-' . ICL_LANGUAGE_CODE;
    return $classes;
}

add_filter('body_class', 'append_language_class');