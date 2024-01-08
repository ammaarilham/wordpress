<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
  exit( 'Direct script access denied.' );
}
do_action( 'wke_admin_header' );
?>

  <div class="wke-loading"></div>
  <div class="wke-loader-overlay"></div>

  <div class="section box">

      <h3><?php esc_html_e( 'Manage Modules', 'wpkit-elementor' ); ?></h3>
      
      <?php
      $modules = WKE_Admin::register_modules();

      foreach( $modules as $key => $module):
        if( $module['show'] ):
      ?>

        <div class="module-card">  
              <div class="name">
                <h3>
                  <?php echo $module['name']; ?>
                </h3>
                <p><?php echo esc_html( $module['desc'] ); ?></p>
              </div>

              <div class="action-links">
                  <?php
                    if( get_option( $key ) == '1' ) {
                       echo '<a class="wke_toggle toggle-on button-module" data-redirect="' . admin_url( 'admin.php?page=wpkit' ) . '" data-action="deactivate" data-module="' . esc_attr( $key ) . '" data-value="0" href="javascript:void(0);"></a>';
                    }else{
                       echo '<a class="wke_toggle toggle-off button-module" data-redirect="' . admin_url( 'admin.php?page=wpkit').'" data-action="activate" data-module="' . esc_attr( $key ) . '" data-value="1" href="javascript:void(0);"></a>';
                    }
                  ?>       
              </div>
        </div>

      <?php 
        endif;
      endforeach;
      ?>
  </div>

</div>