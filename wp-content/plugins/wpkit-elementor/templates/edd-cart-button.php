<?php
/*
 * EDD Cart Button Shortcode Template
 * @package WPKit For Elementor
 */

$edd_cart_price_id      =   $wke_data->price_id;
$edd_cart_product_id  	=   $wke_data->product_id;
$edd_cart_style       	=   $wke_data->style;
$edd_cart_shape       	=   $wke_data->shape;
$edd_cart_text_color  	=   $wke_data->text_color;
$edd_cart_color      	=   $wke_data->color;
$edd_cart_text        	=   $wke_data->button_text;
$edd_cart_size       	=   $wke_data->size;
$edd_cart_alignment   	=   $wke_data->alignment;
$edd_cart_extra_class 	=   $wke_data->extra_class;
$edd_cart_animation     =   $wke_data->animation;
$edd_cart_inline_style	=	'';

if( $edd_cart_color !=='' && $edd_cart_color !== '#000000' ) {
   if( $edd_cart_style !== 'outline' ){
      $edd_cart_inline_style .= 'background-color:' . $edd_cart_color . ';border-color:' . $edd_cart_color . '!important;';
   }else{
      $edd_cart_inline_style .= 'border-color:' . $edd_cart_color . '!important;';
   }
}

if( $edd_cart_text_color !=='' && $edd_cart_text_color !== '#ffffff' ) {
    $edd_cart_inline_style .= 'color:' . $edd_cart_text_color . '!important;';
}
$edd_cart_inline_style = 'style="' . $edd_cart_inline_style . '"';

$renderHTML = '<div class="wke-button-container '. esc_attr( $edd_cart_alignment ) . ' ' . esc_attr( $edd_cart_extra_class ) . '">';
$renderHTML .= '<a href="' . esc_url( home_url('/') ) . 'cart/?add-to-cart=' . esc_attr( $edd_cart_product_id ) . '" class="wke-button ' . esc_attr( $edd_cart_shape ) . ' ' . esc_attr( $edd_cart_style ) . ' ' . esc_attr( $edd_cart_size ) . '" ' . $edd_cart_inline_style . '>' . esc_attr( $edd_cart_text ) . '</a>';
$renderHTML .= '</div>';
echo $renderHTML;