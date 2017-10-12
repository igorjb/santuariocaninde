<?php
/*
Plugin Name: Easy Content Types
Plugin URI: http://pippinsplugins.com/easy-content-types/
Description: The easiest way to create unlimited custom post types, taxonomies, and meta boxes
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Version: 2.5.8.1
*/

/*****************************************
plugin shortname = ECPT
*****************************************/

/*****************************************
Constants
*****************************************/

// plugin base file
if(!defined('ECPT_BASE_FILE')) {
	define('ECPT_BASE_FILE', __FILE__);
}
if(!defined('ECPT_BASE_DIR')) {
	define('ECPT_BASE_DIR', dirname(ECPT_BASE_FILE));
}
// plugin folder url
if(!defined('ECPT_PLUGIN_URL')) {
	define('ECPT_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

/*****************************************
global variables
*****************************************/

// plugin prefix
global $ecpt_prefix;
$ecpt_prefix = 'ecpt_';

// field types
$field_types = array('text', 'textarea', 'select', 'checkbox', 'multicheck', 'radio', 'date', 'upload', 'slider', 'repeatable', 'repeatable upload');

// metabox page
$metabox_pages = get_post_types('', 'objects');

// metabox context
$metabox_contexts = array('normal', 'advanced', 'side');

// metabox priority
$metabox_priorities = array('default', 'high', 'core', 'low');

// taxonomy objects
$tax_objects = get_post_types('', 'objects');

// taxonomy attributes
$tax_atts = array('hierarchical', 'show_tagcloud', 'show_in_nav_menus');

// user levels
$user_levels = array('Admin', 'Editor', 'Author');

// load the plugin options
$ecpt_options = get_option( 'ecpt_settings' );

/*****************************************
load the languages
*****************************************/

load_plugin_textdomain( 'ecpt', false, dirname( plugin_basename( ECPT_BASE_FILE ) ) . '/languages/' );

/*****************************************
includes
*****************************************/
if(is_admin()) {
	// get_plugin_data() is only available in admin
	//require(ECPT_BASE_DIR . '/update-notifier.php'); // this is the old method of doing this. It's still here in case I need it
	if(!class_exists('Custom_Plugin_Updater')) {
		include_once(ECPT_BASE_DIR . '/class-custom-plugin-updater.php' );
	}
	include(ECPT_BASE_DIR . '/includes/upgrades.php');
	include(ECPT_BASE_DIR . '/includes/page-home.php');
	include(ECPT_BASE_DIR . '/includes/process-data.php');
	include(ECPT_BASE_DIR . '/includes/process-ajax-data.php');
	include(ECPT_BASE_DIR . '/includes/post-types-admin.php');
	include(ECPT_BASE_DIR . '/includes/taxonomies-admin.php');
	include(ECPT_BASE_DIR . '/includes/metabox-admin.php');
	include(ECPT_BASE_DIR . '/includes/scripts.php');
	include(ECPT_BASE_DIR . '/includes/register-meta-boxes.php');
	include(ECPT_BASE_DIR . '/includes/settings.php');
	include(ECPT_BASE_DIR . '/includes/export-admin.php');
	include(ECPT_BASE_DIR . '/includes/help-page.php');
	include(ECPT_BASE_DIR . '/includes/admin-menus.php');
	include(ECPT_BASE_DIR . '/includes/plugin-action-links.php');
	include(ECPT_BASE_DIR . '/includes/admin-notices.php');
	//include(ECPT_BASE_DIR . '/includes/plugins/plugins.php');
	
	// setup the plugin updater
	$ecpt_updater = new Custom_Plugin_Updater( 'http://pippinsplugins.com/updater/api/', ECPT_BASE_FILE, array());
	
}

include(ECPT_BASE_DIR . '/includes/install.php');
include(ECPT_BASE_DIR . '/includes/register-post-types.php');
include(ECPT_BASE_DIR . '/includes/register-taxonomies.php');
include(ECPT_BASE_DIR . '/includes/display-functions.php');
include(ECPT_BASE_DIR . '/includes/shortcodes.php');
include(ECPT_BASE_DIR . '/includes/ecpt-widgets.php');
include(ECPT_BASE_DIR . '/includes/misc-functions.php');
include(ECPT_BASE_DIR . '/includes/caching-functions.php');
if(!is_admin()) {
	include(ECPT_BASE_DIR . '/includes/query-filters.php');
}