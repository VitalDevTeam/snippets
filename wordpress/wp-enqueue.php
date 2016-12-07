<?php
// Cache-busting script enqueuer
wp_enqueue_script(
    'global',
    get_template_directory_uri() . '/scripts/site/global.js',
    false,
    filemtime(get_template_directory() . '/scripts/site/global.js'),
    true
);