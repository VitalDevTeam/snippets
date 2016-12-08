<?php
/**
 * Disables internal author page URL
 */
function disable_author_link() {
    return '';
}
add_filter('author_link', 'disable_author_link');

/**
 * Redirect all author page requests
 */
function disable_author_page() {
    if (is_author()) {
        wp_redirect(home_url(), 301);
        exit;
    }
}
add_action('template_redirect', 'disable_author_page');