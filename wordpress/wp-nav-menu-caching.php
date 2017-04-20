<?php

/** --------------------------------
FOR SIMPLE MENUS WITH NO ACTIVE NAV ITEMS
------------------------------------ */

// In your template:
$menu_query = get_transient('main_menu_query');

if ($menu_query === false ) {

    $menu_query = wp_nav_menu(array(
        'theme_location' => 'main_nav',
        'echo' => 0,
    ));

    set_transient('main_menu_query', $menu_query, 1 * HOUR_IN_SECONDS);

}

echo $menu_query;

// In functions.php:

/**
 * Delete menu cache when menus or posts are updated
 */
function delete_menu_transients() {
    delete_transient('main_menu_query');
}

add_action('wp_update_nav_menu', 'delete_menu_transients');
add_action('save_post', 'delete_menu_transients');


/** --------------------------------------------
FOR MENUS WITH ACTIVE NAV ITEMS
You must generate a unique transient for each page
------------------------------------------------ */

// Setup unique key
$key = md5(esc_url($_SERVER['REQUEST_URI']));

// Create unique transient
$menu_query = get_transient('main_menu_' . $key);

if ($menu_query === false) {

    $menu_query = wp_nav_menu(array(
        'theme_location' => 'main_nav',
        'echo' 			 => 0,
    ));

    // No expiration for best results
    set_transient('main_menu_' . $key, $menu_query);
}

echo $menu_query;

// In functions.php:

/**
 * Deletes wp_nav_menu transients on post or menu updates
 */
function delete_unique_menu_transients() {

    global $wpdb;

    // The main menu transient prefix
    $prefix = esc_sql('main_menu_');

    $options = $wpdb->options;

    $t  = esc_sql("_transient_$prefix%");

    $sql = $wpdb->prepare(
        "
          SELECT option_name
          FROM $options
          WHERE option_name LIKE '%s'
        ",
        $t
    );

    $transients = $wpdb->get_col($sql);

    // For each transient...
    foreach($transients as $transient) {

        // Strip away the WordPress prefix in order to arrive at the transient key.
        $key = str_replace('_transient_', '', $transient);

        // Now that we have the key, use WordPress core to the delete the transient.
        delete_transient($key);
    }

    // Also flush the object cache
    wp_cache_flush();

}

add_action('wp_update_nav_menu', 'delete_unique_menu_transients');
add_action('save_post', 'delete_unique_menu_transients');
