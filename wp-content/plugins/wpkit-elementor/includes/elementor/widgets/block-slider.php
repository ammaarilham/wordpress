<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Block_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'block-slider';
    }

    public function get_title() {
        return apply_filters('wke_block_slider_title',esc_html__('Global Blocks Slider', 'wpkit-elementor'));
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
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
            'section_block_slider',
            [
                'label' => esc_html__('Blocks Setting', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'block_slider',
            [
                'label' => esc_html__( 'Blocks', 'wpkit-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'text' => esc_html__( 'Block #1', 'wpkit-elementor' ),
                    ]
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'wpkit-elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Title', 'wpkit-elementor' ),
                        'show_label' => true,
                    ],
                    [
                        'name' => 'block',
                        'label' => esc_html__( 'Global Block', 'wpkit-elementor' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => self::get_blocks(),
                        'show_label' => true,
                    ]
                ],
                'title_field' => '{{{ name }}}',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_image_carousel_slider',
            [
                'label' => esc_html__('Slider Setting', 'wpkit-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '1',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
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
