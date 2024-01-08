<?php

/**
 * Opacity controls
 */

function wke_add_opacity_control_to_widget( $element, $section_id, $args ) {

    if ( 'common' === $element->get_name() && '_section_style' === $section_id ) {

        $element->start_controls_section(
            '_section_opacity',
            [
                'label' => esc_html__( 'Opacity', 'wpkit-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'opacity',
            [
                'label' => esc_html__( 'Opacity', 'wpkit-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'description' => esc_html__('Generally, the value should between 0 and 1','wpkit-elementor'),
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'opacity: {{SIZE}};'
                ]
            ]
        );


        $element->end_controls_section();

    }

}
add_action( 'elementor/element/after_section_end', 'wke_add_opacity_control_to_widget', 10, 3 );