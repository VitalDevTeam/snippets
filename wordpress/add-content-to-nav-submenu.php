<?php
// Insert custom HTML at the top of a WordPress submenu
class Custom_Nav_Walker extends Walker_Nav_Menu {
    static $count = 0;

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        // Reset $count when we are on the first level
        if ($depth === 0) {
            self::$count = 0;
        }

        // IF we are in the first submenu AND items count is 1 AND the
        // top-level item of this menu is the one we're after
        if ($depth === 1 && self::$count === 1 && $item->menu_item_parent === '42') {
            $output .= '<div>Look at me!!!@</div>';
        }


        // All the rest of start_el goes here ...


        // Increment $count
        self::$count++;
    }
}
