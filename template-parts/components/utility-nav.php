<section class="visitor-tools">
<?php
  $phone = get_theme_mod( 'nus_phone' );
  $phone_plain = $res = preg_replace("/[^0-9]/", "", $phone );
  $email = get_theme_mod( 'nus_email' );
  if ( !empty($phone) || !empty($email) ) {
?>
  <aside class="contact">
    <h2><?php echo __('Questions?', 'nus'); ?></h2>
    <ul class="contact-methods">
      <li><span class="contact--phone"><a href="tel://<?php echo $phone_plain; ?>"><?php echo $phone; ?></a></span></li>
      <li><span class="contact--email"><a href="mailto:<?php echo $email; ?>" title="Email Sanford Harmony"><?php echo $email; ?></a></span></li>
    </ul>
  </aside>
<?php } ?>
  <?php wp_nav_menu( array( 'theme_location' => 'ambassador-menu', 'container' => 'div', 'container_class' => 'ambassador-menu' ) ); ?>
</section>
