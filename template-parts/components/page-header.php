<?php
/**
 * Displays the page header
 *
 * @package WordPress
 * @subpackage nus
 * @since 1.0.0
 */
 ?>
<header class="page-header">
  <?php
    if ( is_archive() && ! is_home() ) :
      $current_term = single_term_title( "", false );
      echo '<h1 class="page-title archive-title">' . get_the_title( get_option('page_for_posts', true) ) . ' - ' . $current_term . '</h1>';
    elseif ( is_home() ) :
      single_post_title( '<h1 class="page-title archive-title posts-page-title">', '</h1>' );
    elseif ( is_single() ) :
      echo '<h2 class="posts-page-title">' . get_the_title( get_option('page_for_posts', true) ) . '</h2>';
    elseif ( is_page() && !is_front_page() ) :
      the_title( '<div class="hero-title">', '</div>' );
    endif;
  ?>
</header><!-- .page-header -->
