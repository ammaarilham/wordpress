<?php
/*
 * IconBox Shortcode Template
 * @package WPKit For Elementor
 */

$wke_iconbox_text_color     =   $wke_data->text_color;
$wke_iconbox_title          =   $wke_data->title;
$wke_iconbox_intro          =   $wke_data->intro;
$wke_iconbox_icon           =   $wke_data->icon;
$wke_iconbox_icon_position  =   $wke_data->position;
$wke_iconbox_extra_class    =   $wke_data->extra_class;
$wke_iconbox_inline_style   =   '';

if( $wke_iconbox_text_color !== '#000000' ){
  $wke_iconbox_inline_style = 'style="color:' . $wke_iconbox_text_color . '"';
}

$renderHTML = '<div class="wke-icon-box ' . esc_attr( $wke_iconbox_icon_position ) . ' ' . esc_attr( $wke_iconbox_extra_class ) . '">';

if( $wke_iconbox_icon !+= '' ) {
  $renderHTML .= '<div class="icon"><i class="' . $wke_iconbox_icon . '"></i></div>';
}
$renderHTML .=  '<div class="content" ' . $wke_iconbox_inline_style . '>';

if( $wke_iconbox_title !== '' ) {
  $renderHTML .= '<strong class="title">' . esc_attr( $wke_iconbox_title ) . '</strong>';
}

if( $wke_iconbox_intro !=='' ) {
    $renderHTML .= '<p class="intro">' . esc_attr( $wke_iconbox_intro ) . '</p>';
}
$renderHTML .= '</div>
             </div>';

echo $renderHTML;