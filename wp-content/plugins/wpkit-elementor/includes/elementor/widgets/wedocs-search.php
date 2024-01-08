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

class WKE_WeDocs_Search_Widget extends Widget_Base {

    public function get_name() {
        return 'wedocs-search';
    }

    public function get_title() {
        return esc_html__( 'weDocs Search', 'wpkit-elementor' );
    }

    public function get_icon() {
        return 'eicon-search';
    }

    public function get_categories() {
        return array( 'wpkit-wedocs-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_wedocs_search',
            [
                'label' => esc_html__( 'weDocs Search', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(

            'search_field_placeholder',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Field Placeholder', 'wpkit-elementor' ),
                'default' => esc_html__( 'Documentation Search &hellip;', 'wpkit-elementor' )
            ]
        );

        $this->add_control(

            'button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button Text', 'wpkit-elementor'),
                'default' => esc_html__( 'Search', 'wpkit-elementor' )
            ]
        );

        $this->add_control(
            'dropdown',
            [
                'label' => esc_html__( 'Docs Dropdown', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '1',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->end_controls_section();

        //Style Tab
        $this->start_controls_section(
            'section_field_style',
            [
                'label' => esc_html__('Field', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'field_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-field' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label' => esc_html__( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-field' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_field_text',
                'label' => esc_html__( 'Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div .search-field',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_border',
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div .search-field',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'field_border_radius',
            [
                'label' => __( 'Border Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div .search-field',
            ]
        );

        $this->end_controls_section();

        //Select Style Tab
        $this->start_controls_section(
            'section_select_style',
            [
                'label' => esc_html__('Dropdown', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dropdown' => '1',
                ]
            ]
        );

        $this->add_control(
            'select_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div #search_in_doc' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'select_text_color',
            [
                'label' => esc_html__( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div #search_in_doc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_select_text',
                'label' => esc_html__( 'Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div #search_in_doc',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'select_border',
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div #search_in_doc',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'select_border_radius',
            [
                'label' => __( 'Border Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div #search_in_doc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'select_box_shadow',
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div #search_in_doc',
            ]
        );

        $this->end_controls_section();

        //Button Style Tab
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__('Button', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_button_text',
                'label' => esc_html__( 'Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div .search-submit',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div .search-submit',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-submit:hover, .wke-wedocs-search form div .search-submit:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-submit:hover, {{WRAPPER}} .wke-wedocs-search form div .search-submit:focus' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wke-wedocs-search form div .search-submit:hover svg, {{WRAPPER}} .wke-wedocs-search form div .search-submit:focus svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-submit:hover, {{WRAPPER}} .wke-wedocs-search form div .search-submit:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __( 'Hover Animation', 'wpkit-elementor' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Button Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-wedocs-search form div .search-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .wke-wedocs-search form div .search-submit',
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
