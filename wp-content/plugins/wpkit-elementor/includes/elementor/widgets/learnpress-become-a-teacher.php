<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_LP_Become_A_Teacher_Form_Widget extends Widget_Base {

    public function get_name() {
        return 'learnpress-become-teacher-form';
    }

    public function get_title() {
        return esc_html__( 'Become Teacher Form', 'wpkit-elementor' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return array( 'wpkit-lp-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_become_a_teacher',
            [
                'label' => esc_html__( 'Settings', 'wpkit-elementor' ),
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
