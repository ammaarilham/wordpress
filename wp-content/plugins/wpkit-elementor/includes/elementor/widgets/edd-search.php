<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_EDD_Search_Widget extends Widget_Base {

    public function get_name() {
        return 'edd-search';
    }

    public function get_title() {
        return apply_filters( 'wke_edd_search_title', esc_html__( 'EDD Search', 'wpkit-elementor' ) );
    }

    public function get_icon() {
        return 'eicon-search-bold';
    }

    public function get_categories() {
        return array( 'wpkit-edd-widget' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_edd_search_text',
            [
                'label' => apply_filters( 'wke_edd_search_title', esc_html__( 'EDD Search', 'wpkit-elementor' ) ),
            ]
        );

        $this->add_control(

            'placeholder',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Placeholder Text', 'wpkit-elementor' ),
                'default' => '',
                'prefix_class' => 'tmvc-edd-search-placeholder-',
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
        WKE_Extend_Elementor::widget_template( self::get_name(), $this->get_settings() );
    }

    protected function content_template() {

    }

}
