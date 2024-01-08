<?php
/*
 * WooCommerce Cart Button Shortcode Template
 * @package WPKit For Elementor
 */

$button_action      	=   $wke_data->action;
$button_product_id  	=   $wke_data->product_id;
$button_style       	=   $wke_data->style;
$button_shape       	=   $wke_data->shape;
$button_text_color  	=   $wke_data->text_color;
$button_color     	 	=   $wke_data->color;
$button_text        	=   $wke_data->button_text;
$button_size      		=   $wke_data->size;
$button_extra_class 	=   $wke_data->extra_class;
$button_action      	=   $wke_data->action;
$button_inline_style	=	'';

if( $button_color !== '' && $button_color !== '#000000' ){
   if( $button_style !== 'outline' ) {
   		$button_inline_style .= 'background-color:' . $button_color . ';border-color:' . $button_color . '!important;';
   }else{
   		$button_inline_style .= 'border-color:' . $button_color . '!important;';
   }
}

if( $button_text_color !== '' && $button_text_color !== '#ffffff' ){
    $button_inline_style .= 'color:' . $button_text_color . '!important;';
}

$button_inline_style = 'style="' . $button_inline_style . '"';

$button_link = 'javascript:void(0);';

if( $button_product_id !== '' ) {
   $button_link = wc_get_cart_url() . '?add-to-cart=' . esc_attr( $button_product_id );
}

$renderHTML = ' <div class="wke-button-container ' . esc_attr( $button_extra_class ) . '">';

if( $button_action == 'ajax' || $button_action == '' ) {

  $renderHTML .= '<a href="javascript:void(0);" data-quantity="1" data-product_id="' . esc_attr($button_product_id ) . '" class="hvr-grow add_to_cart_button wke-button product_type_simple ajax_add_to_cart ' . esc_attr( $button_shape ) . ' ' . esc_attr( $button_style ) . ' ' . esc_attr( $button_size ) . '" ' . $button_inline_style . '>' . esc_attr( $button_text ) . '</a>';

}else{

  $renderHTML .= '<a href="' . esc_url( $button_link ) . '" class="wke-button ' . esc_attr( $button_shape ) . ' '. esc_attr( $button_style ) . ' ' . esc_attr( $button_size ) . '" ' . $button_inline_style . '>' . esc_attr( $button_text ) . '</a>';
}

$renderHTML .= '</div>';

echo $renderHTML;