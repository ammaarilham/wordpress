<?php
/*
 * Counter Shortcode Template
 * @package WPKit For Elementor
 */

$wke_counter_id           =   'wke_counter_'.WKE_Util::random_string(10,false);
$wke_counter_text_color   =   $wke_data->text_color;
$wke_counter_title        =   $wke_data->title;
$wke_counter_start        =   $wke_data->start;
$wke_counter_end          =   $wke_data->end;
$wke_counter_extra_class  =   $wke_data->extra_class;
$wke_counter_inline_style =   '';

if( $wke_counter_text_color !== '#000000' ) {
  $wke_counter_inline_style = 'style="color:' . $wke_counter_text_color . '"';
}

$renderHTML = '<div ' . $wke_counter_inline_style . ' class="wke-counter ' . esc_attr( $wke_counter_extra_class ) . '">
        <span id="wke-counter-' . esc_html( $wke_counter_id ) . '" class="wke-count-number">' . esc_attr( $wke_counter_start ) . '</span>
        <strong class="wke-counter-text"> ' . esc_attr( $wke_counter_title ) . '</strong>
     </div>';

$renderHTML .= '<script type="text/javascript">
jQuery(document).ready(function($){
  var counterUp = $("#wke-counter-' . esc_attr( $wke_counter_id ) . '");
  counterUp.waypoint(function() {
      counterUp.counter({
       autoStart: false,
       duration: 2000,
       countTo: ' . esc_html( $wke_counter_end ) . ',
       placeholder: ' . esc_html( $wke_counter_start ) . ',
       easing: "easeOutCubic"
      });
      counterUp.counter("start");
  },{ offset: 700 });
});
</script>';

echo $renderHTML;