<?php
if (!defined('ABSPATH')) die('-1');

if (!class_exists("WD_ASL_Menu")) {
    /**
     * Class WD_ASL_Menu
     *
     * Menu handler for Ajax Search Pro plugin. This class encapsulates the menu elements as well.
     *
     * @class         WD_ASL_Menu
     * @version       1.0
     * @package       AjaxSearchLite/Classes/Core
     * @category      Class
     * @author        Ernest Marcinko
     */
    class WD_ASL_Menu {

        /**
         * Holds the main menu item
         *
         * @var array the main menu
         */
        private static $main_menu = array(
            "title" => "Ajax Search Lite",
            "slug" => "/backend/settings.php",
            "position" => "206.5",
            "icon_url" => 'icon.png'
        );

        /**
         * Submenu titles and slugs
         *
         * @var array
         */
        private static $submenu_items = array(
            array(
                "title" => "Analytics Integration",
                "slug" => "/backend/analytics.php"
            ),
            array(
                "title" => "Compatibility Settings",
                "slug" => "/backend/compatibility.php"
            ),
            array(
                "title" => "Performance options",
                "slug" => "/backend/performance_options.php"
            ),
            array(
                "title" => "Help & Support",
                "slug" => "/backend/help_and_support.php"
            )
        );

        /**
         * Runs the menu registration process
         */
        public static function register() {

            $capability = ASL_DEMO == 1 ? 'read' : 'manage_options';

            add_menu_page(
                self::$main_menu['title'],
                self::$main_menu['title'],
                $capability,
                ASL_DIR . self::$main_menu['slug'],
                '',
                ASL_URL . self::$main_menu['icon_url'],
                self::$main_menu['position']
            );

            foreach (self::$submenu_items as $submenu) {
                add_submenu_page(
                    ASL_DIR . self::$main_menu['slug'],
                    self::$main_menu['title'],
                    $submenu['title'],
                    $capability,
                    ASL_DIR . $submenu['slug']
                );

            }

        }

        /**
         * Method to obtain the menu pages for context checking
         *
         * @return array
         */
        public static function getMenuPages() {
            $ret = array();

            $ret[] = ASL_DIR . self::$main_menu['slug'];

            foreach (self::$submenu_items as $menu)
                $ret[] = ASL_DIR . $menu['slug'];

            return $ret;
        }

    }
}