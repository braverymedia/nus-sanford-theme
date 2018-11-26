<div class="site-branding">
  <?php if ( has_custom_logo() ) : ?>
    <div class="site-logo"><?php echo nus_get_icon_svg('sanford-logo', '180px' ); ?></div>
  <?php endif; ?>
  <?php $blog_info = get_bloginfo( 'name' ); ?>
  <?php if ( ! empty( $blog_info ) ) : ?>
    <?php if ( is_front_page() && is_home() ) : ?>
      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    <?php else : ?>
      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
    <?php endif; ?>
  <?php endif; ?>

  <?php
    $description = get_bloginfo( 'description', 'display' );
    if ( $description || is_customize_preview() ) :
      ?>
        <p class="site-description">
          <?php echo $description; ?>
        </p>
  <?php endif; ?>
</div><!-- .site-branding -->
