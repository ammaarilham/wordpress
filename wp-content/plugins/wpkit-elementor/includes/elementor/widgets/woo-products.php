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

class WKE_WOO_Products_Widget extends Widget_Base {

    public function get_name() {
        return 'woo-products';
    }

    public function get_title() {
        return apply_filters('wke_woo_products_title',esc_html__('WC Product Grid', 'wpkit-elementor'));
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return array('wpkit-woocommerce-widget');
    }

    public function get_script_depends() {
        return [
            'jquery-masonry'
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_wc_products_content',
            [
                'label' => esc_html__('Content', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__('Number of Products Per Page', 'wpkit-elementor'),
                'default' => '6',
            ]
        );

        $this->add_control(
            'product_filter',
            [
                'label' => esc_html__( 'Product Data Filter', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => array(
                    '' => esc_html__('All Products','wpkit-elementor'),
                    '_featured' => esc_html__('Featured Products','wpkit-elementor'),
                    '_sale_price' => esc_html__('On Sale Products','wpkit-elementor'),
                )
            ]
        );


        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order By', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date' => esc_html__('Date','wpkit-elementor'),
                    'rand' => esc_html__('Random','wpkit-elementor'),
                )
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
            'featured_label',
            [
                'label' => esc_html__( 'Show Featured Label?', 'wpkit-elementor' ),
                'description' => esc_html__('Once a product is set as featured product, the featured label will display on the product thumbnail.', 'wpkit-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1'
            ]
        );

        $this->add_control(
            'onsale_label',
            [
                'label' => esc_html__( 'Show Sale Label?', 'wpkit-elementor' ),
                'description' => esc_html__('Once a product has on sale price, the sale label will display on the product thumbnail.', 'wpkit-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1'
            ]
        );

        $this->add_control(

            'category',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Categories', 'wpkit-elementor'),
                'default' => '',
                'description' => esc_html__('Specific the categories for the product grid. Multiple category should be separated by English comma.', 'wpkit-elementor'),
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


        $this->end_controls_section();


        $this->start_controls_section(
            'section_wc_products_layout',
            [
                'label' => esc_html__('Layout', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(

            'layout',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Layout', 'wpkit-elementor'),
                'default' => 'grid',
                'options' => array(
                    'grid' => esc_html__('Grid','wpkit-elementor'),
                    'masonry' => esc_html__('Masonry','wpkit-elementor'),
                )
            ]
        );

        $this->add_control(
            'center_text',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => esc_html__('Center Alignment', 'wpkit-elementor'),
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
                'condition' => [
                    'layout' => 'grid',
                ]
            ]
        );

        $this->add_control(

            'thumbnail',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Thumbnail Size', 'wpkit-elementor'),
                'default' => 'full',
                'options' => array(
                    'full' => esc_html__('Full Size','wpkit-elementor'),
                    'large' => esc_html__('Large','wpkit-elementor'),
                    'medium' => esc_html__('Medium','wpkit-elementor'),
                    'thumbnail' => esc_html__('Small','wpkit-elementor'),
                ),
                'condition' => [
                    'layout' => 'masonry',
                ],
            ]
        );


        $this->add_control(
            'columns',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Grid Columns', 'wpkit-elementor'),
                'default' => '3',
                'description' => esc_html__('Set the number of grid columns', 'wpkit-elementor'),
                'options' => [
                    '2' => esc_html__( '2 Columns', 'wpkit-elementor' ),
                    '3' => esc_html__( '3 Columns', 'wpkit-elementor' ),
                    '4' => esc_html__( '4 Columns', 'wpkit-elementor' ),
                ]
            ]
        );

        $this->add_responsive_control(

            'thumbnail_height',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Thumbnail Height', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-grid-item .wke-grid-thumbnail' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'description'  =>  esc_html__('Only when the thumbnail container height is not correct, then you should adjust this value. '),
                'default' => [
                    'size' => 300,
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
            'grid_style',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Grid Style', 'wpkit-elementor'),
                'default' => 'default',
                'description' => esc_html__('Set the number of grid columns', 'wpkit-elementor'),
                'options' => [
                    'default' => esc_html__( 'Thumbnail + Title + Price', 'wpkit-elementor' ),
                    'overlap' => esc_html__( 'Thumbnail With Hover Effect', 'wpkit-elementor' )
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selectors' => [
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay a.title' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay h3.title' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'grid_style' => 'overlap',
                ],
            ]
        );

         $this->add_responsive_control(

            'overlay_title_size',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Title Size In The Overlay', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay a.title' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay h3.title' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'description'  =>  esc_html__('Change the font size of the title in the overlay'),
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'em', 'px' ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => 12,
                        'max' => 32,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'grid_style' => 'overlap',
                ],
            ]
        );

        $this->add_responsive_control(

            'overlay_title_line_height',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Line Height', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay a.title' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail .overlay h3.title' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'description'  =>  esc_html__('Change the font size of the title in the overlay'),
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'em', 'px' ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => 12,
                        'max' => 32,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'grid_style' => 'overlap',
                ],
            ]
        );

        $this->add_responsive_control(

            'standard_title_size',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Standard Title Size', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-title a:first-child' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'description'  =>  esc_html__('Change the line height of the title in the default grid style.','wpkit-elementor'),
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'em', 'px' ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => 12,
                        'max' => 50,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'grid_style' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(

            'standard_title_line_height',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Line Height', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-title a:first-child' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'description'  =>  esc_html__('Change the line heigt of the title in the default grid style.'),
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'em', 'px' ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => 12,
                        'max' => 32,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'grid_style' => 'default',
                ],
            ]
        );

        $this->add_control(

            'standard_title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Standard Title Color', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-title a' => 'color: {{VALUE}};',
                ],
                'description'  =>  esc_html__('Change the title color in the default grid style.','wpkit-elementor'),
                'default' => '',
                'condition' => [
                    'grid_style' => 'default',
                ],
            ]
        );

        $this->add_control(

            'border_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Border Color', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-grids .wke-grid-item .wke-grid-thumbnail.product-showcase' => 'border:1px solid {{VALUE}};',
                ],
                'description'  =>  esc_html__('Change the thumbnail border color.','wpkit-elementor'),
                'default' => ''
            ]
        );

         $this->add_control(

            'shape',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Grid Shape', 'wpkit-elementor'),
                'default' => 'square',
                'options' => array(
                    'square' => esc_html__('Square','wpkit-elementor'),
                    'round' => esc_html__('Round','wpkit-elementor'),
                ),
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
                'return_value' => 'no-margin',
                'condition' => [
                    'grid_style' => 'overlap',
                ],
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
