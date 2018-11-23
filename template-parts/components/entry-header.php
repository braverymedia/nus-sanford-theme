<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage nus
 * @since 1.0.0
 */
 ?>

<?php
  if ( ! is_page() ) :

    the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' );
    get_template_part('template-parts/components/entry', 'meta');

  endif;
?>
