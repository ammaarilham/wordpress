<?php

/**
 * Parallax controls
 */

function wke_add_parallax_control_to_widget( $element, $section_id, $args ) {

    if ( 'common' === $element->get_name() && '_section_style' === $section_id ) {

        $element->start_controls_section(
            '_section_parallax',
            [
                'label' => esc_html__( 'Parallax', 'wpkit-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'parallax_item',
            [
                'label' => esc_html__( 'Parallax Item', 'wpkit-elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'On', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'Off', 'wpkit-elementor' ),
                'return_value' => 'yes',
            ]
        );

        $element->add_control(
            'parallax_axis',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Parallax Axis', 'wpkit-elementor' ),
                 'default' => 'y',
                 'options' => [
                    'y'  => esc_html__( 'Y axis', 'wpkit-elementor' ),
                    'x' => esc_html__( 'X axis', 'wpkit-elementor' ),
                 ],
            ]
        );

        $element->add_control(
            'parallax_momentum',
            [
                'label' => esc_html__( 'Momentum', 'wpkit-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'description' => esc_html__('Generally, the value should between -1 and +1','wpkit-elementor'),
                'default' => [
                    'size' => 0.5,
                ],
                'range' => [
                    'px' => [
                        'min' => -5,
                        'max' => 5,
                        'step' => 0.1,
                    ]
                ],
                'condition' => [
                    'parallax_item' => 'yes',
                ],
            ]
        );

        $element->end_controls_section();

    }

}
add_action( 'elementor/element/after_section_end', 'wke_add_parallax_control_to_widget', 10, 3 );

function wke_add_parallax_control_attributes_to_elements( \Elementor\Element_Base $element ) {
    if ( ! $element->get_settings( 'parallax_item' ) == 'yes' ) {
        return;
    }

    $element->add_render_attribute( '_wrapper', [
        'class' => 'parallax-layer',
        'data-parallax-momentum' => $element->get_settings( 'parallax_momentum' )['size'],
        'data-parallax-axis' => $element->get_settings( 'parallax_axis' ),
    ] );
}
add_action( 'elementor/frontend/element/before_render', 'wke_add_parallax_control_attributes_to_elements' );
add_action( 'elementor/frontend/widget/before_render', 'wke_add_parallax_control_attributes_to_elements' );