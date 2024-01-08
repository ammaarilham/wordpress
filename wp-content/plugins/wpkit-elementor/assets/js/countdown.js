/**
 * Countdown Scripts
 * Version: 1.0
 */
(function($){

   "use strict";
   
   window.showCountDown = function() {
   	 
   	  $('.countdown').each(function(){
   	  
   	  	 var id = $(this).children('span').attr('id');
   	  	 var expiredNotice = $(this).data('expired-notice');
   	  	 var filter = $(this).data('filter');

   	  	 $('#' + id).countdown(filter+':00')
		.on('update.countdown', function(event) {
		  var format = '%H:%M:%S';
		  
		  if(event.offset.totalDays > 0) {
		    format = '%-d day%!d ' + format;
		  }
		  
		  if(event.offset.weeks > 0) {
		    format = '%-w week%!w ' + format;
		  }
		  
		  $(this).html(event.strftime(format));
		})
		.on('finish.countdown', function(event) {
		  $(this).html(expiredNotice)
		    .parent().addClass('disabled');

		});
   	  });
   }
   window.showCountDown();
})(jQuery);