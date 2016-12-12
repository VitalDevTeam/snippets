<?php
/**
 * Remove metabox for custom taxonomies.
 * Replace `tax_slug` with tax name.
 */
function remove_custom_tax_metabox() {
    // Hierarchical taxonomy.
    remove_meta_box('tax_slugdiv', 'post_type_slug', 'side' );
    // Non-hierarchical taxonomy.
    remove_meta_box('tagsdiv-tax_slug', 'post_type_slug', 'side' );
}
add_action('admin_menu', 'remove_custom_tax_metabox');