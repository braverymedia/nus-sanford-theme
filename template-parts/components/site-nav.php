<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php echo nus_get_icon_svg( 'menu', '25px'); ?> <span class="screen-reader-text"><?php _e( 'Site Menu', 'nus' ); ?></span></button>
<nav id="site-navigation" class="main-navigation" role="navigation">
  <?php wp_nav_menu(
    array(
      'theme_location' => 'site-menu',
      'container'      => false,
      'items_wrap'     => '<ul id="%1$s" class="%2$s" tabindex="0">%3$s</ul>', // accessibility
    )
  ); ?>
</nav><!-- #site-navigation -->
