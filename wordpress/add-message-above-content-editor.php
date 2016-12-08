<?php
/**
 * Add message above the content editor
 */
function vital_edit_form_after_title() {
    $screen = get_current_screen();
    if ('post' === $screen->base && 'post' === $screen->post_type) {
        echo '<p style="color:green;"><span class="dashicons-before dashicons-warning" style="vertical-align:middle;margin-right:0.25em;"></span>The first heading in your content should always be level 2 for the best SEO and accessibility results.</p>';
    }
}

add_action('edit_form_after_title', 'vital_edit_form_after_title');