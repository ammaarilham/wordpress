<?php
/*
 * Woo Product Carousel Template
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
$fullwidth            =   $wke_data->fullwidth;
$show_price           =   $wke_data->show_price;
$show_button          =   $wke_data->show_button;
$grid_style           =   $wke_data->grid_style;
$product_filter       =   $wke_data->product_filter;
$zoom_in              =   $wke_data->zoom_in;
$center_text          =   $wke_data->center_text;
$image_size           =   $wke_data->image_size;
$boxed                =   $wke_data->boxed;
$shape                =   $wke_data->shape;

$carousel_id = 'wke-carousel-' . WKE_Util::random_string(10);

if( $grid_style == 'overlay' ){
      $extra_class .= 'no-title';
}

if( $fullwidth == 'fullwidth' ){
      $extra_class .= 'wke-fullwidth';
}

if( $zoom_in ){
      $extra_class .= 'zoom-in';
}

if( $center_text ){
      $extra_class .= 'text-center';
}


$renderHTML = '<div id="' . esc_attr( $carousel_id ) . '" data-columns="' . esc_attr( $columns ) . '" data-gap="' . esc_html( $gap['size'] ) . '" data-auto-play="' . esc_attr( $autoplay ) . '" class="wke-carousel swiper-container '.$shape.' '.esc_attr( $extra_class ).'">
                <div class="swiper-wrapper">';

                $params = array(
                  'posts_per_page' => esc_attr( $number ),
                  'post_type' => 'product',
                  'product_cat' => esc_attr( $category ),
                  'orderby' => $orderby,
                  'order' => $order
                );

                if( $product_filter == '_featured' ) {
                  $params['tax_query']= array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                        )
                  );
                }

                if( $product_filter == '_sale_price' ) {
                  $params['post__in'] = wc_get_product_ids_on_sale();
                }

                $wke_carousel_query = new WP_Query($params);

                if( $wke_carousel_query->have_posts() ) {
                    while ( $wke_carousel_query->have_posts() ) : $wke_carousel_query->the_post();
                       global $product;

                       /* Get Product Informations */
                       $sale_price = $product->get_sale_price();
                       $regular_price = $product->get_regular_price();
                       $price = $product->get_price();
                       $rating = wc_get_rating_html( $product->get_average_rating() );
                       $review_count = $product->get_review_count();
                       $product_title = esc_html( get_the_title() );
                       $product_type = $product->get_type();
                       $product_link = get_permalink();

                       //Out of stock label
                       $nostock = $product->is_in_stock() ? '' : '<span class="no-stock">'.esc_html__('Out of Stock!','wpkit-elementor').'</span>';

                       //Cart Button Type
                       $ajax_class = '';
                       $icon_text = '';
                       $target = '';
                       $button_link = 'javascript:void(0);';

                       switch ( $product_type ) {
                        case 'external':
                          $icon_text = '<i class="fa fa-external-link"></i>';
                          $target = 'target="_blank"';
                          $button_link = $product_link;
                        break;

                        case 'grouped':
                          $icon_text = '<i class="fa fa-link"></i>';
                        break;

                        case 'simple':
                          $icon_text = '<i class="fa fa-shopping-cart"></i><i class="fa fa-spinner fa-spin"></i><i class="fa fa-check"></i>';
                          $button_link = esc_url( get_permalink() ).'?add-to-cart=' . esc_attr( get_the_ID() );
                          $ajax_class .= 'product_type_simple add_to_cart_button ajax_add_to_cart';
                        break;

                        case 'variable':
                          $icon_text = '<i class="fa fa-cog"></i>';
                        break;
                       }

                       /* HTML Makeup below */
                       $renderHTML .= '<div class="swiper-slide wke-carousel-item wke-carousel-item-' . esc_attr( get_the_ID() ) . ' ' . esc_attr( $boxed ) . '">';
                       //Highlight Label
                       if( $product->is_on_sale() ) {
                         $renderHTML .= '<span class="on-sale">' . esc_html__( 'Sale!','wpkit-elementor' ) . '</span>';
                       }
                       $renderHTML .= '<div class="wke-carousel-thumbnail '. $hover_effect . '">
                                          <img src="' . esc_url( get_the_post_thumbnail_url( get_the_ID(),'large' ) ) . '" alt=" ' . esc_attr( get_the_title() ) . ' " />
                                          <div class="overlay">';
                                             if( $grid_style == 'overlay' ){
                                                 $renderHTML .= '<a class="title" href="' . esc_url( $product_link ) . '">' . esc_attr( get_the_title() ) . '</a>';
                                                 if( $show_price == '1' ) {
                                                   //Price
                                                   if( $sale_price !== '' && $sale_price !== '0' ) {
                                                     $renderHTML .= '<span class="sale-price">' . wc_price( $sale_price ) .'</span>';
                                                     $renderHTML .= '<del class="regular-price">' . wc_price( $regular_price ) . '</del>';
                                                   }else{
                                                     $renderHTML .= '<span class="wke-carousel-price">' . wc_price( $price ) . '</span>';
                                                   }
                                                 }
                                                 $renderHTML .= '<div class="button-area wke-cart-button">';

                                                 if( $show_button == '1' ) {
                                                  $renderHTML .= '<a href="' . esc_url( $button_link ) . '"
                data-quantity="1" data-product_id="' . $product->get_id() . '"
                class="buy wke-carousel-button ' . esc_attr( $ajax_class ) . '">' . $icon_text . '</a>';
                                                 }

                                                 $renderHTML .= '<a href="' . esc_url( $product_link ) . '" class="view wke-carousel-button"><i class="fa fa-plus"></i></a>';

                                                 do_action( 'wke_woo_product_carousel_button_area' );

                                                 $renderHTML .= '</div>';

                                            }else{
                                                $renderHTML .= '<div class="button-area wke-cart-button">';

                                                if( $show_button == '1' ){
                                                  $renderHTML .= '<a href="' . esc_url( $button_link ) . '"
                data-quantity="1" data-product_id="' . $product->get_id() . '"
                class="buy wke-carousel-button ' . esc_attr( $ajax_class ) . '">' . $icon_text . '</a>';
                                                }

                                                $renderHTML .= '<a href="' . esc_url( $product_link ) . '" class="details wke-carousel-button"><i class="fa fa-plus"></i></a>';

                                                do_action( 'wke_woo_product_carousel_button_area' );

                                                $renderHTML .= '</div>';
                                            }

                          $renderHTML .= '</div>
                                       </div>';

                       if( $grid_style == 'default' ) {
                         $renderHTML .= '<h4 class="wke-carousel-title"><a href="' . esc_url( $product_link ) . '">' . esc_html( get_the_title() ) . '</a></h4>';

                         if( $show_price == '1' ){
                            $renderHTML .= '<div class="wke-carousel-price">';
                                //Price
                               if( $sale_price !== '' && $sale_price !== '0' ) {
                                 $renderHTML .= '<span class="sale-price">' . wc_price( $sale_price ) . '</span>';
                                 $renderHTML .= '<del class="regular-price">' . wc_price( $regular_price ) . '</del>';
                               }else{
                                 $renderHTML .= '<span class="price">' . wc_price( $price ) . '</span>';
                               }
                            $renderHTML .= '</div>';
                         }
                         do_action( 'wke_woo_product_carousel_after_title' );
                       }
                       $renderHTML .= '</div>';

                    endwhile;
                    wp_reset_postdata();
                }else{
                  $renderHTML .= '<div class="swiper-slide wke-carousel-item"><p>' . esc_html__( 'No Product Found','wpkit-elementor') . '</p></div>';
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

echo $renderHTML;
