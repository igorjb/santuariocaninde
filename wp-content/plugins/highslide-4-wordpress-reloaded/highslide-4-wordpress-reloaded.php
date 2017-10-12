<?php
/*
Plugin Name: Highslide for Wordpress *reloaded*
Plugin URI: http://solariz.de/highslide-wordpress-reloaded
Description: Add configurable "Highslide JS" Support to your Wordpress Installation, including Auto Image linking.
Version: 1.28
Author: Marco Goetze
Author URI: http://solariz.de

Released under a Creative Commons Attribution-NonCommercial 2.5 License.

	This program is distributed WITHOUT ANY WARRANTY

*/

// Versions
    $hs4wp_ver_hs       = 4113;
    $hs4wp_ver_plugin   = 128;

// addon check
    if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
    }

// PHP Version check
    if( floatval(phpversion()) < 5 ) {
        // PHP < 5
        if( is_admin() ) echo "<div id='hs4wp-warning' class='updated fade'><p><strong>".__('PHP Version seems outdated.')."</strong> ".'The Plugin "Highslide for Wordpress" need at least PHP 5.0 to work.'."</p></div>";
        return false;
    }

// fixed set / requires
    $hs4wp_plugin_path = trailingslashit(ABSPATH.'wp-content/plugins/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
    $hs4wp_plugin_uri  = trailingslashit(WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
    require_once($hs4wp_plugin_path.'functions.hs4wp.php');
    $hs4wp_img_count = 0;
    $plugin = plugin_basename(__FILE__);


// WP Actions & Filter
    if(hs4wp_getConf('hs4wp_lic_agreement') == "on") {

        add_filter('the_content', 'hs4wp_auto_set',60);
        if(hs4wp_getConf('hs4wp_attachment_filter')!="on") add_filter('attachment_link', 'hs4wp_auto_set_attachmentURL',61);

        add_action('wp_head', 'hs4wp_prepare_header');
        add_action('wp_footer', 'hs4wp_add_to_footer');
        // Workaround, some themes using strange wp_footer behaviors
        // reported 30. Dec. by Max
        if(hs4wp_getConf('hs4wp_only_use_header')=="on") add_action('wp_head', 'hs4wp_prepare_footer');
        else add_action('wp_footer', 'hs4wp_prepare_footer');
    }
    add_action('admin_init', 'hs4wp_admin_init');
    add_action('admin_print_scripts', 'hs4wp_prepare_adminheader');
    add_action('admin_menu', 'hs4wp_config_page');
    add_filter("plugin_action_links_$plugin", 'hs4wp_plugin_settings_link' );
    if(hs4wp_getConf('hs4wp_media_icon') != "on") add_action('media_buttons', 'hs4wp_add_media_button', 20);


    // register_activation_hook(__FILE__, 'hs4wp_act');
    add_action('init', 'hs4wp_act');
