<section class="visitor-tools">
<?php
  $phone = get_theme_mod( 'nus_phone' );
  $email = get_theme_mod( 'nus_email' );
  if ( !empty($phone) || !empty($email) ) {
?>
  <aside class="contact">
    <h2><?php echo __('Questions?', 'nus'); ?></h2>
    <ul class="contact-methods">
      <li><span class="contact--phone"><?php echo $phone; ?></span></li>
      <li><span class="contact--email"><?php echo $email; ?></span></li>
    </ul>
  </aside>
<?php } ?>
</section>
