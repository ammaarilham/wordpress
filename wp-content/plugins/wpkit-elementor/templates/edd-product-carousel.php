<?php
/*
 * EDD Product Carousel Template
 * @package WPKit For Elementor
 */

$number               =   $wke_data->number;
$columns              =   $wke_data->columns;
$gap                  =   $wke_data->gap;
$category             =   $wke_data->category;
$order                =   $wke_data->order;
$orderby              =   $wke_data->orderby;
$autoplay             =   $wke_data->autoplay;
$hover_effect         =   $wke_data->hover_effect;
$show_price           =   $wke_data->show_price;
$show_button          =   $wke_data->show_button;
$grid_style           =   $wke_data->grid_style;
$boxed                =   $wke_data->boxed;
$shape                =   $wke_data->shape;

$carousel_id = 'wke-carousel-' . WKE_Util::random_string(10);
$extra_class = $grid_style == 'overlay' ? 'no-title' : '';

$renderHTML = '<div id="' . esc_attr( $carousel_id ) . '" data-columns="' . esc_attr( $columns ) . '" data-gap="' . esc_attr( $gap['size'] ) . '" data-auto-play="' . esc_attr( $autoplay ) . '" class="wke-carousel swiper-container '.$shape.' '.esc_attr( $extra_class ).'">
            <div class="swiper-wrapper">';
            $params = array(
              'posts_per_page' => esc_attr( $number ),
              'post_type' => 'download',
              'download_category' => esc_attr( $category ),
              'orderby' => $orderby,
              'order' => $order
            );

            $wke_carousel_query = new WP_Query( $params );

            if ( $wke_carousel_query->have_posts() ) {
                while ( $wke_carousel_query->have_posts() ) : $wke_carousel_query->the_post();
                   $buy_link = apply_filters( 'wke_edd_buy_link', home_url('/').'checkout?edd_action=add_to_cart&download_id=' . $post->ID );

                   /* HTML Makeup below */
                   $renderHTML .= '<div class="swiper-slide wke-carousel-item wke-carousel-item-' . esc_attr( get_the_ID() ) . ' ' . esc_attr( $boxed ) . '">';
                   $renderHTML .= '<div class="wke-carousel-thumbnail ' . $hover_effect . '">
                                      <img src="' . esc_url( get_the_post_thumbnail_url( get_the_ID(),'large' ) ) . '" alt=" ' . esc_attr( get_the_title() ) . ' " />
                                      <div class="overlay">';
                                         if( $grid_style == 'overlay' ){
                                             $renderHTML .= '<a class="title" href="' . esc_url( get_the_permalink() ) . '">' . esc_attr( get_the_title() ) . '</a>';
                                             if( $show_price == '1' ) {
                                               $renderHTML .= edd_price( get_the_ID(), false );
                                             }
                                             $renderHTML .= '<div class="button-area">';
                                             if( $show_button == '1' ) {
                                              $renderHTML .= '<a href="' . esc_url( $buy_link ) . '" class="buy wke-carousel-button"><i class="fa fa-shopping-cart"></i></a>';
                                             }
                                             $renderHTML .= '<a href="' . esc_url( get_permalink() ) .'" class="view wke-carousel-button"><i class="fa fa-plus"></i></a>';
                                             $renderHTML .= '</div>';
                                        }else{
                                            $renderHTML .= '<div class="button-area">';
                                            $renderHTML .= '<a href="' . esc_url( get_permalink() ) . '" class="details wke-carousel-button"><i class="fa fa-plus"></i></a>';
                                            if( $show_button == '1' ){
                                              $renderHTML .= '<a href="'. esc_url( $buy_link ) . '" class="buy wke-carousel-button"><i class="fa fa-shopping-cart"></i></a>';
                                            }
                                            $renderHTML .= '</div>';
                                        }
                      $renderHTML .= '</div>
                                   </div>';
                   if( $grid_style == 'default' ) {
                     $renderHTML .= '<h4 class="wke-carousel-title"><a href="'. esc_url( get_permalink() ) . '">'. esc_html( get_the_title() ) . '</a></h4>';
                     if( $show_price == '1' ) {
                        $renderHTML .= '<div class="wke-carousel-price">' . edd_price( get_the_ID(), false ) . "</div>";
                     }
                     do_action( 'wke_edd_product_carousel_after_title' );
                   }
                   $renderHTML .= '</div>';

                endwhile;
                wp_reset_postdata();
            }else{
              $renderHTML .= '<div class="swiper-slide wke-carousel-item"><p>' . esc_html__( 'No Posts Found','wpkit-elementor' ) . '</p></div>';
            }

$renderHTML .='</div>

    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

</div>';

// Don't delete the following codes
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    $renderHTML .= '<script>window.WKE.swiper();</script>';
}

echo $renderHTML;
