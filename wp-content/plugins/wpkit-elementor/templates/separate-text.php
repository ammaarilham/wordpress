<?php
/*
 * Separate Text Template
 * @package WPKit For Elementor
 */
$text       =   $wke_data->text;
$align      =   $wke_data->align;

$renderHTML = '<div class="wke-separate-text ' . esc_html( $align ) . '"><h3>' . esc_html( $text ) . '</h3></div>';

echo $renderHTML;