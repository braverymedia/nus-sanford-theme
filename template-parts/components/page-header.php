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
    // Single Event
    if ( tribe_is_event() && is_single()  ) :
      the_title( '<h1 class="hero-title single-event-title">', '</h1>' );

    // If we're on the main events page
    elseif ( tribe_is_event_query() && is_archive() ) :
      echo '<h1 class="hero-title events-title">' . __('Events', 'nus') . '</h1>';

    // Other single posts
    elseif ( is_single() && ! tribe_is_event() ) :
      echo '<div class="hero-title page-title">' . __('Harmony Headlines', 'nus') . '</div>';

    elseif ( is_archive() && ! is_home() ) :
      $current_term = single_term_title( "", false );
      echo '<h1 class="page-title archive-title">' . get_the_title( get_option('page_for_posts', true) ) . ' - ' . $current_term . '</h1>';

    elseif ( is_home() ) :
      single_post_title( '<h1 class="page-title archive-title posts-page-title">', '</h1>' );

    elseif ( is_page() && !is_front_page() ) :
      the_title( '<div class="hero-title">', '</div>' );
    endif;
  ?>
</header><!-- .page-header -->
