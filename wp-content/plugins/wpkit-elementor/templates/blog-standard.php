<?php
/*
 * Standard Blog Template
 * @package WPKit For Elementor
 */

$number               =   $wke_data->number;
$show_thumbnail       =   $wke_data->show_thumbnail;
$thumbnail_align      =   $wke_data->thumbnail_align;
$pagination           =   $wke_data->pagination;
$category             =   $wke_data->category;
$extra_class          =   $wke_data->extra_class;
$order                =   $wke_data->order;
$orderby              =   $wke_data->orderby;
$social_share         =   $wke_data->social_share;
$boxed                =   $wke_data->boxed;
$post_meta_date       =   $wke_data->post_meta_date;
$post_meta_category   =   $wke_data->post_meta_category;
$post_meta_author     =   $wke_data->post_meta_author;

$extra_class .= ' thumbnail-' . $thumbnail_align;

/* Pagination */
static $blog_loop;

if( ! isset( $blog_loop ) )
  $blog_loop = 1;
else
  $blog_loop ++;

$paging = 'paged' . $blog_loop;
$paged = isset( $_GET[$paging] ) ? $_GET[$paging] : 1;
$pagination_base = add_query_arg( $paging, '%#%' );

$blog_section_id = 'wke-standard-blog-' . WKE_Util::random_string( 10 );

$renderHTML='<div id="' . esc_attr( $blog_section_id ) . '" class="wke-standard-blog ' . esc_attr( $extra_class ) . ' ' . esc_attr( $boxed ) . '">';

            $params = array(
              'posts_per_page' => esc_attr( $number ),
              'post_type'      => 'post',
              'category_name'  => esc_attr( $category ),
              'orderby'        => $orderby,
              'order'          => $order,
              'paged'          => $paged
            );

            $wke_blog_query = new WP_Query( $params );

            if ( $wke_blog_query->have_posts() ) {

                while ( $wke_blog_query->have_posts() ) : $wke_blog_query->the_post();
                   $no_thumbnail = ! has_post_thumbnail() ? 'wke-no-thumbnail' : '';

                   /* Loop HTML Markup Below */
                   $renderHTML .= '<div class="wke-post post-' . esc_attr( get_the_ID() ) . '">';

                     // Post Thumbnail
                     if( $show_thumbnail && has_post_thumbnail() ){
                        $renderHTML .= '<div class="wke-post-thumbnail" style="background-image:url(' . get_the_post_thumbnail_url( get_the_ID(), 'large' ) . ')">
                          <a href=" ' . esc_url( get_permalink() ) . ' "></a>
                        </div>';

                     }

                     $renderHTML .= '<div class="wke-post-entry ' . esc_attr( $no_thumbnail ) . '">';

                         //Post Title
                         $renderHTML .= '<h4 class="wke-post-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4>';

                         //Post Meta
                         $renderHTML .= '<div class="meta">';

                           if( $post_meta_date ) {
                              $renderHTML .= '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="datePublished" content="' . get_the_date( get_option('date_format') ) . '" class="meta-item">' .  get_the_date(get_option('date_format')) . '</a>';
                           }

                           if( $post_meta_category ) {
                              $renderHTML .= '<span class="category meta-item" itemprop="category">' . esc_html__( 'In', 'wpkit-elementor' ) . ' ' .get_the_category_list(', ') . '</span>';
                           }

                           if( $post_meta_author ) {
                              $renderHTML .= '<span class="author meta-item" itemprop="author" itemscope itemtype="http://schema.org/Person">' . esc_html__( 'By', 'wpkit-elementor' ) . ' ' . get_the_author_posts_link() . '</span>';
                           }

                         $renderHTML .= '</div>';

                         //Post Excerpt
                         $renderHTML .= '<p class="wke-post-excerpt">' . WKE_Util::truncate_string( esc_html( get_the_excerpt() ), 300 ) . '</p>';

                         //Post Footer
                         $renderHTML .= '<footer class="wke-post-footer">';

                                    if( $social_share ){
                                        $renderHTML .= wke_social_share( get_the_ID() );
                                    }

                                    $renderHTML .= '<a href=" ' . esc_url( get_permalink() ) .' " class="read-more">' . esc_html__( 'Continue to read', 'wpkit-elementor' ) . '</a>
                                         </footer>';

                     $renderHTML .= '</div>';

                   $renderHTML .= '</div>';

                endwhile;
                wp_reset_postdata();

            }else{
                $renderHTML .= '<div class="wke-standard-post"><p>' . esc_html__( 'No Posts Found', 'wpkit-elementor') . '</p></div>';
            }

$renderHTML .='</div>';

/* Pagination */
if( $pagination == '1' && wp_count_posts() > $number ):
   $renderHTML .= '<div class="wke-pagenavi">';
   $renderHTML .= paginate_links( array(
      'type'      => '',
      'base'      => $pagination_base,
      'format'    => '?' . $paging . '=%#%',
      'current'   => max( 1, $wke_blog_query->get( 'paged' ) ),
      'total'     => $wke_blog_query->max_num_pages
   ));
   $renderHTML .= '</div>';
endif;

echo $renderHTML;
