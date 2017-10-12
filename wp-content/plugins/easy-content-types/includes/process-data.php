<?php

function ecpt_process_data() {

	global $wpdb;
	global $ecpt_db_name;
	global $ecpt_db_tax_name;
	global $ecpt_db_meta_name;
	global $ecpt_db_meta_fields_name;
	global $ecpt_base_dir;
	$ecpt_post = (!empty($_POST)) ? true : false;

	if($ecpt_post) // if data is being sent
	{
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'add-post-type' && wp_verify_nonce($_POST['ecpt-cpt-nonce'], 'ecpt_add_post_type_nonce') ) {

			if(isset($_POST['label-single']) && $_POST['label-single'] != '') { $single = $_POST['label-single']; } else { $single = $_POST['post-type-name']; }
			if(isset($_POST['label-plural']) && $_POST['label-plural'] != '') { $plural = $_POST['label-plural']; } else { $plural = $_POST['post-type-name']; }
			
			if(isset($_POST['advanced-labels']) && !empty($_POST['advanced-labels'])) {
				
				
				foreach($_POST['advanced-labels'] as $key => $label) {
					if(strlen(trim($label)) < 1) {
						$_POST['advanced-labels'][$key] = $_POST['label-single']; // set blank labels to singular name
					}
					if($key == 'menu-name') {
						$_POST['advanced-labels'][$key] = $_POST['label-plural'];
					}
				}
				$labels = array();
				$labels['add_new'] = $_POST['advanced-labels']['add-new'];
				$labels['all_items'] = $_POST['advanced-labels']['all-items'];
				$labels['add_new_item'] = $_POST['advanced-labels']['add-new-item'];
				$labels['edit_item'] = $_POST['advanced-labels']['edit-item'];
				$labels['new_item'] = $_POST['advanced-labels']['new-item'];
				$labels['view_item'] = $_POST['advanced-labels']['view-item'];
				$labels['search_items'] = $_POST['advanced-labels']['search-items'];
				$labels['not_found'] = $_POST['advanced-labels']['not-found'];
				$labels['not_found_in_trash'] = $_POST['advanced-labels']['not-found-in-trash'];
				$labels['parent_item_colon'] = $_POST['advanced-labels']['parent-item-colon'];
				$labels['menu_name'] = $_POST['advanced-labels']['menu-name'];
			}
			
			// check for checked options
			if(isset($_POST['options-hierarchical']))	{ $hierarchical = 1; } else { $hierarchical = 0; }
			if(isset($_POST['options-post-formats'])) 	{ $post_formats = 1; } else { $post_formats = 0; }
			if(isset($_POST['options-archives'])) 		{ $archives = 1; } else { $archives = 0; }
			if(isset($_POST['options-nav'])) 			{ $nav = 1; } else { $nav = 0; }
			if(isset($_POST['options-search'])) 		{ $search = 1; } else { $search = 0; }
			
			// menu icon - set to default if no image given
			if(isset($_POST['options-icon']) && $_POST['options-icon'] != '') { $icon = $_POST['options-icon']; } else { $icon = $ecpt_base_dir . 'includes/images/icon.png'; }
			
			// check for supports options
			if(isset($_POST['options-title'])) 				{ $title = 1; } else { $title = 0; }
			if(isset($_POST['options-editor'])) 			{ $editor = 1; } else { $editor = 0; }
			if(isset($_POST['options-author'])) 			{ $author = 1; } else { $author = 0; }
			if(isset($_POST['options-thumbnail'])) 		{ $thumbnail = 1; } else { $thumbnail = 0; }
			if(isset($_POST['options-excerpt'])) 			{ $excerpt = 1; } else { $excerpt = 0; }
			if(isset($_POST['options-custom-fields'])) 	{ $fields = 1; } else { $fields = 0; }
			if(isset($_POST['options-comments'])) 			{ $comments = 1; } else { $comments = 0; }
			if(isset($_POST['options-revisions'])) 		{ $revisions = 1; } else { $revisions = 0; }
			if(isset($_POST['options-tags'])) 				{ $tags = 1; } else { $tags = 0; }
			if(isset($_POST['options-categories'])) 		{ $categories = 1; } else { $categories = 0; }
			
			// check for custom support options
			if(isset($_POST['options-advanced-supports']) && $_POST['options-advanced-supports'] !== '') {
				$advanced_supports = $_POST['options-advanced-supports'];
			} else {
				$advanced_supports = null;
			}
			
			// check for advanced options
			if(!isset($_POST['advanced-position']) || $_POST['advanced-position'] == '') 	{ $position = 5; } else { $position = intval($_POST['advanced-position']); }
			if(!isset($_POST['advanced-slug']) || $_POST['advanced-slug'] == '') { 
				$slug = str_replace(' ', '_', strtolower($_POST['post-type-name'])); 
			} else { 
				$slug = $_POST['advanced-slug']; 
			}
			if(isset($_POST['advanced-with-front'])) 	{ $with_front = 1; } else { $with_front = 0; }
				
			// page attributes (for page templates) are not used at this time but set in order to prevent errors	
			$page_attributes = 0;	
				
			$add = $wpdb->query("INSERT INTO " . $ecpt_db_name . " SET 
				`name`='" . str_replace(' ', '', strtolower($_POST['post-type-name'])) . "',			
				`singular_name`='"		. 	utf8_encode($single) . "',	
				`plural_name`='"			. 	utf8_encode($plural) . "',	
				`hierarchical`='"			. 	$hierarchical . "',	
				`post_formats`='"			. 	$post_formats . "',	
				`page_attributes`='"		. 	$page_attributes . "',	
				`show_in_nav_menus`='"	. 	$nav . "',	
				`exclude_from_search`='". 	$search . "',	
				`has_archive`='"			. 	$archives . "',		
				`title`='"					. 	$title . "',
				`editor`='"					. 	$editor . "',
				`author`='"					. 	$author . "',
				`thumbnail`='"				. 	$thumbnail . "',
				`excerpt`='"				. 	$excerpt . "',
				`fields`='"					. 	$fields . "',
				`comments`='"				. 	$comments . "',
				`revisions`='"				. 	$revisions . "',
				`menu_icon`='"				. 	$icon . "',
				`menu_position`='"		. 	$position . "',
				`slug`='"					. 	utf8_encode($slug) . "',
				`with_front`='"			. 	$with_front . "',
				`post_tags`='"				. 	$tags . "',
				`categories`='"			. 	$categories . "',
				`labels`='"					. 	serialize($labels) . "',
				`advanced_supports`='"	. 	$advanced_supports . "'
			;");	
			
			do_action('ecpt_add_post_type', $_POST);			
			
			// clear the post type cache
			ecpt_clear_cache('post_types');
			
			$url = admin_url( 'admin.php?page=easy-content-types/easy-content-types.php?posttypes&post-type-added=1' );
			wp_redirect( $url ); exit;
		}
		
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'add-taxonomy' && wp_verify_nonce($_POST['ecpt-tax-nonce'], 'ecpt_add_tax_nonce') ) {

			if(isset($_POST['label-single']) && $_POST['label-single'] != '') { $single = $_POST['label-single']; } else { $single = $_POST['taxonomy-name']; }
			if(isset($_POST['label-plural']) && $_POST['label-plural']!= '') { $plural = $_POST['label-plural']; } else { $plural = $_POST['taxonomy-name']; }
			if(isset($_POST['options-slug']) && $_POST['options-slug'] != '' ) { 
				$slug = strtolower(str_replace(' ', '-', $_POST['options-slug'])); 
			} else { 
				$slug = str_replace(' ', '', strtolower($_POST['taxonomy-name'])); 
			}
			
			
			// check for checked options
			if(isset($_POST['options-hierarchical'])) 	{ $hierarchical = 1; } else { $hierarchical = 0; }
			if(isset($_POST['options-tagcloud'])) 		{ $show_tagcloud = 1; } else { $show_tagcloud = 0; }
			if(isset($_POST['options-nav'])) 			{ $nav = 1; } else { $nav = 0; }
			if(isset($_POST['options-with-front'])) 	{ $with_front = 1; } else { $with_front = 0; }
			if(isset($_POST['options-enable-filter'])) 	{ $enable_filter = 1; } else { $enable_filter = 0; }
			
			$pages = array();
			if(isset($_POST['taxonomy-object'])) {
				foreach($_POST['taxonomy-object'] as $page) { $pages[] = $page; };
				$pages_final = implode(',', $pages);
			} else {
				$pages_final = array('post');
			}
			$add = $wpdb->query("INSERT INTO " . $ecpt_db_tax_name . " SET 
				`name`='" 						. 	str_replace(' ', '', strtolower($_POST['taxonomy-name'])) . "',
				`singular_name`='"			. 	utf8_encode($single) . "',
				`plural_name`='"				. 	utf8_encode($plural) . "',	
				`hierarchical`='"				. 	$hierarchical . "',
				`show_tagcloud`='"			. 	$show_tagcloud . "',
				`show_in_nav_menus`='"		. 	$nav . "',
				`page`='"						. 	$pages_final . "',
				`with_front`='"				. 	$with_front . "',
				`slug`='"						. 	utf8_encode($slug) . "',
				`enable_filter`='"			. 	$enable_filter . "'

			;");	
			
			do_action('ecpt_add_taxonomy', $_POST);				
			
			// clear the taxonomy cache
			ecpt_clear_cache('taxonomies');
			
			$url = admin_url( 'admin.php?page=easy-content-types/easy-content-types.php?taxonomies&taxonomy-added=1' );
			wp_redirect( $url ); exit;
		}
		
		// add custom meta boxes
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'add-metabox' && wp_verify_nonce($_POST['ecpt-metabox-nonce'], 'ecpt_add_metabox_nonce') ) {
			
			$pages = array();
			if(isset($_POST['metabox-page'])) {
				foreach($_POST['metabox-page'] as $page) { $pages[] = $page; };
				$pages_final = implode(',', $pages);
			} else {
				$pages_final = array('post');
			}
			
			if(isset($_POST['metabox-post-ids']) && $_POST['metabox-post-ids'] != '') {
				if(strpos($_POST['metabox-post-ids'], ',')) {
					$post_ids = explode(',', str_replace(' ', '', $_POST['metabox-post-ids']));
				} else {
					$post_ids = array($_POST['metabox-post-ids']);
				}
				$post_ids = maybe_serialize($post_ids);
			} else {
				$post_ids = NULL;
			}
			
			$add = $wpdb->query("INSERT INTO " . $ecpt_db_meta_name . " SET 
				`name`='" 	.   str_replace(' ', '', strtolower($_POST['metabox-name'])) . "',
				`nicename`='" .   utf8_encode($_POST['metabox-name']) . "',
				`page`='"		. 	$pages_final . "',
				`context`='"	. 	$_POST['metabox-context'] . "',
				`priority`='"	. 	$_POST['metabox-priority'] . "',
				`post_ids`='"	.	$post_ids . "'
			;");	
			
			do_action('ecpt_add_meta_box', $_POST);				
			
			// clear the cache
			ecpt_clear_cache('metaboxes');
			
			$url = admin_url( 'admin.php?page=easy-content-types/easy-content-types.php?metaboxes&metabox-added=1' );
			wp_redirect( $url ); exit;
		}
		
		
		
		// add fields to meta boxes
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'add-field' && wp_verify_nonce($_POST['ecpt-field-nonce'], 'ecpt_add_field_nonce') ) {
			
			$existing_field = $wpdb->get_row("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE nicename = '" . $_POST['field-name'] . "' ORDER BY id DESC LIMIT 1");
			
			if(isset($_POST['field-id']) && strlen(trim($_POST['field-id'])) > 0 ) {
				$field_id = str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-id'])));
			} elseif($existing_field) {
				$existing_field_id_number = substr($existing_field->name, -1);
				if(is_numeric($existing_field_id_number)) {
					$new_number = intval($existing_field_id_number) + 1;
					$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name'])))) . '_' . $new_number;
				} else {
					$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name'])))) . '_2';
				}
			} else {
				$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name']))));
			}
			
			if(isset($_POST['rich-editor'])) 	{ $rich_editor = 1; } else { $rich_editor = 0; }
			
			$add = $wpdb->query("INSERT INTO " . $ecpt_db_meta_fields_name . " SET 
				`name`= '" 			. str_replace("'", '', $field_id) . "',
				`nicename`='"		. addslashes(utf8_encode($_POST['field-name'])) . "',
				`parent`='"			. $_POST['field-parent'] . "',
				`type`='"			. $_POST['field-type'] . "',
				`description`='"	. addslashes(utf8_encode($_POST['field-desc'])) . "',
				`options`='"		. str_replace(', ', ',', $_POST['field-options']) . "',
				`rich_editor`='"	. $rich_editor . "',
				`list_order`='"		. intval($_POST['field-order']) . "',
				`max`='"			. intval($_POST['field-max']) . "'

			;");	
			
			do_action('ecpt_add_meta_field', $_POST);				
			
			$url = admin_url( 'admin.php?page=easy-content-types/easy-content-types.php?metaboxes&fields-edit=' . $_POST['current-field'] );
			wp_redirect( $url ); exit;
		}
		
		/*************************************
		* update data
		*************************************/
		
		/* process post type updates*/
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'update-post-type' && wp_verify_nonce($_POST['ecpt-edit-cpt-nonce'], 'ecpt_edit_cpt_nonce') ) {
			
			if($_POST['posttype-singlular'] != '') { $single = $_POST['posttype-singlular']; } else { $single = $_POST['posttype-name']; }
			if($_POST['posttype-plural'] != '') { $plural = $_POST['posttype-plural']; } else { $plural = $_POST['posttype-name']; }

			// check for checked options
			if(isset($_POST['posttype-hierarchical']))			{ $hierarchical = 1; } else { $hierarchical = 0; }
			if(isset($_POST['posttype-post_formats'])) 			{ $post_formats = 1; } else { $post_formats = 0; }
			if(isset($_POST['posttype-has_archive'])) 			{ $archives = 1; } else { $archives = 0; }
			if(isset($_POST['posttype-show_in_nav_menus'])) 	{ $nav = 1; } else { $nav = 0; }
			if(isset($_POST['posttype-exclude_from_search'])) 	{ $search = 1; } else { $search = 0; }
			
			// menu icon - set to default if no image given
			if(isset($_POST['posttype-menu-icon']) && $_POST['posttype-menu-icon'] != '') { 
				$icon = $_POST['posttype-menu-icon']; 
			} else { 
				$icon = $ecpt_base_dir . 'includes/images/icon.png'; 
			}
			
			if(isset($_POST['advanced-labels'])) {
				
				
				foreach($_POST['advanced-labels'] as $key => $label) {
					if(strlen(trim($label)) < 1) {
						$_POST['advanced-labels'][$key] = $_POST['label-single']; // set blank labels to singular name
					}
				}
				$labels = array();
				$labels['add_new'] = $_POST['advanced-labels']['add-new'];
				$labels['all_items'] = $_POST['advanced-labels']['all-items'];
				$labels['add_new_item'] = $_POST['advanced-labels']['add-new-item'];
				$labels['edit_item'] = $_POST['advanced-labels']['edit-item'];
				$labels['new_item'] = $_POST['advanced-labels']['new-item'];
				$labels['view_item'] = $_POST['advanced-labels']['view-item'];
				$labels['search_items'] = $_POST['advanced-labels']['search-items'];
				$labels['not_found'] = $_POST['advanced-labels']['not-found'];
				$labels['not_found_in_trash'] = $_POST['advanced-labels']['not-found-in-trash'];
				$labels['parent_item_colon'] = $_POST['advanced-labels']['parent-item-colon'];
				$labels['menu_name'] = $_POST['advanced-labels']['menu-name'];
			}
			
			// check for supports options
			if(isset($_POST['posttype-title'])) 		{ $title = 1; } else { $title = 0; }
			if(isset($_POST['posttype-editor'])) 		{ $editor = 1; } else { $editor = 0; }
			if(isset($_POST['posttype-author'])) 		{ $author = 1; } else { $author = 0; }
			if(isset($_POST['posttype-thumbnail'])) 	{ $thumbnail = 1; } else { $thumbnail = 0; }
			if(isset($_POST['posttype-excerpt'])) 		{ $excerpt = 1; } else { $excerpt = 0; }
			if(isset($_POST['posttype-fields'])) 		{ $fields = 1; } else { $fields = 0; }
			if(isset($_POST['posttype-comments'])) 		{ $comments = 1; } else { $comments = 0; }
			if(isset($_POST['posttype-revisions']))		{ $revisions = 1; } else { $revisions = 0; }
			if(isset($_POST['posttype-tags'])) 			{ $tags = 1; } else { $tags = 0; }
			if(isset($_POST['posttype-categories']))	{ $categories = 1; } else { $categories = 0; }
			
			// check for custom support options
			if(isset($_POST['posttype-advanced-supports']) && $_POST['posttype-advanced-supports'] !== '') {
				$advanced_supports = $_POST['posttype-advanced-supports'];
			} else {
				$advanced_supports = null;
			}			
			
			// check for advanced options
			if(!isset($_POST['posttype-position']) || $_POST['posttype-position'] == '') { 
				$position = 5; 
			} else { 
				$position = intval($_POST['posttype-position']); 
			}
			if(!isset($_POST['posttype-slug']) || $_POST['posttype-slug'] == '') { 
				$slug = str_replace(' ', '_', strtolower($_POST['posttype-name'])); 
			} else { 
				$slug = str_replace(' ', '_', strtolower($_POST['posttype-slug']));  
			}
			if(isset($_POST['posttype-with-front'])) 	{ $with_front = 1; } else { $with_front = 0; }
				
			// page attributes (for page templates) are not used at this time but set in order to prevent errors	
			$page_attributes = 0;
					
			$update = $wpdb->query("UPDATE " . $ecpt_db_name . " SET 
				`name`='" 					. str_replace(' ', '', strtolower($_POST['posttype-name'])) . "', 
				`singular_name`='" 		. utf8_encode($single) . "', 
				`plural_name`='" 			. utf8_encode($plural) . "', 
				`title`='" 					. $title . "',
				`editor`='" 				. $editor . "',
				`author`='" 				. $author . "',
				`thumbnail`='" 			. $thumbnail . "',
				`excerpt`='" 				. $excerpt . "',
				`fields`='" 				. $fields . "',
				`comments`='" 				. $comments . "',
				`revisions`='" 			. $revisions . "',
				`has_archive`='" 			. $archives . "',
				`hierarchical`='" 		. $hierarchical . "',
				`post_formats`='" 		. $post_formats . "',
				`show_in_nav_menus`='"	. $nav . "',
				`exclude_from_search`='". $search . "',
				`menu_icon`='"				. $icon . "',
				`menu_position`='"		. $position . "',
				`slug`='"					. utf8_encode($slug) . "',
				`with_front`='"			. $with_front . "',
				`post_tags`='"				. $tags . "',
				`categories`='"			. $categories . "',
				`labels`='"					. serialize($labels) . "',
				`advanced_supports`='"	. $advanced_supports . "'
				WHERE `id`='" 				. intval($_POST['posttype-id']) . "';"
			);
			
			do_action('ecpt_update_post_type', $_POST);				
			
			// clear the post type cache
			ecpt_clear_cache('post_types');
			
			wp_redirect( add_query_arg('post-type-updated', 1) ); exit;
			
		} // end post type update
		
		
		
		/* process taxonomy updates*/
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'update-taxonomy' && wp_verify_nonce($_POST['ecpt-edit-tax-nonce'], 'ecpt_edit_tax_nonce') ) {
			
			// taxonomy labels
			if($_POST['tax-singular'] != '') { $single = $_POST['tax-singular']; } else { $single = $_POST['tax-name']; }
			if($_POST['tax-plural'] != '') { $plural = $_POST['tax-plural']; } else { $plural = $_POST['tax-name']; }
			
			// check for checked options
			if(isset($_POST['tax-hierarchical'])) 	{ $hierarchical = 1; } else { $hierarchical = 0; }
			if(isset($_POST['tax-tagcloud'])) 		{ $show_tagcloud = 1; } else { $show_tagcloud = 0; }
			if(isset($_POST['tax-show-in-nav'])) 	{ $nav = 1; } else { $nav = 0; }
			if(isset($_POST['tax-with-front'])) 	{ $with_front = 1; } else { $with_front = 0; }
			if(isset($_POST['tax-enable-filter'])) 	{ $enable_filter = 1; } else { $enable_filter = 0; }
			
			// taxonomy objects
			$pages = array();
			foreach($_POST['tax-page'] as $page) { $pages[] = $page; };
			$pages_final = implode(',', $pages);
			
			// taxonomy slug
			if(!isset($_POST['tax-slug']) || $_POST['tax-slug'] == '') { 
				$slug = str_replace(' ', '_', strtolower($_POST['tax-name'])); 
			} else { 
				$slug = str_replace(' ', '_', strtolower($_POST['tax-slug']));  
			}
			
			$update = $wpdb->query("UPDATE " . $ecpt_db_tax_name . " SET 
					`name`='" 				. str_replace(' ', '', strtolower($_POST['tax-name'])) . "', 
					`page`='" 				. $pages_final . "', 
					`singular_name`='" 		. utf8_encode($single) . "', 
					`plural_name`='" 		. utf8_encode($plural) . "', 
					`hierarchical`='" 		. $hierarchical . "',
					`show_tagcloud`='" 		. $show_tagcloud . "',
					`show_in_nav_menus`='"	. $nav . "', 
					`slug`='"				. utf8_encode($slug) . "',
					`with_front`='"			. $with_front . "', 
					`enable_filter`='"		. $enable_filter . "' 
					WHERE `id`='" 			. $_POST['tax-id'] . "';"
				);
						
			do_action('ecpt_update_taxonomy', $_POST);				
						
			// clear the taxonomy cache
			ecpt_clear_cache('taxonomies');
			
			wp_redirect( add_query_arg('taxonomy-updated', 1) ); exit;

		} // end taxonomy update
		
		
		
		/* process metabox updates */
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'update-metabox' && wp_verify_nonce($_POST['ecpt-edit-metabox-nonce'], 'ecpt_edit_metabox_nonce') ) {
			
			$pages = array();
			if(isset($_POST['metabox-page'])) {
				foreach($_POST['metabox-page'] as $page) { $pages[] = $page; };
				$pages_final = implode(',', $pages);
			} else {
				$pages_final = array('post');
			}
			if(isset($_POST['metabox-post-ids']) && $_POST['metabox-post-ids'] != '') {
				if(strpos($_POST['metabox-post-ids'], ',')) {
					$post_ids = explode(',', str_replace(' ', '', $_POST['metabox-post-ids']));
				} else {
					$post_ids = array($_POST['metabox-post-ids']);
				}
				$post_ids = maybe_serialize($post_ids);
			} else {
				$post_ids = NULL;
			}
			
			
			$update = $wpdb->query("UPDATE " . $ecpt_db_meta_name . " SET 
				`name`='" 		. str_replace(' ', '', strtolower($_POST['metabox-name'])) . "', 
				`nicename`='" 	. utf8_encode($_POST['metabox-name']) . "', 
				`page`='" 		. $pages_final . "', 
				`context`='" 	. $_POST['metabox-context'] . "',
				`priority`='" 	. $_POST['metabox-priority'] . "',
				`post_ids`='"	. $post_ids . "' 
				WHERE `id`='" 	. $_POST['metabox-id'] . "';"
			);
			
			// if the name has been changed, we need to update the fields
			if($_POST['metabox-name'] != $_POST['metabox-old-name']) {
				// update each of the meta box field parent names
				foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE `parent`='" . $_POST['metabox-old-name'] . "';") as $key => $field) {
					$update_field = $wpdb->query("UPDATE " . $ecpt_db_meta_fields_name . " SET 
						`parent`= '" 		. str_replace(' ', '', strtolower($_POST['metabox-name'])) . "' 
						WHERE `id`='" 		. $field->id . "';"
					);
				}
			}
		
			do_action('ecpt_update_meta_box', $_POST);			
		
			// clear the cache
			ecpt_clear_cache('metaboxes');
		
			wp_redirect( add_query_arg('metabox-updated', 1) ); exit;
		} // end metabox update
		
		
		
		/* process field updates*/
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'update-field' && wp_verify_nonce($_POST['ecpt-edit-field-nonce'], 'ecpt_edit_field_nonce') ) {
				
			$existing_field = $wpdb->get_row("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE nicename = '" . $_POST['field-name'] . "' AND id != '" . $_POST['field-id'] . "' ORDER BY id DESC LIMIT 1");
			
			if(isset($_POST['field-unique-id']) && strlen(trim($_POST['field-unique-id'])) > 0 ) {
				$field_id = str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-unique-id'])));
			} elseif($existing_field) {
				$existing_field_id_number = substr($existing_field->name, -1);
				if(is_numeric($existing_field_id_number)) {
					$new_number = intval($existing_field_id_number) + 1;
					$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name'])))) . '_' . $new_number;
				} else {
					$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name'])))) . '_2';
				}
			} else {
				$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name']))));
			}
				
			if(isset($_POST['rich-editor'])) 	{ $rich_editor = 1; } else { $rich_editor = 0; }
			
			$update = $wpdb->query("UPDATE " 			. $ecpt_db_meta_fields_name . " SET 
				`name`= '" 			. $field_id . "',
				`nicename`= '"		. addslashes(utf8_encode($_POST['field-name'])) . "', 
				`description`= '"	. addslashes(utf8_encode($_POST['field-desc'])) . "', 
				`type`='" 			. $_POST['field-type'] . "', 
				`options`='" 		. str_replace(', ', ',', $_POST['field-options']) . "', 
				`rich_editor`='" 	. $rich_editor . "', 
				`max`='" 			. $_POST['field-max'] . "' 
				WHERE `id`='" 		. $_POST['field-id'] . "';"
			);
			
			do_action('ecpt_update_meta_field', $_POST);				
			
			wp_redirect(add_query_arg('field-updated', 1)); exit;
		} // end meta field update	
	} 

	/*************************************
	* process $_GET requests
	*************************************/
	$ecpt_get = (!empty($_GET)) ? true : false;

	if($ecpt_get) // if data is being sent
	{
		/* delete post type */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'delete-posttype' && isset($_GET['posttype-id'])) {
			$remove = $wpdb->query("DELETE FROM " . $ecpt_db_name . " WHERE `id`='" . $_GET['posttype-id'] . "';");

			do_action('ecpt_delete_post_type', $_GET);				
			
			// clear the post type cache
			ecpt_clear_cache('post_types');
		}
		/* delete taxonomy */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'delete-taxonomy' && isset($_GET['tax-id'])) {
			$remove = $wpdb->query("DELETE FROM " . $ecpt_db_tax_name . " WHERE `id`='" . $_GET['tax-id'] . "';");
	
			do_action('ecpt_delete_taxonomy', $_GET);				
			
			// clear the taxonomy cache
			ecpt_clear_cache('taxonomies');
		}
		/* delete metabox */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'delete-metabox' && isset($_GET['metabox-id'])) {
			$remove = $wpdb->query("DELETE FROM " . $ecpt_db_meta_name . " WHERE `id`='" . $_GET['metabox-id'] . "';");
			$remove_fields = $wpdb->query("DELETE FROM " . $ecpt_db_meta_fields_name . " WHERE `parent`='" . $_GET['metabox-name'] . "';");
			
			do_action('ecpt_delete_meta_box', $_GET);	
				
			// clear the cache
			ecpt_clear_cache('metaboxes');
		}
		
		/* duplicate metabox */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'duplicate' && isset($_GET['metabox-id'])) {
		
			// duplicate the meta box
			$duplicate_metabox = $wpdb->query("INSERT INTO " . $ecpt_db_meta_name . " (`name`,`nicename`,`page`,`context`,`priority`) SELECT `name`,`nicename`,`page`,`context`,`priority` FROM " . $ecpt_db_meta_name . " WHERE `id`='" . $_GET['metabox-id'] . "';");
			
			// grab the name and ID of the new box
			$new_meta_box = $wpdb->get_results("SELECT `name`,`id` FROM " . $ecpt_db_meta_name . " ORDER BY `id` DESC LIMIT 1");
						
			// figure out the name of the new meta box
			if($new_meta_box) {
				$existing_box_id_number = substr($new_meta_box[0]->name, -1);
				if(is_numeric($existing_box_id_number)) {
					$new_number = intval($existing_box_id_number) + 1;
					$new_box_name = substr($new_meta_box[0]->name, 0, -1) . $new_number;
				} else {
					$new_box_name = $new_meta_box[0]->name . '_2';
				}
			} else {
				$new_box_name = $_GET['metabox-name'] . '_2';
			}
			
			// update the name of the meta box
			$update_metabox_name = $wpdb->update(
				$ecpt_db_meta_name, 
				array('name' => $new_box_name), 
				array('id' => $new_meta_box[0]->id)
			);
			
			// grab all fields from the original meta box
			$fields = $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE `parent`='" . $_GET['metabox-name'] . "';");
			if($fields) :
				//print_r($fields); die();
				foreach($fields as $field) :
					$field_parent = $new_box_name;
					
					$field_id = $wpdb->query("INSERT INTO " . $ecpt_db_meta_fields_name . " SET 
						`name`= '" 			. $field->name . "',
						`nicename`='"		. $field->nicename . "',
						`parent`='"			. $field_parent . "',
						`type`='"			. $field->type . "',
						`description`='"	. $field->description . "',
						`options`='"		. $field->options . "',
						`rich_editor`='"	. $field->rich_editor . "',
						`list_order`='"	. $field->list_order . "',
						`max`='"				. $field->max . "'
		
					;");			
										
				endforeach;
			endif;
			
			do_action('ecpt_duplicate_meta_box', $_GET);				
			
			// clear the cache
			ecpt_clear_cache('metaboxes');			
			
		}
		
		/* delete field */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'delete-field' && isset($_GET['field-id'])) {
			$remove = $wpdb->query("DELETE FROM " . $ecpt_db_meta_fields_name . " WHERE `id`='" . $_GET['field-id'] . "';");
			do_action('ecpt_delete_meta_field', $_GET);	
		}
	}
}
add_action('admin_init', 'ecpt_process_data');