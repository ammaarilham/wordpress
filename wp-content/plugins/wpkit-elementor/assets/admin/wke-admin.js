/**
 * Admin Scripts
 */
 
jQuery(document).ready(function($){
    
    "use strict";

	$('.button-module').each(function(){
        var module_id = $(this).data('module');
        var value = $(this).data('value');
        var redirect = $(this).data('redirect');
        var action = $(this).data('action');

        $(this).on('click',function(){
            if(action == 'deactivate'){
              $(this).removeClass('toggle-on');
            }
            if(action == 'activate'){
              $(this).addClass('toggle-on');
            }
            $('.wke-loader-overlay').show();
            $('.wke-loading').show();
            $.ajax({
                url : wke_admin_data.ajax_url,
                type : 'post',
                data : {
                    action: 'update_module_status',
                    id : module_id,
                    status : value
                },
                success : function( response ){ window.location = redirect; },
                error : function(error){ console.log(error) }
            });
        });
    });
});
