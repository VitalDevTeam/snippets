<?php
/**
 * Test if current post is an ancestor of given post ID
 * @param  integer $pid Post ID of parent
 * @return boolean
 */
function is_tree($pid) {
    global $post;
    if (is_page($pid))
        return true;
    if ($post) {
        $anc = get_post_ancestors($post->ID);
        foreach ($anc as $ancestor) {
            if (is_page() && $ancestor == $pid) {
                return true;
            }
        }
    }
    return false;
}
