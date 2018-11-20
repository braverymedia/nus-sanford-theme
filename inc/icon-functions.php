<?php
/**
 * SVG icons related functions
 *
 * @package WordPress
 * @subpackage nus
 * @since 1.0.0
 */

/**
 * Gets the SVG code for a given icon.
 */
function nus_get_icon_svg( $icon, $size = 24 ) {
	return NUS_SVG_Icons::get_svg( 'ui', $icon, $size );
}

/**
 * Gets the SVG code for a given social icon.
 */
function nus_get_social_icon_svg( $icon, $size = 24 ) {
	return NUS_SVG_Icons::get_svg( 'social', $icon, $size );
}

/**
 * Detects the social network from a URL and returns the SVG code for its icon.
 */
function nus_get_social_link_svg( $uri, $size = 24 ) {
	return NUS_SVG_Icons::get_social_link_svg( $uri, $size );
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function nus_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social-links' === $args->theme_location ) {
		$svg = nus_get_social_link_svg( $item->url, 26 );
		if ( empty( $svg ) ) {
			$svg = nus_get_icon_svg( 'link' );
		}
		$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'nus_nav_menu_social_icons', 10, 4 );


/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string  $title The menu item's title.
 * @param  WP_Post $item  The current menu item.
 * @param  array   $args  An array of wp_nav_menu() arguments.
 * @param  int     $depth Depth of menu item. Used for padding.
 * @return string  $title The menu item's title with dropdown icon.
 */
function nus_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'site-menu' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = '<span>' . $title . '</span>' . nus_get_icon_svg( 'keyboard_arrow_down');
			}
		}
	}

	return $title;
}
add_filter( 'nav_menu_item_title', 'nus_dropdown_icon_to_menu_link', 10, 4 );
