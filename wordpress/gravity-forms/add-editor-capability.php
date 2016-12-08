<?php
/**
 * Add Gravity Forms access to Editor user capabilities
 */
function add_gforms_editor_cap() {
    $role = get_role('editor');
    $role->add_cap('gform_full_access');
}
add_action('admin_init', 'add_gforms_editor_cap');