<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage nus
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'nus' ); ?></a>

	<header id="masthead" class="primary<?php echo is_singular() && nus_can_show_post_thumbnail() ? ' site-header featured-image' : ' site-header'; ?>">
		<?php
			/**
			 * Include logo and branding, then site navigation
			**/
			get_template_part('template-parts/components/site', 'branding');
			get_template_part('template-parts/components/site', 'nav');
			get_template_part('template-parts/components/utility', 'nav');
		?>
	</header><!-- #masthead -->
	<?php
		/**
		 *  Image or blank for page header.
		 **/
		if ( is_singular() && !is_front_page() && nus_can_show_post_thumbnail() && has_post_thumbnail() ) : ?>
		<div class="page-cover-image">
			<?php nus_post_thumbnail(); ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	<?php
		elseif ( is_singular() && is_front_page() && nus_can_show_post_thumbnail() && has_post_thumbnail() ) : ?>
		<div class="page-cover-image">
			<?php nus_post_thumbnail(); ?>
			<?php the_title( '<div class="home-tagline">', '</div>' ); ?>
		</div>
	<?php
		endif; ?>
	<div id="content" class="site-content">
