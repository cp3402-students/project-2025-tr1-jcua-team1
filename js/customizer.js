/* global wp */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );

	// Live preview for footer settings
	wp.customize('footer_padding', function(value) {
		value.bind(function(to) {
			$('.site-footer').css({
				'padding-top': to + 'px',
				'padding-bottom': to + 'px'
			});
		});
	});

	wp.customize('footer_text_align', function(value) {
		value.bind(function(to) {
			$('.site-footer').css('text-align', to);
		});
	});

	// Live preview for header border settings
	wp.customize('header_border_thickness', function(value) {
		value.bind(function(to) {
			var color = wp.customize.value('header_border_color')();
			if (to === '0') {
				$('.site-header').css('border-bottom', 'none');
			} else {
				$('.site-header').css('border-bottom', to + 'px solid ' + color);
			}
		});
	});

	wp.customize('header_border_color', function(value) {
		value.bind(function(to) {
			var thickness = wp.customize.value('header_border_thickness')();
			if (thickness !== '0') {
				$('.site-header').css('border-bottom', thickness + 'px solid ' + to);
			}
		});
	});
}( jQuery ) );
