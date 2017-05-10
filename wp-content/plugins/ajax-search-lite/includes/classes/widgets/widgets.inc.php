<?php
if (!defined('ABSPATH')) die('-1');

require_once(ASL_CLASSES_PATH . "widgets/class-search-widget.php");

add_action( 'widgets_init', create_function( '', 'return register_widget("AjaxSearchLiteWidget");' ) );