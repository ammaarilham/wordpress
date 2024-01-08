<?php
/*
 * Blog Carousel Template
 * @package WPKit For Elementor
 */

$number               =   $wke_data->number;
$columns              =   $wke_data->columns;
$gap                  =   $wke_data->gap;
$category             =   $wke_data->category;
$order                =   $wke_data->order;
$orderby              =   $wke_data->orderby;
$autoplay             =   $wke_data->autoplay;
$dots                 =   $wke_data->dots;
$boxed                =   $wke_data->boxed;
$shape                =   $wke_data->shape;
$title_single_line    =   $wke_data->title_single_line;

$carousel_id = 'wke-carousel-' . WKE_Util::random_string(10);
$no_dots = ! $dots ? 'no-dots' : '';

$renderHTML = '<div id="' . esc_html( $carousel_id ) . '" data-columns="' . esc_attr( $columns ) . '" data-gap="' . esc_attr( $gap['size'] ) . '" data-auto-play="' . esc_attr( $autoplay ) . '" class="wke-carousel swiper-container '. $shape .' '. $no_dots .'">

                <div class="swiper-wrapper">';

                $params = array(
                  'posts_per_page' => esc_attr( $number ),
                  'post_type' => 'post',
                  'category_name' => esc_attr( $category ),
                  'orderby' => $orderby,
                  'order' => $order
                );

                $wke_carousel_query = new WP_Query( $params );
                if ( $wke_carousel_query->have_posts() ) {

                    while( $wke_carousel_query->have_posts() ) : $wke_carousel_query->the_post();

                       /* HTML Makeup below */
                       $renderHTML .= '<div class="swiper-slide wke-carousel-item wke-carousel-item-' . esc_attr( get_the_ID() ) . ' ' . esc_attr( $boxed ) . '">';
                       $renderHTML .= '<a href="' . esc_url( get_permalink() ) . '" class="wke-carousel-thumbnail"><img src="' . esc_url( get_the_post_thumbnail_url( get_the_ID(),'large' ) ) . '" alt=" ' . esc_attr( get_the_title() ) . ' " /></a>';
                       $renderHTML .= '<h4 class="wke-carousel-title '. $title_single_line .'"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4>';
                       $renderHTML .= '<p class="wke-carousel-excerpt">' . WKE_Util::truncate_string( get_the_excerpt(), 80 ) . '</p>';
                       $renderHTML .= '</div>';

                    endwhile;
                    wp_reset_postdata();
                }else{
                  $renderHTML .= '<div class="swiper-slide wke-carousel-item"><p>' . esc_html__( 'No Posts Found','wpkit-elementor' ) . '</p></div>';
                }

$renderHTML .='</div>';

if( $dots ) {
  $renderHTML .= '<!-- If we need pagination -->
                <div class="swiper-pagination"></div>';
}

$renderHTML .= '<div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
</div>';

// Don't delete the following codes
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    $renderHTML .= '<script>window.WKE.swiper();</script>';
}

echo $renderHTML;
