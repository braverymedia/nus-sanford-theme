<section class="nus-block-slider alignfull">
  <?php
    $images = get_field('slider_images');
    $size = 'full'; // (thumbnail, medium, large, full or custom size)

    if( $images ) : ?>
      <div class="slider-container">
        <?php
          foreach( $images as $image ) :
            echo wp_get_attachment_image( $image['ID'], $size );
          endforeach;
        ?>
      </div>
  <?php
    endif; ?>
  <button class="prev-slide">Prev</button>
  <button class="next-slide">Next</button>
</section>
