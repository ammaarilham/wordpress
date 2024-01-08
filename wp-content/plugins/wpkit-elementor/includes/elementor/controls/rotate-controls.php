<?php

/**
 * Rotate controls
 */

function wke_rotate_control_to_widget( $element, $section_id, $args ) {

    if ( 'common' === $element->get_name() && '_section_style' === $section_id ) {

        $element->start_controls_section(
            '_section_rotate',
            [
                'label' => esc_html__( 'Rotate', 'wpkit-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'rotate_angle',
            [
                'label' => esc_html__( 'Rotate Angle', 'wpkit-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'description' => esc_html__('Generally, the value should between -360 and 360','wpkit-elementor'),
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );


        $element->end_controls_section();

    }

}
add_action( 'elementor/element/after_section_end', 'wke_rotate_control_to_widget', 10, 3 );