<?php
/**
 * Add widget title as class on widget heading
 */
function widget_title_as_class($title) {
    return '<h2 class="widget-title ' . sanitize_title($title) . '">' . $title . '</h2>';
}
add_filter('widget_title', 'widget_title_as_class');