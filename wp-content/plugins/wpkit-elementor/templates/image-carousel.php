<?php
/*
 * Image Carousel Template
 * @package WPKit For Elementor
 */

$image_carousel       =   $wke_data->image_carousel;
$columns              =   $wke_data->columns;
$grid_style           =   $wke_data->grid_style;
$gap                  =   $wke_data->gap;
$hover_effect         =   $wke_data->hover_effect;
$extra_class          =   $wke_data->extra_class;
$autoplay             =   $wke_data->autoplay;
$boxed                =   $wke_data->boxed;
$shape                =   $wke_data->shape;

$carousel_id = 'wke-carousel-' . WKE_Util::random_string(10);
$responsive_gap = $gap['size'] - 10;
$auto = $autoplay == 0 ? '0' : '8000';

if( $image_carousel ) {
  $renderHTML = '<div id="' . $carousel_id . '"  data-columns="' . $columns . '" data-gap="' . $gap['size'] . '" class="wke-carousel swiper-container '.$esc_attr( $shape ).' ' . esc_attr( $extra_class ) . '">
                  <div class="swiper-wrapper">';

                  foreach( $image_carousel as $item ){
                     $target = $item['link']['is_external'] ? 'target="_blank"' : '';

                     /* HTML Makeup below */
                     $renderHTML .= '<div class="swiper-slide wke-carousel-item ' . esc_attr( $boxed ) . '">';
                     if( isset( $item['link']['url'] ) && $item['link']['url'] !== '' ) {
                       $renderHTML .= '<a href="' . esc_url( $item['link']['url'] ) . '" class="wke_carousel_thumbnail ' . $hover_effect . '" style="background-image:url('.esc_url( $item['image']['url'] ) . ');" ' . esc_html( $target ) . '></a>';

                       if( $grid_style == 'default' ) {
                          $renderHTML .= '<h4 class="wke-carousel-title"><a href="' . esc_url( $item['link']['url'] ) . '">' . esc_html( $item['title'] ) . '</a></h4>';
                       }
                     }else{
                       $renderHTML .= '<div class="wke-carousel-thumbnail" ' . esc_attr( $target ) . '><img src="' . esc_url( get_the_post_thumbnail_url( get_the_ID(),'large' ) ) . '" alt=" ' . esc_attr( get_the_title() ) . ' " /></div>';
                       if($grid_style == 'default'){
                          $renderHTML .= '<h4 class="wke-carousel-title">' . esc_html( $item['title'] ) . '</h4>';
                       }
                     }

                     if( $grid_style == 'default' ) {
                       $renderHTML .= '<p class="wke-carousel-excerpt">' . $item['content'] . '</p>';
                     }
                     $renderHTML .= '</div>';
                  }
  $renderHTML .= '</div>

      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

  </div>';

  // Don't delete the following codes
  if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    $renderHTML .= '<script>window.WKE.swiper();</script>';
  }
}

echo $renderHTML;
