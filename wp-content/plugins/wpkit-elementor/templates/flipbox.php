<?php

/**
 * Frontend For Flip Box
 * This file should be used to render each module instance.
 * You have access to two variables in this file: 
 * 
 * $module An instance of your module class.
 * $wke_data The module's settings.
 */

/* Element Frontend */
$direction 				= $wke_data->direction;
$height 				  = isset( $height ) ? $wke_data->height : ['size'=>300];
$extra_class  		= $wke_data->extra_class;

$front_icon  			= $wke_data->front_icon;
$front_title  		= $wke_data->front_title;
$front_content 		= $wke_data->front_content;
$front_single_image  = $wke_data->front_single_image;

$back_icon  			= $wke_data->back_icon;
$back_title  			= $wke_data->back_title;
$back_content  	  = $wke_data->back_content;
$back_single_image  = $wke_data->back_single_image;
$back_show_button = $wke_data->back_show_button;
$back_button_link = $wke_data->back_button_link;
$back_button_text = $wke_data->back_button_text;


$half_height_css='';

if( $direction == 'vertical' ){
	$half_height_css = 'style="transform-origin: 100% ' . ( $height['size'] / 2 ) . 'px;-webkit-transform-origin: 100% ' . ( $height['size'] / 2 ) . 'px;-moz-transform-origin: 100% ' . ( $height['size'] / 2 ) . 'px;-ms-transform-origin: 100% ' . ( $height['size'] / 2 ) . 'px;"';
}

$render = '<div class="wke-flipbox ' . $direction . ' ' . $extra_class . '" ontouchstart="this.classList.toggle("hover");">
        <div class="flipper" ' . $half_height_css . '>
          <div class="front">
            <div class="inner">';
             if( $front_icon !== '' ) $render .= '<p class="icon"><i class="' . esc_html( $front_icon ) . '"></i></p>';
             if( $front_title !== '' ) $render .=  '<strong class="title">' . esc_html( $front_title ) . '</strong>';
             if( $front_content !== '' ) $render .= '<p class="content">' . esc_html( $front_content ) . '</p>';
$render .= '</div>
          </div>
          <div class="back">
            <div class="inner">';
             if( $back_icon <> '' ) $render .= '<p class="icon"><i class="' . esc_html( $back_icon ) . '"></i></p>';
             if( $back_title <> '' ) $render .=  '<strong class="title">' . esc_html( $back_title ) . '</strong>';
             if( $back_content <> '' ) $render  .= '<p class="content">' . esc_html( $back_content ) . '</p>';
             if( $back_show_button ) $render .= '<p><a href="'.$back_button_link['url'].'" class="wke-button">' . esc_html( $back_button_text ) . '</a></p>';
$render .= '</div>
          </div>
        </div>
      </div>';

echo $render;