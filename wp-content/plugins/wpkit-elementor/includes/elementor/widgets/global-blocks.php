<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Global_Blocks_Widget extends Widget_Base {

    public function get_name() {
        return 'global-blocks';
    }

    public function get_title() {
        return esc_html__( 'Global Blocks', 'wpkit-elementor' );
    }

    public function get_icon() {
        return 'eicon-inner-section';
    }

    public function get_categories() {
        return array( 'wpkit-common-widget' );
    }

    public function get_blocks() {
        $lists = get_posts( array( 'post_type'=> 'wke-global-block', 'posts_per_page' => -1 ) );
        $lists_array = array();
        $lists_array['0'] = esc_html__( 'Please select', 'wpkit-elementor' );

        foreach( $lists as $list ){
            $lists_array[$list->ID] = $list->post_title;
        }

        return $lists_array;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_global_blocks',
            [
                'label' => esc_html__( 'Global Blocks', 'wpkit-elementor' ),
            ]
        );

        $this->add_control(

            'global-blocks',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Select a Global Block', 'wpkit-elementor' ),
                'default' => '',
                'options' => self::get_blocks()
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $this->get_settings( 'global-blocks' ) );
    }

    protected function content_template() {

    }

}
