<?php
  $section_title = get_field('section_title');
  $chiclets_rows = get_field('chiclet');
  $count = count($chiclets_rows);
  if ( have_rows('chiclet') ) : ?>
    <section class="nus-block-chiclet-grid">
      <div class="wp-block--inner has-<?php echo $count; ?>">
        <?php while ( have_rows('chiclet') ) : the_row('chiclet');
          $icon     = get_sub_field('icons');
          $title    = get_sub_field('chiclet_title');
          $content  = get_sub_field('chiclet_copy');
          $link     = get_sub_field('chiclet_link');
        ?>
          <article class="nus-block-chiclet">
            <?php if ( !empty($link) ) : ?>
            <a href="<?php echo $link; ?>" title="<?php echo $title; ?>" class="nus-block-chiclet--inner">
              <h3 class="nus-block-text"><?php echo $title; ?></h3>
              <figure class="nus-block-chiclet-icon">
                <?php echo nus_get_icon_svg( $icon, 85 ); ?>
              </figure>
              <?php echo $content; ?>
              <div class="nus-block-chiclet--action">Read More <?php echo nus_get_icon_svg('right-arrow', '14px'); ?></div>
            </a>
          <?php else : ?>
            <div class="nus-block-chiclet--inner">
              <h3 class="nus-block-text"><?php echo $title; ?></h3>
              <figure class="nus-block-chiclet-icon">
                <?php echo nus_get_icon_svg( $icon, 85 ); ?>
              </figure>
              <?php echo $content; ?>
            </div>
          <?php endif ?>
          </article>
        <?php endwhile; ?>
      </div>
    </section>
<?php endif; ?>
