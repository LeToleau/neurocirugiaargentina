<?php

/**
 * This class add features to the native wordpress menus
 * 
 * Use: Call WPExtendedMenu::printMenu($args); to print your menu.
 * 
 * $args = array(
 *  'wp_nav_menu' => array($opt), // All settings allowed by wp_nav_menu() native function https://developer.wordpress.org/reference/functions/wp_nav_menu/
 *  'parent_menu_icon' => string/img/svg //You can set a custom icon for items with children.
 * );
 */


class WPExtendedMenu
{
    public static $icon = '>';
    public static $menu = 'main-menu';

    static function printMenu($opt){
        $opt += array( 
            'wp_nav_menu' => array(
                'theme_location' => 'main-menu',
                'container_class' => 'menu b-navbar__menu'
            ),
            'parent_menu_icon' => '>'
        );

        self::$icon = $opt['parent_menu_icon'];
        self::$menu = $opt['wp_nav_menu']['theme_location']; 

        add_filter('walker_nav_menu_start_el', array( get_called_class(), 'add_icon' ), 10, 4);

        wp_nav_menu($opt['wp_nav_menu']); 
    }

    static function add_icon($output, $item, $depth, $args)
    {

        //Only add class to 'top level' items on the 'primary' menu.
        if (self::$menu == $args->theme_location && $depth === 0) {
            if (in_array("menu-item-has-children", $item->classes)) {
                $output .= '<span class="sub-menu-toggle">'.self::$icon.'</span>';
            }
        }
        return $output;
    }
}
