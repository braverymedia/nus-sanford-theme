<?php
/**
 * NUS Base Theme Customizer
 *
 * @package WordPress
 * @subpackage nus
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nus_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'nus_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'nus_customize_partial_blogdescription',
			)
		);
	}

/**
 * Add contact info section and panel.
 */
	$wp_customize->add_section( 'nus_customizer_contact' , array(
	    'title'       => __( 'Contact Info','nus' ),
	    'priority'    => 30,
			'description' => __( 'Set the default site contact info.', 'nus' )
	) );

	// Adds setting and control for configuring a Phone Number
	$wp_customize->add_setting(
		'nus_phone',
		array(
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'nus_phone',
		array(
			'type'     => 'text',
			'label'    => __( 'Phone Number', 'nus' ),
			'description' => __( 'Contact phone number used across this site.', 'nus' ),
			'section'  => 'nus_customizer_contact',
			'priority' => 5,
		)
	);

	$wp_customize->add_setting(
		'nus_email',
		array(
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_email',
		)
	);

	$wp_customize->add_control(
		'nus_email',
		array(
			'type'     => 'email',
			'label'    => __( 'Email', 'nus' ),
			'description' => __( 'Contact email used across this site.', 'nus' ),
			'section'  => 'nus_customizer_contact',
			'priority' => 5,
		)
	);

	$wp_customize->get_setting( 'nus_phone' )->transport 				= 'postMessage';
}
add_action( 'customize_register', 'nus_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nus_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nus_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function nus_customizer_preview_js() {
	wp_enqueue_script( 'nus-customizer-preview', get_theme_file_uri( '/assets/js/customizer-preview.js' ), array( 'customize-preview' ), '20181115', true );
}
add_action( 'customize_preview_init', 'nus_customizer_preview_js' );
