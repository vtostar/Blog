/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	// wp.customize( 'blogname', function( value ) {
	// 	value.bind( function( to ) {
	// 		$( '.site-title a' ).text( to );
	// 	} );
	// } );
	// wp.customize( 'blogdescription', function( value ) {
	// 	value.bind( function( to ) {
	// 		$( '.site-description' ).text( to );
	// 	} );
	// } );
	wp.customize( 'classplus_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.site-info .copyright' ).text( to );
		} );
	} );
	// Site favicon
	wp.customize( 'classplus_favicon', function( value ) {
		value.bind( function( to ) {
			if( to != '' ) {
				$('#site-favicon').attr('href', to );
			} else {
				
			}
		} );
	} );
	// Site main color.
	wp.customize( 'classplus_main_color', function( value ) {
		value.bind( function( to ) {

				$( '.list-categories > li > a' ).css( {'color': to} );

				$( '.categories-links a' ).css( {'background-color': to} );

				$( '.pagination span.current' ).css( {
					'background-color': to,
					'border-color': to
				} );
				$( '.pagination a' ).hover(function(){
					$(this).css( {'background-color': to,'border-color': to} );
				}, function(){
					$(this).css( {'background-color': '#fafafa','border-color': '#dddddd'} );
				});

				$( '.single-post .entry-meta .entry-actions a' ).hover(function(){
					$(this).css( {'color': to} );
				}, function(){
					$(this).css( {'color': '#428bca'} );
				});

				$( '.comment-list .comment-reply-link' ).css( {
					'color': to
				} );

				$( '.widget-title' ).css( {
					'color': to
				} );
		} );
	} );
} )( jQuery );
