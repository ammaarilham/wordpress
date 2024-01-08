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

class WKE_PriceTable_Widget extends Widget_Base {

    public function get_name() {
        return 'pricetable';
    }

    public function get_title() {
        return esc_html__('Price Table', 'wpkit-elementor');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_pricetable_content',
            [
                'label' => esc_html__('Price Table Content', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(

            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Table Name', 'wpkit-elementor')
            ]
        );

        $this->add_control(

            'price',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Price', 'wpkit-elementor'),
                'description' => esc_html__('Do not miss the currency symbol such as $10 or $10/month.', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'content',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Table Content', 'wpkit-elementor'),
                'description' => esc_html__('Support shortcode and specific HTML tags: strong, span, ol, ul, li, em, b, i, a, blockquote. ', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button Text', 'wpkit-elementor')
            ]
        );

        $this->add_control(

            'button_link',
            [
                'type' => Controls_Manager::URL,
                'label' => esc_html__('Button Link', 'wpkit-elementor'),
                'description' => esc_html__('If you leave it empty, the button will not be shown.', 'wpkit-elementor'),
            ]
        );


        $this->add_control(
            'featured',
            [
                'label' => esc_html__( 'Mark it As Featured Plan?', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 'featured',
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


        //Style Tab: Table
        $this->start_controls_section(
            'section_pricetable_style',
            [
                'label' => esc_html__('Table', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'price_table_border',
                'selector' => '{{WRAPPER}} .wke-price-table',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'table_border_radius',
            [
                'label' => __( 'Border Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wke-price-table header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'table_box_shadow',
                'selector' => '{{WRAPPER}} .wke-price-table',
            ]
        );
        $this->end_controls_section();

        //Style Tab: Table Head
        $this->start_controls_section(
            'section_pricetable_head_style',
            [
                'label' => esc_html__('Table Head', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'table_head_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table header' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'table_head_border_color',
            [
                'label' => esc_html__( 'Border Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table header .price, {{WRAPPER}} .wke-price-table header h3' => 'border-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'table_content_head_name',
            [
                'label' => esc_html__( 'Table Name', 'wpkit-elementor' ),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'table_content_head_name_color',
            [
                'label' => esc_html__( 'Name Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#0000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table header h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_table_head_name',
                'label' => esc_html__( 'Name Text Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-price-table header h3',
            ]
        );

        $this->add_control(
            'table_content_head_price',
            [
                'label' => esc_html__( 'Price', 'wpkit-elementor' ),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'table_content_head_price_color',
            [
                'label' => esc_html__( 'Price Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#0000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table header .price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_table_head_price',
                'label' => esc_html__( 'Price Text Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-price-table header .price',
            ]
        );

        $this->end_controls_section();

        //Style Tab: Table Content
        $this->start_controls_section(
            'section_pricetable_content_style',
            [
                'label' => esc_html__('Table Content', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'table_content_text_color',
            [
                'label' => esc_html__( 'Content Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#0000000',
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table ol li, {{WRAPPER}} .wke-price-table ul li, {{WRAPPER}} .price_content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_table_content',
                'label' => esc_html__( 'Content Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-price-table ol li, {{WRAPPER}} .wke-price-table ul li, {{WRAPPER}} .price_content',
            ]
        );

       $this->end_controls_section();

       //Style Tab: Table Button
        $this->start_controls_section(
            'section_pricetable_button_style',
            [
                'label' => esc_html__('Button', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
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
            'button_text_color',
            [
                'label' => __( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .wke-price-table-button',
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
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table-button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wke-price-table-button' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table-button' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .wke-price-table-button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __( 'Hover Animation', 'wpkit-elementor' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'selector' => '{{WRAPPER}} .wke-price-table-button',

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .wke-price-table-button',
            ]
        );

        $this->add_responsive_control(
            'button_text_padding',
            [
                'label' => __( 'Padding', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-price-table-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
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
