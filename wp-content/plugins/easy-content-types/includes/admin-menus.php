<?php
// create custom plugin settings menu
function ecpt_menu() {
	global $ecpt_options, 
	$ecpt_about_page, 
	$ecpt_post_types_page, 
	$ecpt_taxonomies_page, 
	$ecpt_meta_boxes_page,
	$ecpt_settings_page, 
	$ecpt_export_page, 
	$ecpt_help_page;
	
	// check the user levels needed to access each page
	
	if($ecpt_options['menu_user_level'] == 'Author') { 
		$menu_level = 'edit_posts'; $posts_level = 'edit_posts'; $tax_level = 'edit_posts'; $meta_level = 'edit_posts';
	} else if ($ecpt_options['menu_user_level'] == 'Editor') { 
		$menu_level = 'edit_pages'; $posts_level = 'edit_pages'; $tax_level = 'edit_pages'; $meta_level = 'edit_pages';
	} else { 
		$menu_level = 'manage_options'; $posts_level = 'manage_options'; $tax_level = 'manage_options'; $meta_level = 'manage_options'; 
	}	
	
	if($ecpt_options['posttype_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$posts_level = 'edit_posts'; 
	} else if ($ecpt_options['posttype_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$posts_level = 'edit_pages'; 
	} else { 
		$posts_level = 'manage_options'; 
	}
	
	if($ecpt_options['tax_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$tax_level = 'edit_posts'; 
	} else if ($ecpt_options['tax_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$tax_level = 'edit_pages'; 
	} else { 
		$tax_level = 'manage_options'; 
	}
	//echo $tax_level; exit;
	
	if($ecpt_options['metabox_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$meta_level = 'edit_posts'; 
	} else if ($ecpt_options['metabox_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$meta_level = 'edit_pages'; 
	} else { 
		$meta_level = 'manage_options'; 
	}
	
	//create new top-level menu
	add_menu_page('Custom Content Types', 'Content Types', $menu_level, ECPT_BASE_FILE, 'ecpt_home_page', plugins_url('/images/icon.png', __FILE__));
	
	// add about page -- top level page links here
	$ecpt_about_page = add_submenu_page(ECPT_BASE_FILE, 'About', 'About',$menu_level, ECPT_BASE_FILE, 'ecpt_home_page');	
	
	// add custom post types page
	$ecpt_post_types_page = add_submenu_page(ECPT_BASE_FILE, __('Post Types', 'ecpt'), __('Post Types', 'ecpt'), $posts_level, ECPT_BASE_FILE . '?posttypes', 'ecpt_posttype_manager');	
	
	// add custom taxonomies page
	$ecpt_taxonomies_page = add_submenu_page(ECPT_BASE_FILE, __('Taxonomies', 'ecpt'), __('Taxonomies', 'ecpt'), $tax_level, ECPT_BASE_FILE . '?taxonomies', 'ecpt_tax_manager');	

	// add custom metaboxes page
	$ecpt_meta_boxes_page = add_submenu_page(ECPT_BASE_FILE, __('MetaBoxes', 'ecpt'), __('Meta Boxes', 'ecpt'),$meta_level, ECPT_BASE_FILE . '?metaboxes', 'ecpt_metabox_manager');	
	
	// add settings page
	$ecpt_settings_page = add_submenu_page(ECPT_BASE_FILE, __('Settings', 'ecpt'), __('Settings', 'ecpt'),'manage_options', ECPT_BASE_FILE . '?settings', 'ecpt_settings_page');		
	
	// add export page
	$ecpt_export_page = add_submenu_page(ECPT_BASE_FILE, __('Export', 'ecpt'), __('Export', 'ecpt'),'manage_options', ECPT_BASE_FILE . '?export', 'ecpt_export_page');		
	
	// add help page
	$ecpt_help_page = add_submenu_page(ECPT_BASE_FILE, __('Help', 'ecpt'), __('Help', 'ecpt'), $menu_level, ECPT_BASE_FILE . '?help', 'ecpt_help_page');	
	
}
add_action('admin_menu', 'ecpt_menu');