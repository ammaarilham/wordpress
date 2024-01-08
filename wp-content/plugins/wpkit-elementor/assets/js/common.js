/**
 * WPKit Elementor Scripts
 * Version: 1.0
 */

var WKE = window.WKE || {};
window.WKE = WKE;

(function($){
 	 "use strict";

	WKE.grid_system  = function(){

		$('.wke-grids').each(function(){

			var $grid = $('.wke-grids');

			/* Masonry Layout */
		   if($grid.hasClass('wke-masonry-container')){

				// init Isotope
			    $grid = $('.wke-grids').isotope({
				 	  itemSelector: '.wke-grid-item',
					  percentPosition: true,
					  layoutMode: 'masonry'
			    });

			    // layout Isotope after each image loads
			    $grid.imagesLoaded().progress( function() {
				  $grid.isotope('layout');
			    });
		    }

		    /* Infinite Scroll */
		    if($grid.data('infinite')===true){
			    $grid.infiniteScroll({
			    	path:'.next',
					history: false,
					append: false,
					hideNav: '.wke-pagenavi',
					status: '.page-load-status'
					//debug: true
				});

				$grid.on( 'load.infiniteScroll', function(event, response ) {
					  // get posts from response
					  var $new_items = $( response ).find('.wke-grid-item');

					  // Append Items to Masonry Layout
					  if($(this).hasClass('wke-masonry-container')){
						  // append posts after images loaded
						  $grid.infiniteScroll('appendItems', $new_items )
						  	.isotope( 'appended', $new_items);

						  $grid.imagesLoaded().progress( function() {
							  $grid.isotope('layout');
						  });
					  }

					  // Append Items to Grid Layout
					  if($grid.hasClass('wke-grid-container')){
						  $grid.infiniteScroll('appendItems', $new_items );
					  }

					  // Excute scripts after new item appended
					  grid_depended_scripts();
				});

			}

		    var grid_depended_scripts = function(){
				// Reset thumbnail height for grid layout.
				if($grid.hasClass('wke-grid-container')){
				   $grid.find('.wke-grid-thumbnail a.grid-thumbnail').css('height', $grid.data('thumbnail-height'));
			    }
		    }
		    grid_depended_scripts();
		});

	}

	WKE.parallax_layer = function(){
		/**
		 * In viewport helper
		 * @return {Boolean}
		 */
		$.fn.inView = function(buffer){

			buffer = typeof buffer !== 'undefined' ? buffer : 100;
		    var win = $(window);

		    var viewport = {
		        top : win.scrollTop(),
		        left : win.scrollLeft()
		    };
		    viewport.right = viewport.left + win.width() - buffer;
		    viewport.bottom = viewport.top + win.height() - buffer;

		    var bounds = this.offset();
		    bounds.right = bounds.left + this.outerWidth();
		    bounds.bottom = bounds.top + this.outerHeight();

		    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

		};

		/**
		 *  Parallax fxn for elements
		 */
		$.fn.parallax = function(momentum, axis) {
			momentum = typeof momentum !== 'undefined' ? momentum : '0.5';
			axis = typeof axis !== 'undefined' ? axis : 'y';
		    var scrollTop = $(window).scrollTop();
		    var offset = this.parent().offset();
		    var moveValue = 0 - Math.round((offset.top - scrollTop) * momentum);
		    // this.css('transform', 'translateY( '+  moveValue +'px)');
		    if (axis === "x") {
		    	this.velocity({
		    		translateX: moveValue + "px",
		    	}, { queue: false, duration: 0 });
		    }
		    else {
				this.velocity({
					translateY: moveValue + "px",
				}, { queue: false, duration: 0 });
		    }
		};

		function moveParallaxLayers() {
			$('.parallax-layer').each(function(){
				if ($(this).inView(0)) {
					var momentum = $(this).data('parallax-momentum');
					var axis = $(this).data('parallax-axis');
				    $(this).parallax(momentum, axis);
				}
			});
		}

		window.initParallaxLayers = function() {
			moveParallaxLayers();
			$('.parallax-layer').velocity({ opacity: 1 }, { duration: 300});
			$(window).on('scroll', function() {
				moveParallaxLayers();
			});
		}

		initParallaxLayers();
	}

	WKE.swiper = function(){

		$('.wke-swiper-slider').each(function(){
			var id = '#'+$(this).attr('id');
			var autoHeight = $(this).data('direction') !== undefined ? $(this).data('direction') : false;
			var sliderPerView = $(this).data('slider-per-view') !== undefined ? $(this).data('slider-per-view') : 1;
			var space = $(this).data('slide-space') !== undefined ? $(this).data('slide-space') : 0;
			var sliderPerViewMobile = $(this).data('slider-per-view-mobile') !== undefined ? $(this).data('slider-per-view-mobile') : 1;

			var wke_swiper = new Swiper(id, {
				init: true,
	            preloadImages: false,
	            lazy: true,
	            slidesPerView: sliderPerView,
	            spaceBetween: space,
	            autoHeight: autoHeight,
	            direction: $(this).data('direction'),
	            autoplay: 5000,
	            autoplayDisableOnInteraction: true,
	            parallax: true,
	            navigation: {
				      nextEl: ".swiper-button-next",
				      prevEl: ".swiper-button-prev",
				},
	            pagination: {
				    el: '.swiper-pagination',
				    type: 'bullets',
				    clickable: true
				},
			    onLazyImageLoaded: function() {
			        $('.swiper-lazy-preloader').hide();
			    },
			    breakpoints: {
			    	767: {
			    		slidesPerView: sliderPerViewMobile
			    	}
			    }
	        });
		});

		$('.wke-carousel').each(function(){

			var id = '#'+$(this).attr('id');
			var columns = $(this).data('columns');
			var gap = $(this).data('gap');
			var auto_play = $(this).data('auto-play');

			var autoplay = auto_play === 0 ? '0' : '8000';
			var responsive_gap = gap - 10;

			$(id).imagesLoaded(function(){

          $(id).fadeIn();

          var wke_carousel = new Swiper(id, {
            slidesPerView: columns,
            spaceBetween: parseInt(gap),
            lazy: true,
            autoplay: parseInt(autoplay),
            autoplayDisableOnInteraction: true,
            navigation: {
  			      nextEl: ".swiper-button-next",
  			      prevEl: ".swiper-button-prev",
				    },
  				  pagination: {
  				    el: '.swiper-pagination',
  				    type: 'bullets',
  				    clickable: true
  				  },
            breakpoints: {
              1920: {
                slidesPerView: columns
              },
              1024: {
                slidesPerView: columns,
                spaceBetween: responsive_gap,
              },
              768: {
                slidesPerView: 2,
                spaceBetween: responsive_gap,
              },
              640: {
                slidesPerView: 1,
                spaceBetween: 0,
              },
              320: {
                slidesPerView: 1,
                spaceBetween: 0,
              }
            }
           });
           wke_carousel.update();
        });
		});
	}


	WKE.init  = function(){
		WKE.parallax_layer();
		WKE.swiper();
		WKE.grid_system();
	}
	WKE.init();

})(jQuery);
