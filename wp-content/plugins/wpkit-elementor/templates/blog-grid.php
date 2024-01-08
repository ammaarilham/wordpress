<?php
/*
 * Grid Blog Template
 * @package WPKit For Elementor
 */

$number               =   $wke_data->number;
$pagination           =   $wke_data->pagination;
$category             =   $wke_data->category;
$extra_class          =   $wke_data->extra_class;
$columns              =   $wke_data->columns;
$order                =   $wke_data->order;
$orderby              =   $wke_data->orderby;
$post_meta_date       =   $wke_data->post_meta_date;
$post_meta_category   =   $wke_data->post_meta_category;
$post_meta_author     =   $wke_data->post_meta_author;

/* Pagination */
static $blog_loop;

if( ! isset( $blog_loop ) )
  $blog_loop = 1;
else
  $blog_loop ++;

$paging = 'paged' . $blog_loop;
$paged = isset( $_GET[$paging] ) ? $_GET[$paging] : 1;
$pagination_base = add_query_arg( $paging, '%#%' );

$blog_section_id = 'wke-grid-blog-' . WKE_Util::random_string( 10 );

$renderHTML='<div id="' . esc_attr( $blog_section_id ) . '" class="wke-grid-blog ' . esc_html( $columns ) . ' ' . esc_html( $extra_class ) . '">';

            $params = array(
              'posts_per_page' => $number, 
              'post_type'      => 'post',
              'category_name'  => $category,
              'orderby'        => $orderby,
              'order'          => $order,
              'paged'          => $paged
            ); 

            $wke_blog_query = new WP_Query( $params ); 

            if ( $wke_blog_query->have_posts() ) {

                while ( $wke_blog_query->have_posts() ) : $wke_blog_query->the_post();  
                  
                  // Post Thumbnail
                  if( has_post_thumbnail() ){
                        
                  }

                   /* Loop HTML Markup Below */
                   $renderHTML .= '<div class="wke-post post-' . esc_attr( get_the_ID() ) . '">';

                    // Post Thumbnail
                     if( has_post_thumbnail() ){
                        $renderHTML .= '<div class="wke-post-thumbnail" style="background-image:url(' . get_the_post_thumbnail_url( get_the_ID(), 'large' ) . ')">
                          <a href=" ' . esc_url( get_permalink() ) . ' " class="overlay"></a>
                        </div>';
                     }
                     
                     $renderHTML .= '<div class="wke-post-entry">';

                         if( $post_meta_category ) {
                            $renderHTML .= '<span class="category-link" itemprop="category">' .get_the_category_list(', ') . '</span>';
                         }

                         //Post Title
                         $renderHTML .= '<h4 class="wke-post-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4>';

                         //Post Meta
                         $renderHTML .= '<div class="meta">';
                           
                           if( $post_meta_date ) {
                              $renderHTML .= '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="datePublished" content="' . get_the_date( get_option('date_format') ) . '" class="meta-item">' .  get_the_date(get_option('date_format')) . '</a>';
                           }

                           if( $post_meta_author ) {
                              $renderHTML .= '<span class="author meta-item" itemprop="author" itemscope itemtype="http://schema.org/Person">' . esc_html__( 'By', 'wpkit-elementor' ) . ' ' . get_the_author_posts_link() . '</span>';
                           }

                         $renderHTML .= '</div>';


                     $renderHTML .= '</div>';

                   $renderHTML .= '</div>';

                endwhile; 
                wp_reset_postdata(); 

            }else{
                $renderHTML .= '<div class="wke-post"><p>' . esc_html__( 'No Posts Found', 'wpkit-elementor') . '</p></div>';
            }
 
$renderHTML .='</div>';

/* Pagination */
if( $pagination == '1' ){
   $renderHTML .= '<div class="wke-pagenavi">';
   $renderHTML .= paginate_links( array(
      'type'      => '',
      'base'      => $pagination_base,
      'format'    => '?' . $paging . '=%#%',
      'current'   => max( 1, $wke_blog_query->get( 'paged' ) ),
      'total'     => $wke_blog_query->max_num_pages
   ));
   $renderHTML .= '</div>';
}

echo $renderHTML;