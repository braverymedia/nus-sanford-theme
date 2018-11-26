<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage nus
 * @since 1.0.0
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
			if ( have_posts() ) { ?>
				<section id="posts-area">
					<?php
							// Load posts loop.
							while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/content/content', 'excerpt' );
							}
							// Previous/next page navigation.
							nus_the_posts_navigation();
					 } else {
							// If no content, include the "No posts found" template.
							get_template_part( 'template-parts/content/content', 'none' );

					 }
					?>
				</section>
			<?php
				 // Sidebar widgets aren't ever full-height, so load them here
				 get_sidebar();
				?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
