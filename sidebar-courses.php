<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package nus
 */

if ( ! is_active_sidebar( 'course-widgets' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'course-widgets' ); ?>
</div><!-- #secondary -->
