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

class WKE_LearnPress_Courses_Widget extends Widget_Base {

    public function get_name() {
        return 'learnpress-courses';
    }

    public function get_title() {
        return apply_filters( 'wke_learnpress_courses_title', esc_html__('LearnPress Courses', 'wpkit-elementor') );
    }

    public function get_icon() {
        return 'eicon-apps';
    }

    public function get_categories() {
        return array( 'wpkit-lp-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_learnpress_courses_content',
            [
                'label' => esc_html__( 'Courses Data', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(

            'number',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'The number of courses per page', 'wpkit-elementor' ),
                'default' => '6',
                'prefix_class' => 'wke-lp-courses-number-',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order By', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date' => esc_html__( 'Date', 'wpkit-elementor' ),
                    'rand' => esc_html__( 'Random','wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(

            'category',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Categories', 'wpkit-elementor' ),
                'default' => '',
                'description' => esc_html__(' Specific the categories for the courses loop. Multiple category should be separated by English comma.', 'wpkit-elementor' ),
            ]
        );


        $this->add_control(

            'extra_class',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Extra Class', 'wpkit-elementor' ),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpkit-elementor'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_learnpress_courses_general',
            [
                'label' => esc_html__( 'General', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(

            'columns',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Columns', 'wpkit-elementor' ),
                'default' => '3',
                'description' => esc_html__( 'Two or three columns of the grid.', 'wpkit-elementor' ),
                'options' => array(
                    '1' => esc_html__( '1 Column', 'wpkit-elementor' ),
                    '2' => esc_html__( '2 Columns', 'wpkit-elementor' ),
                    '3' => esc_html__( '3 Columns', 'wpkit-elementor' ),
                    '4' => esc_html__( '4 Columns', 'wpkit-elementor' ),
                )
            ]
        );

        $this->add_responsive_control(

            'min_height',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Thumbnail Mini Height', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-grid-thumbnail' => 'height: {{SIZE}}{{UNIT}}!important;',
                ],
                'description'  => esc_html__( 'Only when the thumbnail container height is not correct, then you should adjust this value. ', 'wpkit-elementor'),
                'default' => [
                    'size' => 230,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 600,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_control(

            'thumbnail',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Thumbnail Size', 'wpkit-elementor' ),
                'default' => 'large',
                'prefix_class' => 'wke-edd-products-thumbnail-',
                'description' => esc_html__( 'The thumbnail size options: thumbnail, medium, large, full', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__( 'Enable Pagination?', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__('Infinite Scroll', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => false,
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => true,
                'condition' => [
                    'pagination' => '1',
                ],
            ]
        );

        $this->add_control(
            'show_price',
            [
                'label' => esc_html__( 'Show Price', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '1',
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
                'default' => '1',
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

        $this->add_control(

            'layout',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Layout', 'wpkit-elementor' ),
                'default' => 'grid',
                'options' => array(
                    'grid' => esc_html__( 'Grid','wpkit-elementor' ),
                    'masonry' => esc_html__( 'Masonry', 'wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(
            'no_margin',
            [
                'label' => esc_html__( 'No Margin Space', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 'no_margin',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_learnpress_courses_grid_style',
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
                    '{{WRAPPER}} .wke-grids .wke-grid-item.boxed' => 'background: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .wke-grids .wke-grid-item.boxed',
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
                    '{{WRAPPER}} .wke-grids .wke-grid-item.boxed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .wke-grids .wke-grid-item.boxed',
                'condition' => [
                    'boxed' => 'boxed'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_learnpress_courses_title',
            [
                'label' => esc_html__( 'Title', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(

            'title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids.wke-grid-style-default .wke-grid-item .wke-grid-title a' => 'color: {{VALUE}};',
                ],
                'description'  =>  esc_html__( 'Change the title color in the default grid style.', 'wpkit-elementor' ),
                'default' => '#000000',
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Title Hover Color', 'wpkit-elementor' ),
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .wke-grids.wke-grid-style-default .wke-grid-item .wke-grid-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_single_line',
            [
                'label' => esc_html__( 'Single Line Display', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 'single-line',
            ]
        );

        $this->add_responsive_control(

            'title_space',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Space', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids.wke-grid-style-default .wke-grid-item .wke-grid-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'description'  => esc_html__( 'The margin bottom space of the title. ', 'wpkit-elementor'),
                'default' => [
                    'size' => 5,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-grids.wke-grid-style-default .wke-grid-item .wke-grid-title a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_learnpress_courses_price',
            [
                'label' => esc_html__( 'Price', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Price Text Color', 'wpkit-elementor' ),
                'default' => '#aaaaaa',
                'selectors' => [
                    '{{WRAPPER}} .wke-grid-price' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => esc_html__( 'Price Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-grid-price',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_learnpress_courses_meta',
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
                    '{{WRAPPER}} .wke-grid-meta' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__( 'Meta Text Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-grid-meta',
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
                    '{{WRAPPER}} .wke-grid-footer a' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .wke-grid-footer a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => esc_html__( 'Category Text Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-grid-footer',
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
