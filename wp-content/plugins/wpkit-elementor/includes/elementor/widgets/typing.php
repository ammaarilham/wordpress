<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Typing_Widget extends Widget_Base {

    public function get_name() {
        return 'typing';
    }

    public function get_title() {
        return esc_html__('Typing', 'wpkit-elementor');
    }

    public function get_icon() {
        return 'fa fa-pencil';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_typing_text',
            [
                'label' => esc_html__('Typing', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(

            'static_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Static Text', 'wpkit-elementor'),
                'prefix_class' => 'tmvc-typing-',
            ]
        );

        $this->add_control(

            'typing_text',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Typing Text', 'wpkit-elementor'),
                'description' => esc_html__('One sentence or word per line.', 'wpkit-elementor'),
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

        $this->add_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'wpkit-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => array(
                    'left'    => array(
                        'title' => esc_html__( 'Left', 'wpkit-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'wpkit-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__( 'Right', 'wpkit-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ),
                ),
                'selectors' => [
                    '{{WRAPPER}} .wke-typing-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_typing_style',
            [
                'label' => esc_html__('Text', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-typing-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-typing-text',
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
