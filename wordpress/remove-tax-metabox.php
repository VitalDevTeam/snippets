<?php
/**
 * Remove taxonomy metabox
 */
function remove_tax_metabox() {
    remove_meta_box('tax_slugdiv', 'post_type_slug', 'side');
}
add_action('admin_menu', 'remove_tax_metabox');