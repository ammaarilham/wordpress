<?php
/**
 * Customize Elementor UI
 */

if( ! class_exists( 'Elementor\Plugin' ) ) {
    return;
}

/**
 * Editor Scripts
 */
function wke_elementor_editor_script(){
      wp_enqueue_style( 'wke_elementor_editor_styles',  plugins_url( 'includes/elementor/editor/assets/editor.css', WKE_FILE ) );
      wp_enqueue_script('wke_elementor_editor_script', plugins_url( 'includes/elementor/editor/assets/editor.js', WKE_FILE ), array('jquery'), null, true );
}
add_action( 'elementor/editor/after_enqueue_scripts', 'wke_elementor_editor_script' );

/**
 * Preview Scripts
 */
function wke_elementor_preview_script(){
      wp_enqueue_style( 'wke_elementor_preview_styles',  plugins_url( 'includes/elementor/editor/assets/preview.css', WKE_FILE ) );
}
add_action( 'elementor/preview/enqueue_styles', 'wke_elementor_preview_script' );
