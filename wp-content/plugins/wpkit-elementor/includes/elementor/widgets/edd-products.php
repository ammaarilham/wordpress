<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_EDD_Products_Widget extends Widget_Base {

    public function get_name() {
        return 'edd-products';
    }

    public function get_title() {
        return apply_filters( 'wke_edd_products_title', esc_html__('EDD Products', 'wpkit-elementor') );
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return array( 'wpkit-edd-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_edd_products_content',
            [
                'label' => esc_html__( 'Downloads Data', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(

            'number',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'The number of downloads per page', 'wpkit-elementor' ),
                'default' => '6',
                'prefix_class' => 'wke-edd-products-number-',
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
                'description' => esc_html__(' Specific the categories for the product grid. Multiple category should be separated by English comma.', 'wpkit-elementor' ),
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
            'section_edd_products_general',
            [
                'label' => esc_html__( 'General', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
                    'size' => 180,
                ],
                'range' => [
                    'px' => [
                        'min' => 150,
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
                'default' => 'full',
                'prefix_class' => 'wke-edd-products-thumbnail-',
                'description' => esc_html__( 'The thumbnail size options: thumbnail, medium, large, full', 'wpkit-elementor' ),
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
                'default' => '1',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_edd_products_style',
            [
                'label' => esc_html__( 'Style', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'grid_style',
            [
                'label' => esc_html__( 'Grid Style', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => array(
                    'default' => esc_html__( 'Thumbnail + Title', 'wpkit-elementor' ),
                    'overlay' => esc_html__( 'Only Thumbnail', 'wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(

            'overlay_title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay h3.title, {{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay a.title' => 'color: {{VALUE}};',
                ],
                'description'  =>  esc_html__( 'Change the title color in the default grid style.', 'wpkit-elementor' ),
                'default' => '',
                'condition' => [
                    'grid_style' => 'overlay',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'overlay_title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay h3.title, {{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay a.title',
                'condition' => [
                    'grid_style' => 'overlay',
                ],
            ]
        );

        $this->add_control(

            'standard_title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Standard Title Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids.wke-grid-style-default .wke-grid-item .wke-grid-title a' => 'color: {{VALUE}};',
                ],
                'description'  =>  esc_html__( 'Change the title color in the default grid style.', 'wpkit-elementor' ),
                'default' => '',
                'condition' => [
                    'grid_style' => 'default',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'standard_title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-grids.wke-grid-style-default .wke-grid-item .wke-grid-title a',
                'condition' => [
                    'grid_style' => 'default',
                ],
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
    }

    protected function render() {
        WKE_Extend_Elementor::widget_template( self::get_name(), $this->get_settings() );
    }

    protected function content_template() {

    }

}
