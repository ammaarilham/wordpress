<?php
/*
 * EDD Product Grid Template
 * @package WPKit For Elementor
 */

$products_number          =   $wke_data->number;
$products_layout          =   $wke_data->layout;
$products_no_margin       =   $wke_data->no_margin;
$products_columns         =   $wke_data->columns;
$products_shape           =   $wke_data->shape;
$products_pagination      =   $wke_data->pagination;
$products_category        =   $wke_data->category;
$products_extra_class     =   $wke_data->extra_class;
$products_thumbnail_size  =   $wke_data->thumbnail;
$products_orderby         =   $wke_data->orderby;
$products_show_price      =   $wke_data->show_price;
$products_show_button     =   $wke_data->show_button;
$products_grid_style      =   $wke_data->grid_style;
$products_infinite        =   $wke_data->infinite;
$products_min_height      =   $wke_data->min_height;

/* Columns */
$columns_class = '';

switch( $products_columns ) {
  case '2':
    $columns_class = 'small-12 medium-6 large-6 cell';
    $products_extra_class .= ' two-columns';
    break;

  case '3':
    $columns_class = 'small-12 medium-6 large-4 cell';
    $products_extra_class .= ' three-columns';
    break;

  case '4':
    $columns_class = 'small-12 medium-6 large-3 cell';
    $products_extra_class .= ' four-columns';
    break;
} 

/* Pagination */
static $products_loop;

if( !isset( $products_loop ) )
  $products_loop = 1;
else
  $products_loop ++;

$paging = 'paged' . $products_loop;

if( isset( $_GET[$paging] ) ) {
   $paged = $_GET[$paging];
}else{
   $paged = 1;
}

$pagination_base = add_query_arg( $paging, '%#%' );

/* Grid ID */
$grid_object_id = WKE_Util::random_string( 10 );

/* Grid Gutter */
$grid_margin = $products_no_margin == 'no_margin' ? 'no-margin' : 'grid-margin-x';

$renderHTML = '';
$renderHTML .= '<div id="wke-edd-products-' . esc_attr( $grid_object_id ) . '" class="wke-grids grid-x ' . $grid_margin . ' ' . esc_html( $products_extra_class ) . ' wke-grid-style-' . $products_grid_style . ' ' . $products_no_margin . ' wke-' . $products_layout . '-container" data-id="' . $grid_object_id . '" data-thumbnail-height="' . $products_min_height['size'] . $products_min_height['unit'] . '" data-infinite="' . $products_infinite . '">';
            
            /* Data Query */
            $params = array(
              'posts_per_page'   => $products_number, 
              'post_type'        => 'download',
              'orderby'          => $products_orderby,
              'order'            => 'desc',
              'download_category'=> esc_attr( $products_category ),
              'paged'            => $paged
            ); 

            $edd_query = new WP_Query( $params ); 
            if ( $edd_query->have_posts() ) {
                while ( $edd_query->have_posts() ) : $edd_query->the_post();
                    
                    /* EDD Buy Link */
                    $buy_link = apply_filters( 'wke_edd_buy_link', home_url('/').'checkout?edd_action=add_to_cart&download_id=' . $post->ID );

                    $renderHTML .= '<div class="wke-grid-item wke-edd-grid-' . esc_attr( get_the_ID() ) . ' ' . $columns_class . '">';
                    $renderHTML .= '<div class="wke-grid-thumbnail ' . $products_shape . '">' . get_the_post_thumbnail( get_the_ID(), $products_thumbnail_size, array( 'alt' => esc_attr(get_the_title() ) ) ).
                    '<div class="overlay">';
                      /* Overlay Grid Style: Overlay */
                      if( $products_grid_style == 'overlay' ){
                         $renderHTML .= '<a class="wke-grid-title title" href="' . esc_url( get_the_permalink() ) . '">' . esc_attr( get_the_title() ) . '</a>';
                         if( $products_show_price == '1' ) {
                           $renderHTML .= edd_price( get_the_ID(), false );
                         }
                         $renderHTML .= '<div class="button-area">';
                         if( $products_show_button == '1' ){
                          $renderHTML .= '<a href="'. esc_url( $buy_link ) . '" class="buy grid-button"><i class="fa fa-shopping-cart"></i></a>';
                         }
                         $renderHTML .= '<a href="' . esc_url( get_permalink() ) . '" class="view grid-button"><i class="fa fa-plus"></i></a>';
                         $renderHTML .= '</div>';
                      
                      /* Default Grid Style: Button Area */
                      }else{
                        $renderHTML .= '<div class="button-area">';
                        $renderHTML .= '<a href="' . esc_url( get_permalink() ) . '" class="details grid-button"><i class="fa fa-plus"></i></a>';
                        if( $products_show_button == '1' ){
                          $renderHTML .= '<a href="'. esc_url( $buy_link ) . '" class="buy grid-button"><i class="fa fa-shopping-cart"></i></a>';
                        }
                        $renderHTML .= '</div>';
                      }

                    $renderHTML .= '</div>
                    </div>';

                    /* Default Grid Style: Text Area */
                    if( $products_grid_style == 'default' ){
                       $renderHTML .= '<h3 class="wke-grid-title"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</a>
                       '. get_the_term_list( $post->ID, 'download_category', '', ', ', '' ).'
                       </h3>';
                       if( $products_show_price == '1' ){
                         $renderHTML .= '<div class="wke-grid-price">' . edd_price( get_the_ID(), false ) . '</div>';
                       }
                       do_action( 'wke_edd_products_after_title' );
                     }
                    $renderHTML .= '</div>';
                endwhile; 
                wp_reset_postdata(); 
            }else{
                $renderHTML.='<p>'.esc_html__( 'No Item Found', 'wpkit-elementor').'</p>';
            }
 
$renderHTML .='</div>';

/* Pagination */
if( $products_pagination == '1' ){
   $renderHTML .= '<div class="wke-pagenavi">';
   $renderHTML .= paginate_links( array(
      'type'      => '',
      'base'      => $pagination_base,
      'format'    => '?'. $paging .'=%#%',
      'current'   => max( 1, $edd_query->get( 'paged' ) ),
      'total'  => $edd_query->max_num_pages
   ));
   $renderHTML .= '</div>';
}

// Don't delete the following codes
if( isset( $_GET['action'] ) && $_GET['action'] == 'elementor' ) {
    $renderHTML .= "<script>window.WKE.grid_system();</script>";
}

echo $renderHTML;