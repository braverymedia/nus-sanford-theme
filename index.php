<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nus
 */

get_header(); ?>

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
	</section>
<?php
	get_footer();
