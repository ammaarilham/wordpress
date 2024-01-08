<?php
/*
 * Block Slider Elementor Template
 * @package WPKit For Elementor
 */

$block_slider               =   $wke_data->block_slider;

/* Element Frontend */
$id = WKE_Util::random_string( 10, false );
$renderHTML = '';
$total_number = 0;

if( $block_slider ) {
  $total_number = count( $block_slider );
  $renderHTML = '<div id="wke-swiper-slider-' . esc_attr( $id ) . '" class="wke-block-slider wke-swiper-slider swiper-container swiper-container-horizontal" data-direction="horizontal" data-auto-height="true" data-slider-per-view="auto">
              <div class="swiper-wrapper">';
              foreach( $block_slider as $item ){
                    $renderHTML .= '<div class="swiper-slide swiper-lazy wke-block-slider-item wke-block-slider-item-' . esc_attr( $id ) . '">'.Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['block'] ).'</div>';
              }

  $renderHTML.= '</div>';

   if( $total_number > 1 ){
        $renderHTML.=  '<!-- If we need pagination -->
              <div class="swiper-pagination"></div>';
   }
   
   $renderHTML.= '</div>';
}

echo $renderHTML;