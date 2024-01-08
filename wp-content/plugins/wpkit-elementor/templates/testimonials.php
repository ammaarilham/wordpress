<?php
/*
 * Testimonials Template
 * @package WPKit For Elementor
 */

$wke_testimonials    =   $wke_data->testimonials;
$wke_gap    		     =   $wke_data->gap;
$wke_columns   		   =   $wke_data->columns;
$wke_slide_style     =   $wke_data->slide_style;
$wke_slide_align     =   $wke_data->align;
$wke_extra_class  	 =   $wke_data->extra_class;

/* Element Frontend */
$testimonial_id = WKE_Util::random_string( 10, false );

$renderHTML = '<div id="wke-testimonials-' . esc_attr( $testimonial_id ) . '" class="wke-testimonials wke-carousel swiper-container wke-slide-' . esc_attr( $wke_slide_align ) . ' ' . esc_attr( $wke_slide_style ) . ' ' . esc_attr( $wke_extra_class ) . '" data-direction="horizontal" data-columns="'.$wke_columns.'" data-gap="'.$wke_gap['size'].'" data-slider-per-view-mobile="1">
					<div class="swiper-wrapper">';

	foreach( $wke_testimonials as $item ){
		$renderHTML .= '<div class="swiper-slide">';
		  $renderHTML .= '<div class="testimonial-text">
		                      ' . wpautop( $item['said'] ) . '
		                  </div>

		                  <footer class="testimonial-author">
		                    <img src="' . esc_url( $item['avatar']['url'] ) . '" alt="' . esc_attr( $item['name'] ) . '" class="avatar" />
                        <span class="author">' . esc_html( $item['name'] ) .' <em>'.esc_html( $item['job'] ) . '</em></span>
		                  </footer>';
		$renderHTML .= '</div>';
  }

  $renderHTML .= '</div>';
	$renderHTML .= '<div class="swiper-pagination"></div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>';
$renderHTML .= '</div>';

// Don't delete the following codes
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    $renderHTML .= '<script>window.WKE.swiper();</script>';
}

echo $renderHTML;
