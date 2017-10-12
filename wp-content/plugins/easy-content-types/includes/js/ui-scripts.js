jQuery(document).ready(function($)
{
	
	if($('.form-table .ecpt_upload_field').length > 0 ) {
		// Media Uploader
		var formfield = '';
		$('.ecpt_upload_image_button').on('click', function() {
		
			formfield = $('.ecpt_upload_field',$(this).parent());
            //tb_show('', 'media-upload.php?post_id='+post_vars.post_id+'&type=file&TB_iframe=true');
            tb_show('', 'media-upload.php?post_id='+post_vars.post_id+'&TB_iframe=true');
			return false;
        });	

		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (formfield) {
				imgurl = $('a','<div>'+html+'</div>').attr('href');
				formfield.val(imgurl);			
				tb_remove();			  
			} else {
				window.original_send_to_editor(html);
			}			
			// Clear the formfield value so the other media library popups can work as they are meant to. - 2010-11-11.
			formfield = '';
		}
		
	}
	
	if($('.form-table .ecpt-slider').length > 0 ) {
		$('.ecpt-slider').each(function(){
			var $this = $(this);
			var id = $this.attr('rel');
			var val = $('#' + id).val();
			var max = $('#' + id).attr('rel');
			max = parseInt(max);
			//var step = $('#' + id).closest('input').attr('rel');
			$this.slider({
				value: val,
				max: max,
				step: 1,
				slide: function(event, ui) {
					$('#' + id).val(ui.value);
				}
			});
		});
	}
	
	if($('.form-table .ecpt_datepicker').length > 0 ) {
		var dateFormat = 'mm/dd/yy';
		$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
	}
	
	// add new repeatable field
	$(".ecpt_add_new_field").on('click', function() {
		var $this = $(this);
		var field = $this.closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
		var fieldLocation = $this.closest('td').find('div.ecpt_repeatable_wrapper:last');
		// set the new field val to blank
		$('input', field).val("");
		field.insertAfter(fieldLocation, $this.closest('td'));
		return false;
	});
	
	// add new repeatable upload field
	$(".ecpt_add_new_upload_field").on('click', function() {
		var $this = $(this);
		var container = $this.closest('tr');
		var field = $this.closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
		var fieldLocation = $this.closest('td').find('div.ecpt_repeatable_upload_wrapper:last');		
		$('input[type="text"]', field).val("");
		field.insertAfter(fieldLocation, $this.closest('td'));
		return false;
	});
	
	// remove repeatable field
	$('.ecpt_remove_repeatable').on('click', function(e) {
		e.preventDefault();
		var field = $(this).parent();
		$('input', field).val("");
		field.remove();				
		return false;
	});
	
	$(function() {	
		$(".ecpt_field_type_repeatable").sortable({
			handle: '.dragHandle', items: '.ecpt_repeatable', opacity: 0.6, cursor: 'move', axis: 'y', update: function() {
				var $this = $(this);
				var field = $this.closest('tr');
				var meta_id = $('input.ecpt_repeatable_field_name', field).attr('id');
				var inputs = '';
				$('.ecpt_repeatable input', field).each(function() {
					var $this =  $(this);
					inputs = inputs + $this.attr('name') + '=' + $this.val() + '&';
				});
				var order = inputs + 'action=ecpt_update_repeatable_order&post_id=' + post_vars.post_id + '&meta_id=' + meta_id;
				$.post(ajaxurl, order, function(theResponse){
					// show response here, if needed
					//alert(theResponse);
				});
			}
		});
	});
	
	$(function() {	
		$(".ecpt_field_type_repeatable_upload").sortable({
			handle: '.dragHandle', items: '.ecpt_repeatable', opacity: 0.6, cursor: 'move', axis: 'y', update: function() {
				var $this = $(this);
				var field = $this.closest('tr');
				var meta_id = $('input.ecpt_repeatable_upload_field_name', field).attr('id');
				var inputs = '';
				$('.ecpt_repeatable input', field).each(function() {
					var $this =  $(this);
					inputs = inputs + $this.attr('name') + '=' + $this.val() + '&';
				});
				var order = inputs + 'action=ecpt_update_repeatable_order&post_id=' + post_vars.post_id + '&meta_id=' + meta_id;
				$.post(ajaxurl, order, function(theResponse){
					// show response here, if needed
					//alert(theResponse);
				});
			}
		});
	});
});