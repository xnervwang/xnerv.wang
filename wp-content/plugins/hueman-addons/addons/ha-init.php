<?php
/**
* Fires the plugin or the theme addon
* @author Nicolas GUILLAUME
* @since 1.0
*/
if ( ! class_exists( 'HU_AD' ) ) :
  final class HU_AD {
      //Access any method or var of the class with classname::$instance -> var or method():
      static $instance;

      public static $theme;
      public static $theme_name;
      public $is_customizing;
      private $is_pro_theme;
      private $is_pro_addons;

      public $models;

      public $pro_header;//Will store the pro header instance
      public $pro_grids;//Will store the pro grids instance
      public $pro_infinite;//Will store the pro infinite scroll instance
      public $pro_skins;

      public static function ha_get_instance() {
          if ( ! isset( self::$instance ) && ! ( self::$instance instanceof HU_AD ) )
            self::$instance = new HU_AD();
          return self::$instance;
      }


      function __construct() {
          self::$instance =& $this;

          //checks if is customizing : two context, admin and front (preview frame)
          $this -> is_customizing = $this -> ha_is_customizing();

          self::$theme          = $this -> ha_get_theme();
          self::$theme_name     = $this -> ha_get_theme_name();

          //did_action('plugins_loaded') ?


          if( ! defined( 'HA_BASE_PATH' ) ) define( 'HA_BASE_PATH' , trailingslashit( dirname( dirname( __FILE__ ) ) ) );

          //are we in pro theme?
          if ( defined( 'HU_IS_PRO' ) && HU_IS_PRO ) {
              if( ! defined( 'HA_BASE_URL' ) ) define( 'HA_BASE_URL' , HU_BASE_URL );
          } else {
              if( ! defined( 'HA_BASE_URL' ) ) define( 'HA_BASE_URL' , trailingslashit( plugins_url( basename( dirname( __DIR__ ) ) ) ) );
          }


          if( ! defined( 'HA_SKOP_ON' ) ) define( 'HA_SKOP_ON' , true );

          //PRO THEME / PRO ADDON ?
          $this->is_pro_theme   = ( ! defined( 'HU_IS_PRO_ADDONS' ) || ( defined( 'HU_IS_PRO_ADDONS' ) && false == HU_IS_PRO_ADDONS ) ) && ! defined( 'IS_HUEMAN_ADDONS' );
          $this->is_pro_addons  = ( defined( 'HU_IS_PRO_ADDONS' ) && false != HU_IS_PRO_ADDONS ) || ( ! did_action('plugins_loaded') && file_exists( HA_BASE_PATH . 'addons/ha-init-pro.php' ) );

          //stop execution if not Hueman or if minimal version of Hueman is not installed
          if ( ! defined( 'HU_IS_PRO' ) || ! HU_IS_PRO ) {
              if ( false === strpos( self::$theme_name, 'hueman' ) || version_compare( self::$theme -> version, MINIMAL_AUTHORIZED_THEME_VERSION, '<' ) ) {
                add_action( 'admin_notices', array( $this , 'ha_admin_notice' ) );
                $this->is_pro_theme = $this->is_pro_addons = false;
                return;
              }
          }


          //TEXT DOMAIN
          //adds plugin text domain
          add_action( 'plugins_loaded', array( $this , 'ha_plugin_lang' ) );

          //fire
          $this -> ha_load();

          add_action('wp_head', array( $this, 'hu_admin_style') );
      }//construct



      /* ------------------------------------------------------------------------- *
      *  MODELS UTILITIES
      /* ------------------------------------------------------------------------- */
      //When doing partial ajax, get the model directly from the setter
      //in other cases, use the cached one
      function ha_get_model( $model_name , $setter = null , $args = array() ) {
          $model_data = array();
          if ( ha_is_partial_ajax_request() ) {
              $model_data = call_user_func_array( $setter, $args );
          } else {
              $_models = $this -> models;
              if ( ! is_array($_models) ) {
                  ha_error_log( 'Problem in HU_AD::ha_get_model : attempting to get a model (' . $model_name . ') but the HU_AD::models property is not populated yet.');
              }
              $model_data = ( array_key_exists( $model_name, $_models ) && array_key_exists( 'data', $_models[$model_name] ) ) ? $_models[ $model_name ]['data'] : false;
          }

          return $model_data;
      }

      //@return void()
      //@param $setter can be a function or an array with a class and a method array( $this, '_get_pro_header_model' )
      function ha_set_model( $model_name, $setter = null , $args = array() ) {
          $_models = $this -> models;
          $model_data = call_user_func_array( $setter, $args );

          if ( ! is_string( $model_name ) || empty( $model_name ) || ! is_array( $model_data ) || empty( $model_data ) ) {
            wp_die('Hueman Addons : model not properly defined.');
          }
          $_models[$model_name] = array( 'data' => $model_data, 'setter' => $setter, 'args' => $args );
          $this -> models = $_models;
      }

      /* ------------------------------------------------------------------------- *
      *  I am a man in constant sorrow
      /* ------------------------------------------------------------------------- */
      function ha_is_pro_addons() {
        return $this->is_pro_addons;
      }

      function ha_is_pro_theme() {
        return $this->is_pro_theme;
      }

      //@return the right url path whether we are in plugin or pro theme
      function ha_get_base_url() {
        return defined( 'HU_BASE' ) && HU_IS_PRO ? HU_BASE_URL : HA_BASE_URL;
      }


      /* ------------------------------------------------------------------------- *
      *  I am a man in constant sorrow
      /* ------------------------------------------------------------------------- */
      function ha_load() {
        /* ------------------------------------------------------------------------- *
         *  Loads Features
        /* ------------------------------------------------------------------------- */
        require_once( HA_BASE_PATH . 'addons/sharrre/ha-sharrre.php' );
        new HA_Sharrre();
        require_once( HA_BASE_PATH . 'addons/shortcodes/ha-shortcodes.php' );
        new HA_Shortcodes();

        /* ------------------------------------------------------------------------- *
         *  Loads Customizer
        /* ------------------------------------------------------------------------- */
        require_once( HA_BASE_PATH . 'addons/czr/ha-czr.php' );
        new HA_Czr();

        /* ------------------------------------------------------------------------- *
         *  Loads SKOP
        /* ------------------------------------------------------------------------- */
        if ( $this -> ha_is_skop_on() ) {
          if ( defined('CZR_DEV') && true === CZR_DEV ) {
              if ( file_exists( HA_BASE_PATH . 'addons/skop/_dev/skop-x-fire.php' ) ) {
                  require_once( HA_BASE_PATH . 'addons/skop/_dev/skop-x-fire.php' );
              }
          } else {
              require_once( HA_BASE_PATH . 'addons/skop/czr-skop.php' );
          }
        }
        /* ------------------------------------------------------------------------- *
         *  Loads PRO
        /* ------------------------------------------------------------------------- */
        if ( $this -> ha_is_pro_addons() || $this -> ha_is_pro_theme() ) {
          require_once( HA_BASE_PATH . 'addons/ha-init-pro.php' );
        }
      }


      function ha_plugin_lang() {
        load_plugin_textdomain( 'hueman-addons' , false, basename( dirname( __FILE__ ) ) . '/lang' );
      }

      /**
      * @uses  wp_get_theme() the optional stylesheet parameter value takes into account the possible preview of a theme different than the one activated
      *
      * @return  the (parent) theme object
      */
      function ha_get_theme(){
        // Return the already set theme
        if ( self::$theme )
          return self::$theme;
        // $_REQUEST['theme'] is set both in live preview and when we're customizing a non active theme
        $stylesheet = $this -> is_customizing && isset($_REQUEST['theme']) ? $_REQUEST['theme'] : '';

        //gets the theme (or parent if child)
        $ha_theme               = wp_get_theme($stylesheet);

        return $ha_theme -> parent() ? $ha_theme -> parent() : $ha_theme;

      }

      /**
      *
      * @return  the theme name
      *
      */
      function ha_get_theme_name(){
        $ha_theme = $this -> ha_get_theme();

        return sanitize_file_name( strtolower( $ha_theme -> Name ) );
      }


      //hook : admin_notices
      function ha_admin_notice() {
          if ( version_compare( self::$theme -> version, MINIMAL_AUTHORIZED_THEME_VERSION, '<' ) ) {
            $message = sprintf( __( 'This version of the <strong>%1$s</strong> plugin requires at least the version %2$s of the Hueman theme.', 'hueman-addons' ),
              'Hueman Addons',
              MINIMAL_AUTHORIZED_THEME_VERSION
            );
          } else if ( false === strpos( self::$theme_name, 'hueman' ) ) {
            $message = sprintf( __( 'The <strong>%1$s</strong> plugin %2$s.', 'hueman-addons' ),
              'Hueman Addons',
              __( 'works only with the Hueman theme', 'hueman-addons' )
            );
          } else {
            return;
          }

        ?>
          <div class="error"><p><?php echo $message; ?></p></div>
        <?php
      }


      /**
      * Is the customizer left panel being displayed ?
      * @return  boolean
      * @since  3.3+
      */
      function ha_is_customize_left_panel() {
        global $pagenow;
        return is_admin() && isset( $pagenow ) && 'customize.php' == $pagenow;
      }


      /**
      * Is the customizer preview panel being displayed ?
      * @return  boolean
      * @since  3.3+
      */
      function ha_is_customize_preview_frame() {
        return is_customize_preview() || ( ! is_admin() && isset($_REQUEST['customize_messenger_channel']) );
      }

      function ha_is_previewing_live_changeset() {
        return ! isset( $_POST['customize_messenger_channel']) && is_customize_preview();
      }

      /**
      * Always include wp_customize or customized in the custom ajax action triggered from the customizer
      * => it will be detected here on server side
      * typical example : the donate button
      *
      * @return boolean
      * @since  3.3+
      */
      function ha_doing_customizer_ajax() {
        $_is_ajaxing_from_customizer = isset( $_POST['customized'] ) || isset( $_POST['wp_customize'] );
        return $_is_ajaxing_from_customizer && ( defined( 'DOING_AJAX' ) && DOING_AJAX );
      }

      /**
      * Are we in a customization context ? => ||
      * 1) Left panel ?
      * 2) Preview panel ?
      * 3) Ajax action from customizer ?
      * @return  bool
      * @since  3.3+
      */
      function ha_is_customizing() {
        //checks if is customizing : two contexts, admin and front (preview frame)
        return in_array( 1, array(
          $this -> ha_is_customize_left_panel(),
          $this -> ha_is_customize_preview_frame(),
          $this -> ha_doing_customizer_ajax()
        ) );
      }

      //@return bool
      //skop shall not be activated when previewing the theme from the customizer

      function ha_is_skop_on() {
        global $wp_version;
        if ( $this -> ha_isprevdem() )
          return;
        return apply_filters( 'ha_is_skop_on', version_compare( $wp_version, '4.7', '>=' ) );
      }


      //Check the existence of the 'changeset_uuid' method in the WP_Customize_Manager to state if the changeset feature is
      function ha_is_changeset_enabled( $wp_customize = null ) {
        if ( $this -> ha_is_customizing() && ( is_null( $wp_customize ) || ! is_object( $wp_customize ) ) ) {
          global $wp_customize;
        }
        return $this -> ha_is_customizing() && method_exists( $wp_customize, 'changeset_uuid');
      }

      //@return an array of unfiltered options
      //=> all options or a single option val
      function ha_get_raw_option( $opt_name = null, $opt_group = null, $from_cache = true ) {
          $alloptions = wp_cache_get( 'alloptions', 'options' );
          $alloptions = maybe_unserialize( $alloptions );
          //is there any option group requested ?
          if ( ! is_null( $opt_group ) && array_key_exists( $opt_group, $alloptions ) ) {
            $alloptions = maybe_unserialize( $alloptions[ $opt_group ] );
          }
          //shall we return a specific option ?
          if ( is_null( $opt_name ) ) {
              return $alloptions;
          } else {
              $opt_value = array_key_exists( $opt_name, $alloptions ) ? maybe_unserialize( $alloptions[ $opt_name ] ) : false;//fallback on cache option val
              //do we need to get the db value instead of the cached one ? <= might be safer with some user installs not properly handling the wp cache
              //=> typically used to checked the template name for czr_fn_isprevdem()
              if ( ! $from_cache ) {
                  global $wpdb;
                  //@see wp-includes/option.php : get_option()
                  $row = $wpdb->get_row( $wpdb->prepare( "SELECT option_value FROM $wpdb->options WHERE option_name = %s LIMIT 1", $opt_name ) );
                  if ( is_object( $row ) ) {
                      $opt_value = $row->option_value;
                  }
              }
              return $opt_value;
          }
      }

      function ha_isprevdem() {
          $_active_theme  = $this -> ha_get_raw_option( 'template' );
          $hu_theme       = wp_get_theme();
          $hu_theme       = $hu_theme -> parent() ? $hu_theme -> parent() : $hu_theme;
          $hu_theme       = strtolower( $hu_theme -> name );
          $hu_theme       = str_replace(' ', '-', $hu_theme );
          return apply_filters( 'hu_isprevdem', ( $_active_theme != $hu_theme && ! is_child_theme() ) );
      }

      //hook : wp_head
      //only on front end and if user is logged-in
      function hu_admin_style() {
        ?>
            <script type="text/javascript" id="ha-customize-btn">
              jQuery( function($) {
                  $( "#wp-admin-bar-customize").find('a').attr('title', '<?php _e( "Customize this page !", "hueman-addons"); ?>' );
              });
            </script>
            <style type="text/css" id="ha-fun-ab">
              @-webkit-keyframes super-rainbow {
                0%   { text-shadow : 0px 0px 2px;}
                20%  { text-shadow : 0px 0px 5px; }
                40%  { text-shadow : 0px 0px 10px; }
                60%  { text-shadow : 0px 0px 13px }
                80%  { text-shadow : 0px 0px 10px; }
                100% { text-shadow : 0px 0px 5px; }
              }
              @-moz-keyframes super-rainbow {
                0%   { text-shadow : 0px 0px 2px;}
                20%  { text-shadow : 0px 0px 5px; }
                40%  { text-shadow : 0px 0px 10px; }
                60%  { text-shadow : 0px 0px 13px }
                80%  { text-shadow : 0px 0px 10px; }
                100% { text-shadow : 0px 0px 5px; }
              }

              #wp-admin-bar-customize .ab-item:before {
                  color:#7ECEFD;
                  -webkit-animation: super-rainbow 4s infinite linear;
                   -moz-animation: super-rainbow 4s infinite linear;
              }
            </style>
        <?php
      }
  } //end of class
endif;


function ha_error_log( $data ) {
  if ( ! defined('CZR_DEV') || true !== CZR_DEV )
    return;
  error_log( $data );
}


//Creates a new instance
function HU_AD() {
  return HU_AD::ha_get_instance();
}
HU_AD();