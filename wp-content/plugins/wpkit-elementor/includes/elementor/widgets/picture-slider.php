<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Picture_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'picture-slider';
    }

    public function get_title() {
        return esc_html__('Picture Slider', 'wpkit-elementor');
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return array('wpkit-common-widget');
    }

    public function get_script_depends() {
        if(!WKE_DEBUG){
            return [];
        }
        return [
            'swiper'
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_picture_slider',
            [
                'label' => esc_html__('Picture Slider', 'wpkit-elementor'),
            ]
        );

        $this->add_control(
            'picture_slider',
            [
                'label' => esc_html__( 'Picture Slider', 'wpkit-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'picture',
                        'label' => esc_html__( 'Slide Picture', 'wpkit-elementor' ),
                        'type' => Controls_Manager::MEDIA,
                        'show_label' => false,
                    ],
                    [
                        'name' => 'picture_size',
                        'type' => Controls_Manager::SELECT,
                        'label' => esc_html__('Picture Size', 'wpkit-elementor'),
                        'default' => 'auto',
                        'options' => array(
                            'auto' => 'auto',
                            '100%' => '100%',
                            'cover' => 'cover',
                            'contain' => 'contain',
                        )
                    ],

                    [
                        'name' => 'picture_position',
                        'type' => Controls_Manager::SELECT,
                        'label' => esc_html__('Picture Position', 'wpkit-elementor'),
                        'default' => 'center center',
                        'options' => array(
                            'top center' => esc_html__( 'Top Center', 'wpkit-elementor' ),
                            'top left' => esc_html__( 'Top Left', 'wpkit-elementor' ),
                            'top right' => esc_html__( 'Top Right', 'wpkit-elementor' ),
                            'center center' => esc_html__( 'Center Center', 'wpkit-elementor' ),
                            'center left' => esc_html__( 'Center Left', 'wpkit-elementor' ),
                            'center right' => esc_html__( 'Center Right', 'wpkit-elementor' ),
                            'bottom center' => esc_html__( 'Bottom Center', 'wpkit-elementor' ),
                            'bottom left' => esc_html__( 'Bottom Left', 'wpkit-elementor' ),
                            'bottom right' => esc_html__( 'Bottom Right', 'wpkit-elementor' ),
                        )
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__( 'Picture Link', 'wpkit-elementor' ),
                        'type' => Controls_Manager::URL,
                        'show_label' => true,
                    ],
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'wpkit-elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'show_label' => true,
                    ],
                    [
                        'name' => 'title_wrapper',
                        'type' => Controls_Manager::SELECT,
                        'label' => esc_html__('Title Wrapper', 'wpkit-elementor'),
                        'default' => 'h2',
                        'options' => array(
                            'h1' => 'H1',
                            'h2' => 'H2',
                            'h3' => 'H3',
                            'h4' => 'H4',
                            'div' => 'DIV'
                        )
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => esc_html__( 'Content', 'wpkit-elementor' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'show_label' => true,
                    ],
                    [
                        'name' => 'textcolor',
                        'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#000000',
                    ],
                    [
                        'name' => 'content_position',
                        'type' => Controls_Manager::SELECT,
                        'label' => esc_html__('Text Position', 'wpkit-elementor'),
                        'default' => 'center-center',
                         "options" => array(
                            'center-center'=> esc_html__('Center','wpkit-elementor'),
                            'center-left'  => esc_html__('Center Left','wpkit-elementor'),
                            'center-right' => esc_html__('Center Right','wpkit-elementor'),
                            'top-left'     => esc_html__('Top Left','wpkit-elementor'),
                            'top-right'    => esc_html__('Top Right','wpkit-elementor'),
                            'bottom-left'  => esc_html__('Bottom Left','wpkit-elementor'),
                            'bottom-right' => esc_html__('Bottom Right','wpkit-elementor'),
                          ),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->add_responsive_control(

            'height',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Slider Height', 'wpkit-elementor'),
                'size_units' => ['px','em'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 25,
                        'max' => 62.5,
                        'step' => 0.1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .wke-picture-slider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(

            'direction',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Slider Direction', 'wpkit-elementor'),
                'options' => array(
                    'horizontal' => esc_html__('Horizontal','wpkit-elementor'),
                    'vertical'   => esc_html__('Vertical','wpkit-elementor'),
                ),
                'default' => 'horizontal'
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
    }

    protected function render() {
        WKE_Extend_Elementor::widget_template(self::get_name(),$this->get_settings());
    }

    protected function content_template() {

    }

}
