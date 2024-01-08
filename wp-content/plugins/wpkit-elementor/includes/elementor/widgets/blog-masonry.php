<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Blog_Masonry_Widget extends Widget_Base {

    public function get_name() {
        return 'blog-masonry';
    }

    public function get_title() {
        return apply_filters( 'wke_blog_masonry_title', esc_html__( 'Blog Masonry', 'wpkit-elementor' ) );
    }

    public function get_icon() {
        return 'eicon-posts-masonry';
    }

    public function get_categories() {
        return array( 'wpkit-common-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_blog_masonry_post',
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
            'section_blog_masonry_general',
            [
                'label' => esc_html__( 'General Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'columns-3',
                'options' => array(
                    'columns-2' => esc_html__( '2 Columns', 'wpkit-elementor' ),
                    'columns-3' => esc_html__( '3 Columns', 'wpkit-elementor' ),
                    'columns-4' => esc_html__( '4 Columns','wpkit-elementor' ),
                    'columns-5' => esc_html__( '5 Columns','wpkit-elementor' ),
                )
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => esc_html__( 'Grid Gap', 'wpkit-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wke-masonry-blog' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
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
            'section_blog_masonry_title_style',
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
            'section_blog_masonry_excerpt_style',
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
    }

    protected function render() {
        WKE_Extend_Elementor::widget_template( self::get_name(),$this->get_settings() );
    }

    protected function content_template() {

    }

}
