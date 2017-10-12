<?php
function ecpt_metabox_manager() {

	global $wpdb;
	global $ecpt_db_meta_name;
	global $ecpt_db_meta_fields_name;
	global $field_types;
	global $metabox_pages;
	global $metabox_contexts;
	global $metabox_priorities;
	global $ecpt_base_dir;
	
	if(has_filter('ecpt_field_types')) {
		$field_types = apply_filters('ecpt_field_types', $field_types);
	}
	
	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;
	?>
	<div class="wrap">
	<div id="ecpt-wrap">
	
		<?php 		
		if(isset($_GET['edit-field'])):
			// edit a specific field
			include('meta-field-edit.php');
		elseif(isset($_GET['fields-edit'])):
			// edit met abox fields
			include('meta-fields-edit.php');
			// add new meta box field form
			include('meta-add-new-field-form.php');		
		elseif (isset($_GET['metabox-edit'])):
			// edit a meat box
			include('metabox-edit.php');			
		else: 		
			// list all of the meta boxes
			include('metabox-list.php');
			// add new meta box form
			include('metabox-add-new.php');		
		endif;
		?>
	</div><!--end #ecpt-wrap-->
	</div><!--end #wrap-->
<?php 
}