<?php
  // Recent posts setup
  $section_title = get_field('section_title');
  $cat = get_field('recent_category');
  $count = get_field('post_count');

  $q_args = array(
    'posts_per_page' => $count,
    'cat'            => $cat
  );
?>

<section class="nus-block-recent-posts">
  <header>
    <h2><?php echo $section_title; ?></h2>
    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" title="See All News">See All News <?php echo nus_get_icon_svg( 'right-arrow', '12px'); ?></a>
  </header>
  <?php
    $p = new WP_Query($q_args);
    if ( $p->have_posts() ) : ?>
    <div class="nus-block-recent-posts--feed">
      <?php while ( $p->have_posts() ) : $p->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="post" title="Read <?php the_title(); ?>">
          <article>
            <span class="post-date"><?php the_time('F j'); ?></span>
            <h3><?php the_title(); ?></h3>
          </article>
        </a>
      <?php endwhile; wp_reset_query(); ?>
    </div>
  <?php endif; ?>
</section>
