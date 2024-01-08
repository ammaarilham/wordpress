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

class WKE_FlipBox_Widget extends Widget_Base {

    public function get_name() {
        return 'flipbox';
    }

    public function get_title() {
        return esc_html__('Flip Box', 'wpkit-elementor');
    }

    public function get_icon() {
        return 'eicon-flip-box';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
    }

    protected function register_controls() {

        //Content Tab: General Setting
        $this->start_controls_section(
            'section_flipbox',
            [
                'label' => esc_html__('Flipbox Settings', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(

            'height',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Flip Box Height', 'wpkit-elementor'),
                'default' => [
                    'size' => 400,
                ],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 800,
                        'step' => 1,
                    ]
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .front,{{WRAPPER}} .wke-flipbox .back' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'direction',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Flipping Direction', 'wpkit-elementor'),
                'default' => 'horizontal',
                'options' => array(
                    'horizontal' => esc_html__( 'Flip X', 'wpkit-elementor' ),
                    'vertical' => esc_html__( 'Flip Y', 'wpkit-elementor' ),
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

        //Content Tab: Front Content
        $this->start_controls_section(
            'section_flipbox_front_content',
            [
                'label' => esc_html__('Front Content', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(

            'front_icon',
            [
                'type' => Controls_Manager::ICON,
                'label' => esc_html__('Select Icon', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'front_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'front_content',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Content', 'wpkit-elementor'),
            ]
        );

        $this->add_control(
            'front_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.3)',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .front,{{WRAPPER}} .wke-flipbox .front:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(

            'front_single_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Background Image', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .front' => 'background-image: url({{URL}});',
                ],
            ]
        );


        $this->end_controls_section();

        //Content Tab: Back Content
        $this->start_controls_section(
            'section_flipbox_back_content',
            [
                'label' => esc_html__('Back Content', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(

            'back_icon',
            [
                'type' => Controls_Manager::ICON,
                'label' => esc_html__('Select Icon', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'back_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'wpkit-elementor'),
            ]
        );

        $this->add_control(

            'back_content',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Content', 'wpkit-elementor'),
            ]
        );

        $this->add_control(
            'back_show_button',
            [
                'label' => esc_html__( 'Show Button?', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '1',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'back_button_text',
            [
                'label' => __( 'Button Text', 'wpkit-elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Click here', 'wpkit-elementor' ),
                'placeholder' => __( 'Click here', 'wpkit-elementor' ),
                'condition' => [
                    'back_show_button' => '1'
                ]
            ]
        );

        $this->add_control(
            'back_button_link',
            [
                'label' => __( 'Button Link', 'wpkit-elementor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'wpkit-elementor' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'back_show_button' => '1'
                ]
            ]
        );

        $this->add_control(
            'back_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.3)',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .back,{{WRAPPER}} .wke-flipbox .back:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(

            'back_single_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Background Image', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .back' => 'background-image: url({{URL}});',
                ],
            ]
        );
        $this->end_controls_section();

        //Style Tab: Front
        $this->start_controls_section(
            'section_flipbox_front_style',
            [
                'label' => esc_html__('Front Style', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'front_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .front p.icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(

            'front_icon_size',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Icon Size', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .front p.icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'description'  =>  esc_html__('Change the icon size.'),
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'em', 'px' ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => 12,
                        'max' => 100,
                        'step' => 1,
                    ]
                ]
            ]
        );

        $this->add_control(
            'front_title_color',
            [
                'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .inner strong.title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_front_title',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-flipbox .flipper .front .inner strong.title',
            ]
        );

        $this->add_control(
            'front_content_color',
            [
                'label' => esc_html__( 'Content Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .front .inner p.content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_content',
                'label' => esc_html__( 'Content Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-flipbox .flipper .front .inner p.content',
            ]
        );

        $this->end_controls_section();

        //Style Tab: Back
        $this->start_controls_section(
            'section_flipbox_back_style',
            [
                'label' => esc_html__('Back Style', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'back_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .back p.icon' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(

            'back_icon_size',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Icon Size', 'wpkit-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .back p.icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'description'  =>  esc_html__('Change the icon size.'),
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'em', 'px' ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => 12,
                        'max' => 100,
                        'step' => 1,
                    ]
                ]
            ]
        );

        $this->add_control(
            'back_title_color',
            [
                'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner strong.title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_back_title',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-flipbox .flipper .back .inner strong.title',
            ]
        );

        $this->add_control(
            'back_content_color',
            [
                'label' => esc_html__( 'Content Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner p.content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_back_content',
                'label' => esc_html__( 'Content Typography', 'wpkit-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-flipbox .flipper .back .inner p.content',
            ]
        );

        $this->add_control(
            'back_button_style',
            [
                'label' => __( 'Button Style', 'wpkit-elementor' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_button_typography',
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'back_tab_button_normal',
            [
                'label' => __( 'Normal', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'back_button_text_color',
            [
                'label' => __( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_button_background_color',
            [
                'label' => __( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_button_border',
                'selector' => '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'back_tab_button_hover',
            [
                'label' => __( 'Hover', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(
            'back_button_hover_color',
            [
                'label' => __( 'Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button:hover, {{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button:focus' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button:hover svg, {{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button:focus svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_button_background_hover_color',
            [
                'label' => __( 'Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button:hover, {{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_button_hover_border_color',
            [
                'label' => __( 'Border Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button:hover, {{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_button_hover_animation',
            [
                'label' => __( 'Hover Animation', 'wpkit-elementor' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'back_button_border_radius',
            [
                'label' => __( 'Border Radius', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_button_box_shadow',
                'selector' => '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button',
            ]
        );

        $this->add_responsive_control(
            'back_button_text_padding',
            [
                'label' => __( 'Padding', 'wpkit-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wke-flipbox .flipper .back .inner .wke-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
