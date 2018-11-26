<?php // ACF Download Bar block
  $db_type = get_field('db_type');
  $left = get_field('left_side');
  $right = get_field('right_side');
  $button = $right['nus_button'];
?>
<aside class="nus-block-download-bar download-bar--<?php echo $db_type; ?>">
  <header>
    <?php echo $left['text_content']; ?>
  </header>
  <div class="download-bar--action">
    <?php if ( $button ) { ?>
      <div class="wp-block-button">
        <a href="<?php echo $button['button_url']; ?>" class="wp-block-button__link has-background" style="background-color: <?php echo $button['button_color']; ?>;"><?php echo $button['button_label']; ?></a>
      </div>
    <?php } ?>
    <?php if ( have_rows( $right['db_images'] ) ) : while ( have_rows( $right['db_images'] ) ) : the_row( $right['db_images'] );
      $image = get_sub_field('db_image'); ?>
      ?>
      <a href="<?php the_sub_field('db_link'); ?>">
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
      </a>
    <?php endwhile;  endif; ?>
  </div>
</aside>
