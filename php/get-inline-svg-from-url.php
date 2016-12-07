<?php
/**
 * Get inline SVG from file URL
 * @param  string  $file  URL of SVG
 * @param  boolean $echo  Echo SVG file contents or return if false
 * @return string         Markup of SVG file
 */
function get_url_inline_svg($file, $echo = true) {
    $file_headers = @get_headers($file);
    if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return false;
    } else {
        if ($echo === true) {
            echo file_get_contents($file);
        } else {
            return file_get_contents($file);
        }
    }
}