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
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TBJRGVX');</script>
		<!-- End Google Tag Manager -->
		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TBJRGVX"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
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
		if ( is_singular() && !is_single() && !is_front_page() && nus_can_show_post_thumbnail() && has_post_thumbnail() ) : ?>
		<div class="page-cover-image">
			<?php nus_post_thumbnail(); ?>
			<?php the_title( '<div class="hero-title">', '</div>' ); ?>
		</div>
	<?php
		elseif ( is_front_page() && nus_can_show_post_thumbnail() && has_post_thumbnail() ) : ?>
		<div class="page-cover-image">
			<?php nus_post_thumbnail(); ?>
			<?php the_title( '<div class="home-tagline">', '</div>' ); ?>
		</div>
	<?php
		else :
			get_template_part( 'template-parts/components/page', 'header' );
		endif;

		/**
		 *  breadcrumbs
		 **/
		if ( ! is_front_page() ) {
			get_template_part('template-parts/components/breadcrumbs');
		}
	?>
	<div id="content" class="site-content">
