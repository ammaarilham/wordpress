<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_EDD_Product_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'edd-product-carousel';
    }

    public function get_title() {
        return apply_filters( 'wke_edd_product_carousel_title', esc_html__( 'EDD Product Carousel', 'wpkit-elementor') );
    }

    public function get_icon() {
        return 'eicon-media-carousel';
    }

    public function get_categories() {
        return array( 'wpkit-edd-widget' );
    }

    public function get_script_depends() {
        return [];
   }

    protected function register_controls() {

        $this->start_controls_section(
            'section_edd_product_carousel_post',
            [
                'label' => esc_html__( 'Product Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'Number of Products', 'wpkit-elementor' ),
                'default' => '6',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Order By', 'wpkit-elementor' ),
                'default' => 'date',
                'options' => array(
                    'date' => esc_html__( 'Date', 'wpkit-elementor' ),
                    'rand' => esc_html__( 'Random', 'wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
                    'desc' => esc_html__('Desc','wpkit-elementor'),
                    'asc' => esc_html__('Asc','wpkit-elementor'),
                )
            ]
        );

        $this->add_control(

            'category',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Categories', 'wpkit-elementor' ),
                'default' => '',
                'description' => esc_html__( 'Specific the categories for the products. Multiple category should be separated by English comma.', 'wpkit-elementor' ),
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_edd_product_carousel_slider',
            [
                'label' => esc_html__( 'Carousel Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'grid_style',
            [
                'label' => esc_html__( 'Grid Style', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => array(
                    'default' => esc_html__( 'Standard','wpkit-elementor' ),
                    'overlay' => esc_html__( 'Overlay','wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(
            'columns',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Columns', 'wpkit-elementor' ),
                'default' => '3',
                'description' => esc_html__( 'Set the number of grid columns when the screen size is bigger than 1024', 'wpkit-elementor' ),
                'options' => [
                    '1' => esc_html__( '1 Column', 'wpkit-elementor' ),
                    '2' => esc_html__( '2 Columns', 'wpkit-elementor' ),
                    '3' => esc_html__( '3 Columns', 'wpkit-elementor' ),
                    '4' => esc_html__( '4 Columns', 'wpkit-elementor' )
                ]
            ]
        );

        $this->add_control(
            'gap',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Column Gap', 'wpkit-elementor' ),
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ]
                ],
                'size_units' => [ 'px' ],
            ]
        );

        $this->add_responsive_control(

            'thumbnail_height',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Thumbnail Height', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-thumbnail' => 'height: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .wke-carousel'   => 'height:auto;'
                ],
                'description'  =>  esc_html__( 'You can adjust the thumbnail height for different devices. ', 'wpkit-elementor' ),
                'default' => [
                    'size' => 250,
                ],
                'range' => [
                    'px' => [
                        'min' => 180,
                        'max' => 600,
                        'step' => 1,
                    ]
                ]
            ]
        );

        $this->add_control(
            'show_price',
            [
                'label' => esc_html__( 'Show Price', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label' => esc_html__( 'Show Cart Button', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '1',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'hover_effect',
            [
                'label' => esc_html__( 'Hover Effect', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 'scale',
            ]
        );

        $this->add_control(

            'shape',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Grid Shape', 'wpkit-elementor' ),
                'default' => 'square',
                'options' => array(
                    'square' => esc_html__( 'Square', 'wpkit-elementor' ),
                    'round' => esc_html__( 'Round','wpkit-elementor' ),
                )
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_edd_carousel_grid_style',
            [
                'label' => esc_html__('Grid', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'boxed',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => esc_html__( 'Boxed Style', 'wpkit-elementor' ),
                'default' => '',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 'boxed'
            ]
        );

        $this->add_control(
            'item_bg_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Grid Item Background Color', 'wpkit-elementor' ),
                'default' => '#f9f9f9',
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel .swiper-slide.boxed' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'boxed' => 'boxed',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .wke-carousel .swiper-slide.boxed',
                'separator' => 'before',
                'condition' => [
                    'boxed' => 'boxed'
                ]
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => __( 'Border Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'boxed' => 'boxed'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .wke-carousel .swiper-slide.boxed',
                'condition' => [
                    'boxed' => 'boxed'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_edd_product_carousel_title_style',
            [
                'label' => esc_html__('Title', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-carousel-title a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_edd_product_carousel_price_style',
            [
                'label' => esc_html__( 'Price', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Price Color', 'wpkit-elementor' ),
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-carousel-price',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_edd_product_carousel_overlay_style',
            [
                'label' => esc_html__( 'Overlay', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

         $this->add_control(
            'overlay_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Overlay Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_edd_product_carousel_icon_style',
            [
                'label' => esc_html__( 'Icon', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'view_icon_bg_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'View Icon Background Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-button.view, {{WRAPPER}} .wke-carousel-button.details' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'view_icon_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'View Icon Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-button.view, {{WRAPPER}} .wke-carousel-button.details' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_bg_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Cart Icon Background Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-button.buy' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Cart Icon Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-button.buy' => 'color: {{VALUE}}',
                ],
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
