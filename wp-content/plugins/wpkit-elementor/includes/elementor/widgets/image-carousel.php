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

class WKE_Image_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'image-carousel';
    }

    public function get_title() {
        return apply_filters('wke_image_carousel_title',esc_html__('Image Carousel', 'wpkit-elementor'));
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_image_carousel_post',
            [
                'label' => esc_html__('Image Setting', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_carousel',
            [
                'label' => esc_html__( 'Images', 'wpkit-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'text' => esc_html__( 'Item #1 content', 'wpkit-elementor' ),
                    ]
                ],
                'fields' => [
                    [
                        'name' => 'image',
                        'label' => esc_html__( 'Upload Picture', 'wpkit-elementor' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'show_label' => true,
                    ],
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'wpkit-elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Item Title', 'wpkit-elementor' ),
                        'show_label' => true,
                    ],
                    [
                        'name' => 'content',
                        'label' => esc_html__( 'Content', 'wpkit-elementor' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => esc_html__( 'Item Content', 'wpkit-elementor' ),
                        'show_label' => true,
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__( 'Link', 'wpkit-elementor' ),
                        'type' => Controls_Manager::URL,
                        'show_label' => true,
                    ]
                ],
                'title_field' => '{{{ name }}}',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_image_carousel_slider',
            [
                'label' => esc_html__('Slider Setting', 'wpkit-elementor'),
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
                    'default' => esc_html__('Standard','wpkit-elementor'),
                    'overlay' => esc_html__('Overlay','wpkit-elementor'),
                )
            ]
        );

        $this->add_control(
            'columns',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Columns', 'wpkit-elementor'),
                'default' => '3',
                'description' => esc_html__('Set the number of grid columns when the screen size is bigger than 1024', 'wpkit-elementor'),
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
                'label' => esc_html__('Column Gap', 'wpkit-elementor'),
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
                'label' => esc_html__('Thumbnail Height', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-thumbnail' => 'height: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .wke-carousel'   => 'height:auto;'
                ],
                'description'  =>  esc_html__('You can adjust the thumbnail height for different devices. '),
                'default' => [
                    'size' => 250,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 600,
                        'step' => 1,
                    ]
                ]
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
            'section_image_carousel_grid_style',
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
            'section_images_carousel_title_style',
            [
                'label' => esc_html__('Title', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Title Color', 'wpkit-elementor'),
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke_carousel_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke_carousel_title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_images_carousel_content_style',
            [
                'label' => esc_html__('Content', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Content Text Color', 'wpkit-elementor'),
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke_carousel_excerpt' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Content Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke_carousel_excerpt',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_blog_caroursel_dot',
            [
                'label' => esc_html__('Pagination Dots', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label' => __( 'Dots Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ]
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
