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

class WKE_WeDocs_Archive_Widget extends Widget_Base {

    public function get_name() {
        return 'wedocs-archive';
    }

    public function get_title() {
        return esc_html__( 'weDocs Archive', 'wpkit-elementor' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return array( 'wpkit-wedocs-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_wedocs_archive',
            [
                'label' => esc_html__( 'weDocs Archive', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'columns',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Columns', 'wpkit-elementor' ),
                'default' => '3',
                'options' => array(
                    '2' => esc_html__( '2 Columns', 'wpkit-elementor' ),
                    '3' => esc_html__( '3 Columns', 'wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(
            'number',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'Number of Questions Per Section', 'wpkit-elementor' ),
                'default' => '6',
            ]
        );

        $this->add_control(
            'more_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Read More Text', 'wpkit-elementor' ),
                'default' => 'More Questions',
            ]
        );

        $this->end_controls_section();

        //Style Tab
        $this->start_controls_section(
            'section_text_style',
            [
                'label' => esc_html__('Text', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wedocs-archive-wrap .wedocs-docs-single h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_title',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wedocs-archive-wrap .wedocs-docs-single h3',
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => esc_html__( 'Link Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wedocs-archive-wrap .wedocs-doc-sections li a, {{WRAPPER}} .wedocs-archive-wrap .wedocs-doc-link a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__( 'Link Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wedocs-archive-wrap .wedocs-doc-sections li a:hover, {{WRAPPER}} .wedocs-archive-wrap .wedocs-doc-link a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_link',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} {{WRAPPER}} .wedocs-archive-wrap .wedocs-doc-sections li a, {{WRAPPER}} .wedocs-archive-wrap .wedocs-doc-link a',
            ]
        );

        $this->end_controls_section();

        //Box Style Tab
        $this->start_controls_section(
            'section_box_style',
            [
                'label' => esc_html__('Box', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .wedocs-archive-wrap ul.wedocs-docs-list.col-2:not(.wedocs-doc-sections) > li, {{WRAPPER}} .wedocs-archive-wrap ul.wedocs-docs-list.col-3:not(.wedocs-doc-sections) > li',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => __( 'Border Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wedocs-archive-wrap ul.wedocs-docs-list.col-2:not(.wedocs-doc-sections) > li, {{WRAPPER}} .wedocs-archive-wrap ul.wedocs-docs-list.col-3:not(.wedocs-doc-sections) > li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_box_shadow',
                'selector' => '{{WRAPPER}} .wedocs-archive-wrap ul.wedocs-docs-list.col-2:not(.wedocs-doc-sections) > li, {{WRAPPER}} .wedocs-archive-wrap ul.wedocs-docs-list.col-3:not(.wedocs-doc-sections) > li',
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
