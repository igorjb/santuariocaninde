<div id="icon-edit" class="icon32 icon32-posts-post"><br/></div>
<h2>
<?php _e('Edit Field', 'ecpt'); ?> - <a href="admin.php?page=easy-content-types/easy-content-types.php?metaboxes&fields-edit=<?php echo $_GET['fields-edit']; ?>" title="Go Back"><?php _e('Go Back', 'ecpt'); ?></a>
</h2>
<?php if(isset($_GET['field-updated'])) : ?>
	<div class="updated fade">
		<p><?php _e('Field Updated', 'ecpt'); ?></p>
	</div>
<?php endif; ?>	
<form id="edit-field" method="post">
	<table class="form-table">
		<tbody>		
		<?php
			$i = 0;
			foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE id='" . $_GET['edit-field'] . "';") as $key => $field) { ?>		
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="field-name"><?php _e('Name', 'ecpt'); ?></label>
				</th>
				<td>
					<input type="text" id="field-name" name="field-name" value="<?php echo utf8_decode($field->nicename); ?>"  class="ecpt-text no-float"/>
					<p class="description"><?php _e('The field name is used displayed next to the field in the meta box', 'ecpt'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="field-unique-id"><?php _e('ID', 'ecpt'); ?></label>
				</th>
				<td>
					<input type="text" id="field-unique-id" name="field-unique-id" value="<?php echo $field->name; ?>"  class="ecpt-text no-float"/>
					<p class="description"><?php _e('The field id is used for displaying field content with shortcodes and template tags', 'ecpt'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="field-type"><?php _e('Type', 'ecpt'); ?></label>
				</th>
				<td>
					<select name="field-type" id="field-type" class="ecpt-text no-float"/>
						<?php
						foreach ($field_types as $option) {
							echo '<option id="' . $option . '"', $field->type == $option ? ' selected="selected"' : '', '>', $option, '</option>';
						}
						?>
					</select>
					<p class="description"><?php _e('The field type determines what kind of field is displayed', 'ecpt'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="field-desc"><?php _e('Description', 'ecpt'); ?></label>
				</th>
				<td>
					<textarea id="field-desc" name="field-desc"  class="ecpt-textarea no-float"><?php echo stripslashes(utf8_decode($field->description)); ?></textarea>
					<p class="description"><?php _e('The field description is display beneath the field in the metabox', 'ecpt'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label><?php _e('Field Options', 'ecpt'); ?></label>
				</th>
				<td>
					<?php include(dirname(__FILE__) . '/meta-field-options.php'); ?>
					
					<?php 
					if(has_action('ecpt_field_options_' . $field->type)) {
						do_action('ecpt_field_options_' . $field->type, $field); 
					} else { ?>
						<p class="description"><?php _e('No options for this field', 'ecpt'); ?></p>
						<input type="hidden" id="rich-editor" name="rich-editor" value="<?php echo $field->rich_editor; ?>"/>
						<input type="hidden" id="field-options" name="field-options" value="<?php echo $field->options; ?>"/>
						<input type="hidden" id="field-max" name="field-max" value="<?php echo $field->max; ?>"/>
					<?php } ?>
				</td>
			</tr>
		<?php
		} ?>
	</table>
	<p class="submit">
		<?php echo wp_nonce_field('ecpt_edit_field_nonce', 'ecpt-edit-field-nonce'); ?>
		<input type="hidden" name="ecpt-action" value="update-field"/>
		<input type="hidden" name="field-id" value="<?php echo $_GET['edit-field']; ?>"/>
		<input type="submit" id="<?php echo $_GET['edit-field'];?>" class="button-primary field-update" value="Update"/>
	</p>	
</form>