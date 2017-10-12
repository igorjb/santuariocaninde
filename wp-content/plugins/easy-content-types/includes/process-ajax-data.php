<?php

function ecpt_process_ajax_data() {
	global $wpdb;
	$ecpt_db_meta_fields_name = $wpdb->prefix . "ecpt_meta_box_fields";
	$updateRecordsArray = $_POST['recordsArray'];
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {

		$wpdb->update($ecpt_db_meta_fields_name, array('list_order' => $listingCounter ), array('id' => $recordIDValue));
		$listingCounter++;
	}
	die('test');
}
add_action('wp_ajax_ecpt_update_field_listing', 'ecpt_process_ajax_data');

function ecpt_process_repeatable_order() {
	
	$post_id = $_POST['post_id'];
	$meta_id = $_POST['meta_id'];
	
	// retrieve the existing field order
	$old_meta = get_post_meta($post_id, $meta_id, true);
	$updated_meta = array();
	
	$new_meta = $_POST[$meta_id];
	foreach($new_meta as $meta_field) {
		$updated_meta[] = $meta_field;
	}
	update_post_meta($post_id, $meta_id, $updated_meta);
	die();
}
add_action('wp_ajax_ecpt_update_repeatable_order', 'ecpt_process_repeatable_order');