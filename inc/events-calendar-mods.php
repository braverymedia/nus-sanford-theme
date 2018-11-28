<?php
  function nus_tribe_show_past_webinars() {

    $events = tribe_get_events( array(
      'eventDisplay'   => 'past',
      'posts_per_page' => -1,
      'order'          => 'DESC',
      'tax_query'=> array(
          array(
            'taxonomy' => 'tribe_events_cat',
            'field' => 'slug',
            'terms' => 'webinars'
          )
        )
    ) );

    foreach($events as $event) { ?>
    <article class="nus-tribe-event nus-tribe-event--webinar">
      <div class="wp-block--inner">
        <div class="nus-tribe-event--copy">
          <h2><a href="<?php the_permalink($event->ID); ?>" title="Watch this webinar."><?php echo $event->post_title; ?></a></h2>
        </div>
        <div class="nus-tribe-event--action">
          <div class="wp-block-button aligncenter">
            <a class="wp-block-button__link has-background has-denim-background-color" href="<?php the_permalink($event->ID); ?>" title="Watch <?php echo $event->post_title; ?>">Watch Webinar</a>
          </div>
        </div>
      </div>
    </article>

  <?php }
}
