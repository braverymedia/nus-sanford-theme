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
    <?php if ( $db_type == 'button' ) { ?>
      <div class="wp-block-button">
        <a href="<?php echo $button['button_url']; ?>" class="wp-block-button__link has-background" style="background-color: <?php echo $button['button_color']; ?>;"><?php echo $button['button_label']; ?></a>
      </div>
    <?php
      }  else {
        $images = $right['db_images'];
        foreach ( $images as $img ) {
          echo '<a href="'. $img['db_link'] .'" title="'. $img['alt'] .'">';
          echo '<img src="'. $img['db_image']['url'] .'" alt="'. $img['db_image']['alt'] .'"/>';
          echo '</a>';
        }
      }
    ?>
  </div>
</aside>
