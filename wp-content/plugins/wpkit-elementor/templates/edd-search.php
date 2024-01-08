<?php
/*
 * EDD Search Shortcode Template
 * @package WPKit For Elementor
 */

$edd_placeholder     =   $wke_data->placeholder;
$edd_extra_class     =   $wke_data->extra_class;

$renderHTML = '<div class="wke-edd-search ' . esc_attr( $edd_extra_class ) . '">
		           <form role="search" method="get" class="searchform" action="' . esc_url( home_url('/') ) . '">
		               <input type="text" id="search-edd-product" placeholder="' . esc_html( $edd_placeholder ) . '" value="" name="s">
		               <input type="submit" value="' . esc_html__('Search','wpkit-elementor') . '" />
		               <input type="hidden" id="edd-post-type" name="post_type" value="download">
		           </form>
		       </div>';

echo $renderHTML;