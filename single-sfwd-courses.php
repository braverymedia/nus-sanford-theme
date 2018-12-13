<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage nus
 * @since 1.0.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="post-content">
				<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content/content', 'course' );

					endwhile; // End of the loop.
				?>
			</section>
			<?php
				 // Sidebar widgets aren't ever full-height, so load them here
				 get_sidebar('courses');
			?>
		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
	get_footer();
