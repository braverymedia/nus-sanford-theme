<?php
/**
 * ACF Configuration
 *
 * @package nus
 */

 // Let's use ACF Gutenberg blocks
  add_action('acf/init', 'nus_acf_init');
  function nus_acf_init() {

  	// check function exists
  	if( function_exists('acf_register_block') ) {

  		// register accordion block
  		acf_register_block(array(
  			'name'				=> 'accordion',
  			'title'				=> __('Accordion'),
  			'description'		=> __('Facilitates the creation of accessible accordion blocks'),
  			'render_callback'	=> 'nus_acf_block_render_callback',
  			'category'			=> 'common',
  			'icon'				=> '<svg version="1.1" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><title>resize v</title><g><polygon points="8,3 12,7 4,7 "></polygon> <polygon points="8,13 4,9 12,9 "></polygon> <rect data-color="color-2" x="1" width="14" height="2"></rect> <rect data-color="color-2" x="1" y="14" width="14" height="2"></rect></g></svg>',
  			'keywords'			=> array( 'accordion', 'faq' ),
  		));

      // register chiclets block
  		acf_register_block(array(
  			'name'				=> 'chiclets',
  			'title'				=> __('Chiclets'),
  			'description'		=> __('Facilitates the creation of chiclet blocks'),
  			'render_callback'	=> 'nus_acf_block_render_callback',
  			'category'			=> 'formatting',
  			'icon'				=> 'admin-comments',
  			'keywords'			=> array( 'chiclet', 'callout' ),
  		));

      // register content grid block
  		acf_register_block(array(
  			'name'				=> 'content-grid',
  			'title'				=> __('Content Grid'),
  			'description'		=> __('Facilitates the creation of content grids'),
  			'render_callback'	=> 'nus_acf_block_render_callback',
  			'category'			=> 'layout',
  			'icon'				=> 'admin-comments',
  			'keywords'			=> array( 'featured', 'grid' ),
  		));

      // register download bar block
  		acf_register_block(array(
  			'name'				=> 'download-bar',
  			'title'				=> __('Download Bar'),
  			'description'		=> __('Facilitates the creation of download bar blocks'),
  			'render_callback'	=> 'nus_acf_block_render_callback',
  			'category'			=> 'widgets',
  			'icon'				=> 'admin-comments',
  			'keywords'			=> array( 'cta', 'action', 'download' ),
  		));

      // register image slider block
  		acf_register_block(array(
  			'name'				=> 'slider',
  			'title'				=> __('Image Slider'),
  			'description'		=> __('Facilitates the creation of image slider blocks'),
  			'render_callback'	=> 'nus_acf_block_render_callback',
  			'category'			=> 'widgets',
  			'icon'				=> 'admin-comments',
  			'keywords'			=> array( 'gallery', 'carousel', 'slider' ),
  		));

      // register recent posts block
  		acf_register_block(array(
  			'name'				=> 'recent-posts',
  			'title'				=> __('Recent Posts'),
  			'description'		=> __('Facilitates the creation of recent post blocks'),
  			'render_callback'	=> 'nus_acf_block_render_callback',
  			'category'			=> 'widgets',
  			'icon'				=> 'admin-comments',
  			'keywords'			=> array( 'news', 'headlines' ),
  		));

      // register testimonial block
  		acf_register_block(array(
  			'name'				=> 'testimonial',
  			'title'				=> __('Testimonial'),
  			'description'		=> __('Facilitates the creation of testimonial blocks'),
  			'render_callback'	=> 'nus_acf_block_render_callback',
  			'category'			=> 'widgets',
  			'icon'				=> 'admin-comments',
  			'keywords'			=> array( 'quote', 'testimonial', 'carousel' ),
  		));

      // register recent posts block
  		acf_register_block(array(
  			'name'				=> 'social-follow-bar',
  			'title'				=> __('Social Follow Bar'),
  			'description'		=> __('Configure and create a dynamic social follow bar.'),
  			'render_callback'	=> 'nus_acf_block_render_callback',
  			'category'			=> 'widgets',
  			'icon'				=> 'admin-comments',
  			'keywords'			=> array( 'social', 'dynamic' ),
  		));
  	}
  }
  // Accordion Block markup
  function nus_acf_block_render_callback( $block ) {

  	$slug = str_replace('acf/', '', $block['name']);

  	if( file_exists(STYLESHEETPATH . "/template-parts/blocks/block-acf-{$slug}.php") ) {
  		include( STYLESHEETPATH . "/template-parts/blocks/block-acf-{$slug}.php" );
  	}
  }

function nus_acf_enqueue_admin_script() {

    wp_enqueue_script( 'nus-acf-admin', get_template_directory_uri() . '/assets/js/min/acf-admin.min..js', array(), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'nus_acf_enqueue_admin_script' );
