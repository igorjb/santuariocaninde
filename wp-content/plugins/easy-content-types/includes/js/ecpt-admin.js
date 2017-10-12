jQuery(function($){
	// show tool tips on click
	$('a.ecpt-help').click(function(e) {
		e.preventDefault();
		var showToolTip = {
			'text-decoration' : 'none',
			'visibility' : 'visible',
			'opacity' : '1',
			'-moz-transition' : 'all 0.2s linear',
			'-webkit-transition' : 'all 0.2s linear',
			'-o-transition' : 'all 0.2s linear',
			'transition' : 'all 0.2s linear'
		}
		var hideToolTip = {
			'visibility' : 'hidden',
			'opacity' : '0',
			'-moz-transition' : 'all 0.4s linear',
			'-webkit-transition' : 'all 0.4s linear',
			'-o-transition' : 'all 0.4s linear',
			'transition' : 'all 0.4s linear'
		}
		$(this).children().css(showToolTip);
		$(this).mouseout(function(){
			$(this).children().css(hideToolTip);
		});
	});
	
	// hide/show advanced label options
	$('.ecpt-advanced-labels').on('click', function() {
		$('#ecpt-advanced-labels').slideToggle();
		$('.ecpt-advanced-labels').toggle();
		return false;
	});
	
	// delete post type function
	$('#ecpt-wrap .ecpt-post-type-delete').click(function(){
		if(confirm("Do you you really want to delete this Post Type?"))
		{
			return true;
		}
		return false;
	});	
	
	// delete taxonomy function
	$('#ecpt-wrap .ecpt-delete-taxonomy').click(function(){
		if(confirm("Do you you really want to delete this Taxonomy?"))
		{
			return true
		}
		return false;
	});
	// delete metabox function
	$('#ecpt-wrap .ecpt-delete-metabox').click(function(){
		if(confirm("Do you you really want to delete this Metabox?"))
		{
			return true;
		}
		return false;
	});
	// delete field function
	$('#ecpt-wrap .ecpt-delete-field').click(function(){
		if(confirm("Do you you really want to delete this Field?"))
		{				
			return true;
		}
		return false;
	});
	
	// upload / insert image function
	var txtBox_id = '';
	$('#ecpt-add-posttype .ecpt_upload_image_button').click(function() {
		txtBox_id = '#'+$(this).prop('id').replace('_button', '');
		image_id = '#image_'+$(this).prop('id').replace('upload_image_button_', '');
		formfield = $(txtBox_id);
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	// send the selected image to the iamge url field
	window.send_to_editor = function(html) {
		imgurl = $('img',html).prop('src');
		$(txtBox_id).val(imgurl);
		$(image_id).prop('src', imgurl)
		tb_remove();
	}	
	
	// check for posttype name on submit
	$('#ecpt-add-posttype #ecpt-submit').click(function() {
		if($('#ecpt-post-type-name').val() == '') {
			alert('You must enter a post type name');
			return false;
		}
	});	
	
	$('#ecpt-wrap .posttype-update').click(function(){
		$(this).attr('disable', true).addClass('disabled');
	});	
	
	// check for metabox name on submit
	$('#ecpt-add-metabox #ecpt-submit').click(function() {
		if($('#ecpt-metabox-name').val() == '') {
			alert('You must enter a metabox name');
			return false;
		}
	});
	

	// check for taxonomy name on submit
	$('#ecpt-add-taxonomy #ecpt-submit').click(function() {
		
		if($('#ecpt-taxonomy-name').val() == '') {
			alert('You must enter a taxonomy name');
			return false;
		}
		if(!$('#ecpt-taxonomy-object option:selected').length) {
			alert('You must select at least on taxonomy object');
			return false;
		}
	});
	
	
	
	// make fields sortable via drag and drop
	$(function() {	
		$(".wp-list-table tbody").sortable({
			handle: '.dragHandle', items: '.ecpt-field', opacity: 0.6, cursor: 'move', axis: 'y', update: function() {
				var order = $(this).sortable("serialize") + '&action=ecpt_update_field_listing';
				$.post(ajaxurl, order, function(theResponse){
				});
			}
		});			
	});
		
	// check for field name on submit
	$('#ecpt-add-new-field #ecpt-submit').click(function() {
		if($('#ecpt-field-name').val() == '') {
			alert('You must enter a field name');
			return false;
		}
	});		
			
	// disable options field unless SELECT or RADIO type is chosen
	$('#ecpt-field-type').change(function(){
		var id = $('option:selected', this).prop("id");
		var hiddenFields = '.ecpt-disabled';
		var richEditor = '.ecpt-rich-editor-disabled';
		var max = '.ecpt-max-disabled';
		if(id == 'select' || id == 'radio' || id == 'multicheck') {
			$(hiddenFields).fadeIn();
			$(richEditor).fadeOut();
			$(max).fadeOut();
		} else if(id == 'textarea') {
			$(richEditor).fadeIn();
			$(hiddenFields).fadeOut();
			$(max).fadeOut();
		} else if(id == 'slider') {
			$(max).fadeIn();
			$(hiddenFields).fadeOut();
			$(richEditor).fadeOut();
		} else {
			$(hiddenFields).fadeOut();
			$(richEditor).fadeOut();
			$(max).fadeOut();
		}
	});	
	
	// disable options field unless SELECT or RADIO type is chosen
	$('#field-type').change(function(){
		var field_id = $('option:selected', this).prop("id");
		if(field_id == 'select' || field_id == 'radio' || field_id == 'multicheck') {
			$('#field-options').fadeTo('fast', 100);
			$('#field-options').prop('disabled', '');
		} else {
			$('#field-options').fadeTo('slow', 0.5);
			$('#field-options').prop('disabled', 'true');			
		}
	});	
	
});