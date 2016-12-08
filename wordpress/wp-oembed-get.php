<?php
// Simple example:
echo wp_oembed_get('http://www.youtube.com/watch?v=dQw4w9WgXcQ', array('width' => 500));

// Add the following to functions.php to modify wp_oembed_get's output, allowing additional configuration parameters:

// Modify wp_oembed_get output to allow additional arguments
function vtl_oembed_result($html, $url, $args) {
    $newargs = $args;
    array_pop($newargs);
    $parameters = http_build_query($newargs);
    $html = str_replace('?feature=oembed', '?feature=oembed' . '&amp;' . $parameters, $html);
    return $html;
}

add_filter('oembed_result','vtl_oembed_result', 10, 3);

// Now, you can do the following:

echo wp_oembed_get('http://www.youtube.com/watch?v=dQw4w9WgXcQ', array('width' => 500, 'rel' => 0, 'autohide' => 1, 'modestbranding' => 1, 'showinfo' => 0));