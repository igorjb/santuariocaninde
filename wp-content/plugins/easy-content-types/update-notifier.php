<?php
/**************************************************************
 *                                                            *
 *   Provides a notification to the user everytime            *
 *   your WordPress plugin is updated                         *
 *															  *
 *	 Based on the script by Unisphere:						  *
 *   https://github.com/unisphere/unisphere_notifier          *
 *                                                            *
 *   Author: Pippin Williamson                                *
 *   Profile: http://codecanyon.net/user/mordauk              *
 *   Follow me: http://twitter.com/pippinsplugins             *
 *                                                            *
 **************************************************************/
 
 

// Constants for the plugin name, folder and remote XML url
define( 'ECPT_NOTIFIER_PLUGIN_NAME', 'Easy Custom Content Types' ); // The plugin name
define( 'ECPT_NOTIFIER_PLUGIN_SHORT_NAME', 'ECPT' ); // The plugin short name, only if needed to make the menu item fit. Remove this if not needed
define( 'ECPT_NOTIFIER_PLUGIN_FOLDER_NAME', 'easy-content-types' ); // The plugin folder name
define( 'ECPT_NOTIFIER_PLUGIN_FILE_NAME', 'easy-content-types.php' ); // The plugin folder name
define( 'ECPT_NOTIFIER_PLUGIN_MENU_NAME', 'easy-content-types-updates' ); // The plugin folder name
define( 'ECPT_CACHE_NAME', 'ecpt-cache' ); // The cache name
define( 'ECPT_NOTIFIER_PLUGIN_XML_FILE', 'http://pippinsplugins.com/updates/ecpt/notifier.xml' ); // The remote notifier XML file containing the latest version of the plugin and changelog
define( 'PLUGIN_ECPT_NOTIFIER_CACHE_INTERVAL', 21600 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)


// Adds an update notification to the WordPress Dashboard menu
function ecpt_update_plugin_notifier_menu() {  
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
	    $xml = ecpt_get_latest_plugin_version(PLUGIN_ECPT_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . ECPT_NOTIFIER_PLUGIN_FOLDER_NAME . '/' . ECPT_NOTIFIER_PLUGIN_FILE_NAME); // Read plugin current version from the style.css
		
		if( (string)$xml->latest > (string)$plugin_data['Version']) { // Compare current plugin version with the remote XML version
			if(defined('ECPT_NOTIFIER_PLUGIN_SHORT_NAME')) {
				$menu_name = ECPT_NOTIFIER_PLUGIN_SHORT_NAME;
			} else {
				$menu_name = ECPT_NOTIFIER_PLUGIN_NAME;
			}
			add_dashboard_page( ECPT_NOTIFIER_PLUGIN_NAME . ' Plugin Updates', $menu_name . ' <span class="update-plugins count-1"><span class="update-count">New Updates</span></span>', 'administrator', ECPT_NOTIFIER_PLUGIN_MENU_NAME, 'ecpt_update_notifier');
		}
	}	
}
add_action('admin_menu', 'ecpt_update_plugin_notifier_menu');  



// Adds an update notification to the WordPress 3.1+ Admin Bar
function ecpt_update_notifier_bar_menu() {
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
		global $wp_admin_bar, $wpdb;
	
		if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
		return;
		
		$xml = ecpt_get_latest_plugin_version(PLUGIN_ECPT_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . ECPT_NOTIFIER_PLUGIN_FOLDER_NAME . '/' .ECPT_NOTIFIER_PLUGIN_FILE_NAME); // Read plugin current version from the main plugin file
	
		if( (string)$xml->latest > (string)$plugin_data['Version']) { // Compare current plugin version with the remote XML version
			$wp_admin_bar->add_menu( array( 'id' => 'plugin_ecpt_update_notifier', 'title' => '<span>' . ECPT_NOTIFIER_PLUGIN_NAME . ' <span id="ab-updates">New Updates</span></span>', 'href' => get_admin_url() . 'index.php?page=' . ECPT_NOTIFIER_PLUGIN_MENU_NAME ) );
		}
	}
}
add_action( 'admin_bar_menu', 'ecpt_update_notifier_bar_menu', 1000 );



// The notifier page
function ecpt_update_notifier() { 
	$xml = ecpt_get_latest_plugin_version(PLUGIN_ECPT_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
	$plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . ECPT_NOTIFIER_PLUGIN_FOLDER_NAME . '/' .ECPT_NOTIFIER_PLUGIN_FILE_NAME); // Read plugin current version from the main plugin file ?>
	
	<style>
		.update-nag { display: none; }
		#instructions {max-width: 670px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo ECPT_NOTIFIER_PLUGIN_NAME ?> Plugin Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo ECPT_NOTIFIER_PLUGIN_NAME; ?> plugin available.</strong> You have version <?php echo $plugin_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>
		
		<div id="instructions">
		    <h3>Update Download and Instructions</h3>
		    <p><strong>Please note:</strong> make a <strong>backup</strong> of the Plugin inside your WordPress installation folder <strong>/wp-content/plugins/<?php echo ECPT_NOTIFIER_PLUGIN_FOLDER_NAME; ?>/</strong></p>
		    <p>To update the Theme, login to <a href="http://www.codecanyon.net/">CodeCanyon</a>, head over to your <strong>downloads</strong> section and re-download the plugin like you did when you bought it.</p>
		    <p>Extract the zip's contents, look for the extracted plugin folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/plugins/<?php echo ECPT_NOTIFIER_PLUGIN_FOLDER_NAME; ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the plugin files).</p>
		    <p>If you didn't make any changes to the plugin files, you are free to overwrite them with the new ones without the risk of losing any plugins settings, and backwards compatibility is guaranteed.</p>
		</div>
	    
	    <h3 class="title">Changelog</h3>
	    <?php echo $xml->changelog; ?>

	</div>
    
<?php } 



// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function ecpt_get_latest_plugin_version($interval) {
	$ECPT_NOTIFIER_file_url = ECPT_NOTIFIER_PLUGIN_XML_FILE;	
	$db_cache_field = ECPT_CACHE_NAME;
	$db_cache_field_last_updated = 'notifier-cache-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		if( function_exists('curl_init') ) { // if cURL is available, use it...
			$ch = curl_init($ECPT_NOTIFIER_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
		} else {
			$cache = file_get_contents($ECPT_NOTIFIER_file_url); // ...if not, use the common file_get_contents()
		}
		
		if ($cache) {			
			// we got good results	
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		} 
		// read from the cache file
		$ECPT_NOTIFIER_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$ECPT_NOTIFIER_data = get_option( $db_cache_field );
	}
	
	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$ECPT_NOTIFIER_data, '<notifier>') === false ) {
		$ECPT_NOTIFIER_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
	}
	
	// Load the remote XML data into a variable and return it
	$xml = simplexml_load_string($ECPT_NOTIFIER_data); 
	
	return $xml;
}