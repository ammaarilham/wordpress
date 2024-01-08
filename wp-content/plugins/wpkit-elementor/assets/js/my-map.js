(function($){

  "use strict";

  var googleMapsLoaded = false;

  window.initMaps = function() {

    var $maps = $('.tmvc-my-map');
    if ($maps.length) {

      if (!googleMapsLoaded) {

          var key = 'AIzaSyD2CceBjG8AubWTK3F7iFJXeWxLEBg_FgI';
          $.getScript("https://maps.google.com/maps/api/js?sensor=true&key=" + key)
          .done(function (script, textStatus) {  
            googleMapsLoaded = true;
            createMaps($maps);
          })
          .fail(function (jqxhr, settings, ex) {
          });
      } else {
        createMaps($maps);
      }

    }
  }

  window.createMaps = function($maps) {
    $maps.each(function() {

      var defaultOptions = {
        scrollwheel: false,
        mapTypeControl: false,
        streetViewControl: false
      };

      var savedOptions = $(this).data('map-settings');
      var mapOptions = $.extend( {}, defaultOptions, savedOptions );
      var mapCanvas = $(this).get(0);
      var myLatLong = new google.maps.LatLng(mapOptions.lat, mapOptions.long);
      mapOptions.center = myLatLong;
      var map = new google.maps.Map(mapCanvas, mapOptions);

      var marker = new google.maps.Marker({
            position: myLatLong,
            map: map,
            title: 'Snazzy!',
            icon: mapOptions.marker
      });
     
    });
  }

  initMaps();
})(jQuery);