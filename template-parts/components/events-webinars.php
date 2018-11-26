<?php
  // Only load if the plugin exists
  if ( function_exists('nus_tribe_show_past_webinars') ) { ?>
  <section class="nus-section--past-webinars">
    <?php nus_tribe_show_past_webinars(); ?>
  </section>
<?php } ?>
