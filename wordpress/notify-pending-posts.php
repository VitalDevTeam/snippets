<?php
/**
 * Add notification badge to admin menu when there are pending posts
 */
function pending_post_notify() {
    global $menu;

    if (!current_user_can('publish_posts')) {
        return false;
    }

    $post_type = 'post_type';
    $menu_str  = 'edit.php?post_type=' . $post_type;
    $num_posts = wp_count_posts($post_type, 'readable');

    if (isset($num_posts->pending)) {
        $count = $num_posts->pending;
        foreach ($menu as $key => $value) {
            if ($menu[$key][2] === $menu_str) {
                $menu[$key][0] .= " <span class='update-plugins count-{$count}'><span class='plugin-count'>" . number_format_i18n($count) . '</span></span>';
                return;
            }
        }
    }
}

add_action('admin_menu', 'pending_post_notify');
