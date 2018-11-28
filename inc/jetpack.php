<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package nus
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function nus_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'type' 	 		=> 'click',
		'container' => 'posts-area',
		'render'    => 'nus_infinite_scroll_render',
		'footer'    => false,
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details'    => array(
			'stylesheet' => 'nus-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images' => array(
			'archive'    => true,
			'post'       => true,
			'page'       => true,
		),
	) );

}
add_action( 'after_setup_theme', 'nus_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function nus_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content/content', 'search' );
		// Events Calendar Check
		elseif ( tribe_is_past() || tribe_is_upcoming() && !is_tax() ) :
			get_template_part( 'template-parts/content/content', 'single-event' );
		else :
			get_template_part( 'template-parts/content/content', 'excerpt' );
		endif;
	}
}

function nus_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load more', 'l18n' );
	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'nus_jetpack_infinite_scroll_js_settings' );

function nus_jetpack_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
