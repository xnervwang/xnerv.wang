<?php
/**
* Plugin Name: Hueman Addons
* Plugin URI: http://presscustomizr.com
* Description: Hueman Theme Addons
* Version: 2.0.11
* Text Domain: hueman-addons
* Author: Press Customizr
* Author URI: http://presscustomizr.com
* License: GPLv2 or later
*/

//last version sync
if( ! defined( 'LAST_THEME_VERSION_FMK_SYNC' ) ) define( 'LAST_THEME_VERSION_FMK_SYNC' , '3.3.11' );
if( ! defined( 'MINIMAL_AUTHORIZED_THEME_VERSION' ) ) define( 'MINIMAL_AUTHORIZED_THEME_VERSION' , '3.3.0' );
if( ! defined( 'IS_HUEMAN_ADDONS' ) ) define( 'IS_HUEMAN_ADDONS' , true );
if( ! defined( 'HU_IS_PRO_ADDONS' ) ) define( 'HU_IS_PRO_ADDONS' , false );
/**
* helper ( can be already defined in the hueman theme)
* Check if we are really on home, all cases covered
* @return  bool
*/
function ha_is_hueman_pro() {
  //get WP_Theme object of Hueman
  $hu_theme                     = wp_get_theme();

  //Get infos from parent theme if using a child theme
  $hu_theme = $hu_theme -> parent() ? $hu_theme -> parent() : $hu_theme;
  return "hueman-pro" == sanitize_file_name( strtolower( $hu_theme -> name) );
}



if ( ! function_exists( 'hu_is_real_home') ) {
  function hu_is_real_home() {
    return ( is_home() && ( 'posts' == get_option( 'show_on_front' ) || '__nothing__' == get_option( 'show_on_front' ) ) )
    || ( 0 == get_option( 'page_on_front' ) && 'page' == get_option( 'show_on_front' ) )//<= this is the case when the user want to display a page on home but did not pick a page yet
    || is_front_page();
  }
}

if ( ha_is_hueman_pro() ) {
    //hook : admin_notices
    function ha_is_pro_admin_notice() {
      ?>
        <div class="error"><p><?php _e( 'The Hueman Addons plugin is already included in Hueman Pro. You can disable it.', 'hueman-addons' ) ?></p></div>
      <?php
    }
    add_action( 'admin_notices', 'ha_is_pro_admin_notice' );

} else {
    require_once( plugin_dir_path( __FILE__ ) . 'addons/ha-init.php' );
}
