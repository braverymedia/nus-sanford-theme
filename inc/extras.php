<?php
/**
 * Various branding and tweaks
 *
 *
 * @package nus
 */

/**
 * Enqueues jQuery in the footer instead of the header
 */

function nus_enqueue_jquery_in_footer( &$scripts ) {

    if ( ! is_admin() )
        $scripts->add_data( 'jquery', 'group', 1 );
}
add_action( 'wp_default_scripts', 'nus_enqueue_jquery_in_footer' );


/**
 * Defers our scripts so they don't break loading.
 * This is meant to be a speed optimization.
 *
 */

function nus_script_tag_defer($tag, $handle) {
    if (is_admin()){
        return $tag;
    }
    if (strpos($tag, '/wp-includes/js/jquery/jquery')) {
        return $tag;
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.') !==false) {
        return $tag;
    }
    else {
        return str_replace(' src',' defer src', $tag);
    }
}
add_filter('script_loader_tag', 'nus_script_tag_defer',10,2);

// Custom Login Styles
function nus_login_stylesheet() {
    wp_enqueue_style( 'nus-login', get_template_directory_uri() . '/assets/css/bravery-login.css' );
}
add_action( 'login_enqueue_scripts', 'nus_login_stylesheet' );

// Edit login page logo url
function nus_login_logo_url() {
	return 'https://bravery.co';
}
add_filter('login_headerurl', 'nus_login_logo_url');

function nus_login_logo_tooltip() {
	return 'Built with Bravery.';
}

// customize admin footer text
function nus_admin_footer() {
	echo '<a href="https://bravery.co/?ref=ctheme" title="Built with Bravery" target="_blank">Built with Bravery.</a>';
}
add_filter('admin_footer_text', 'nus_admin_footer');

// enable html markup in user profiles
remove_filter('pre_user_description', 'wp_filter_kses');

// admin link for all settings
function nus_all_settings_link() {
	add_theme_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'nus_all_settings_link');

// Remove paragraphs from img or iframes
function nus_filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
// add_filter('the_content', 'nus_filter_ptags_on_images');

// Allow SVG Uploads
function nus_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'nus_mime_types');
