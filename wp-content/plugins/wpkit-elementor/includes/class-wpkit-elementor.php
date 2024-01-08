<?php
/**
 * WPKit For Elementor setup
 *
 * @package WPKit For Elementor
 * @since   1.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main WPKit_Elementor Class.
 *
 * @class WPKit_Elementor
 */
final class WPKit_Elementor {

	/**
	 * WPKit For Elementor version.
	 *
	 * @var string
	 */
	public $version = '1.1.0';

	/**
	 * The single instance of the class.
	 *
	 * @var WPKit_Elementor
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main WPKit_Elementor Instance.
	 *
	 * Ensures only one instance of WPKit_Elementor is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see WPKit_Elementor()
	 * @return WPKit_Elementor - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		wc_doing_it_wrong( __FUNCTION__, esc_html__( 'Cloning is forbidden.', 'wpkit-elementor' ), '1.1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		wc_doing_it_wrong( __FUNCTION__, esc_html__( 'Unserializing instances of this class is forbidden.', 'wpkit-elementor' ), '1.1.0' );
	}

	/**
	 * WPKit_Elementor Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Init Hooks
	 */
	public function init_hooks(){
		add_action( 'init', array($this,'textdomain') );
		add_action( 'activated_plugin', array( $this, 'activation' ) );
	}

	/**
	 * Define Constants.
	 */
	private function define_constants() {
		$this->define( 'WKE_DEBUG', true );
		$this->define( 'WKE_ABSPATH', dirname( WKE_FILE ) . '/' );
		$this->define( 'WKE_PLUGIN_BASENAME', plugin_basename( WKE_FILE ) );
		$this->define( 'WKE_DIR', plugin_dir_path( dirname(__FILE__) ) );
    $this->define( 'WKE_ROOT_DIR', plugins_url().'/'.plugin_basename( WKE_DIR ).'/' );
		$this->define( 'WKE_VERSION', $this->version );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	public function activation(){
		if( get_option( 'global_blocks' ) == NULL  ){
			add_option( 'global_blocks', '1' );
		}else{
			update_option( 'global_blocks', '1' );
		}

		if( get_option( 'elementor_flexiable_panel' ) == NULL  ){
			add_option( 'elementor_flexiable_panel', '0' );
		}

		if( get_option( 'ui_theme' ) !== NULL ) {
			update_option( 'ui_theme', 'dark' );
		}
	}

	/**
     * Localize
     */
	public function textdomain() {
	   load_plugin_textdomain('wpkit-elementor', FALSE, dirname(plugin_basename(WKE_FILE)).'/languages/');
	}


	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {

		/**
		 * Template Loader.
		 */
		include_once WKE_ABSPATH . 'includes/class-template-loader.php';

		/**
		 * Utils
		 */
		include_once WKE_ABSPATH . 'includes/class-util.php';

		/**
		 * Scripts
		 */
		include_once WKE_ABSPATH . 'includes/class-load-scripts.php';

		/**
		 * Template Tags.
		 */
		include_once WKE_ABSPATH . 'includes/template-tags.php';

		/**
		 * Admin
		 */
		include_once WKE_ABSPATH . 'includes/admin/class-admin.php';

		/**
		 * Load Global Blocks
		 */
		include_once WKE_ABSPATH . 'includes/global-blocks/class-global-blocks.php';

		/**
		 * Load Elementor Module
		 */
		if( class_exists( 'Elementor\Plugin' ) ){
			include_once WKE_ABSPATH . 'includes/elementor/class-extend-elementor.php';
		}
	}

}
