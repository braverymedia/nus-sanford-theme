<?php
/**
 * nus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nus
 */

if ( ! function_exists( 'nus_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function nus_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on nus, use a find and replace
		 * to change 'nus' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'nus', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 980, 1200 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'site-menu' => esc_html__( 'Site Menu', 'nus' ),
			'ambassador-menu' => esc_html__( 'Ambassador Menu', 'nus' ),
			'social-links' => esc_html__( 'Social Links Menu', 'nus' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'nus' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'nus_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 400,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		// add_editor_style( 'assets/css/editor.css' );

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary Color', 'nus' ),
					'slug'  => 'primary',
					'color' => nus_hsl_hex( 'default' === get_theme_mod( 'colorscheme' ) ? 199 : get_theme_mod( 'colorscheme_primary_hue', 199 ), 100, 33 ),
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Excerpt support needed for navigation descriptions
		add_post_type_support( 'page', 'excerpt' );

		// Adds our theme colors
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

		// Disables custom colors in block color palette.
add_theme_support( 'disable-custom-colors' );

	}
endif; // nus_setup
add_action( 'after_setup_theme', 'nus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nus_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 680 );
}
add_action( 'after_setup_theme', 'nus_content_width', 0 );

if ( ! function_exists( 'nus_register_image_sizes' ) ) :
	/*
	 * Enables support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	function nus_register_image_sizes() {
		// Bubble images
		// add_image_size( 'nus-square', 1000, 1000, true );
		// Heroes
		// add_image_size( 'nus-hero', 1400, 500, true );
	}
	add_action( 'after_setup_theme', 'nus_register_image_sizes' );

endif;

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function nus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Widgets', 'nus' ),
		'id'            => 'widget-area-1',
		'description'   => esc_html__( 'Add widgets here.', 'nus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'nus_widgets_init' );

function nus_scripts() {
	// Get theme version
	$theme = wp_get_theme();
	$theme_version = $theme->get( 'Version' );

	// Web fonts
	$font_url = '//use.typekit.net/tas7lio.css';

	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/assets/js/modernizr.min.js', false, '3.6', false);
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'nus-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'aria-accordion', get_template_directory_uri() . '/assets/js/min/aria.accordion.min.js', array(), '3.2.1', true );
	wp_enqueue_style( 'nus-webfonts', $font_url, array(), null, 'screen' );
	wp_enqueue_style( 'dashicons' );

	// See if we're on dev or not
	if ( SCRIPT_DEBUG || WP_DEBUG ) :

		wp_enqueue_style( 'nus-style', get_template_directory_uri() . '/assets/css/sanford.css', false, time(), 'all' );
		wp_enqueue_script( 'nus-script', get_template_directory_uri() . '/assets/js/global.js', array(), time() );

	else :

		wp_enqueue_style( 'nus-style', get_template_directory_uri() . '/assets/css/sanford.css', false, $theme_version, 'all' );
		wp_enqueue_script( 'nus-script', get_template_directory_uri() . '/assets/js/min/global.min.js', array(), $theme_version, true );

	endif;

}
add_action( 'wp_enqueue_scripts', 'nus_scripts' );

/**
 * Enqueue supplemental block editor styles.
 */
function nus_editor_customizer_styles() {

	wp_enqueue_style( 'nus-editor-customizer-styles', get_theme_file_uri( '/assets/css/nus-blocks-admin.css' ), false, '1.0', 'all' );

	if ( 'custom' === get_theme_mod( 'colorscheme' ) ) {
		// Include color patterns
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'nus-editor-customizer-styles', nus_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'nus_editor_customizer_styles' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-nus-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-nus-walker-comment.php';

/**
 * ACF Block settings.
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Events Calendar Mods
 */
 if ( class_exists('Tribe__Events__Main') ) {
	 require get_template_directory() . '/inc/events-calendar-mods.php';
 }


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
