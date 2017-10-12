<?php 
foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_name . " WHERE id='" . $_GET['fields-edit'] . "';") as $key => $metabox) { ?>
<h2>
	<?php _e('Edit Fields for', 'ecpt'); ?> <?php echo $metabox->name; ?> - 
	<a href="admin.php?page=easy-content-types/easy-content-types.php?metaboxes" title="Go Back"><?php _e('Go Back', 'ecpt'); ?></a>
</h2>
<table class="wp-list-table widefat fixed posts">
	<thead>
		<tr>
			<th><?php _e('Order', 'ecpt'); ?></th>
			<th><?php _e('Name', 'ecpt'); ?></th>
			<th><?php _e('ID', 'ecpt'); ?></th>
			<th><?php _e('Type', 'ecpt'); ?></th>
			<th><?php _e('Description', 'ecpt'); ?></th>
			<th><?php _e('Options', 'ecpt'); ?></th>
			<th><?php _e('Shortcode', 'ecpt'); ?></th>
			<th><?php _e('Actions', 'ecpt'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php _e('Order', 'ecpt'); ?></th>
			<th><?php _e('Name', 'ecpt'); ?></th>
			<th><?php _e('ID', 'ecpt'); ?></th>
			<th><?php _e('Type', 'ecpt'); ?></th>
			<th><?php _e('Description', 'ecpt'); ?></th>
			<th><?php _e('Options', 'ecpt'); ?></th>
			<th><?php _e('Shortcode', 'ecpt'); ?></th>
			<th><?php _e('Actions', 'ecpt'); ?></th>
		</tr>
	</tfoot>
	<tbody>
	<?php $i = 1; ?>
	<?php foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE parent='" . $metabox->name . "' ORDER BY list_order;") as $key => $field) { ?>			
		<tr id="recordsArray_<?php echo $field->id; ?>" class="ecpt-field <?php if(ecpt_is_odd($i)) { echo 'alternate'; } ?>">
			<td><a href="#" class="dragHandle"></a></td>
			<td><?php echo stripslashes(utf8_decode($field->nicename)); ?></td>
			<td>ecpt_<?php echo utf8_decode($field->name); ?></td>
			<td><?php echo $field->type; ?></td>
			<td><?php if(strlen($field->description) > 30) { echo substr(stripslashes(utf8_decode($field->description)), 0, 30) . '...'; } else { echo stripslashes(utf8_decode($field->description)); } ?></td>
			<td>
				<?php if($field->type == 'textarea') { ?>
					<?php if($field->rich_editor == 1) { echo 'Rich Editor'; } else { echo 'Plain Text'; } ?>
				<?php } else if($field->type == 'select' || $field->type == 'radio' || $field->type == 'multicheck') { ?>
					<?php echo $field->options; ?>
				<?php } else if($field->type == 'slider') { ?>
					<?php echo 'Max: ' . $field->max; ?>
				<?php } ?>
			</td>
			<td>
				<?php 
				$field_shortcode = '[ecpt_field id="' . $field->name . '"]';
				// the "ecpt_field_shortcode" filter can be used to change the short code displayed
				if(has_filter('ecpt_field_shortcode')) {
					echo apply_filters('ecpt_field_shortcode', $field, $field_shortcode); 
				} else {
					echo $field_shortcode;
				}
				?>
			</td>
			<td>
				<a href="admin.php?page=easy-content-types/easy-content-types.php?metaboxes&fields-edit=<?php echo $_GET['fields-edit']; ?>&edit-field=<?php echo $field->id; ?>" title="<?php _e('Edit', 'ecpt'); ?>" class="ecpt-edit-field" id="ecpt-edit-field-<?php echo $field->id; ?>"><?php _e('Edit', 'ecpt'); ?></a> |
				<a href="admin.php?page=easy-content-types/easy-content-types.php?metaboxes&fields-edit=<?php echo $_GET['fields-edit']; ?>&ecpt-action=delete-field&field-id=<?php echo $field->id; ?>" title="<?php _e('Delete', 'ecpt'); ?>" class="ecpt-delete-field" id="ecpt-delete-field-<?php echo $field->id; ?>"><?php _e('Delete', 'ecpt'); ?></a>
			</td>
		</tr>
		<?php $i++;
	} ?>
</table>
<?php } ?>