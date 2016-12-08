<?php
/**
 * Remove titles from widgets
 */
function remove_widget_title($widget_title) {
    return false;
}
add_filter('widget_title', 'remove_widget_title');
