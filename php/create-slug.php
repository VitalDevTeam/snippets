<?php
/**
 * Create a web-friendly URL slug from any string
 * @param  string $text
 * @return string
 */
function create_slug($text) {
    // Lower case everything
    $text = strtolower($text);
    // Make alphanumeric (removes all other characters)
    $text = preg_replace("/[^a-z0-9_\s-]/", "", $text);
    // Clean up multiple dashes or whitespaces
    $text = preg_replace("/[\s-]+/", " ", $text);
    // Convert whitespaces and underscore to dash
    $text = preg_replace("/[\s_]/", "-", $text);

    return $text;
}