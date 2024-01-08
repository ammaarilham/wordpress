<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_CF7_Widget extends Widget_Base {

    public function get_name() {
        return 'cf7';
    }

    public function get_title() {
        return esc_html__( 'Contact Form 7', 'wpkit-elementor' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return array( 'wpkit-common-widget' );
    }

    public function get_form() {
        $forms = get_posts( array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 ) );

        $form_info = array();
        $form_info['0'] = esc_html__( 'Please select a form', 'wpkit-elementor' );

        foreach( $forms as $form ){
            $form_info[$form->ID] = $form->post_title;
        }

        return $form_info;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_cf7',
            [
                'label' => esc_html__( 'Contact Form 7', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(

            'cf7',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Select a Form', 'wpkit-elementor' ),
                'default' => '',
                'options' => self::get_form()
            ]
        );

        $this->add_control(
            'field_border_color',
            [
                'label' => esc_html__( 'Fields Border Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} input[type="text"]'  => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} input[type="email"]' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} textarea'            => 'border-color:{{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'field_background_color',
            [
                'label' => esc_html__( 'Fields Background Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} input[type="text"]'  => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} input[type="email"]' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} textarea'            => 'background-color:{{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label' => esc_html__( 'Fields Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} input[type="text"]'  => 'color:{{VALUE}};',
                    '{{WRAPPER}} input[type="email"]' => 'color:{{VALUE}};',
                    '{{WRAPPER}} textarea'            => 'color:{{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__( 'Button Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} input[type="reset"]'  => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} input[type="submit"]' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} input[type="search"]' => 'background-color:{{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Button Text Color', 'wpkit-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} input[type="reset"]'  => 'color:{{VALUE}};',
                    '{{WRAPPER}} input[type="submit"]' => 'color:{{VALUE}};',
                    '{{WRAPPER}} input[type="search"]' => 'color:{{VALUE}};',
                ]
            ]
        );


        $this->add_control(

            'extra_class',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Extra Class', 'wpkit-elementor' ),
                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpkit-elementor' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        echo '<div class="wke_cf7 '. $this->get_settings( 'extra_class' ) . '">' . do_shortcode( '[contact-form-7 id="'.$this->get_settings( 'cf7' ) .'"]' ) . '</div>';
    }

    protected function content_template() {

    }

}
