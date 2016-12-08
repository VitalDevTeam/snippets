<?php
// utility function to get all possible values for a particular meta / post type
function get_meta_values($meta_key = false,  $post_type = 'post') {

    if ($meta_key) {

        // Get posts and add values to array
        $posts = get_posts(
            array(
                'post_type' => $post_type,
                'meta_key' => $meta_key,
                'posts_per_page' => -1,
            )
        );

        foreach ($posts as $post) {
            $meta_values[] = trim(get_post_meta($post->ID, $meta_key, true));
        }

        // Clean and sort the results
        $meta_values = array_unique($meta_values);
        sort($meta_values);

        return $meta_values;
    }

}
?>