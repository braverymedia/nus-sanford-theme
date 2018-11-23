<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage nus
 * @since 1.0.0
 */
?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer primary" role="contentinfo">
		<div class="inner-bounds">
			<section class="footer-menus" role="navigation">
			<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
				<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'nus' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'menu_class'     => 'footer-links-menu',
								'container' => false
							)
						);
						?>
				 </nav>
				<?php endif; ?>
				<?php if ( has_nav_menu( 'social-links' ) ) : ?>
					<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'nus' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social-links',
								'menu_class'     => 'social-links-menu',
								'container'			 => false,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . nus_get_icon_svg( 'link' ),
								'depth'          => 1,
							)
						);
						?>
					</nav><!-- .social-navigation -->
				<?php endif; ?>
			</section>
			<section class="site-info">
				<aside id="legal">
					<p><span class="copyright">Copyright &copy; <?php echo date("Y"); echo " "; bloginfo('name'); ?>. All Rights Reserved.</span> <a href="http://bravery.co/?c" target="_blank" title="Success Demands Bravery" class="credit screen-reader-text">Built with Bravery.</a></p>
				</aside>
			</section><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->

	<?php wp_footer(); ?>

</body>
</html>
