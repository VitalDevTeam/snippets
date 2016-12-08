<?php
/**
 * Sets the maximum year displayed in the date field's year drop down and
 * the HTML5 max attribute for the date field's year input
 */
function vital_gform_set_max_year($max_year) {
    $future_year = strtotime('+3 years');
    return date('Y', $future_year);
}
add_filter('gform_date_max_year', 'vital_gform_set_max_year');

/**
 * Sets the minimum year displayed in the date field's year drop down and
 * the HTML5 min attribute for the date field's year input
 */
function vital_gform_set_min_year($max_year) {
    $current_year = date('Y');
    return $current_year;
}
add_filter('gform_date_min_year', 'vital_gform_set_min_year');
