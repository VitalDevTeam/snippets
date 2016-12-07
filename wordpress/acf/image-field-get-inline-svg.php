<?php
// Get inline SVG from ACF image field.
// Field should return image URL as value.
if (get_field('icon')) {

    $icon = get_field('icon');
    $ext = pathinfo($icon, PATHINFO_EXTENSION);

    if ($ext === 'svg') { // You could also restrict image field to SVG filetype and forego this check

        if (file_exists($icon)) {
            echo file_get_contents($icon);
        }

    }
}