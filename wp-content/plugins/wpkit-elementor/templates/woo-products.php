<?php
/*
 * WooCommerce Product Grid Shortcode Template
 * @package WPKit For Elementor
 */

$product_item_number     =   $wke_data->number;
$product_grid_columns    =   $wke_data->columns;
$product_pagination      =   $wke_data->pagination;
$product_category        =   $wke_data->category;
$product_extra_class     =   $wke_data->extra_class;
$product_filter          =   $wke_data->product_filter;
$product_grid_style      =   $wke_data->grid_style;
$product_layout          =   $wke_data->layout;
$product_infinite        =   $wke_data->infinite;
$product_no_margin       =   $wke_data->no_margin;
$product_grid_shape      =   $wke_data->shape;
$product_thumbnail_size  =   $wke_data->thumbnail;
$product_orderby         =   $wke_data->orderby;
$product_featured_label  =   $wke_data->featured_label;
$product_onsale_label    =   $wke_data->onsale_label;
$center_text             =   $wke_data->center_text;


/* Columns */
$columns_class = '';
$image_size = '';

switch( $product_grid_columns ) {
  case '2':
    $columns_class = 'small-12 medium-6 large-6 cell';
    $product_extra_class .= ' two-columns';
    $image_size = 'large';
    break;

  case '3':
    $columns_class = 'small-12 medium-6 large-4 cell';
    $product_extra_class .= ' three-columns';
    $image_size = 'medium';
    break;

  case '4':
    $columns_class = 'small-12 medium-6 large-3 cell';
    $product_extra_class .= ' four-columns';
    $image_size = 'thumbnail';
    break;
} 

if( $center_text ){
    $product_extra_class .= 'text-center';
}

/* Pagination */
static $product_loop;
global $post;

if( !isset( $product_loop ) )
  $product_loop = 1;
else
  $product_loop ++;

$paging = 'paged' . $product_loop;
$paged = isset($_GET[$paging]) ? $_GET[$paging] : 1;
$pagination_base = add_query_arg( $paging, '%#%');

/* Grid ID */
$grid_object_id = WKE_Util::random_string( 10 );

/* Grid Margin */
$grid_margin = $product_no_margin =='no-margin' ? 'no-margin' : 'grid-margin-x';

$renderHTML = '<div id="wke-wc-products-' . $grid_object_id . '" class="wke-grids woocommerce grid-x ' . $grid_margin . ' ' . esc_html( $product_extra_class ) .' wke-grid-style-' . $product_grid_style . ' wke-' . $product_layout . '-container" data-id="' . $grid_object_id . '" data-infinite="' . $product_infinite . '">';
           
            //Data Query
            $params = array(
              'posts_per_page' => $product_item_number, 
              'post_type' => 'product',
              'product_cat' => esc_attr( $product_category ),
              'paged'   => $paged,
              'order'   => 'desc',
              'orderby' => esc_attr( $product_orderby )
            ); 

            if( $product_filter == '_featured' ) {
              $params['tax_query'] = array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                    )
              );
            }

            if( $product_filter == '_sale_price' ) {
              $params['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
            }

            $wc_query = new WP_Query( $params ); 

            if ( $wc_query->have_posts() ) {
              
                while ( $wc_query->have_posts()) : $wc_query->the_post();  
                   global $product;

                   $offset = rand( -1,1 ) / 25;

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
                  

                   //Button Icon
                   switch ( $product_type ) {
                    case 'external':
                      $icon_text = '<i class="fa fa-external-link"></i>' . '<span>' . esc_html__( 'View Product', 'wpkit-elementor' ) . '</span>';
                      $target ='target="_blank"';
                      $button_link = $product_link;
                    break;

                    case 'grouped':
                      $icon_text = '<i class="fa fa-link"></i>' . '<span>' . esc_html__( 'View All Related Products','wpkit-elementor') . '</span>';
                    break;

                    case 'simple':
                      $icon_text = '<i class="fa fa-shopping-cart"></i><i class="fa fa-spinner fa-spin"></i><i class="fa fa-check"></i>' . '<span>' . esc_html__( 'Add to Cart','wpkit-elementor' ) . '</span>';
                      $ajax_class .= 'ajax_add_to_cart';
                    break;

                    case 'variable':
                      $icon_text = '<i class="fa fa-cog"></i>' . '<span>' . esc_html__( 'Select Options', 'wpkit-elementor' ) . '</span>';
                    break;
                   }

                   $featured_class = $product->is_featured() ? 'wke-featured-product' : '';

                   /* HTML Makeup below */
                   $renderHTML .= '<div class="wke-grid-item ' . $featured_class . ' wke-wc-product-item wke-wc-product-item-' . get_the_ID() . ' ' . $columns_class . '">';
                       
                       //Highlight Label
                       if( $product->is_on_sale() && $product_onsale_label == '1' ) {
                         $renderHTML .= '<span class="on_sale">' . esc_html__( 'Sale!', 'wpkit-elementor' ) . '</span>';
                       }

                       //Thumbnail & Title & Cart Button
                       $renderHTML .= '<div class="wke-grid-thumbnail product-showcase">';
                       if( $product->is_featured() && $product_featured_label == '1' ) {
                            $renderHTML .= '<span class="featured">' . esc_html__( 'Featured!', 'wpkit-elementor') . '</span>';
                       }

                       //Thumbnail
                       $attachment_ids = $product->get_gallery_image_ids();
                       $hover_image =  '';
                       $attachment_id = '';
                       
                       if( count( $attachment_ids ) > 0 && isset( $attachment_ids[0] ) ) {
                          $attachment_id = $attachment_ids[0]; 
                          $hover_image = '<span class="product-hover-image" style="background-image:url('.esc_url( wp_get_attachment_url( $attachment_id ) ).');background-size:cover;background-position:center;"></span>';   
                       }

                       $renderHTML .= '<a class="wke-grid-thumbnail ' . $product_grid_shape . '" href="' . esc_url( $product_link ) . '" ' . $target . '>';
                       
                       $renderHTML .= $hover_image;

                       if( has_post_thumbnail() ) {
                             $renderHTML .= get_the_post_thumbnail( get_the_ID(), $image_size );
                       }
                       $renderHTML .= '</a>';

                       if( $product->is_in_stock() ){
                         if( $product_grid_style == 'default' || $product_grid_style == '' ){
            
                           //Add to cart button
                           $renderHTML .= '<div class="button-area wke-cart-button"><a href="' . esc_url( $button_link ) . '"
            data-quantity="1" data-product_id="' . $product->get_id() . '"
            class="button alt add_to_cart_button product_type_simple ' . esc_attr( $ajax_class ) . '">' . $icon_text . '</a></div>';

                         // Overlay Grid Style
                         }elseif( $product_grid_style == 'overlap' ) {
                             $renderHTML.='<div class="overlay">
                             
                             <h3 class="title"><a href="' . esc_url( $product_link ) . '" ' . $target . '>' . esc_html( get_the_title() ) . '</a>' . $nostock . '</h3>';
                             
                             //Star Rating
                             if( $average = $product->get_average_rating() ) {
                              $renderHTML .= '<div class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'wpkit-elementor' ), $average ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . esc_html__( 'out of 5', 'wpkit-elementor' ) . '</span></div>'; 
                             }

                             //Price
                             if( $sale_price !== '' && $sale_price !== '0' ) {
                               $renderHTML .= '<span class="sale-price">' . wc_price( $sale_price ) . '</span>';
                               $renderHTML .= '<del class="regular-price">' . wc_price( $regular_price ) .'</del>';
                             }else{
                               $renderHTML .= '<span class="price">' . wc_price( $price ) . '</span>';
                             }

                             //Button
                             $renderHTML .= '<div class="button-area wke-cart-button">
                                             <a href="' . esc_url( $button_link ) . '" data-quantity="1" data-product_id="' . $product->get_id() . '" class="button alt add_to_cart_button product_type_simple ' . esc_attr( $ajax_class ) . '">' . $icon_text . '</a>
                                             ' . do_action( 'wke_woo_products_buttons' ) . '
                                          </div>

                             </div>';
                          }
                       }

                       $renderHTML .= '</div>';

                       // Grid Default Style
                       if( $product_grid_style == 'default' || $product_grid_style == '' ) {

                         //Product Title
                         $renderHTML .= '<h3 class="wke-grid-title"><a href="' . esc_url( $product_link ) . '" ' . $target . '>' . get_the_title() . '</a>' . $nostock . '</h3>';
                         
                         //Star Rating
                         if( $average = $product->get_average_rating() ){
                          
                          $renderHTML .= '<div class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'wpkit-elementor' ), $average ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . esc_html__( 'out of 5', 'wpkit-elementor' ) . '</span></div>'; 
                         }

                         //Price
                         if( $sale_price !== '' && $sale_price !== '0' ) {
                           $renderHTML .= '<span class="sale-price">' . wc_price( $sale_price ) . '</span>';
                           $renderHTML .= '<del class="regular-price">' . wc_price( $regular_price ) . '</del>';
                         }else{
                           $renderHTML .= '<span class="price">' . wc_price( $price ) . '</span>';
                         }
                       }

                       $renderHTML .= '</div>';
                    endwhile; 
                    wp_reset_postdata(); 
            }else{
                $renderHTML .= '<p>' . esc_html__( 'No Products Found','wpkit-elementor') . '</p>';
            }

$renderHTML .= '</div>';

if( $product_pagination == '1' ):
   $renderHTML .= '<div class="wke_pagenavi">';
   $renderHTML .= paginate_links( array(
      'type'      => '',
      'base'      => $pagination_base,
      'format'    => '?'. $paging .'=%#%',
      'current'   => max( 1, $wc_query->get('paged') ),
      'total'  => $wc_query->max_num_pages
   ));
   $renderHTML .= '</div>';
endif;

// Don't delete the following codes
if( isset( $_GET['action'] ) && $_GET['action'] == 'elementor' ){
      $renderHTML .= "<script>window.WKE.grid_system();</script>";
}

do_action( 'wke_after_woo_grid' );

echo $renderHTML;