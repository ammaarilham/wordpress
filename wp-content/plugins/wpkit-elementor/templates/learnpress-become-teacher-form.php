<?php
/*
 * LearnPress Become Teacher Form
 * @package WPKit For Elementor
 */

$login_status = ! is_user_logged_in() ? 'non-logged-in' : '';
?>
<div class="wke-lp-become-teacher-form-wrapper <?php echo $login_status; ?>">
   <?php if( ! is_user_logged_in() ) : ?>
	<p><?php echo sprintf( __( 'Please <a href="%s">log in</a> to fill out this form', 'wpkit-elementor' ), home_url( '/login/?redirect_to=' . get_permalink() ) )?></p>
   <?php endif; ?>
   
   <?php
     do_action( 'learn-press/become-teacher-form' );
     do_action( 'learn-press/after-become-teacher-form' );
   ?>
</div>