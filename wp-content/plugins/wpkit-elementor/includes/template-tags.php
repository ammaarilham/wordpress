<?php
/**
 * Social Share Icons
 */
if ( ! function_exists( 'wke_social_share' ) ) {
	function wke_social_share( $id ){

	    $return_html = '<div class="wke-social-share">
	    	 <span class="label">' . esc_html__( 'Share', 'wpkit-elementor' ) . ': </span>
	   		 <a href="https://www.facebook.com/sharer/sharer.php?display=popup&u='.urlencode( get_permalink() ).'" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
	   		 <a href="http://twitter.com/share?text='.urlencode( strip_tags( get_the_title() ) ).'&amp;url='.urlencode( get_permalink( $id ) ).'" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
	   		 <a href="https://pinterest.com/pin/create/button/?media='.esc_url( wp_get_attachment_url( get_post_thumbnail_id( $id ) ) ).'&amp;description='. urlencode( strip_tags( get_the_title() ) ).'&amp;url=' . urlencode( get_permalink( $id ) ) . '" target="_blank" class="pinterest"><i class="fa fa-pinterest"></i></a>
	   		 <a href="https://www.linkedin.com/shareArticle?mini=true&amp;title=' . urlencode( strip_tags( get_the_title() ) ) . '&amp;source=' . urlencode( get_permalink( $id ) ) . '&amp;url='. urlencode( get_permalink( $id ) ) . '" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
	   	</div>';

	    return $return_html;
	}
}
