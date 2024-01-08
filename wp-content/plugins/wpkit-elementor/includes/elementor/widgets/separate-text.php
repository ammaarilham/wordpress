<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Separate_Text_Widget extends Widget_Base {

    public function get_name() {
        return 'separate-text';
    }

    public function get_title() {
        return apply_filters('wke_separate_text_title',esc_html__('Separate Text', 'wpkit-elementor'));
    }

    public function get_icon() {
        return 'eicon-divider';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_separate_text',
            [
                'label' => esc_html__('Text Settings', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text',
            [
                'label'    => esc_html__( 'Separate Text', 'wpkit-elementor' ),
                'type'     => Controls_Manager::TEXT,
                'default'  => 'Sub Heading',
                'selector' => '{{WRAPPER}} .wke-separate-text h3'
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
                'default' => 'center'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__('Text Color', 'wpkit-elementor'),
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-separate-text h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_width',
            [
                'label' => esc_html__( 'Text Width', 'wpkit-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 33,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wke-separate-text h3' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_border_weight',
            [
                'label'   => esc_html__( 'Text Border Width', 'wpkit-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wke-separate-text h3'     => 'border-width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'txt_typography',
                'label'    => esc_html__( 'Typography', 'wpkit-elementor' ),
                'scheme'   => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-separate-text h3',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_separate_line',
            [
                'label' => esc_html__('Separate Line Settings', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'line_style',
            [
                'label' => esc_html__( 'Line Style', 'wpkit-elementor' ),
                'type'  => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => array(
                    'solid'  => esc_html__('Solid','wpkit-elementor'),
                    'dotted' => esc_html__('Dotted','wpkit-elementor'),
                    'dashed' => esc_html__('dashed','wpkit-elementor'),
                    'double' => esc_html__('Double','wpkit-elementor'),
                ),
                'selectors' => [
                    '{{WRAPPER}} .wke-separate-text:before' => 'border-style:{{VALUE}};',
                    '{{WRAPPER}} .wke-separate-text:after'  => 'border-style:{{VALUE}};',
                    '{{WRAPPER}} .wke-separate-text h3'  => 'border-style:{{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'weight',
            [
                'label'   => esc_html__( 'Line Weight', 'wpkit-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wke-separate-text:before' => 'border-top-width:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wke-separate-text:after' => 'border-top-width:{{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'color',
            [
                'label'    => esc_html__( 'Color', 'wpkit-elementor' ),
                'type'     => Controls_Manager::COLOR,
                'default'  => '',
                'scheme'   => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_3,
                ],
                'selectors' => [
                     '{{WRAPPER}} .wke-separate-text:before' => 'border-color: {{VALUE}};',
                     '{{WRAPPER}} .wke-separate-text:after' => 'border-color: {{VALUE}};',
                     '{{WRAPPER}} .wke-separate-text h3' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'wpkit-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wke-separate-text:before' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wke-separate-text:after' => 'width: {{SIZE}}{{UNIT}};',
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
