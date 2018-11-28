<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.19
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>
<!-- Featured Image -->
<?php echo tribe_event_featured_image( null, 'medium' ); ?>
<!-- Event Meta -->
<div class="tribe-events-event-meta">
	<div class="author">

		<!-- Schedule & Recurrence Details -->
		<div class="tribe-event-schedule-details">
			<?php
				// changed from default to format date
				echo tribe_get_start_date($post->ID, false, 'l, M. j, Y'); ?>
		</div>
	</div>
</div><!-- .tribe-events-event-meta -->
<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h3 class="tribe-events-list-event-title">
	<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h3>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<!-- Event Cost -->
<?php if ( tribe_get_cost() ) : ?>
	<div class="tribe-events-event-cost">
		<span class="ticket-cost"><?php echo tribe_get_cost( null, true ); ?></span>
		<?php
		/**
		 * Runs after cost is displayed in list style views
		 *
		 * @since 4.5
		 */
		do_action( 'tribe_events_inside_cost' )
		?>
	</div>
<?php endif; ?>
<?php if ( $venue_details ) : ?>
	<!-- Venue Display Info -->
	<div class="tribe-events-venue-details">
		<span class="venue-name"><a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark"><?php echo tribe_get_venue(); ?></a></span>
	</div> <!-- .tribe-events-venue-details -->
<?php endif; ?>
