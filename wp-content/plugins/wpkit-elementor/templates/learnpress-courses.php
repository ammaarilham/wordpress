<?php
/*
 * LearnPress Courses Grid Template
 * @package WPKit For Elementor
 */

$courses_number          =   $wke_data->number;
$courses_layout          =   $wke_data->layout;
$courses_no_margin       =   $wke_data->no_margin;
$courses_columns         =   $wke_data->columns;
$courses_shape           =   $wke_data->shape;
$courses_boxed           =   $wke_data->boxed;
$courses_pagination      =   $wke_data->pagination;
$courses_category        =   $wke_data->category;
$courses_extra_class     =   $wke_data->extra_class;
$courses_thumbnail_size  =   $wke_data->thumbnail;
$courses_orderby         =   $wke_data->orderby;
$courses_show_price      =   $wke_data->show_price;
$courses_show_category   =   $wke_data->show_category;
$courses_infinite        =   $wke_data->infinite;
$courses_min_height      =   $wke_data->min_height;
$courses_single_line_title     =   $wke_data->title_single_line;
$courses_show_students_count   =   $wke_data->show_students_count;

/* Columns */
$columns_class = '';

switch( $courses_columns ) {
  case '2':
    $columns_class = 'small-12 medium-6 large-6 cell';
    $courses_extra_class .= ' two-columns';
    break;

  case '3':
    $columns_class = 'small-12 medium-6 large-4 cell';
    $courses_extra_class .= ' three-columns';
    break;

  case '4':
    $columns_class = 'small-12 medium-6 large-3 cell';
    $courses_extra_class .= ' four-columns';
    break;
}

/* Pagination */
static $courses_loop;

if( !isset( $courses_loop ) )
  $courses_loop = 1;
else
  $courses_loop ++;

$paging = 'paged' . $courses_loop;

if( isset( $_GET[$paging] ) ) {
   $paged = $_GET[$paging];
}else{
   $paged = 1;
}

$pagination_base = add_query_arg( $paging, '%#%' );

/* Grid ID */
$grid_object_id = WKE_Util::random_string( 10 );

/* Grid Gutter */
$grid_margin = $courses_no_margin == 'no_margin' ? 'no-margin' : 'grid-margin-x';

$renderHTML = '';
$renderHTML .= '<div id="wke-learnpress-courses-' . esc_attr( $grid_object_id ) . '" class="wke-learnpress-courses wke-grids grid-x ' . $grid_margin . ' ' . esc_html( $courses_extra_class ) . ' wke-grid-style-default ' . $courses_no_margin . ' wke-' . $courses_layout . '-container" data-id="' . $grid_object_id . '" data-thumbnail-height="' . $courses_min_height['size'] . $courses_min_height['unit'] . '" data-infinite="' . $courses_infinite . '">';

            /* Data Query */
            $params = array(
              'posts_per_page'   => $courses_number,
              'post_type'        => 'lp_course',
              'orderby'          => $courses_orderby,
              'order'            => 'desc',
              'course_category'  => esc_attr( $courses_category ),
              'paged'            => $paged
            );

            $lp_query = new WP_Query( $params );
            if ( $lp_query->have_posts() ) {
                while ( $lp_query->have_posts() ) : $lp_query->the_post();
                    $course = learn_press_get_course( get_the_ID() );
                    $count_students = intval( $course->count_students() );

                    $renderHTML .= '<div class="wke-grid-item wke-grid-item-' . esc_attr( get_the_ID() ) . ' ' . esc_attr( $columns_class ) . ' ' . esc_attr( $courses_boxed ) . '">';
                    $renderHTML .= '<div class="wke-grid-thumbnail ' . esc_attr( $courses_shape ) . '">' . get_the_post_thumbnail( get_the_ID(), $courses_thumbnail_size, array( 'alt' => esc_attr(get_the_title() ) ) ).
                       '<div class="overlay">';
                        $renderHTML .= '<div class="button-area">
                                          <a href="' . esc_url( get_permalink() ) . '" class="details grid-button"><i class="fa fa-plus"></i></a>
                                        </div>
                        </div>
                    </div>';

                    $renderHTML .= '<h3 class="wke-grid-title ' . $courses_single_line_title . '"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</a>
                    </h3>';

                    $renderHTML .= '<div class="wke-grid-meta">';
                    if( $courses_show_price == '1' ){
                       $renderHTML .= '<div class="wke-grid-price">' . $course->get_price_html() . '</div>';
                    }
                    if( $courses_show_students_count == '1' ){
                       $renderHTML .= '<div class="student-count"><span>' . $count_students .'</span>'. esc_html__( 'Students', 'wpkit-elementor' ) . '</div>';
                    }
                    $renderHTML .= '</div>';

                    if( $courses_show_category ) {
                      $renderHTML .= '<div class="wke-grid-footer">';
                         if ( ! get_the_terms( $post->ID, 'course_category' ) ) {
                           $renderHTML .= '<span class="course-category">' . esc_html__( 'Uncategorized', 'wpkit-elementor' ) . '</span>';
                         } else {
                           $renderHTML .= get_the_term_list( $post->ID, 'course_category', '<span class="course-category">', ',', '</span>' );
                         }
                      $renderHTML .= '</div>';
                    }

                    $renderHTML .= '</div>';
                endwhile;
                wp_reset_postdata();
            }else{
                $renderHTML.='<p>'.esc_html__( 'No courses Found', 'wpkit-elementor').'</p>';
            }

$renderHTML .='</div>';

/* Pagination */
if( $courses_pagination == '1' ){
   $renderHTML .= '<div class="wke-pagenavi">';
   $renderHTML .= paginate_links( array(
      'type'      => '',
      'base'      => $pagination_base,
      'format'    => '?'. $paging .'=%#%',
      'current'   => max( 1, $lp_query->get( 'paged' ) ),
      'total'  => $lp_query->max_num_pages
   ));
   $renderHTML .= '</div>';
}

// Don't delete the following codes
if( isset( $_GET['action'] ) && $_GET['action'] == 'elementor' ) {
    $renderHTML .= "<script>window.WKE.grid_system();</script>";
}

echo $renderHTML;
