<?php
/*
 * Typing Shortcode Template
 * @package WPKit For Elementor
 */

function wke_fuzzy( $str ) {
    return '"' . $str . '"';
}

$wke_typing_id           =   'wke-typing-'.WKE_Util::random_string( 10, false );
$wke_typing_text_color   =   $wke_data->text_color;
$wke_typing_static_text  =   $wke_data->static_text;
$wke_typing_text         =   preg_split( "/((\r?\n)|(\r\n?))/", wp_strip_all_tags( $wke_data->typing_text ) );
$wke_typing_text 		 =   array_map( 'trim', $wke_typing_text ); //trim blank space char.
$wke_typing_text 		 =   array_map( 'wke_fuzzy', $wke_typing_text ); //fuzzy '"'
$wke_typing_text_string  =   implode( ",",$wke_typing_text ); //convert array to string.
$wke_typing_inline_style =   '';
$wke_typing_separator    =   ',';

if( $wke_typing_text_color !== '#000000' ){
    $wke_typing_inline_style = 'style="color:'.esc_attr( $wke_typing_text_color ) . '"';
}

if( $wke_typing_text !== '' ):
?>
<div class="wke-typing-text <?php echo esc_attr($wke_data->extra_class);?>" <?php echo $wke_typing_inline_style;?>>
  <?php echo esc_attr( $wke_typing_static_text );?>
  <span id="<?php echo esc_attr( $wke_typing_id ); ?>"></span>
</div>

<script type="text/javascript">
jQuery(function($){
   	 $("#<?php echo $wke_typing_id;?>").typed({
	     strings: [<?php echo $wke_typing_text_string; ?>],
	     typeSpeed: 50,
	     loop:true
   	 });
});
</script>

<?php endif;?>