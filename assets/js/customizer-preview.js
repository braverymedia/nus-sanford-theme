/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function( $ ) {
	// update phone number
	wp.customize('nus_phone', function( value ) {
		value.bind( function( to ) {
			$( '.visitor-tools .contact--phone' ).html( '<a href="tel://' + to + '">' + to + '</a>' );
		})
	});
	// update email
	wp.customize('nus_email', function( value ) {
		value.bind( function( to ) {
			$( '.visitor-tools .contact--email' ).html( '<a href="mailto:' + to + '" title="Email Sanford Harmony">' + to + '</a>' );
		})
	});

})( jQuery );
