<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_WOO_Cart_Button_Widget extends Widget_Base {

    public function get_name() {
        return 'woo-cart-button';
    }

    public function get_title() {
        return apply_filters('wke_woo_cart_button_title',esc_html__('WC Cart Button', 'wpkit-elementor'));
    }

    public function get_icon() {
        return 'eicon-cart-medium';
    }

    public function get_categories() {
        return array('wpkit-woocommerce-widget');
    }

    public function get_products(){
         $products = get_posts(array('posts_per_page'=>'-1','post_type'=>'product'));
         $product_ids = array(''=>'Please Select');

         foreach($products as $product){
            $product_ids[$product->ID] = get_the_title($product->ID);
         }

        return $product_ids;

    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_wc_products_text',
            [
                'label' => esc_html__('WooCommerce Button', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_id',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Select Product', 'wpkit-elementor'),
                'options' => self::get_products(),
            ]
        );

        $this->add_control(
            'action',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Click Action', 'wpkit-elementor'),
                'default' => 'ajax',
                'description' => esc_html__('Standard or outline style.', 'wpkit-elementor'),
                'options' => [
                    'ajax' => esc_html__( 'Ajax', 'wpkit-elementor' ),
                    'redirect' => esc_html__( 'Redirect', 'wpkit-elementor' ),
                ]
            ]
        );


        $this->add_control(
            'button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button Text', 'wpkit-elementor'),
                'default' => 'Buy Now',
                'prefix_class' => 'tmvc-wc-button-text-',
            ]
        );


        $this->add_control(
            'extra_class',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Extra Class', 'wpkit-elementor'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpkit-elementor'),
            ]
        );


        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'wpkit-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => array(
                    'left'    => array(
                        'title' => esc_html__( 'Left', 'wpkit-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'wpkit-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__( 'Right', 'wpkit-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ),
                ),
                'selectors' => [
                    '{{WRAPPER}} .wke-button-container' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_wc_products_style',
            [
                'label' => esc_html__('Button Style', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Button Style', 'wpkit-elementor'),
                'default' => 'stardard',
                'description' => esc_html__('Standard or outline style.', 'wpkit-elementor'),
                'options' => array(
                    'standard' => esc_html__( 'Standard', 'wpkit-elementor' ),
                    'outline' => esc_html__( 'Outline', 'wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(
            'shape',
            [
                'label' => esc_html__( 'Button Shape', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'square',
                'options' => array(
                    'square' => esc_html__('Square','wpkit-elementor'),
                    'round' => esc_html__('Round','wpkit-elementor'),
                    'rounded' => esc_html__('Rounded','wpkit-elementor'),
                )
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => esc_html__( 'Button Size', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => array(
                    'normal' => esc_html__('Normal','wpkit-elementor'),
                    'medium' => esc_html__('Medium','wpkit-elementor'),
                    'large' => esc_html__('Large','wpkit-elementor'),
                )
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( 'Button Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff'
            ]
        );



        $this->end_controls_section();

    }

    protected function render() {
        WKE_Extend_Elementor::widget_template(self::get_name(),$this->get_settings());
    }

    protected function content_template() {

    }

}
