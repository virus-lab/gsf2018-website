<?php

/* Menu */

class Evnt_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = Array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"wsmenu-submenu\">\n";
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback($args) {
        if (current_user_can('manage_options')) {

            extract($args);

            $fb_output = null;

            if ($container) {
                $fb_output = '<' . $container;

                if ($container_id) {
                    $fb_output .= ' id="' . $container_id . '"';
                }
                if ($container_class) {
                    $fb_output .= ' class="' . $container_class . '"';
                }
                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ($menu_id) {
                $fb_output .= ' id="' . $menu_id . '"';
            }
            if ($menu_class) {
                $fb_output .= ' class="' . $menu_class . '"';
            }
            $fb_output .= '>';
            $fb_output .= '<li><a href="' . esc_url(admin_url('nav-menus.php')) . '">' . esc_html__('Add a menu', 'evnt') . '</a></li>';
            $fb_output .= '</ul>';

            if ($container) {
                $fb_output .= '</' . $container . '>';
            }
            echo $fb_output;
        }
    }

}
