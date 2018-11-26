<?php
/**
 * Add support for custom color palettes in Gutenberg.
 */
function nus_gutenberg_color_palette() {
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Light Grey', 'nus' ),
				'slug' => 'light-grey',
				'color' => '#F3F3F4',
			),
			array(
				'name'  => esc_html__( 'Pistachio', 'nus' ),
				'slug' => 'pistachio',
				'color' => '#8dc806',
			),
			array(
				'name'  => esc_html__( 'Denim', 'nus' ),
				'slug' => 'denim',
				'color' => '#1c68ba',
			),
			array(
				'name'  => esc_html__( 'Orange Red', 'nus' ),
				'slug' => 'orange-red',
				'color' => '#fb440c',
			),
			array(
				'name'  => esc_html__( 'Medium Carmin', 'nus' ),
				'slug' => 'medium-carmine',
				'color' => '#b0412b',
			)
		)
	);
}
add_action( 'after_setup_theme', 'nus_gutenberg_color_palette' );
