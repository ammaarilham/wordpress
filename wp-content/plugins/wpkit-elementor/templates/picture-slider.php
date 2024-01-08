<?php
/*
 * Picture Slider Elementor Template
 * @package WPKit For Elementor
 */


$extra_class                  =   $wke_data->extra_class;
$picture_slider               =   $wke_data->picture_slider;
$picture_slider_direction     =   isset( $wke_data->direction ) && $wke_data->direction !== '' ? $wke_data->direction : 'horizontal';

/* Element Frontend */
$id = WKE_Util::random_string( 10, false );
$renderHTML = '';
$total_number = 0;

if( $picture_slider ) {
$renderHTML = '<div id="wke-swiper-slider-' . esc_attr( $id ) . '" class="wke-picture-slider wke-swiper-slider swiper-container swiper-container-' . $picture_slider_direction . ' ' . esc_html( $extra_class ) . '" data-direction="' . esc_html( $picture_slider_direction ) . '">
            <div class="swiper-wrapper">';
            foreach( $picture_slider as $item ){
                  $total_number .= $total_number + 1;
                  $textcolor = $item['textcolor'] ? 'style="color: ' . $item['textcolor'] . ';"' : '';
                  $target = $item['link']['is_external'] ? 'target="_blank"' : '';
                  $pictureUrl = $item['picture']['url'];

                  $renderHTML .= '<div class="swiper-slide swiper-lazy wke-picture-slider-item wke-picture-slider-item-' . esc_attr( $id ) . ' ' . esc_attr( $item['content_position'] ) . '">
                    <div class="swiper-lazy-preloader"></div>';
                   
                    if( $item['link']['url'] !== '' ){
                       $renderHTML .= '<a href="' . esc_url( $item['link']['url'] ) . '" ' . esc_html( $target ) . '" class="wke-picture-slider-link"></a>';
                    }

                    if( $item['title'] !== '' || $item['subtitle'] !== '' ) {
                    $renderHTML.= '<div class="wke-picture-slider-content">
                          <' . $item['title_wrapper'] . ' class="wke-picture-slider-title" ' . $textcolor . '>' . esc_attr( $item['title'] ) . '</' . $item['title_wrapper'] . '>
                              <div class="wke-picture-slider-subtitle" ' . $textcolor . '>' . esc_attr(stripslashes( $item['subtitle'] ) ) . '</div>
                      </div>';
                      $renderHTML .= '<div class="wke-picture-slider-overlay"></div>';
                    }
                    $renderHTML .= '<div class="wke-picture-slider-background" style="background:url(' . esc_url( $pictureUrl ) . ') no-repeat; background-size: ' . $item['picture_size'] . '; background-position: ' . $item['picture_position'] . ';"></div>';

                  $renderHTML .= '</div>';
            }

$renderHTML.= '</div>';

   if( $total_number > 1 ){
        $renderHTML.=  '<!-- If we need pagination -->
              <div class="swiper-pagination"></div>

              <!-- Add Arrows -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>';
   }
   
   $renderHTML.= '</div>';
}

echo $renderHTML;