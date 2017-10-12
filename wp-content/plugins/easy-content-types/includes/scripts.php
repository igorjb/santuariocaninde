<?php

// load styles for the Content Types admin
function ecpt_admin_styles( $hook ) 
{
	global $ecpt_about_page, 
	$ecpt_post_types_page, 
	$ecpt_taxonomies_page, 
	$ecpt_meta_boxes_page,
	$ecpt_settings_page, 
	$ecpt_export_page, 
	$ecpt_help_page;
	
	$ecpt_pages = array($ecpt_about_page, $ecpt_post_types_page, $ecpt_taxonomies_page, $ecpt_meta_boxes_page, $ecpt_settings_page, $ecpt_export_page, $ecpt_help_page);
	
	if( !in_array( $hook, $ecpt_pages ) )
		return;
	
	wp_enqueue_style('thickbox');
	wp_enqueue_style('ecpt-admin', ECPT_PLUGIN_URL . 'includes/css/admin-styles.css');
	wp_enqueue_style('tooltip-css', ECPT_PLUGIN_URL . 'includes/css/thetooltip.css');
	wp_enqueue_style('jquery-ui-core');
}
add_action('admin_enqueue_scripts', 'ecpt_admin_styles');

// load scripts for the Content Types admin
function ecpt_admin_scripts( $hook )
{
	global $ecpt_about_page, 
	$ecpt_post_types_page, 
	$ecpt_taxonomies_page, 
	$ecpt_meta_boxes_page,
	$ecpt_settings_page, 
	$ecpt_export_page, 
	$ecpt_help_page;
	
	$ecpt_pages = array($ecpt_about_page, $ecpt_post_types_page, $ecpt_taxonomies_page, $ecpt_meta_boxes_page, $ecpt_settings_page, $ecpt_export_page, $ecpt_help_page);
	
	if( !in_array( $hook, $ecpt_pages ) )
		return;
	
	wp_enqueue_script('media-upload'); 
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('ecpt-admin', ECPT_PLUGIN_URL . 'includes/js/ecpt-admin.js', array('jquery'));
}
add_action('admin_enqueue_scripts', 'ecpt_admin_scripts');

// load scripts for the post editors
function ecpt_post_edit_scripts() {
	global $post;
	wp_enqueue_script('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('ecpt-ui', ECPT_PLUGIN_URL . 'includes/js/ui-scripts.js', array('jquery')); 
	if($post) {
		wp_localize_script( 'ecpt-ui', 'post_vars', 
			array( 
				'post_id' => $post->ID
			) 
		);
	}
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-slider');
}

// load post editor styles
function ecpt_post_edit_styles() {
	global $ecpt_base_dir;
	wp_enqueue_style('thickbox');
	wp_enqueue_style('ecpt-admin', ECPT_PLUGIN_URL . 'includes/css/admin-styles.css');
	wp_enqueue_style('datepicker-slider', ECPT_PLUGIN_URL . 'includes/css/datepicker-slider.css');
}

add_action('admin_print_scripts-post.php', 'ecpt_post_edit_scripts');
add_action('admin_print_scripts-edit.php', 'ecpt_post_edit_scripts');
add_action('admin_print_scripts-post-new.php', 'ecpt_post_edit_scripts');
add_action('admin_print_styles-post.php', 'ecpt_post_edit_styles');
add_action('admin_print_styles-edit.php', 'ecpt_post_edit_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_post_edit_styles');

// load the export page scripts
function ecpt_prettify_scripts($hook) {
	if($hook != 'content-types_page_easy-content-types/easy-content-types?export')
		return;

	wp_enqueue_style('jquery-snippet', ECPT_PLUGIN_URL . 'includes/css/jquery.snippet.min.css');	
	wp_enqueue_script('jquery-snippet', ECPT_PLUGIN_URL . 'includes/js/jquery.snippet.min.js');	
	wp_enqueue_script('export-scripts', ECPT_PLUGIN_URL . 'includes/js/export-scripts.js');	
	wp_enqueue_script('postbox');
	wp_enqueue_script('dashboard');
}
add_action('admin_enqueue_scripts', 'ecpt_prettify_scripts');
