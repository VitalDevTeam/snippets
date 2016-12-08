<?php
/**
 * Add custom columns in admin post list
 */

// Register new column(s)
function vtl_post_columns($columns) {
    $columns['custom_meta'] = 'Custom Meta';
    return $columns;
}
add_filter('manage_posts_columns', 'vtl_post_columns');

// Output column content
function vtl_post_columns_content($name) {
    global $post;
    switch ($name) {
        case 'custom_meta':
            $meta = get_post_meta($post->ID, 'custom_meta_key', true);
            echo $meta;
    }
}
add_action('manage_posts_custom_column',  'vtl_post_columns_content');

// Customize column width (optional)
function vtl_post_columns_width() {
    $current_screen = get_current_screen();
    if ($current_screen->id === 'edit-customposttype') {
        echo '<style>
        th[id=custom_meta] {
            width: 5%;
        }
        </style>';
    }
}
add_action('admin_head', 'vtl_post_columns_width');