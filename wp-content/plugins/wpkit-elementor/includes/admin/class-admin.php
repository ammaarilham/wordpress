<?php
/**
 * Admin Page
 * @package WPKit For Elementor
 * @version 1.0
 */

if( ! class_exists( 'WKE_Admin' ) ){
	class WKE_Admin {

		/**
		 * Constructor
		 * Sets up the welcome screen
		 */
		public function __construct() {

			add_action( 'admin_menu', array( $this, 'admin_register_menu' ) );
			add_action( 'admin_init', array( $this,'register_modules' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'wke_admin_header', array( $this, 'admin_ui_header' ), 10 );
			add_action( 'wp_ajax_nopriv_update_module_status',  array( $this,'update_module_status' ) );
			add_action( 'wp_ajax_update_module_status',  array( $this,'update_module_status' ) );
	
		} // end constructor

		/**
		 * Admin Menu
		 * @return void
		 * @since  1.3
		 */
		public function admin_menu(){
			 
			 $admin_menu = array(
			 	'wpkit' => array(
			 		'menu_name'  => esc_html__( 'Modules', 'wpkit-elementor' ),
			 		'page_title' => esc_html__( 'Modules', 'wpkit-elementor' ),
			 		'tab_title'  => esc_html__( 'Modules', 'wpkit-elementor' ),
			 		'menu_page'  => array( $this, 'ui_modules' ),
			 		'capability' => 'edit_theme_options',
			 		'show_as_tab'=> true
			 	)
			 );

			 return apply_filters( 'wke_admin_menu', $admin_menu );
		}

		/**
		 * Creates the dashboard page
		 * @since 1.0
		 */
		public function admin_register_menu() {
			
			if( current_user_can( 'edit_theme_options' ) ){
				
				$admin_menu = $this->admin_menu();

				add_menu_page( 'WPKit For Elementor', 'WPKit For Elementor', 'edit_theme_options', 'wpkit', array($this, 'ui_modules'), plugins_url( 'assets/img/icon.png', WKE_FILE ) );

				foreach( $admin_menu as $key => $value ){
				  add_submenu_page( 'wpkit', $value['page_title'], $value['menu_name'], $value['capability'], $key, $value['menu_page'] );
				}
			  
		    }
		}

		/**
		 * The Admin screen header
		 * @since 1.0.0
		 */
		public function admin_ui_header() {
			
			$current_screen = get_current_screen();

    		if( $current_screen->id === "toplevel_page_wpkit" ) {
			
		?>
			<div class="wrap about-wrap wke-wrap">
				<h1><img src="<?php echo plugins_url( 'assets/img/icon.png', WKE_FILE );?>" alt="WPKit For Elementor" /> <?php echo 'WPKit For Elementor'; ?></h1>
				<p class="intro"><?php esc_html_e( 'WPKit For Elementor offers more custom Elementor widgets, flexible panel and global block module.', 'wpkit-elementor' ); ?></p>
			<?php
		    }
		}

		/**
		 * Admin screen UI
		 * @since 1.0
		 */
	    public function ui_modules() {
		   require_once( WKE_DIR . 'includes/admin/templates/modules-template.php' );
	    }

	    /**
		 * Register Modules
		 * @since 1.3
		 */
	    public function register_modules(){
	    	$modules = array(
			     'elementor_flexiable_panel' => array(
			        'id'   => 'elementor_flexiable_panel',
			        'name' => esc_html__( 'Flexible Panel For Elementor', 'wpkit-elementor' ),
			        'desc' => esc_html__( 'If you turn on this module, the side panel of Elementor will be dragable that allow you to drag and drop it to anywhere on the editing screen.', 'wpkit-elementor' ),
			        'default' => '0',
			        'show' => true
 			    ),
			    'global_blocks' => array(
			        'id'   => 'global_blocks',
			        'name' => esc_html__( 'Global Blocks For Elementor', 'wpkit-elementor' ),
			        'desc' => esc_html__( 'You can create the global template part with global blocks and insert the global blocks to anywhere.', 'wpkit-elementor' ),
			        'default' => '1',
			        'show' => true
 			    ),
			);

	        $modules = apply_filters( 'wke_module_list', $modules );

			foreach( $modules as $key => $module ) {
				   register_setting( 'wke_option_group', $key, array(
		           	 'type' => 'string', 
		           	 'sanitize_callback' => 'esc_attr',
		           	 'default' => $module['default']
		           ) );
		    }

			return $modules;
	    }

	    /**
		 * Check Module Activated or Deactivated
		 * @since 1.3
		 */
	    public static function check_module( $id ){
	    	if( null!== get_option( $id ) && get_option( $id ) == '1' ) {
	    		return true;
	    	}else{
	    		return false;
	    	}
	    }

	    /**
	     * Update Module Status
	     * @since 1.3
	     */
	    public function update_module_status(){
			 if( !isset( $_POST['id'] ) && !isset( $_POST['status'] ) ){
			   return;
			 }

		     update_option( $_POST['id'], $_POST['status'] );
		}

		/**
		 * Add admin scripts
		 */
		public function admin_scripts(){
		      wp_enqueue_style( 'wke-admin-styles', plugins_url( 'assets/admin/wke-admin.css', WKE_FILE ) );
		      wp_enqueue_script( 'wke-admin-script', plugins_url( 'assets/admin/wke-admin.js', WKE_FILE ), array( 'jquery' ), null, true );
			  wp_localize_script( 'wke-admin-script', 'wke_admin_data', array(
			   		'ajax_url' => admin_url( 'admin-ajax.php' )
			 ));
		}

	    /**
	     * Text Field
	     */
		public static function text( $name, $val, $readonly ) {
		  if( null !== get_option( $name ) && get_option( $name ) !== '' ){
		  	 $val = get_option( $name );
		  }

		  $readonly_prop = '';
		  
		  if( $readonly == true ) {
		  	 $readonly_prop = 'readonly';
		  }

		  $return_html = '<input name="'.$name.'" type="text" class="ui textfield" value="'.$val.'" '.$readonly_prop.'>';  

	      return $return_html;
		}

		/**
	     * Hidden Field
	     */
		public static function hidden( $name, $val ) {
		  if( null !== get_option( $name ) && get_option( $name ) !== '' ) {
		  	 $val = get_option( $name );
		  }
		  $return_html = '<input name="'.$name.'" type="hidden" class="ui textfield" value="'.$val.'">';      
	      
	      return $return_html;
		}

	}

	return new WKE_Admin();
}