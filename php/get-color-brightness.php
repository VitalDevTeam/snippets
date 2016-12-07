<?php
/**
 * Determine brightness of RGB color
 * @param  {String} $hex HEX color value
 * @return {integer}     Brightness value
 */
function get_color_brightness($hex = '#ffffff') {
    $hex = str_replace('#', '', $hex);
    $c_r = hexdec(substr($hex, 0, 2));
    $c_g = hexdec(substr($hex, 2, 2));
    $c_b = hexdec(substr($hex, 4, 2));
    return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
}