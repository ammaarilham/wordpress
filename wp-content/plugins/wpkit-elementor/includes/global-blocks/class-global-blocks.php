<?php
/**
 * Global Blocks
 *
 * @package WPKit For Elementor
 * @since   1.0.1
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main WKE_Global_Blocks Page Class.
 *
 * @class WKE_Global_Blocks Page
 */
class WKE_Global_Blocks {

	/**
	 * The single instance of the class.
	 *
	 * @var WKE_Global_Blocks Block
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * The arguments of wpkit-elementor post type
	 *
	 * @var WKE_Global_Blocks Block
	 * @since 1.0.0
	 */
	public $post_type = 'wke-global-block';
	public $post_type_slug = 'global-block';
	public $post_type_description;
	public $post_type_supports = array( 'title', 'editor' );
	public $post_type_labels;
	public $post_type_label;
	public $public = true;
	public $publicly_queryable = true;
	public $show_ui = true;
	public $show_in_menu = true;
	public $query_var = true;
	public $rewrite = true;
	public $capability_type = 'post';
	public $has_archive = true;
	public $hierarchical = true;
	public $menu_position = null;
	public $exclude_from_search = true;
	public $show_in_nav_menus = false;
	public $show_in_admin_bar = false;
	public $menu_icon = 'dashicons-screenoptions';
	public $map_meta_cap = null;
	public $can_export = true;
	public $show_in_rest = true;

	public $register_taxonomy = true;
	public $taxonomy   = 'wke-global-block-cat';
	public $taxonomy_slug = 'global-block-category';
	public $taxonomy_labels;
	public $taxonomy_public = false;
	public $taxonomy_publicly_queryable = false;
	public $taxonomy_show_ui = true;
	public $taxonomy_show_in_menu = true;
	public $taxonomy_show_in_nav_menus = false;
	public $taxonomy_show_tagcloud = true;
	public $taxonomy_show_in_rest = true;
	public $taxonomy_show_in_quick_edit = true;
	public $taxonomy_show_admin_column = true;
	public $taxonomy_query_var = false;

	/**
	 * Main WKE_Global_Blocks Instance.
	 *
	 * Ensures only one instance of WKE_Global_Blocks is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see WKE_Global_Blocks()
	 * @return WKE_Global_Blocks - Main instance.
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
		wc_doing_it_wrong( __FUNCTION__, esc_html__( 'Cloning is forbidden.', 'wpkit-elementor' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		wc_doing_it_wrong( __FUNCTION__, esc_html__( 'Unserializing instances of this class is forbidden.', 'wpkit-elementor' ), '1.0.0' );
	}

	/**
	 * LovagePro Constructor.
	 */
	public function __construct() {

		$this->init_hooks();

	    $this->post_type_labels = array(
		    'name'               => esc_html__( 'Global Blocks', 'wpkit-elementor' ),
				'singular_name'      => esc_html__( 'Global Block', 'wpkit-elementor' ),
				'menu_name'          => esc_html__( 'Global Blocks', 'wpkit-elementor' ),
				'name_admin_bar'     => esc_html__( 'Global Blocks', 'wpkit-elementor' ),
				'add_new'            => esc_html__( 'Add New', 'wpkit-elementor' ),
				'add_new_item'       => esc_html__( 'Add New Global Block', 'wpkit-elementor' ),
				'new_item'           => esc_html__( 'New Global Block', 'wpkit-elementor' ),
				'edit_item'          => esc_html__( 'Edit Global Block', 'wpkit-elementor' ),
				'view_item'          => esc_html__( 'View Global Block', 'wpkit-elementor' ),
				'all_items'          => esc_html__( 'All Global Blocks', 'wpkit-elementor' ),
				'search_items'       => esc_html__( 'Search Global Blocks', 'wpkit-elementor' ),
				'parent_item_colon'  => esc_html__( 'Parent Global Blocks:', 'wpkit-elementor' ),
				'not_found'          => esc_html__( 'No global block found.', 'wpkit-elementor' ),
				'not_found_in_trash' => esc_html__( 'No global block found in Trash.', 'wpkit-elementor' )
	    );
		$this->post_type_label = esc_html__( 'Global Block', 'wpkit-elementor' );

		$this->taxonomy_labels = array(
			'name'                       => _x( 'Block Categoies', 'taxonomy general name', 'wpkit-elementor' ),
			'singular_name'              => _x( 'Block Category', 'taxonomy singular name', 'wpkit-elementor' ),
			'search_items'               => __( 'Search Block Category', 'wpkit-elementor' ),
			'popular_items'              => __( 'Popular Block Category', 'wpkit-elementor' ),
			'all_items'                  => __( 'All Categories', 'wpkit-elementor' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Block Category', 'wpkit-elementor' ),
			'update_item'                => __( 'Update Block Category', 'wpkit-elementor' ),
			'add_new_item'               => __( 'Add New Block Category', 'wpkit-elementor' ),
			'new_item_name'              => __( 'New Block Category Name', 'wpkit-elementor' ),
			'separate_items_with_commas' => __( 'Separate block category with commas', 'wpkit-elementor' ),
			'add_or_remove_items'        => __( 'Add or remove block category', 'wpkit-elementor' ),
			'choose_from_most_used'      => __( 'Choose from the most used block category', 'wpkit-elementor' ),
			'not_found'                  => __( 'No block category found.', 'wpkit-elementor' ),
			'menu_name'                  => __( 'Block Categories', 'wpkit-elementor' ),
		);

	}

	public function settings( $post_type_slug ){
		$this->post_type_slug = $post_type_slug;
	}

	/**
	 * Init Hooks
	 */
	public function init_hooks(){
		add_action( 'init', array( $this, 'post_type' ) );
		add_filter( 'register_post_type_args', array( $this, 'post_type_args' ), 10, 2 );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_filter( 'widget_text', 'do_shortcode' );
    add_shortcode( 'wpkit_global_block', array( $this, 'output_elementor_template' ) );
    add_action( 'elementor/init', array( $this, 'enable_elementor' ) );
    add_action( "add_meta_boxes", array( $this, "add_shortcode_meta_box" ) );
    add_action( 'init', array( $this, 'includes' ) );
    add_filter( 'single_template', array( $this, 'single_template') );
	}

	/**
	 * Register Global Block Post Type
	 */
	public function post_type() {
		/**
		 * Register a post type.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_post_type
		 */

		$args = apply_filters( 'wke_global_block_post_type_args', array(
			'labels'             => $this->post_type_labels,
			'label'				 => $this->post_type_label,
	        'description'        => $this->post_type_description,
			'public'             => $this->public,
			'publicly_queryable' => $this->publicly_queryable,
			'show_ui'            => $this->show_ui,
			'show_in_menu'       => $this->show_in_menu,
			'show_in_nav_menus'  => $this->show_in_nav_menus,
			'show_in_admin_bar'  => $this->show_in_admin_bar,
			'query_var'          => $this->query_var,
			'capability_type'    => $this->capability_type,
			'has_archive'        => $this->has_archive,
			'hierarchical'       => $this->hierarchical,
			'menu_position'      => $this->menu_position,
			'menu_icon'			 => $this->menu_icon,
			'supports'           => $this->post_type_supports,
			'exclude_from_search'=> $this->exclude_from_search,
			'map_meta_cap'		 => $this->map_meta_cap,
			'can_export'		 => $this->can_export,
			'show_in_rest'		 => $this->show_in_rest,
			'rest_base'          => $this->post_type,
    		'rest_controller_class' => 'WP_REST_Posts_Controller',
    		'taxonomies'		 => array( $this->taxonomy )
		));

		if($this->rewrite){
			$args['rewrite'] = array( 'slug' => $this->post_type_slug );
		}else{
			$args['rewrite'] = $this->rewrite;
		}

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register Taxonomy
	 */
	public function register_taxonomies() {

		if(!$this->register_taxonomy){
			return;
		}

		$args = apply_filters('wke_global_blocks_taxonomy_labels', array(
			'hierarchical'       => true,
			'labels'             => $this->taxonomy_labels,
			'public'             => $this->taxonomy_public,
			'publicly_queryable' => $this->taxonomy_publicly_queryable,
			'show_ui'            => $this->taxonomy_show_ui,
			'show_in_menu'       => $this->taxonomy_show_in_menu,
			'show_in_nav_menus'  => $this->taxonomy_show_in_nav_menus,
			'show_admin_column'  => $this->taxonomy_show_admin_column,
			'show_tagcloud'      => $this->taxonomy_show_tagcloud,
			'show_in_rest'  	 => $this->taxonomy_show_in_rest,
			'rest_base'          => $this->taxonomy,
    		'rest_controller_class' => 'WP_REST_Terms_Controller',
			'show_in_quick_edit' => $this->taxonomy_show_in_quick_edit,
			'query_var'  		 => $this->taxonomy_query_var,
			'rewrite'            => array( 'slug' => $this->taxonomy_slug ),
		));

		register_taxonomy( $this->taxonomy, $this->post_type, $args );
		register_taxonomy_for_object_type( $this->taxonomy, $this->post_type );
	}

	/**
	 * Add REST API support to an already registered post type.
	 */
	public function post_type_args( $args, $post_type ) {

	    if ( $this->post_type === $post_type ) {
	        $args['show_in_rest'] = true;

	        // Optionally customize the rest_base or rest_controller_class
	        $args['rest_base']             = $this->post_type;
	        $args['rest_controller_class'] = 'WP_REST_Posts_Controller';
	    }

	    return $args;
	}

	/**
	 * The single template
	 * @since 1.0.1
	 */
	public function single_template( $single ) {

	    global $post;

	    $single_template_file = 'single-global-block.php';

	    /* Checks for single template by post type */
	    if ( get_post_type( $post->ID ) == $this->post_type ) {
	    	if( file_exists( trailingslashit( get_stylesheet_directory() ) . $single_template_file ) ) {
	    		 return trailingslashit( get_stylesheet_directory() ) . $single_template_file;
	    	}else{
		        if ( file_exists( WKE_ABSPATH . 'includes/global-blocks/' . $single_template_file ) ) {
		            return WKE_ABSPATH . 'includes/global-blocks/' . $single_template_file;
		        } else {
		        	return new WP_Error( 'broke', esc_html__( "The single template doesn't exist.", "wpkit-elementor" ) );
		        }
	    	}
	    }else{
	    	return $single;
	    }
	}

	/**
     * Show Shortcode Metabox
     * @since 1.0
     */
    public function add_shortcode_meta_box(){
        add_meta_box('global-block-shortcode','Global Block Shortcode', array( $this, 'shortcode_metabox' ), $this->post_type,'side','high');
    }

    public function shortcode_metabox( $post ){
        ?>
        <p style="margin-bottom:5px;">You can copy the shortcode of this content block to anywhere you want.</p>
        <input type='text' class='widefat' value='[wpkit_global_block id="<?php echo $post->ID; ?>"]' readonly="">
        <?php
    }

    /**
     * Enable elementor for global block by default.
     * @since 1.0
     */
    public function enable_elementor(){
        add_post_type_support( $this->post_type, 'elementor' );
    }

    /**
     * Output elementor block
     * @since 1.0
     */
    public static function output_elementor_template( $atts ){

        if( ! class_exists( 'Elementor\Plugin' ) ) {
            return '';
        }

        if( ! isset( $atts['id'] ) || empty( $atts['id'] ) ){
            return '';
        }

        $post_id = $atts['id'];
        $response = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id );
        return $response;
    }


    /**
    * Load Files
    * @since 1.0
    */
    public function includes(){

    }

}

if( get_option( 'global_blocks' ) && class_exists( 'Elementor\Plugin' ) ) {
   $WKE_Global_Blocks = WKE_Global_Blocks::instance();
}
/**
 * Get Template List
 * @since 1.0
 */
function wke_get_block_list() {

		 $lists = get_posts( array( 'post_type'=> 'wke-global-block', 'posts_per_page' => -1 ) );
		 $lists_array = array();
		 $lists_array['0'] = esc_html__( 'Please select', 'wpkit-elementor' );

		 foreach( $lists as $list ){
				 $lists_array[$list->ID] = $list->post_title;
		 }

		 return $lists_array;
}
require_once WKE_ABSPATH . "includes/global-blocks/global-blocks-widget.php";
