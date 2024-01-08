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

class WKE_Testimonials_Widget extends Widget_Base {

    public function get_name() {
        return 'testimonials';
    }

    public function get_title() {
        return esc_html__('Testimonials', 'wpkit-elementor');
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_testimonials',
            [
                'label' => esc_html__('Testimonials', 'wpkit-elementor'),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials', 'wpkit-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'said' => esc_html__( 'Item #1 content', 'wpkit-elementor' ),
                    ]
                ],
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => esc_html__( 'Customer Name', 'wpkit-elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Customer Name', 'wpkit-elementor' ),
                        'show_label' => true,
                    ],
                    [
                        'name' => 'job',
                        'label' => esc_html__( 'Job Position', 'wpkit-elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Designer', 'wpkit-elementor' ),
                        'show_label' => true,
                    ],
                    [
                        'name' => 'avatar',
                        'label' => esc_html__( 'Customer Avatar', 'wpkit-elementor' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'show_label' => true,
                    ],
                    [
                        'name' => 'said',
                        'label' => esc_html__( 'Content', 'wpkit-elementor' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        'show_label' => false,
                    ]
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonial_slider',
            [
                'label' => esc_html__('Slider Settings', 'wpkit-elementor'),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'   => esc_html__( 'Alignment', 'wpkit-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'wpkit-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wpkit-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'wpkit-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .wke-testimonials' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'slide_style',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Slide Style', 'wpkit-elementor'),
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__( 'Normal', 'wpkit-elementor' ),
                    'boxed' => esc_html__( 'Boxed', 'wpkit-elementor' )
                ]
            ]
        );

        $this->add_control(
            'columns',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Columns', 'wpkit-elementor'),
                'default' => '1',
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

        $this->add_control(

            'extra_class',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Extra Class', 'wpkit-elementor'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpkit-elementor'),
            ]
        );

        $this->end_controls_section();

        //Style Tab
        $this->start_controls_section(
            'section_testimonials_style',
            [
                'label' => esc_html__('Slide Text', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'quotation_color',
            [
                'label' => esc_html__( 'Quotation Marks Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#dddddd',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-text::before,{{WRAPPER}} .testimonial-text::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_content',
                'label' => esc_html__( 'Content Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .testimonial-text',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__( 'Name Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-testimonials .author' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_name',
                'label' => esc_html__( 'Name Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-testimonials .author',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#999999',
                'selectors' => [
                    '{{WRAPPER}} .wke-testimonials .author em' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_title',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-testimonials .author em',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonial_slide_style',
            [
                'label' => esc_html__('Slide Box', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slide_style' => 'boxed'
                ]
            ]
        );

        $this->add_control(
            'slide_background_color',
            [
                'label' => __( 'Slide Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-testimonials .swiper-slide' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slide_style' => 'boxed'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slide_border',
                'selector' => '{{WRAPPER}} .wke-testimonials .swiper-slide',
                'separator' => 'before',
                'condition' => [
                    'slide_style' => 'boxed'
                ]
            ]
        );

        $this->add_control(
            'slide_border_radius',
            [
                'label' => __( 'Border Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-testimonials .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slide_style' => 'boxed'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'slide_box_shadow',
                'selector' => '{{WRAPPER}} .wke-testimonials .swiper-slide',
                'condition' => [
                    'slide_style' => 'boxed'
                ]
            ]
        );

        $this->add_responsive_control(
            'slide_padding',
            [
                'label' => __( 'Padding', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-testimonials .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'slide_style' => 'boxed'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonial_dot',
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
        WKE_Extend_Elementor::widget_template(self::get_name(), $this->get_settings());
    }

    protected function content_template() {

    }

}
