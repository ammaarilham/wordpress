<?php
use \Elementor\Plugin;

/**
 * Extend Elementor Module
 *
 * @package WPKit For Elementor
 * @subpackage Elementor
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class WKE_Extend_Elementor {

    private static $instance = null;

    public static function get_instance() {
      if ( ! self::$instance ){
         self::$instance = new self;
      }
      return self::$instance;
    }

    public function init() {
      add_action( 'elementor/frontend/after_register_styles', array( $this, 'frontend_styles' ), 10 );
      add_action( 'elementor/frontend/after_register_scripts', array( $this, 'frontend_scripts' ), 10 );
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
      add_action( 'elementor/elements/categories_registered', array( $this, 'new_elementor_category' ) );
      add_action( 'init', array( $this, 'load_files' ) );
    }

    /**
     * Load Frontend Styles
     *
     */
    public function frontend_styles() {

    }

   /**
     * Load Frontend Scripts
     *
     */
   public function frontend_scripts() {

   }

   public function new_elementor_category( $elements_manager ) {
        $elements_manager->add_category(
            'wpkit-common-widget',
            array(
                'title' => esc_html__( 'WPKit Common', 'wpkit-elementor' ),
                'icon' => 'fa fa-plug',
            ),
        2);

         $elements_manager->add_category(
            'wpkit-woocommerce-widget',
            array(
                'title' => esc_html__( 'WPKit WooCommerce', 'wpkit-elementor' ),
                'icon' => 'fa fa-plug',
            ),
        2);

        $elements_manager->add_category(
            'wpkit-edd-widget',
            array(
                'title' => esc_html__( 'WPKit EDD', 'wpkit-elementor' ),
                'icon' => 'fa fa-plug',
            ),
        2);

        $elements_manager->add_category(
            'wpkit-lp-widget',
            array(
                'title' => esc_html__( 'WPKit LearnPress', 'wpkit-elementor' ),
                'icon' => 'fa fa-plug',
            ),
        2);

        $elements_manager->add_category(
            'wpkit-wedocs-widget',
            array(
                'title' => esc_html__( 'WPKit weDocs', 'wpkit-elementor' ),
                'icon' => 'fa fa-plug',
            ),
        2);
   }

   public function load_files(){

      include( 'controls/parallax-controls.php' );
      include( 'controls/opacity-controls.php' );
      include( 'controls/rotate-controls.php' );

      if( get_option( 'elementor_flexiable_panel' ) ) {
        include( 'editor/elementor-ui.php' );
      }
   }

   public function widgets_registered( $widgets_manager ) {

      include( 'widgets/separate-text.php' );
      $widgets_manager->register_widget_type( new WKE_Separate_Text_Widget() );

      include( 'widgets/typing.php' );
      $widgets_manager->register_widget_type( new WKE_Typing_Widget() );

      include( 'widgets/testimonials.php' );
      $widgets_manager->register_widget_type( new WKE_Testimonials_Widget() );

      include( 'widgets/interactive-banner.php' );
      $widgets_manager->register_widget_type( new WKE_Interactive_Banner_Widget() );

      include( 'widgets/image-carousel.php' );
      $widgets_manager->register_widget_type( new WKE_Image_Carousel_Widget() );

      include( 'widgets/picture-slider.php' );
      $widgets_manager->register_widget_type( new WKE_Picture_Slider_Widget() );

      include( 'widgets/flipbox.php' );
      $widgets_manager->register_widget_type( new WKE_FlipBox_Widget() );

      include( 'widgets/pricetable.php' );
      $widgets_manager->register_widget_type( new WKE_PriceTable_Widget() );

      include( 'widgets/countdown.php' );
      $widgets_manager->register_widget_type( new WKE_Countdown_Widget() );

      include( 'widgets/my-map.php' );
      $widgets_manager->register_widget_type( new WKE_My_Map_Widget() );

      include( 'widgets/blog-carousel.php' );
      $widgets_manager->register_widget_type( new WKE_Blog_Carousel_Widget() );

      include( 'widgets/blog-standard.php' );
      $widgets_manager->register_widget_type( new WKE_Blog_Standard_Widget() );

      include( 'widgets/blog-masonry.php' );
      $widgets_manager->register_widget_type( new WKE_Blog_Masonry_Widget() );

      include( 'widgets/blog-grid.php' );
      $widgets_manager->register_widget_type( new WKE_Blog_Grid_Widget() );

      if ( class_exists( 'WPCF7' ) ) {
         include( 'widgets/contact-form-7.php' );
         $widgets_manager->register_widget_type( new WKE_CF7_Widget() );
      }

      if( class_exists( 'WeDocs' ) ) {
          include( 'widgets/wedocs-archive.php' );
          $widgets_manager->register_widget_type( new WKE_WeDocs_Archive_Widget() );

          include( 'widgets/wedocs-search.php' );
          $widgets_manager->register_widget_type( new WKE_WeDocs_Search_Widget() );
      }

      if ( get_option( 'global_blocks' ) && class_exists( 'Elementor\Plugin' ) ) {
         include( 'widgets/global-blocks.php' );
         $widgets_manager->register_widget_type( new WKE_Global_Blocks_Widget() );
      }

      if ( get_option( 'global_blocks' ) && class_exists( 'Elementor\Plugin' ) ) {
         include( 'widgets/block-slider.php' );
         $widgets_manager->register_widget_type( new WKE_Block_Slider_Widget() );
      }

      if( class_exists( 'Easy_Digital_Downloads' ) ) {
          include( 'widgets/edd-products.php' );
          $widgets_manager->register_widget_type( new WKE_EDD_Products_Widget() );

          include( 'widgets/edd-cart-button.php' );
          $widgets_manager->register_widget_type( new WKE_EDD_Cart_Button_Widget() );

          include( 'widgets/edd-search.php' );
          $widgets_manager->register_widget_type( new WKE_EDD_Search_Widget() );

          include( 'widgets/edd-product-carousel.php' );
          $widgets_manager->register_widget_type( new WKE_EDD_Product_Carousel_Widget() );
      }

      if( class_exists( 'WooCommerce' ) ) {
          include( 'widgets/woo-cart-button.php' );
          $widgets_manager->register_widget_type( new WKE_WOO_Cart_Button_Widget() );

          include( 'widgets/woo-products.php' );
          $widgets_manager->register_widget_type( new WKE_WOO_Products_Widget() );

          include( 'widgets/woo-product-carousel.php' );
          $widgets_manager->register_widget_type( new WKE_WOO_Product_Carousel_Widget() );
      }

      if( class_exists( 'LearnPress' ) ) {
          include( 'widgets/learnpress-courses.php' );
          $widgets_manager->register_widget_type( new WKE_LearnPress_Courses_Widget() );

          include( 'widgets/learnpress-courses-carousel.php' );
          $widgets_manager->register_widget_type( new WKE_LearnPress_Courses_Carousel_Widget() );

          include( 'widgets/learnpress-become-a-teacher.php' );
          $widgets_manager->register_widget_type( new WKE_LP_Become_A_Teacher_Form_Widget() );
      }
   }

   // Load Widget Template
   public static function widget_template( $template_name,$settings ) {
          $templates = new WKE_Template_Loader();
          foreach( $settings as $key => $value ) {
              $data[$key] = $value;
          }

          ob_start();
          $templates
            ->set_template_data( $data, 'wke_data' )
            ->get_template_part( $template_name );
          echo ob_get_clean();
    }
}

WKE_Extend_Elementor::get_instance()->init();
