<section class="nus-block-testimonial alignfull">
  <?php
    // ACF setup
    $testimonials = get_field('testimonials');
    $pre  = '';
    $post = '';
    // setup the slider container if we need to.
    if ( count($testimonials) > 1 ) {
      $pre  = '<div class="slider-container">';
      $post = '</div>';
    }
    echo $pre;
    while ( have_rows('testimonials') ) : the_row('testimonials');

    // Setup ACF variables
    $type = get_sub_field("testimonial_type");
    $image = get_sub_field("testimonial_image");
    $quote = get_sub_field('testimonial_quote');
  ?>
    <article class="nus-testimonial <?php echo $type; ?>">
      <div class="testimonial--inner">
        <figure class="nus-testimonial--image">
          <?php echo wp_get_attachment_image($image, 'full'); ?>
        </figure>
        <?php
          if ( $type == 'no-quote' ) { ?>
            <div class="entry-content">
              <?php the_sub_field('testimonial_content'); ?>
            </div>
          <?php } else { ?>
            <blockquote>
              <?php echo nus_get_icon_svg('quote', '50px'); ?>
              <?php echo $quote['quotation']; ?>
              <footer>
                <cite><?php echo $quote['citation']; ?></cite>
                <span><?php echo $quote['citation_subhead']; ?></span>
              </footer>
            </blockquote>
          <?php } ?>
      </div>
    </article>
  <?php endwhile; wp_reset_query();
    echo $post;
  ?>
</section>
