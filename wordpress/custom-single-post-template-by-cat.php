<?php
/**
 * Custom single post template for specific categories
 */
function cat_single_template() {
    $cats = get_the_category();

    foreach ($cats as $cat) {
        if (file_exists(TEMPLATEPATH . "/single-category-{$cat->term_id}.php")) {
            return TEMPLATEPATH . "/single-category-{$cat->term_id}.php";
        }
    }

    return $the_template;
}
add_filter('single_template', 'cat_single_template');