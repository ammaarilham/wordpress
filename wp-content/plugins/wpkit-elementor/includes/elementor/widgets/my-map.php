<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_My_Map_Widget extends Widget_Base {

	public function get_name() {
		return 'my-map';
	}

	public function get_title() {
		return esc_html__( 'My Map', 'wpkit-elementor' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return array( 'wpkit-common-widget' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_my_map',
			[
				'label' => esc_html__( 'My Map', 'wpkit-elementor' ),
			]
		);

		$default_lat = '40.6700';
		$default_long = '-73.9400';

		$this->add_control(
			'lat',
			[
				'label' => esc_html__( 'Latitude', 'wpkit-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_lat,
				'default' => $default_lat,
				'label_block' => true,
			]
		);

		$this->add_control(
			'long',
			[
				'label' => esc_html__( 'Longitude', 'wpkit-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_long,
				'default' => $default_long,
				'label_block' => true,
			]
		);

		$this->add_control(
			'zoom',
			[
				'label' => esc_html__( 'Zoom Level', 'wpkit-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 11,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'wpkit-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 500,
				],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 1440,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tmvc-my-map' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'wpkit-elementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
		  'custom_styles',
		  [
		     'label'   => esc_html__( 'Custom Styles', 'wpkit-elementor' ),
		     'type'    => Controls_Manager::CODE,
		     'language' => 'json',
		     'description' => wp_kses( __( 'Insert your Javascript styling array here to customize the map\'s look.  <a href="https://snazzymaps.com/" target="_blank">https://snazzymaps.com</a>', 'wpkit-elementor'), array( 'a' => array( 'href' => array(),'target' => array())) )
		  ]
		);

		$this->add_control(
			'marker',
			[
				'label' => esc_html__( 'Marker Image', 'wpkit-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['lat'] ) || empty( $settings['long'] ) )
			return;

		if ( 0 === absint( $settings['zoom']['size'] ) )
			$settings['zoom']['size'] = 10;

		$map_options = [
			'lat' => $settings['lat'],
			'long' => $settings['long'],
			'zoom' => $settings['zoom']['size'],
			'styles' => !empty($settings['custom_styles']) ? json_decode($settings['custom_styles']) : null,
			'marker' => $settings['marker']['url'],
		];

		$renderHTML = '<div class="tmvc-my-map" data-map-settings="'.esc_attr( wp_json_encode( $map_options ) ).'"></div>';

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
		  $renderHTML .= '<script>window.initMaps();</script>';
		}

   	    print($renderHTML);

	}

	protected function content_template() {}
}
