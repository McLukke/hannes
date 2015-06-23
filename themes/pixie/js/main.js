;jQuery.noConflict();

(function( $ ) {
	"use strict";

	$( document ).on( 'ready', function() {

		var $window = $( window ),
		    $document = $( document ),
		    $body = $( 'body' );

		/**
		 * =======================================
		 * Function: Detect Mobile Device
		 * =======================================
		 */
		// source: http://www.abeautifulsite.net/detecting-mobile-devices-with-javascript/
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match( /Android/i );
			},
			BlackBerry: function() {
				return navigator.userAgent.match( /BlackBerry/i );
			},
			iOS: function() {
				return navigator.userAgent.match( /iPhone|iPad|iPod/i );
			},
			Opera: function() {
				return navigator.userAgent.match( /Opera Mini/i );
			},
			Windows: function() {
				return navigator.userAgent.match( /IEMobile/i );
			},
			any: function() {
				return ( isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows() );
			},
		};

		/**
		 * =======================================
		 * IE9 Placeholder
		 * =======================================
		 */
		if ( ! ( 'placeholder' in document.createElement( 'input' ) ) ) {
			$( 'form' ).on( 'submit', function() {
				$( this ).find( '[placeholder]' ).each(function() {
					var $input = $( this );
					if ( $input.val() == $input.attr( 'placeholder' ) ) {
						$input.val( '' );
					};
				});
			});

			$( '[placeholder]' ).on( 'focus', function() {
				var $input = $( this );
				if ( $input.val() == $input.attr( 'placeholder' ) ) {
					$input.val( '' );
					$input.removeClass( 'placeholder' );
				};
			}).on( 'blur', function() {
				var $input = $( this );
				if ( $input.val() == '' || $input.val() == $input.attr( 'placeholder' ) ) {
					$input.addClass( 'placeholder' );
					$input.val( $input.attr( 'placeholder' ) );
				};
			}).blur();
		}

		/**
		 * =======================================
		 * Function: Resize Background
		 * =======================================
		 */
		var resizeBackground = function( el ) {

			var $el         = $( el ),
				$container  = $el.parent(),
				el_w        = $el.attr( 'width' ),
				el_h        = $el.attr( 'height' ),
				container_w = $container.outerWidth(),
				container_h = $container.outerHeight(),
				scale_w     = container_w/ el_w,
				scale_h     = container_h/ el_h,
				scale       = scale_w > scale_h ? scale_w : scale_h,
				new_el_w, new_el_h, offet_top, offet_left;

			new_el_w = scale * el_w;
			new_el_h = scale * el_h;
			offet_left = ( new_el_w - container_w) / 2 * -1;
			offet_top  = ( new_el_h - container_h) / 2 * -1;

			$el.css( 'width', new_el_w );
			$el.css( 'height', new_el_h );
			$el.css( 'marginTop', offet_top );
			$el.css( 'marginLeft', offet_left );

		};

		var resizeFeaturedImage = function() {
			var window_w         = window.innerWidth,
			    body_h           = $window.height(),
			    body_w           = $body.width(),
			    center_w         = $( '.center-wrapper' ).width(),
			    offset           = -( Math.abs( body_w - center_w ) ) / 2,
			    $side_background = $( '.side-background' ),
			    padding          = 20;

			if ( window_w >= 992 ) {
				$side_background.attr( 'style', '' );
				$side_background.find( '.side-background-overlay iframe, .side-background-overlay img' ).css({
					"max-height" : "none",
				});
				return;
			} else {
				$side_background.css({
					"width" : body_w + "px",
					"height" : Math.max( 0.75 * body_w, Math.min( body_h, body_w ) ) + "px",
					"margin-left" : offset + "px",
				});
				$side_background.find( '.side-background-overlay iframe, .side-background-overlay img' ).css({
					"max-height" : Math.max( 0.75 * body_w, Math.min( body_h, body_w ) ) - ( 2 * padding ) + "px",
				});
			}
		};

		/**
		 * =======================================
		 * Search Toggle
		 * =======================================
		 */
		$body.on( 'click', '.header-search-toggle', function( e ) {
			e.preventDefault();

			var $search_bar = $( '#header-search' );

			$search_bar.toggleClass( 'hidden' );
			$search_bar.filter( ':visible' ).find( 'input' ).focus();
		});

		/**
		 * =======================================
		 * Header Content Toggle
		 * =======================================
		 */
		$body.on( 'click', '.header-collapse-toggle', function( e ) {
			e.preventDefault();

			var $header_collapse = $( '#header-collapse' );

			$header_collapse.toggleClass( 'active' );
		});

		/**
		 * =======================================
		 * Side Background
		 * =======================================
		 */
		$( '.side-background-source' ).each( function( i, el ) {

			var $el          = $( el ),
			    $anchor      = $( '<div></div>' ),
			    $container   = $( '<div></div>' ),
			    $bg_wrapper  = $( '<div></div>' ),
			    $img         = $el.clone(),
			    src          = $el.attr( 'src' ),
			    container_id = 'side-background-' + ( i + 1 );

			$anchor.attr( 'data-target', '#' + container_id );
			$anchor.addClass( 'side-background-anchor' );
			$anchor.insertAfter( $el );

			$img.removeClass( 'side-background-source' );
			$img.appendTo( $bg_wrapper );

			$bg_wrapper.addClass( 'side-background-image' );
			$bg_wrapper.appendTo( $container );

			$container.attr( 'id', container_id );
			$container.addClass( 'side-background wait-loaded' );
			$container.insertAfter( $anchor );
		});

		$( '.side-background-image img' ).one( 'load', function() {
			var $el = $( this ),
			    $sb = $el.parents( '.side-background' );

			$sb.removeClass( 'wait-loaded' );
		}).each( function() {
			if ( this.complete ) $( this ).load();
		});
		
		if ( $.fn.waypoint ) {
			$( '.side-background-anchor' ).waypoint({
				handler: function( direction ) {
					
					if ( direction == 'down' ) {
						var $target = $( $( this.element ).data( 'target' ) );

						if ( $target.length < 1 ) return;

						$( '.side-background' ).removeClass( 'active' );
						$target.addClass( 'active' );
						$( '.post' ).removeClass( 'active' );
						$target.parents( '.post' ).addClass( 'active' );
					}
					else if ( direction == 'up' ) {
						var prev = this.previous(),
						    $target;

						if ( prev ) {
							$target = $( $( prev.element ).data( 'target' ) );

							if ( $target.length < 1 ) return;

							$( '.side-background' ).removeClass( 'active' );
							$target.addClass( 'active' );
							$( '.post' ).removeClass( 'active' );
							$target.parents( '.post' ).addClass( 'active' );
						}
					}

				},
				offset: '50%',
				group: 'side-background',
			});

			$window.on( 'resize', function() {
				resizeFeaturedImage();
				$( '.side-background-image img' ).each( function() {
					resizeBackground( $( this ) );
				});
				Waypoint.refreshAll();
			});
		}

		if ( $( '.side-background.active' ).length < 1 ) {
			$( '.side-background' ).first().addClass( 'active' );
		}

		/**
		 * =======================================
		 * Responsive Slides
		 * =======================================
		 */
		if ( $.fn.responsiveSlides ) {
			$( '.rslides' ).responsiveSlides({
				auto : false,
				nav : true,
				prevText : '<span class="fa fa-angle-left"></span><span class="hidden">Previous</span>',
				nextText : '<span class="fa fa-angle-right"></span><span class="hidden">Next</span>',
			});
		}

		/**
		 * =======================================
		 * Portfolio Grid
		 * =======================================
		 */
		if ( $.fn.isotope ) {
			$( '.portfolio-index' ).each(function() {

				var $el     = $( this ),
				    $filter = $el.find( '.portfolio-grid-filter > a' ),
				    $loop   = $el.find( '.portfolio-grid' );

				$loop.isotope();

				$loop.imagesLoaded(function() {
					$loop.isotope( 'layout' );
				});

				if ( $filter.length > 0 ) {

					$filter.on( 'click', function( e ) {
						e.preventDefault();

						var $a = $( this );
						$filter.removeClass( 'active' );
						$a.addClass( 'active' );
						$loop.isotope({ filter: $a.data( 'filter' ) });
					});
				};
			});
		};

		/**
		 * =======================================
		 * Resume Skills
		 * =======================================
		 */
		if ( $( '.rb-widget-experience .rb-experience-rating' ) ) {

			$( '.rb-widget-experience .rb-experience-rating' ).one( 'inview', function() {

				var $el    = $( this ),
				    $bar   = $( '<div></div>'),
				    rating = $el.data( 'score' );

				$bar.appendTo( $el );
				$({ progress: 0 }).animate({ progress: rating / 5 * 100 }, {
					duration: 1000,
					step: function( now, tween ) {
						$bar.css( 'width', now + '%' );
					},
				});
			});

		}

		/**
		 * =======================================
		 * Anchor Link
		 * =======================================
		 */
		$body.on( 'click', 'a.anchor-link', function( e ) {
			e.preventDefault();

			var $a      = $( this ),
				$target = $( $a.attr( 'href' ) );

			if ( $target.length < 1 ) return;

			$( 'html, body' ).animate({ scrollTop: Math.max( 0, $target.offset().top ) }, 1000 );
		});

		/**
		 * =======================================
		 * Contact Maps
		 * =======================================
		 */
		if ( typeof Maplace == 'function' && $( '#gmap' ) ) {
			new Maplace( gmap_options ).Load();
		};

		/**
		 * =======================================
		 * Init
		 * =======================================
		 */
		$window.trigger( 'resize' );
		$window.trigger( 'scroll' );

	});

})( jQuery );