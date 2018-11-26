<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package nus
 */

// For inlining images in the theme
function nus_img_path( $filename ) {
	$img_path = get_stylesheet_directory_uri() . '/assets/img/' . $filename;
	return $img_path;
}

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'nus' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'nus' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'nus' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if ( ! function_exists( 'nus_posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function nus_posted_by() {
		printf(
			'<span class="byline">By <span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span></span>',
			/* translators: 1: SVG icon. 2: post author, only visible to screen readers. 3: author link. */
			__( 'By', 'nus' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'nus' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'nus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function nus_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'n/j/Y' ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on">' . $time_string . '</span>';

}
endif;

if ( ! function_exists( 'nus_first_category_link' ) ) :
	/**
	 * Gets first category and displays it as a link.
	 */
	function nus_first_category_link() {
		$cat = get_the_category();
		if ( ! empty( $cat ) ) {
			$first_cat_string = '<a href="'. get_category_link( $cat[0]->term_id ) .'" title="View all news in the '. $cat[0]->name .' category.">' . $cat[0]->name . '</a>';

			echo '<span class="post-category">' . $first_cat_string . '</span>';
		}
	}
endif;

if ( ! function_exists( 'nus_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function nus_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'nus' ) );
		if ( $categories_list && nus_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'nus' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'nus' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'nus' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'nus' ), __( '1 Comment', 'nus' ), __( '% Comments', 'nus' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'nus' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'nus' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'nus' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'nus' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'nus' ), get_the_date( _x( 'Y', 'yearly archives date format', 'nus' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'nus' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'nus' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'nus' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'nus' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'nus' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'nus' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'nus' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'nus' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'nus' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'nus' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'nus' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'nus' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'nus' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'nus' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'nus' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'nus' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function nus_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'nus_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'nus_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so nus_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so nus_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'nus_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function nus_post_thumbnail() {
		if ( ! nus_can_show_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<figure class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</figure><!-- .post-thumbnail -->

			<?php
		else :
			?>

		<figure class="post-thumbnail">
			<a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( 'post-thumbnail' );
				?>
			</a>
		</figure>

			<?php
		endif; // End is_singular().
	}
endif;


if ( ! function_exists( 'nus_the_posts_navigation' ) ) :
	/**
	 * Posts navigation
	 */
	function nus_the_posts_navigation() {
		$prev_icon = nus_get_icon_svg( 'chevron_left', 22 );
		$next_icon = nus_get_icon_svg( 'chevron_right', 22 );
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => sprintf( '%s <span class="nav-prev-text">%s</span>', $prev_icon, __( 'Newer posts', 'nus' ) ),
				'next_text' => sprintf( '<span class="nav-next-text">%s</span> %s', __( 'Older posts', 'nus' ), $next_icon ),
			)
		);
	}
endif;


/**
 * Flush out the transients used in nus_categorized_blog.
 */
function nus_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'nus_categories' );
}
add_action( 'edit_category', 'nus_category_transient_flusher' );
add_action( 'save_post',     'nus_category_transient_flusher' );

if ( ! function_exists('nus_breadcrumbs') ) :

	/**
	 * Breadcrumb navigation
	 */
	function nus_breadcrumb_news_parent() {
		$news_page_id = get_option('page_for_posts', true);
		$news_parent_page = get_post_ancestors( $news_page_id );

		$news_parent_string = '<a href="' . get_permalink( $news_parent_page[0] ) . '" title="'. get_the_title( $news_parent_page[0] ) .'" class="crumb-news-parent">' . get_the_title( $news_parent_page[0] ) . '</a>';

		return $news_parent_string;
	}
	function nus_breadcrumbs() {

	    // Settings
	    $separator          = nus_get_icon_svg( 'chevron_right', 12 );
	    $home_title         = 'Sanford Harmony';

	    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
	    $custom_taxonomy    = 'tribe_events_cat';

	    // Get the query & post information
	    global $post,$wp_query;

	    // Do not display on the homepage
	    if ( !is_front_page() ) {

	        // Build the breadcrums
	        echo '<ul>';

	        // Home page
	        echo '<li class="item-home"><a class="crumb-link crumb-home" href="' . get_home_url() . '" title="' . $home_title . '"><span class="screen-reader-text">' . $home_title . '</span>'. nus_get_icon_svg( 'home', '16px') .'</a></li>';
	        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

					if ( is_single() ) {
						$news_parent_string = nus_breadcrumb_news_parent();
						echo '<li class="item-parent">' . $news_parent_string . '</li>';
						echo '<li class="separator"> ' . $separator . ' </li>';
					}
					// Events Calendar home
					if ( tribe_is_event_query() && is_archive() ) {
						$news_parent_string = nus_breadcrumb_news_parent();
						echo '<li class="item-parent">' . $news_parent_string . '</li>';
						echo '<li class="separator"> ' . $separator . ' </li>';
					}
	        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

	            echo '<li class="item-current item-archive"><strong class="crumb-current crumb-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';

	        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

	            // If post is a custom post type
	            $post_type = get_post_type();

	            // If it is a custom post type display name and link
	            if($post_type != 'post') {

	                $post_type_object = get_post_type_object($post_type);
	                $post_type_archive = get_post_type_archive_link($post_type);

	                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="crumb-cat crumb-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
	                echo '<li class="separator"> ' . $separator . ' </li>';

	            }

	            $custom_tax_name = get_queried_object()->name;
	            echo '<li class="item-current item-archive"><strong class="crumb-current crumb-archive">' . $custom_tax_name . '</strong></li>';

	        } else if ( is_single() ) {

	            // If post is a custom post type
	            $post_type = get_post_type();
	            // If it is a custom post type display name and link
	            if($post_type != 'post') {

	                $post_type_object = get_post_type_object($post_type);
	                $post_type_archive = get_post_type_archive_link($post_type);

	                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="crumb-cat crumb-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
	                echo '<li class="separator"> ' . $separator . ' </li>';

	            }

	            // Get post category info
	            $category = get_the_category();

	            if(!empty($category)) {

	                // Get last category post is in
	                $last_category = end(array_values($category));

	                // Get parent any categories and create array
	                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
	                $cat_parents = explode(',',$get_cat_parents);

	                // Loop through parent categories and store in variable $cat_display
	                $cat_display = '';
	                foreach($cat_parents as $parents) {
	                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
	                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
	                }

	            }

	            // If it's a custom post type within a custom taxonomy
	            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
	            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

	                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
	                $cat_id         = $taxonomy_terms[0]->term_id;
	                $cat_nicename   = $taxonomy_terms[0]->slug;
	                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
	                $cat_name       = $taxonomy_terms[0]->name;

	            }

	            // Check if the post is in a category
	            if(!empty($last_category)) {
	                echo $cat_display;
	                echo '<li class="item-current item-' . $post->ID . '"><strong class="crumb-current crumb-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

	            // Else if post is in a custom taxonomy
	            } else if(!empty($cat_id)) {

	                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="crumb-cat crumb-cat-' . $cat_id . ' crumb-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
	                echo '<li class="separator"> ' . $separator . ' </li>';
	                echo '<li class="item-current item-' . $post->ID . '"><strong class="crumb-current crumb-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

	            } else {

	                echo '<li class="item-current item-' . $post->ID . '"><strong class="crumb-current crumb-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

	            }

	        } else if ( is_category() ) {

	            // Category page
							// Custom Parent News Page
							$news_parent_string = nus_breadcrumb_news_parent();
							echo '<li class="item-parent">' . $news_parent_string . '</li>';
							echo '<li class="separator"> ' . $separator . ' </li>';
	            echo '<li class="item-current item-cat"><strong class="crumb-current crumb-cat">' . single_cat_title('', false) . '</strong></li>';

	        } else if ( is_page() ) {

	            // Standard page
	            if( $post->post_parent ){

	                // If child page, get parents
	                $anc = get_post_ancestors( $post->ID );

	                // Get parents in the right order
	                $anc = array_reverse($anc);

	                // Parent page loop
	                if ( !isset( $parents ) ) $parents = null;
	                foreach ( $anc as $ancestor ) {
	                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="crumb-parent crumb-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
	                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
	                }

	                // Display parent pages
	                echo $parents;

	                // Current page
	                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

	            } else {

	                // Just display current page if not parents
	                echo '<li class="item-current item-' . $post->ID . '"><strong class="crumb-current crumb-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

	            }

	        } else if ( is_tag() ) {

	            // Tag page

	            // Get tag information
	            $term_id        = get_query_var('tag_id');
	            $taxonomy       = 'post_tag';
	            $args           = 'include=' . $term_id;
	            $terms          = get_terms( $taxonomy, $args );
	            $get_term_id    = $terms[0]->term_id;
	            $get_term_slug  = $terms[0]->slug;
	            $get_term_name  = $terms[0]->name;

							// Custom Parent News Page
							$news_parent_string = nus_breadcrumb_news_parent();
							echo '<li class="item-parent">' . $news_parent_string . '</li>';
							echo '<li class="separator"> ' . $separator . ' </li>';
	            // Display the tag name
	            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="crumb-current crumb-tag-' . $get_term_id . ' crumb-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';

	        } elseif ( is_day() ) {

	            // Day archive

	            // Year link
	            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="crumb-year crumb-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
	            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

	            // Month link
	            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="crumb-month crumb-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
	            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

	            // Day display
	            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="crumb-current crumb-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';

	        } else if ( is_month() ) {

	            // Month Archive

	            // Year link
	            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="crumb-year crumb-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
	            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

	            // Month display
	            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="crumb-month crumb-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';

	        } else if ( is_year() ) {

	            // Display year archive
	            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="crumb-current crumb-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';

	        } else if ( is_author() ) {

	            // Auhor archive
							// Custom Parent News Page
							$news_parent_string = nus_breadcrumb_news_parent();
							echo '<li class="item-parent">' . $news_parent_string . '</li>';
							echo '<li class="separator"> ' . $separator . ' </li>';
	            // Get the author information
	            global $author;
	            $userdata = get_userdata( $author );

	            // Display author name
	            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="crumb-current crumb-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';

	        } else if ( get_query_var('paged') ) {
							// Custom Parent News Page
							$news_parent_string = nus_breadcrumb_news_parent();
							echo '<li class="item-parent">' . $news_parent_string . '</li>';
							echo '<li class="separator"> ' . $separator . ' </li>';

	            // Paginated archives
	            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="crumb-current crumb-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';

	        } else if ( is_search() ) {

	            // Search results page
	            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="crumb-current crumb-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';

	        } elseif ( is_404() ) {

	            // 404 page
	            echo '<li>' . 'Error 404' . '</li>';
	        } elseif ( is_home() ) {
						$posts_title = get_the_title( get_option('page_for_posts', true) );

						// Custom Parent News Page
						$news_parent_string = nus_breadcrumb_news_parent();
						echo '<li class="item-parent">' . $news_parent_string . '</li>';
						echo '<li class="separator"> ' . $separator . ' </li>';
						echo '<li class="item-current"><strong class="crumb-current" title="'. $posts_title .'">'. $posts_title .'</strong></li>';
					}

	        echo '</ul>';

	    }

	}

endif;
