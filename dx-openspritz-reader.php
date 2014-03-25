<?php
/**
 * Plugin Name: DX OpenSpritz Reader
 * Description: The WordPress cousin of OpenSpritz, the open speed reading library
 */

if ( ! class_exists( 'DX_OpenSpritz_Reader' ) ) {
	
	include 'defines.php';
	
	class DX_OpenSpritz_Reader {

		public function __construct() {
			$this->load_includes();
			add_action( 'wp_enqueue_scripts', array( $this, 'register_spritz_js' ) );
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );
			add_action( 'init', array( $this, 'register_shortcodes' ) );
		}
		
		public function register_spritz_js() {
			wp_register_script( 'openspritz-js', plugins_url( 'assets/js/spritz.js', __FILE__ ) );
		}
		
		public function register_widgets() {
			register_widget( 'DX_OpenSpritz_Widget' );
		}
		
		public function register_shortcodes() {
			add_shortcode( 'dx_openspritz' , array( 'DX_OpenSpritz_Shortcode', 'display' ) );
		}
		
		public function load_includes() {
			include_once DXOSZ_INC_DIR . 'core.php';
			include_once DXOSZ_INC_DIR . 'openspritz-widget.php';
			include_once DXOSZ_INC_DIR . 'openspritz-shortcode.php';
		}
	}
	
	new DX_OpenSpritz_Reader();
}