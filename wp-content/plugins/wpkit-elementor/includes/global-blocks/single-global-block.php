<?php
/**
 * The single post template
 * If you want to override this template by your custom template in the theme folder,
 * tust create the 'lovage-templates/portfolio' folder in the theme folder,
 * then, copy this file to lovage-templates/portfolio folder.
 * @version 1.0.0
 * @package WPKit For Elementor
 */

get_header();

while ( have_posts() ) : the_post(); 
	the_content();
endwhile;

get_footer();