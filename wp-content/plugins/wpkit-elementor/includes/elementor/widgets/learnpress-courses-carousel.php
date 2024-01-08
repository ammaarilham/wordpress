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

class WKE_LearnPress_Courses_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'learnpress-courses-carousel';
    }

    public function get_title() {
        return apply_filters( 'wke_learnpress_courses_carousel_title', esc_html__( 'Courses Carousel', 'wpkit-elementor') );
    }

    public function get_icon() {
        return 'eicon-media-carousel';
    }

    public function get_categories() {
        return array( 'wpkit-lp-widget' );
    }

    public function get_script_depends() {
        return [];
   }

    protected function register_controls() {

        $this->start_controls_section(
            'section_learnpress_courses_carousel_post',
            [
                'label' => esc_html__( 'Courses Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'Number of Courses', 'wpkit-elementor' ),
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
                'description' => esc_html__( 'Specific the categories for the courses. Multiple category should be separated by English comma.', 'wpkit-elementor' ),
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_learnpress_courses_carousel_slider',
            [
                'label' => esc_html__( 'Carousel Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
                    'size' => 220,
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
            'show_category',
            [
                'label' => esc_html__( 'Show Category', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'show_students_count',
            [
                'label' => esc_html__( 'Show Enrolled Students Count', 'wpkit-elementor' ),
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
            'section_learnpress_courses_carousel_grid_style',
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
            'section_learnpress_courses_carousel_title_style',
            [
                'label' => esc_html__('Title', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_single_line',
            [
                'label' => esc_html__( 'Single Line Title', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 'single-line',
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

        $this->add_control(
            'title_hover_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Title Hover Color', 'wpkit-elementor' ),
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-title a:hover' => 'color: {{VALUE}}',
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
            'section_learnpress_courses_carousel_price_style',
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
                'label' => esc_html__( 'Price Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-carousel-price',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_learnpress_courses_carousel_meta_style',
            [
                'label' => esc_html__( 'Meta Text', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Meta Text Color', 'wpkit-elementor' ),
                'default' => '#aaaaaa',
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-meta' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__( 'Meta Text Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-carousel-price',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_learnpress_courses_carousel_category_style',
            [
                'label' => esc_html__( 'Category Text', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'category_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Category Text Color', 'wpkit-elementor' ),
                'default' => '#aaaaaa',
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-footer a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'category_hover_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Category Link Hover Color', 'wpkit-elementor' ),
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-carousel-footer a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => esc_html__( 'Category Text Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-carousel-footer',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_learnpress_courses_carousel_overlay_style',
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
            'section_learnpress_courses_carousel_icon_style',
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
        WKE_Extend_Elementor::widget_template( self::get_name(), $this->get_settings() );
    }

    protected function content_template() {

    }

}
