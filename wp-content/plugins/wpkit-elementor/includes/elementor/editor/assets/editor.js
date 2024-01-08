var jQuery;

jQuery(document).ready(function($){

  "use strict";

   /* Flexiable Panel */
   $( "#elementor-panel" ).wrap('<div id="elementor-panel-wrapper" class="animated"></div>');
   $('body').addClass('new-editor-ui');
   $( "#elementor-panel-wrapper" ).draggable({
      cancel: ".elementor-element-wrapper, input, .elementor-control-input-wrapper, textarea" ,
      start: function() {
        
      },
      drag: function(e) {
        $('body').addClass('dragging-panel');
      },
      stop: function() {
        $('body').removeClass('dragging-panel');
      }
    });
    $( "#elementor-panel-wrapper").resizable({
        start: function( event, ui ) {
            $('body').addClass('dragging-panel');
        },
        stop: function( event, ui ) {
            $('body').removeClass('dragging-panel');
        }
    });
    
    /* Close Pro widgets by default */
    $('#elementor-panel-category-pro-elements').removeClass('elementor-active');

});