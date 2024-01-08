<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Countdown_Widget extends Widget_Base {

    public function get_name() {
        return 'countdown';
    }

    public function get_title() {
        return esc_html__( 'Countdown', 'wpkit-elementor' );
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return array( 'wpkit-common-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_countdown',
            [
                'label' => esc_html__( 'Countdown', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'due_date',
            [
                'label' => esc_html__( 'Due Date', 'wpkit-elementor' ),
                'type' => Controls_Manager::DATE_TIME,
                'default' => '2020/01/01 12:00:00',
                'description' => esc_html__( 'Date set according to your timezone:', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'expired_notice',
            [
                'label' => esc_html__( 'Expired Notice', 'wpkit-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'This offer has expired!',
                'description' => esc_html__( 'Show the text after the time is expired.', 'wpkit-elementor' ),

            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .countdown' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_countdown_style',
            [
                'label' => esc_html__('Title', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .countdown' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => esc_html__( 'Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .countdown',
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
