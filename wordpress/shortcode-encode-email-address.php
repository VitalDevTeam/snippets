<?php
// Encode email addresses
// Usage: [email]example@example.com[/email]
function email_encode_function($atts , $content = null) {
    if (!is_email($content)) {
        return;
    }
    return '<a href="mailto:' . antispambot($content) . '">' . antispambot($content) . '</a>';
}
add_shortcode('email', 'email_encode_function');
?>