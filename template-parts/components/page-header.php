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
      single_post_title( '<h1 class="page-title archive-title">', '-' . get_the_archive_title() . '</h1>' );
    elseif ( is_home() ) :
      single_post_title( '<h1 class="page-title archive-title">', '</h1>' );
    endif;
  ?>
</header><!-- .page-header -->
