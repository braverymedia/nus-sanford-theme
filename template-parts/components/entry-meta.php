<div class="entry-meta">
  <?php
    nus_posted_by();
    nus_posted_on();
    nus_first_category_link();

	// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'nus' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . nus_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	?>
</div><!-- .meta-info -->
