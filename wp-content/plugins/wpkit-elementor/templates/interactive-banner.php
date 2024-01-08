<?php
/*
 * Interactive Banner Shortcode Template
 * @package WPKit For Elementor
 */

$wke_banner_link     		=   $wke_data->link;
$wke_banner_picture         =   $wke_data->picture;
$wke_banner_title           =   $wke_data->title;
$wke_banner_link_target     =   $wke_data->link_target;
$wke_banner_hide_title  	=   $wke_data->hide_title;
$wke_banner_extra_class     =   $wke_data->extra_class;
$hidden_title_css		    =   $wke_banner_hide_title == 1 ? 'wke-hidden-title' : '';

$renderHTML = '<div class="wke-interactive-banner ' . esc_html( $wke_banner_extra_class ) . '">
            <a href="' . esc_url( $wke_banner_link ) . '" target="' . esc_html( $wke_banner_link_target ) . '">
            <img src="' . esc_url( $wke_banner_picture['url'] ) . '" class="banner-picture" alt="' . $wke_banner_title . '" />
            <span class="title ' . $hidden_title_css . '">' . esc_html( $wke_banner_title ) . '</span>
            </a>
        </div>';

echo $renderHTML;