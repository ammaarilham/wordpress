<?php
/*
 * Countdown Template
 * @package WPKit For Elementor
 */

$day  			 =   $wke_data->due_date;
$expired_notice  =   $wke_data->expired_notice;
?>

<div class="countdown" data-expired-notice="<?php echo esc_html( $expired_notice ); ?>" data-filter="<?php echo str_replace('-', '/', $day); ?>">
  <span id="wke-clock-<?php echo esc_attr( $id ); ?>"></span>
</div>

<?php
// Don't delete the following codes
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ):
?>
 <script>window.showCountDown();</script>
<?php
endif;