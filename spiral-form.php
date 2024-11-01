<?php
/**
 * @package   Spiral_Form
 * @author    PIPED BITS Co.,Ltd.
 * @license   GPLv2
 * @link      http://www.pi-pe.co.jp
 * @copyright Copyright (c) PIPED BITS Co.,Ltd.
 *
 * @wordpress-plugin
 * Plugin Name: SPIRAL Form
 * Description: フォーム作成/管理と登録データの閲覧ができるプラグインです。登録データはパイプドビッツが提供するSPIRAL ver.2のクラウド上で安全に管理されます。
 * Version:     3.4.1
 * Author:      PIPED BITS Co.,Ltd.
 * Author URI:  http://www.pi-pe.co.jp
 * License:     GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: spiral-form
 * Domain Path: /languages/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! defined( 'ABSPATH' ) ) {
  exit;
} // Exit if accessed directly
/* Constant Declaration */
if ( ! defined( 'WPFWS_SPIRAL_DIR' ) ) {
  define('WPFWS_SPIRAL_DIR', dirname( __FILE__ ));
}
if ( ! defined( 'WPFWS_SPIRAL_DIR_PATH' ) ) {
  define( 'WPFWS_SPIRAL_DIR_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'WPFWS_SPIRAL_PLUGIN_DIRNAME' ) ) {
  define( 'WPFWS_SPIRAL_PLUGIN_DIRNAME', plugin_basename( dirname( __FILE__ ) ) );
}
if ( ! defined( 'WPFWS_SPIRAL_PLUGIN_DIR_URL' ) ) {
  define( 'WPFWS_SPIRAL_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'WPFWS_SPIRAL_VERSION_NUMBER' ) ) {
  define( 'WPFWS_SPIRAL_VERSION_NUMBER', '2.0' );
}

add_action('plugins_loaded', 'wan_load_textdomain');
function wan_load_textdomain() {
	load_plugin_textdomain( 'spiral-form', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

require_once( WPFWS_SPIRAL_DIR . '/libs/functions.php' );

add_action( 'admin_menu', 'wpfws_add_admin_menu' );

add_action( 'admin_menu', 'wpfws_add_wpfws_form_lists' );

add_action( 'admin_menu', 'wpfws_add_new_form' );

add_action( 'admin_menu', 'wpfws_add_data_record' );

add_shortcode('wpfws_form', 'sc_wpfws_form_output');

//checking the api setting
add_action( 'admin_notices', 'check_setting' );

add_action('init', 'wpfws_set_to_default_shortcode');

add_action('wp_head', 'wp_post_preview_js');

add_action( 'init', 'wpfws_pagetype_init' );

register_activation_hook( __FILE__, 'my_rewrite_flush' );

//link JS & Css for form view
add_action('wp_enqueue_scripts', 'callback_view_scripts_css');
	function callback_view_scripts_css(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-datepicker');
	    
	    wp_register_style( 'form-css', plugins_url('css/form.css', __file__));
	    wp_enqueue_style( 'form-css');
	    
	    wp_register_script( 'form-js', plugins_url('js/form.js', __file__));
	    wp_enqueue_script( 'form-js');

	    wp_register_style( 'calendar-css', plugins_url('css/calendar.css', __file__));
	    wp_enqueue_style( 'calendar-css');
	    
	    wp_register_script( 'jquery-dropdate', plugins_url('js/combodate.js', __file__));
	    wp_enqueue_script( 'jquery-dropdate');
	    
	    wp_register_script( 'date.format', plugins_url('js/moment.min.js', __file__));
	    wp_enqueue_script( 'date.format');
	}
if(is_admin()){
	//link JS & CSS for admin page
	function callback_admin_scripts_css(){
		//script and css for data list page
		if(sanitize_text_field( $_GET['page'] ) == 'wpfws_record'){
			wp_register_script( 'bootstrapcdn-3.0.3.min', plugins_url('js/bootstrapcdn-3.0.3.min.js', __file__));
			wp_enqueue_script( 'bootstrapcdn-3.0.3.min');

			wp_register_script( 'bootstrap-3.3.7', plugins_url('js/bootstrap-3.3.7.js', __file__));
			wp_enqueue_script( 'bootstrap-3.3.7');

			wp_register_style( 'bootstrap-3.3.7', plugins_url('css/bootstrap-3.3.7.css', __file__));
			wp_enqueue_style( 'bootstrap-3.3.7');

			wp_register_style( 'bootstrapiso', plugins_url('css/bootstrapiso.css', __file__));
			wp_enqueue_style( 'bootstrapiso');

			wp_register_script( 'bootstrap_datepicker-1.4.1', plugins_url('js/bootstrap_datepicker-1.4.1.js', __file__));
			wp_enqueue_script( 'bootstrap_datepicker-1.4.1');

			wp_register_style( 'bootstrap_datepicker3-1.4.1', plugins_url('css/bootstrap_datepicker3-1.4.1.css', __file__));
			wp_enqueue_style( 'bootstrap_datepicker3-1.4.1');

			wp_register_script( 'floatTheadjs', plugins_url('js/jquery.floatThead.js', __file__));
			wp_enqueue_script( 'floatTheadjs');

			wp_register_script( 'floatTheadminjs', plugins_url('js/jquery.floatThead.min.js', __file__));
			wp_enqueue_script( 'floatTheadminjs');
		}else if(sanitize_text_field( $_GET['page'] ) == 'wpfws_form_lists'){
			wp_register_style( 'form-lists-css', plugins_url('css/wpfws_form_lists.css', __file__));
			wp_enqueue_style( 'form-lists-css');
		}
		wp_register_style( 'admin-css', plugins_url('css/admin.css', __file__));
		wp_enqueue_style( 'admin-css');
		
		wp_register_script( 'jquery.twbsPagination',  plugins_url('js/jquery.twbsPagination.js', __file__));
		wp_enqueue_script( 'jquery.twbsPagination');

	}
	add_action('admin_enqueue_scripts','callback_admin_scripts_css');
}
