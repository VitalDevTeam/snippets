<?php
/**
 * Move Gravity Forms scripts to footer and
 * delay until jQuery is loaded
 */

// Move the scripts to the footer
add_filter('gform_init_scripts_footer', '__return_true');

// Prevent scripts from firing before Google's CDN copy of jQuery is downloaded
add_filter('gform_cdata_open', 'vtl_wrap_gform_cdata_open');

function vtl_wrap_gform_cdata_open($content = '') {
    $content = 'document.addEventListener("DOMContentLoaded", function() { ';
    return $content;
}
add_filter('gform_cdata_close', 'vtl_wrap_gform_cdata_close');

function vtl_wrap_gform_cdata_close($content = '') {
    $content = ' }, false );';
    return $content;
}