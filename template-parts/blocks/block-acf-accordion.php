<?php
  // uses https://github.com/scottaohara/a11y_accordions

  if ( have_rows('accordion') ) : ?>
<section class="nus-block-accordion">
  <div data-aria-accordion>
    <?php while ( have_rows('accordion') ) : the_row('accordion'); ?>
      <h3 data-aria-accordion-heading>
        <?php the_sub_field('accordion_title'); ?>
      </h3>
      <div data-aria-accordion-panel>
        <?php the_sub_field('accordion_content'); ?>
      </div>
    <?php endwhile; ?>
  </div>
</section>
<?php endif; ?>
