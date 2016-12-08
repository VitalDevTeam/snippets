<?php
/**
 * Override WordPress default core template
 */
function custom_search_template($template) {
    global $wp_query;
    $post_type = get_query_var('post_type');

    if (!$wp_query->is_admin
        && $wp_query->is_search
        && isset($post_type)
        && $post_type === 'faq') {

        return locate_template('templates/faq-search.php');
    }

    return $template;

}
add_filter('template_include', 'custom_search_template');
