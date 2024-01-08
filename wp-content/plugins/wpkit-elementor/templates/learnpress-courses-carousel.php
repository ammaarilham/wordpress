<?php
/*
 * EDD Product Carousel Template
 * @package WPKit For Elementor
 */

$number               =   $wke_data->number;
$columns              =   $wke_data->columns;
$gap                  =   $wke_data->gap;
$shape                =   $wke_data->shape;
$category             =   $wke_data->category;
$order                =   $wke_data->order;
$orderby              =   $wke_data->orderby;
$autoplay             =   $wke_data->autoplay;
$hover_effect         =   $wke_data->hover_effect;
$boxed                =   $wke_data->boxed;
$show_price           =   $wke_data->show_price;
$show_category        =   $wke_data->show_category;
$title_single_line    =   $wke_data->title_single_line;
$courses_show_students_count   =   $wke_data->show_students_count;

$carousel_id = 'wke-carousel-' . WKE_Util::random_string(10);

$renderHTML = '<div id="' . esc_attr( $carousel_id ) . '" data-columns="' . esc_attr( $columns ) . '" data-gap="' . esc_attr( $gap['size'] ) . '" data-auto-play="' . esc_attr( $autoplay ) . '" class="wke-learnpress-courses-carousel wke-carousel swiper-container ' . esc_attr( $shape ) . '">
            <div class="swiper-wrapper">';
            $params = array(
              'posts_per_page' => esc_attr( $number ),
              'post_type' => 'lp_course',
              'course_category' => esc_attr( $category ),
              'orderby' => $orderby,
              'order' => $order
            );

            $wke_carousel_query = new WP_Query( $params );

            if ( $wke_carousel_query->have_posts() ) {
                while ( $wke_carousel_query->have_posts() ) : $wke_carousel_query->the_post();
                   $course = learn_press_get_course( get_the_ID() );
                   $count_students = intval( $course->count_students() );

                   /* HTML Makeup below */
                   $renderHTML .= '<div class="wke-learnpress-courses-carousel swiper-slide wke-carousel-item wke-carousel-item-' . esc_attr( get_the_ID() ) . ' ' . esc_attr( $boxed ) . '">';
                   $renderHTML .= '<div class="wke-carousel-thumbnail ' . $hover_effect . '">
                                     <img src="' . esc_url( get_the_post_thumbnail_url( get_the_ID(),'large' ) ) . '" alt=" ' . esc_attr( get_the_title() ) . ' " />
                                     <div class="overlay">';
                                            $renderHTML .= '<div class="button-area">';
                                            $renderHTML .= '<a href="' . esc_url( get_permalink() ) . '" class="details wke-carousel-button"><i class="fa fa-plus"></i></a>';
                                            $renderHTML .= '</div>';
                     $renderHTML .= '</div>
                                   </div>';
                     $renderHTML .= '<h4 class="wke-carousel-title '.$title_single_line.'"><a href="'. esc_url( get_permalink() ) . '">'. esc_html( get_the_title() ) . '</a></h4>';

                     $renderHTML .= '<div class="wke-carousel-meta">';
                        if( $show_price == '1' ) {
                           $renderHTML .= '<div class="wke-carousel-price">'.$course->get_price_html().'</div>';
                        }
                        if( $courses_show_students_count == '1' ){
                           $renderHTML .= '<div class="student-count"><span>' . $count_students .'</span> '. esc_html__( 'Students', 'wpkit-elementor' ) . '</div>';
                        }
                     $renderHTML .= '</div>';

                     if( $show_category ) {
                       $renderHTML .= '<div class="wke-carousel-footer">';
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
              $renderHTML .= '<div class="swiper-slide wke-carousel-item"><p>' . esc_html__( 'No Courses Found','wpkit-elementor' ) . '</p></div>';
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
