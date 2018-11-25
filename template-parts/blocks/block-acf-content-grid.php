<?php
  if ( have_rows('grid_items') ) : ?>
    <section class="nus-block-content-grid">
      <div class="wp-block--inner">
        <?php while ( have_rows('grid_items') ) : the_row('grid_items');
          $image = get_sub_field('content_image');
          $title = get_sub_field('content_title');
          $content = get_sub_field('content');
        ?>
          <article class="nus-block-content-grid--item">
            <figure class="item-image">
              <?php wp_get_attachment_image( $image, 'full' ); ?>
            </figure>
            <h3><?php echo $title; ?></h3>
            <?php echo $content; ?>
          </article>
        <?php endwhile; ?>
      </div>
    </section>
<?php endif; ?>
