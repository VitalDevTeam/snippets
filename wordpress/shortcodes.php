<?php
// SIMPLE SHORTCODE
// Returns content, accepts no arguments, requires no closing tag

// Usage: [simple_shortcode]
function simple_shortcode_func($atts) {
    return 'Who put the bomp?';
}
add_shortcode('simple_shortcode', 'simple_shortcode_func');

// SINGLE SHORTCODE
// Wraps content, accepts arguments

/* Usage:
[single_shortcode foo="value" bar="value"]
    Maecenas faucibus mollis interdum.
[/single_shortcode]
*/
function single_shortcode_func($atts) {
    extract(shortcode_atts(array(
        'foo' => 'Default value',
        'bar' => 'Default value',
    ), $atts));
    return "{$foo} = {$bar}";
}
add_shortcode('single_shortcode', 'single_shortcode_func');

// NESTING SHORTCODE
// Allows another shortcode to be nested within, accepts arguments
/* Usage:
[nesting_shortcode foo="value" bar="value"]
    [another_shortcode]
        Nulla vitae elit libero, a pharetra augue.
    [/another_shortcode]
[/nesting_shortcode]
*/
function nesting_shortcode_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'foo' => 'Default value',
        'bar' => 'Default value',
    ), $atts));
    return '<span class="outer-shortcode">' . do_shortcode($content) . '</span>';
}
add_shortcode('nesting_shortcode', 'nesting_shortcode_func');
