<?php
// Add custom columns to admin post lists

/**
 * Add new columns
 * @param  [array] $columns Existing admin columns
 */
function admin_custom_post_columns($columns) {
    $columns['likes'] = 'Likes';
    return $columns;
}

add_filter('manage_posts_columns', 'admin_custom_post_columns');
add_filter('manage_edit-posts_sortable_columns', 'admin_custom_post_columns');

/**
 * Populate columns
 * @param  [string] $name Name of column
 */
function admin_custom_post_show_columns($name) {
    global $post;
    switch ($name) {
        case 'likes':
            $likes = get_post_meta($post->ID, 'votes', true);
            echo $likes;
    }
}

add_action('manage_posts_custom_column',  'admin_custom_post_show_columns');

/**
 * Customize column width
 */
function admin_custom_column_width() {
    global $pagenow;
    if ($pagenow == 'edit.php') {
        echo '<style>
        th[id=likes] {
            width: 5%;
        }
        </style>';
    }
}

add_action('admin_head', 'admin_custom_column_width');
