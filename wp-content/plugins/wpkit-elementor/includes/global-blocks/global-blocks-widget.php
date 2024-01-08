<?php
/**
 * Global Blocks Widget
 * @package WPKit For Elementor
 * @since 1.0
 */

class WPKit_Global_Blocks_Widget extends WP_Widget {

	/**
	 * Register widget
	**/
	public function __construct() {

		parent::__construct(
	 		'WPKit_Global_Blocks_Widget', // Base ID
			esc_html__( 'Global Block', 'wpkit-elementor' ), // Name
			array( 'description' => esc_html__( 'Add the global blocks widget to anywhere you want.', 'wpkit-elementor' ), ) // Args
		);

	}


	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {

		extract( $args );

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$global_block_id = isset( $instance['global_block_id'] ) ? esc_attr( $instance['global_block_id'] ) : '';
		echo do_shortcode('[wpkit_global_block id="'.$global_block_id.'"]');
	}


	/**
	 * Sanitize widget form values as they are saved
	**/
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		/* Strip tags to remove HTML. For text inputs and textarea. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['global_block_id'] = strip_tags( $new_instance['global_block_id'] );

		return $instance;

	}


	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {

		/* Default widget settings. */
		$defaults = array(
			'title' => '',
			'global_block_id' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wpkit-elementor'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'global_block_id' ); ?>"><?php _e('Select a Template', 'wpkit-elementor'); ?></label>
			<select name="<?php echo $this->get_field_name('global_block_id'); ?>" class="widefat" id="<?php echo $this->get_field_id('global_block_id'); ?>">
			<?php
        $lists = wke_get_block_list();
				foreach ($lists as $val => $key){
		  ?>
          <option value="<?php echo esc_attr($val);?>" <?php if($instance['global_block_id'] == $val){ echo "selected='selected'";} ?>><?php echo esc_attr($key); ?></option>
        <?php }?>
        </select>
		</p>
	<?php
	}

}

/**
 * Register the new widget.
 *
 * @see 'widgets_init'
 */
function wke_register_global_blocks_widgets() {
	register_widget( 'WPKit_Global_Blocks_Widget' );
}
add_action( 'widgets_init', 'wke_register_global_blocks_widgets' );
