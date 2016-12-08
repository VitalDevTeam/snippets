<?php
/**
 * Add text to featured image metabox
 */
function add_featured_image_instruction($content) {
    return $content .= '<p>Image will be automatically cropped to 640 x 328 pixels. You may crop your image to these dimensions before uploading for specific framing.</p>';
}
add_filter('admin_post_thumbnail_html', 'add_featured_image_instruction');
