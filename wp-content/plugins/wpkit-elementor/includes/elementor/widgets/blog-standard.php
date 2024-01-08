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

class WKE_Blog_Standard_Widget extends Widget_Base {

    public function get_name() {
        return 'blog-standard';
    }

    public function get_title() {
        return apply_filters( 'wke_blog_standard_title', esc_html__( 'Blog Standard', 'wpkit-elementor' ) );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return array( 'wpkit-common-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_blog_standard_post',
            [
                'label' => esc_html__( 'Post Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'Number of Posts', 'wpkit-elementor' ),
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
                    'desc' => esc_html__('Desc','wpkit-elementor' ),
                    'asc' => esc_html__('Asc','wpkit-elementor' ),
                )
            ]
        );


        $this->add_control(

            'category',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Categories', 'wpkit-elementor' ),
                'default' => '',
                'description' => esc_html__( 'Specific the categories for the posts. Multiple category should be separated by English comma.', 'wpkit-elementor' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_blog_standard_general',
            [
                'label' => esc_html__( 'General Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__( 'Enable Pagination', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'social_share',
            [
                'label' => esc_html__( 'Show Social Share Icons', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 1,
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 1,
            ]
        );

        $this->add_control(
            'post_meta_date',
            [
                'label' => esc_html__( 'Show Post Date', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 1,
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 1,
            ]
        );

        $this->add_control(
            'post_meta_category',
            [
                'label' => esc_html__( 'Show Post Category', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 1,
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 1,
            ]
        );

        $this->add_control(
            'post_meta_author',
            [
                'label' => esc_html__( 'Show Post Author', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 1,
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 1,
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

        $this->start_controls_section(
            'section_standard_blog_listing_style',
            [
                'label' => esc_html__('Listing Style', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'boxed',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => esc_html__( 'Boxed', 'wpkit-elementor' ),
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
                'label' => esc_html__( 'Background Color', 'wpkit-elementor' ),
                'default' => '#f8f8f8',
                'selectors' => [
                    '{{WRAPPER}} .wke-standard-blog.boxed .wke-post' => 'background: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .wke-standard-blog.boxed .wke-post',
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
                    '{{WRAPPER}} .wke-standard-blog.boxed .wke-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .wke-standard-blog.boxed .wke-post',
                'condition' => [
                    'boxed' => 'boxed'
                ]
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_blog_standard_title_style',
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
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-post-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Title Hover Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-post-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-post-title a',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_blog_standard_excerpt_style',
            [
                'label' => esc_html__( 'Excerpt', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Excerpt Color', 'wpkit-elementor' ),
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .wke-post-excerpt' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__( 'Excerpt Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-post-excerpt',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_blog_standard_thubmnail_style',
            [
                'label' => esc_html__( 'Thumbnail', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_thumbnail',
            [
                'label' => esc_html__( 'Show Featured Image', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'thumbnail_align',
            [
                'label'   => esc_html__( 'Alignment', 'wpkit-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'wpkit-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'none' => [
                        'title' => esc_html__( 'None', 'wpkit-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'wpkit-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'none',
                'condition' => [
                    'show_thumbnail' => '1',
                ]
            ]
        );

        $this->add_responsive_control(

            'thumbnail_width',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Thumbnail Width', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-post-thumbnail' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                'description'  =>  esc_html__( 'You can adjust the thumbnail width for different devices. ', 'wpkit-elementor' ),
                'default' => [
                    'size' => 300,
                ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 600,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'show_thumbnail' => '1',
                    'thumbnail_align' => 'left',
                ],
            ]
        );

        $this->add_responsive_control(

            'thumbnail_width2',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Thumbnail Width', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-post-thumbnail' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                'description'  =>  esc_html__( 'You can adjust the thumbnail width for different devices. ', 'wpkit-elementor' ),
                'default' => [
                    'size' => 300,
                ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 600,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'show_thumbnail' => '1',
                    'thumbnail_align' => 'right'
                ],
            ]
        );

        $this->add_responsive_control(

            'thumbnail_height',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Thumbnail Height', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-post-thumbnail' => 'height: {{SIZE}}{{UNIT}};'
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
                ],
                'condition' => [
                    'show_thumbnail' => '1',
                    'thumbnail_align' => 'none'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        WKE_Extend_Elementor::widget_template( self::get_name(),$this->get_settings() );
    }

    protected function content_template() {

    }

}
