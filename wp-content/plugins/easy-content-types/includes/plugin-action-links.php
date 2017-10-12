<?php

// add menu links to the plugin entry in the plugins menu
function ecpt_action_links($links, $file) {
    static $this_plugin;
	global $ecpt_base_file;
 
    if (!$this_plugin) {
        $this_plugin = $ecpt_base_file;
    }
 
    // check to make sure we are on the correct plugin
    if ($file == $this_plugin) {
	
        $ecpt_links[] = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=easy-content-types/easy-content-types.php?settings">' . __('Settings', 'ecpt') . '</a>';
		
        $ecpt_links[] = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=easy-content-types/easy-content-types.php?metaboxes">' . __('Meta Boxes', 'ecpt') . '</a>';
		
        $ecpt_links[] = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=easy-content-types/easy-content-types.php?taxonomies">' . __('Taxonomies', 'ecpt') . '</a>';
		
        $ecpt_links[] = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=easy-content-types/easy-content-types.php?posttypes">' . __('Post Types', 'ecpt') . '</a>';
		
		
		
        // add the links to the list of links alread there
		foreach($ecpt_links as $ecpt_link) {
			array_unshift($links, $ecpt_link);
		}
    }
 
    return $links;
}
add_filter('plugin_action_links', 'ecpt_action_links', 0, 2);