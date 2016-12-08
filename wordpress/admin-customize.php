<?php

/*  Remove admin menus from sidebar for non-admins
   -------------------------------------------------------------------------- */

    function vtl_remove_admin_items() {
        global $menu;
        unset($menu[5]); // Posts
        unset($menu[25]); // Comments
    }

   if (!current_user_can('administrator'))
        add_action('admin_menu', 'vtl_remove_admin_items');

/*  Remove admin menus from sidebar for non-admins (Fine-tune)
    NOTE: This doesn't block accessing pages directly via URL, it simply
    hides them on the menu. Good for fine-tuning the backend UI when
    completely blocking access to the area is not important.
   -------------------------------------------------------------------------- */

    function vtl_remove_admin_items_fine() {
        // Menu Pages
        remove_menu_page('edit-comments.php');
        // Submenu Pages
        remove_submenu_page('themes.php', 'customize.php');
    }

   if (!current_user_can('administrator'))
        add_action('admin_menu', 'vtl_remove_admin_items_fine', 999);

/*  Add/remove admin bar items for non-admins
   -------------------------------------------------------------------------- */

    function vtl_custom_admin_bar() {
        global $wp_admin_bar;
        // Remove
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('comments');
        //$wp_admin_bar->remove_menu('new-post', 'new-content');
        $wp_admin_bar->remove_menu('my-account');
        // Add
        $wp_admin_bar->add_menu( array(
            'parent' => 'top-secondary',
            'id' => 'log_out',
            'title' => __('Log Out'),
            'href' => wp_logout_url()
        ));
    }
    if (!current_user_can('administrator'))
        add_action('wp_before_admin_bar_render', 'vtl_custom_admin_bar');

/*  Remove meta boxes for non-admins
   -------------------------------------------------------------------------- */

    function vtl_remove_meta_boxes() {
        remove_meta_box('commentstatusdiv','page','normal'); // Comments status (discussion)
        remove_meta_box('commentsdiv','page','normal'); // Comments
        remove_meta_box('slugdiv','page','normal'); // Slug
        remove_meta_box('authordiv','page','normal'); // Author
        remove_meta_box('postcustom','page','normal'); // Custom fields (WordPress)
        remove_meta_box('postexcerpt','page','normal'); // Excerpt
        remove_meta_box('trackbacksdiv','page','normal'); // Trackbacks
        remove_meta_box('formatdiv','page','normal'); // Formats
        remove_meta_box('tagsdiv-post_tag','page','normal'); // Tags
        remove_meta_box('categorydiv','page','normal'); // Categories
        remove_meta_box('pageparentdiv','page','normal'); // Attributes
    }

    if (!current_user_can('administrator'))
        add_action('admin_init','vtl_remove_meta_boxes');

/*   Change default type for +New admin bar link
    --------------------------------------------------------------------------  */

    function vtl_admin_bar_new_link($wp_admin_bar) {
        $newpage = $wp_admin_bar->get_node('new-page');
        $wp_admin_bar->add_node(array('id' => 'new-content', 'href' => $newpage->href));
    }

    if (!current_user_can('administrator'))
        add_action('admin_bar_menu', 'vtl_admin_bar_new_link', 100);

/*   Remove dashboard widgets for non-admins
    --------------------------------------------------------------------------  */

    function remove_dashboard_widgets() {
        global $wp_meta_boxes;
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    }

    if (!current_user_can('administrator'))
        add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
