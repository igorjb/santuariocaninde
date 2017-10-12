<?php

function ecpt_check_for_notices() {
	global $ecpt_base_file;
	
	// show an error if plugin is activated network wide
	if(function_exists('is_plugin_active_for_network')) {
		if(is_plugin_active_for_network($ecpt_base_file)) {
			add_action('network_admin_notices', 'ecpt_network_activation_warning');
			add_action('admin_notices', 'ecpt_network_activation_warning');
		}
	}
}
add_action('admin_init', 'ecpt_check_for_notices');

function ecpt_network_activation_warning() {
	echo '<div class="error"><p>' . __('Easy Content Types cannot be network activated. Please activate separately on each site.', 'ecpt') . '</p></div>';
}

function ecpt_upgrade_needed_notice() {
	if(ecpt_check_if_upgrade_needed()) {
		echo '<div class="error"><p>' . __('The Easy Content Types database needs updated: ', 'ecpt') . ' ' . '<a href="' . add_query_arg('ecpt-action', 'upgrade', admin_url()) . '">' . __('upgrade now', 'ecpt') . '</a></p></div>';
	}
	if(isset($_GET['ecpt-db']) && $_GET['ecpt-db'] == 'updated') {
		echo '<div class="updated fade"><p>' . __('The Easy Content Types database has been updated', 'ecpt') . '</p></div>';
	}
}
add_action('admin_notices', 'ecpt_upgrade_needed_notice', 100);