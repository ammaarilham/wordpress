<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Interactive_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'interactive-banner';
    }

    public function get_title() {
        return esc_html__('Interactive Banner', 'wpkit-elementor');
    }

    public function get_icon() {
        return 'fa fa-photo';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_interactive_banner',
            [
                'label' => esc_html__('Interactive Banner', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'picture',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Upload Picture', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'link',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Picture Link', 'wpkit-elementor'),
                'description' => esc_html__('Don\'t forget add http:// or https://' , 'wpkit-elementor'),
            ]
        );

        $this->add_control(
            'link_target',
            [
                'label' => esc_html__( 'Link Target', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '_self',
                'options' => array(
                    '_self' => esc_html__('Open in the same window', 'wpkit-elementor'),
                    '_blank' => esc_html__('Open in the new window', 'wpkit-elementor'),
                )
            ]
        );

        $this->add_control(

            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'hide_title',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Hide Title By Default', 'wpkit-elementor'),
                'default' => '0',
                'options' => array(
                    '0' => 'No',
                    '1' => 'Yes'
                )
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
            'section_interactive_banner_style',
            [
                'label' => esc_html__('Text Style', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'text_style' );

        $this->start_controls_tab( 'normal',
            [
                'label' => esc_html__( 'Normal', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Title Color', 'wpkit-elementor'),
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-interactive-banner .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-interactive-banner .title',
            ]
        );

        $this->add_control(
            'border_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Border Color', 'wpkit-elementor'),
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-interactive-banner .title' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Text Background Color', 'wpkit-elementor'),
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-interactive-banner .title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => esc_html__( 'Hover', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Title Color', 'wpkit-elementor'),
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-interactive-banner .title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'border_hover_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Border Color', 'wpkit-elementor'),
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-interactive-banner .title:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_hover_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__('Text Background Color', 'wpkit-elementor'),
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-interactive-banner .title:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        WKE_Extend_Elementor::widget_template(self::get_name(),$this->get_settings());
    }

    protected function content_template() {

    }

}
