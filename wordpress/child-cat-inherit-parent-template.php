<?php
/**
 * Force child category to inherit parent category template
 */
function new_subcategory_hierarchy() {
    $category = get_queried_object();
    $parent_id = $category->category_parent;
    $templates = array();
    if ($parent_id === 0) {
        // Use default values from get_category_template()
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
        $templates[] = 'category.php';
    } else {
        // Create replacement $templates array
        $parent = get_category($parent_id);
        // Current first
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
        // Parent second
        $templates[] = "category-{$parent->slug}.php";
        $templates[] = "category-{$parent->term_id}.php";
        $templates[] = 'category.php';
    }
    return locate_template($templates);
}
add_filter('category_template', 'new_subcategory_hierarchy'); ?>