<?php
/**
 * Get inline SVG markup
 * @param  string  $file  File name (if ending in /{something}.svg, use that for full path instead of concatenating)
 * @param  boolean $echo  Echo SVG file contents or return if false
 * @param  string  $path  Path of image directory relative to theme's root
 * @return string         Markup of SVG file
 */
function get_inline_svg($file, $echo = true, $path = 'assets/images') {
    if (preg_match('/^(.*?)\/(.*?)\.svg$/i', $file)) {
        $file_path = $file;
    } else {
        $file_path = get_template_directory() . '/' . $path . '/' . $file;
    }

    if (file_exists($file_path)) {
        if ($echo === true) {
            echo file_get_contents($file_path);
        } else {
            return file_get_contents($file_path);
        }
    }
}
