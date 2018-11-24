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
  if ( ! is_page() && ! is_singular() ) :

    the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' );
    get_template_part('template-parts/components/entry', 'meta');
  elseif ( is_singular() ) :
    get_template_part('template-parts/components/entry', 'meta');
    the_title( '<h1 class="entry-title">', '</h1>' );


  endif;
?>
