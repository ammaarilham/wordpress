<?php
/**
 * WPKit Elementor Class
 * @package WPKit For Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! class_exists( 'WPKit_Elementor_Scripts' ) ) {
	class WPKit_Elementor_Scripts {
		
		private static $instance = null;

	    public static function get_instance() {
	      if ( ! self::$instance ) {
	         self::$instance = new self;
	      }
	      return self::$instance;
	    }

	    public function init() {
	      add_action( 'init', array( $this,'merge' ) );
	      add_action( 'wp_enqueue_scripts', array( $this,'scripts' ), 10 );
	    }

	    /**
	     * Common Styles and Scripts
	     */
		public function scripts(){
		  wp_enqueue_script( 'imagesLoaded' );	
		  
		  /* Load vendor scripts */
		  wp_enqueue_style( 'wpkit-elementor-vendors',  plugins_url( 'build/css/wpkit-elementor-vendors.css', WKE_FILE ), false, null, "all" );  
		  wp_enqueue_script( 'wpkit-elementor-vendors', plugins_url( 'build/js/wpkit-elementor-vendors.js', WKE_FILE ), array( 'jquery'), null, true );

		  /* Load main scripts */
		  wp_enqueue_style( 'wpkit-elementor-style',   plugins_url( 'build/css/wpkit-elementor.css', WKE_FILE ), false, null, "all" );  
		  wp_enqueue_script( 'wpkit-elementor-script', plugins_url( 'build/js/wpkit-elementor.js', WKE_FILE ), array( 'jquery' ), null, true );
		}

	    /* Merge Resource files */
		public function merge(){
		  WKE_Util::merge_files( WKE_DIR . 'assets/css/', WKE_DIR . 'build/css/', 'wpkit-elementor.css' );
		  WKE_Util::merge_files( WKE_DIR . 'assets/js/',  WKE_DIR . 'build/js/', 'wpkit-elementor.js' );
		  WKE_Util::merge_files( WKE_DIR . 'assets/vendors/js/',  WKE_DIR . 'build/js/', 'wpkit-elementor-vendors.js' );
		  WKE_Util::merge_files( WKE_DIR . 'assets/vendors/css/', WKE_DIR.'build/css/', 'wpkit-elementor-vendors.css' );
		}
	}
}

WPKit_Elementor_Scripts::get_instance()->init();