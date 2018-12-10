<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package nus
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function nus_body_classes( $classes ) {

	if ( is_singular() ) {
		// Adds `singular` to singular pages.
		$classes[] = 'singular';
	} else {
		// Adds `hfeed` to non singular pages.
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	// Adds a class of has-sidebar when there is a sidebar present.
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	}

	// Adds a class if image filters are enabled.
	if ( nus_image_filters_enabled() ) {
		$classes[] = 'image-filters-enabled';
	}

	return $classes;
}
add_filter( 'body_class', 'nus_body_classes' );

/**
 * Adds custom class to the array of posts classes.
 */
function nus_post_classes( $classes, $class, $post_id ) {

	if ( is_single() || is_page() ) {
		global $post;
		$slug = $post->post_name;
		$classes[] = 'post-' . $slug;
	}

	$classes[] = 'entry';

	return $classes;
}
add_filter( 'post_class', 'nus_post_classes', 10, 3 );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nus_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'nus_pingback_header' );

/**
 * Determines if post thumbnail can be displayed.
 */
function nus_can_show_post_thumbnail() {
	return apply_filters( 'nus_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Returns true if image filters are enabled on the theme options.
 */
function nus_image_filters_enabled() {
	if ( 'inactive' === get_theme_mod( 'image_filter' ) ) {
		return false;
	}
	return true;
}

/**
 * Add custom sizes attribute to responsive image functionality for post thumbnails.
 *
 * @origin Twenty Nineteen 1.0
 *
 * @param array $attr  Attributes for the image markup.
 * @return string Value for use in post thumbnail 'sizes' attribute.
 */
function nus_post_thumbnail_sizes_attr( $attr ) {

	if ( is_admin() ) {
		return $attr;
	}

	if ( ! is_singular() ) {
		$attr['sizes'] = '(max-width: 34.9rem) calc(100vw - 2rem), (max-width: 53rem) calc(8 * (100vw / 12)), (min-width: 53rem) calc(6 * (100vw / 12)), 100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'nus_post_thumbnail_sizes_attr', 10, 1 );

/**
 * WCAG 2.0 Attributes for Dropdown Menus
 *
 * Adjustments to menu attributes tot support WCAG 2.0 recommendations
 * for flyout and dropdown menus.
 *
 * @ref https://www.w3.org/WAI/tutorials/menus/flyout/
 */
function nus_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

	// Add [aria-haspopup] and [aria-expanded] to menu items that have children
	$item_has_children = in_array( 'menu-item-has-children', $item->classes );
	if ( $item_has_children ) {
		$atts['aria-haspopup'] = 'true';
		$atts['aria-expanded'] = 'false';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'nus_nav_menu_link_attributes', 10, 4 );

/**
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function nus_add_dropdown_icons( $output, $item, $depth, $args ) {

	// Only add class to 'top level' items on the 'primary' menu.
	if ( ! isset( $args->theme_location ) || 'menu-1' !== $args->theme_location ) {
		return $output;
	}

	if ( in_array( 'mobile-parent-nav-menu-item', $item->classes, true ) && isset( $item->original_id ) ) {
		// Inject the keyboard_arrow_left SVG inside the parent nav menu item, and let the item link to the parent item.
		// @todo Only do this for nested submenus? If on a first-level submenu, then really the link could be "#" since the desire is to remove the target entirely.
		$link = sprintf(
			'<span class="menu-item-link-return" tabindex="-1">%s',
			nus_get_icon_svg( 'chevron_left', 24 )
		);

		// replace opening <a> with <span>
		$output = preg_replace(
			'/<a\s.*?>/',
			$link,
			$output,
			1 // Limit.
		);

		// replace closing </a> with </span>
		$output = preg_replace(
			'#</a>#i',
			'</span>',
			$output,
			1 // Limit.
		);

	} elseif ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add SVG icon to parent items.
		$icon = nus_get_icon_svg( 'keyboard_arrow_down', 24 );

		$output .= sprintf(
			'<span class="submenu-expand" tabindex="-1">%s</span>',
			$icon
		);
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'nus_add_dropdown_icons', 10, 4 );

// Replaces the excerpt "Read More" text by a link
function nus_excerpt_more($more) {
       global $post;
	return '<a class="post-more-link" href="'. get_permalink($post->ID) . '" title="Read the full post">&hellip;</a>';
}
add_filter('excerpt_more', 'nus_excerpt_more');

/**
 * Convert HSL to HEX colors
 */
function nus_hsl_hex( $h, $s, $l, $to_hex = true ) {

	$h /= 360;
	$s /= 100;
	$l /= 100;

	$r = $l;
	$g = $l;
	$b = $l;
	$v = ( $l <= 0.5 ) ? ( $l * ( 1.0 + $s ) ) : ( $l + $s - $l * $s );
	if ( $v > 0 ) {
		$m;
		$sv;
		$sextant;
		$fract;
		$vsf;
		$mid1;
		$mid2;

		$m = $l + $l - $v;
		$sv = ( $v - $m ) / $v;
		$h *= 6.0;
		$sextant = floor( $h );
		$fract = $h - $sextant;
		$vsf = $v * $sv * $fract;
		$mid1 = $m + $vsf;
		$mid2 = $v - $vsf;

		switch ( $sextant ) {
			case 0:
				$r = $v;
				$g = $mid1;
				$b = $m;
				break;
			case 1:
				$r = $mid2;
				$g = $v;
				$b = $m;
				break;
			case 2:
				$r = $m;
				$g = $v;
				$b = $mid1;
				break;
			case 3:
				$r = $m;
				$g = $mid2;
				$b = $v;
				break;
			case 4:
				$r = $mid1;
				$g = $m;
				$b = $v;
				break;
			case 5:
				$r = $v;
				$g = $m;
				$b = $mid2;
				break;
		}
	}
	$r = round( $r * 255, 0 );
	$g = round( $g * 255, 0 );
	$b = round( $b * 255, 0 );

	if ( $to_hex ) {

		$r = ( $r < 15 ) ? '0' . dechex( $r ) : dechex( $r );
		$g = ( $g < 15 ) ? '0' . dechex( $g ) : dechex( $g );
		$b = ( $b < 15 ) ? '0' . dechex( $b ) : dechex( $b );

		return "#$r$g$b";

	} else {

		return "rgb($r, $g, $b)";
	}
}

/**
 * Custom WYSWIYG formats.
 */
function nus_mce_buttons( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'nus_mce_buttons' );
