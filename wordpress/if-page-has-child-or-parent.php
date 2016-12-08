<?php
$children = get_pages('child_of=' . $post->ID);
if (count($children) !== 0 || (is_page() && $post->post_parent)) {
    // Do this
}
