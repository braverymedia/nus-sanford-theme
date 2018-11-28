<?php
$post_parent = '';
if ( $post->post_parent ) {
  $post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
}
?>
<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>" <?php echo $post_parent; ?>>
  <?php
  $event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

  /**
   * Filters the event type used when selecting a template to render
   *
   * @param $event_type
   */
  $event_type = apply_filters( 'tribe_events_list_view_event_type', $event_type );

  tribe_get_template_part( 'list/single', $event_type );
  ?>
</div>
