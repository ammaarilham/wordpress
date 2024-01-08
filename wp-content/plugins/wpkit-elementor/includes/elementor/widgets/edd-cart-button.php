<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_EDD_Cart_Button_Widget extends Widget_Base {

    public function get_name() {
        return 'edd-cart-button';
    }

    public function get_title() {
        return apply_filters( 'wke_edd_cart_button_title', esc_html__( 'EDD Cart Button', 'wpkit-elementor' ) );
    }

    public function get_icon() {
        return 'eicon-cart-solid';
    }

    public function get_categories() {
        return array( 'wpkit-edd-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_edd_products_text',
            [
                'label' => apply_filters( 'wke_edd_cart_button_title', esc_html__( 'EDD Cart Button', 'wpkit-elementor' ) ),
            ]
        );

        $this->add_control(

            'product_id',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'Product ID', 'wpkit-elementor' ),
                'default' => '',
                'prefix_class' => 'wke-edd-products-id-',
            ]
        );

        $this->add_control(

            'price_id',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'Price ID', 'wpkit-elementor' ),
                'default' => '',
                'prefix_class' => 'wke-edd-price-id-',
            ]
        );


        $this->add_control(

            'button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Button Text', 'wpkit-elementor' ),
                'default' => 'Buy Now',
                'prefix_class' => 'wke-edd-button-text-',
            ]
        );

        $this->add_control(

            'style',
            [
                'type' => Controls_Manager::CHOOSE,
                'label' => esc_html__( 'Button Style', 'wpkit-elementor' ),
                'default' => 'stardard',
                'description' => esc_html__( 'Standard or outline style.', 'wpkit-elementor' ),
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
                    'square' => esc_html__( 'Square','wpkit-elementor' ),
                    'round' => esc_html__( 'Round','wpkit-elementor' ),
                    'rounded' => esc_html__( 'Rounded','wpkit-elementor' ),
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
                    'normal' => esc_html__( 'Normal', 'wpkit-elementor' ),
                    'medium' => esc_html__( 'Medium', 'wpkit-elementor' ),
                    'large' => esc_html__( 'Large', 'wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(
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
                )
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( 'Button Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000'
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

        $this->add_control(

            'extra_class',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Extra Class', 'wpkit-elementor' ),
                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpkit-elementor' ),
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        WKE_Extend_Elementor::widget_template( self::get_name(), $this->get_settings() );
    }

    protected function content_template() {

    }

}
