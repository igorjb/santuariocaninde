<?php
//////////// WPADMIN BOOTSTRAP LOADER
    if(file_exists('../../../wp-load.php')) {
    	require_once("../../../wp-load.php");
    } else if(file_exists('../../wp-load.php')) {
    	require_once("../../wp-load.php");
    } else if(file_exists('../wp-load.php')) {
    	require_once("../wp-load.php");
    } else if(file_exists('wp-load.php')) {
    	require_once("wp-load.php");
    } else if(file_exists('../../../../wp-load.php')) {
    	require_once("../../../../wp-load.php");
    } else if(file_exists('../../../../wp-load.php')) {
    	require_once("../../../../wp-load.php");
    } else {

    	if(file_exists('../../../wp-config.php')) {
    		require_once("../../../wp-config.php");
    	} else if(file_exists('../../wp-config.php')) {
    		require_once("../../wp-config.php");
    	} else if(file_exists('../wp-config.php')) {
    		require_once("../wp-config.php");
    	} else if(file_exists('wp-config.php')) {
    		require_once("wp-config.php");
    	} else if(file_exists('../../../../wp-config.php')) {
    		require_once("../../../../wp-config.php");
    	} else if(file_exists('../../../../wp-config.php')) {
    		require_once("../../../../wp-config.php");
    	} else {
    		echo '<p>Failed to load bootstrap.</p>';
    		exit;
    	}
    }
    require_once(ABSPATH.'wp-admin/admin.php');
//////////// END BOOTSTRAP LOADER

if (function_exists('admin_url')) {
	wp_admin_css_color('classic', __('Blue'), admin_url("css/colors-classic.css"), array('#073447', '#21759B', '#EAF3FA', '#BBD8E7'));
	wp_admin_css_color('fresh', __('Gray'), admin_url("css/colors-fresh.css"), array('#464646', '#6D6D6D', '#F1F1F1', '#DFDFDF'));
} else {
	wp_admin_css_color('classic', __('Blue'), get_bloginfo('wpurl').'/wp-admin/css/colors-classic.css', array('#073447', '#21759B', '#EAF3FA', '#BBD8E7'));
	wp_admin_css_color('fresh', __('Gray'), get_bloginfo('wpurl').'/wp-admin/css/colors-fresh.css', array('#464646', '#6D6D6D', '#F1F1F1', '#DFDFDF'));
}

wp_enqueue_script( 'common' );
wp_enqueue_script( 'jquery-color' );

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<title><?php bloginfo('name') ?> &rsaquo; <?php _e('Highslide HTML Expander'); ?> &#8212; <?php _e('WordPress'); ?></title>
	<?php
		wp_enqueue_style( 'global' );
		wp_enqueue_style( 'wp-admin' );
		wp_enqueue_style( 'colors' );
		wp_enqueue_style( 'media' );
	?>
	<script type="text/javascript">
	//<![CDATA[
		function addLoadEvent(func) {if ( typeof wpOnload!='function'){wpOnload=func;}else{ var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}}
	//]]>
	</script>
	<?php
	do_action('admin_print_styles');
	do_action('admin_print_scripts');
	do_action('admin_head');
	if ( isset($content_func) && is_string($content_func) )
		do_action( "admin_head_{$content_func}" );
	?>
</head>
<body id="media-upload">
<div style="padding:10px;" id="hs4wOptions">
<h3>Highslide HTML Expander</h3>
<ul>
With a Highslide Expander you can insert special l inks to your content. If a user click this expander link a HTML popup opens presenting the content you specify. This can be useful for explanation links or e.g. to embed videos. A Highslide Expander is fully HTML capable.
This dialog is just a helper, you also can enter the Highslide code manually in this format:<br /><br />
<b>[highslide]</b>(Title;Link Name;Width;Height)Your content<b>[/highslide]</b><br /><br />
Instead of a 'Link Name' you also can specify a absolut URL to a image. If the Script detects a valid image as link name (jpg,jpeg,png,gif) this image will be displayed, a click at this image will expand the content.<br /><br />
If the Option is enabled in the Plugin settings you can also specify a SWF file as link instead of "Your content" in this case a SWF Object will be inserted in the HTML Expander automatically.<br/><br />  
<b>Example for a SWF:</b><br /><br />
<b>[highslide]</b>(This is my Expander;Click to Expand;640;480)/test/test.swf<b>[/highslide]</b><br /><br />
</ul>
<h3>Insert Options</h3>
<ul>
<table>
  <form name="formular">
    <tr>
        <td><label for="e_Title">Title: </label></td>
        <td><input name="e_Title" type="text" size="32" value="" tabindex="1" /></td>
        <td><small><i>Title of your HTML Expander</i></small></td>
    </tr>
    <tr>
        <td><label for="e_Name">Name: </label></td>
        <td><input name="e_Name" type="text" size="32" value="" tabindex="2" /></td>
        <td><small><i>Link name used on the page or valid image url (with http://)</i></small></td>
    </tr>
    <tr>
        <td><label for="e_Width">Width: </label></td>
        <td><input name="e_Width" type="text" size="8" value="" tabindex="3" /></td>
        <td><small><i>Size in pixel</i></small></td>
    </tr>
    <tr>
        <td><label for="e_Height">Height: </label></td>
        <td><input name="e_Height" type="text" size="8" value="" tabindex="3" /></td>
        <td><small><i>Size in pixel</i></small></td>
    </tr>
  </form>
</table><br/>
<input type="submit" id="insertcode" class="button button-primary" name="insertintopost" value="Insert into post" />
</ul>
<script type="text/javascript">
/* <![CDATA[ */
    jQuery('#insertcode').click(function(){
        var win = window.dialogArguments || opener || parent || top;
        if( window.document.formular.e_Title.value || window.document.formular.e_Name.value || window.document.formular.e_Width.value || window.document.formular.e_Height.value ) {
            var out = '[highslide](';
            if( window.document.formular.e_Title.value )    out = out + window.document.formular.e_Title.value + ';';
            else                                            out = out + 'Info;';
            if( window.document.formular.e_Name.value )     out = out + window.document.formular.e_Name.value + ';';
            else                                            out = out + 'Info;';
            if( window.document.formular.e_Width.value )    out = out + window.document.formular.e_Width.value + ';';
            else                                            out = out + ';';
            if( window.document.formular.e_Height.value )    out = out + window.document.formular.e_Height.value;
            else                                            out = out + ';';
            out = out + ')Your Expander Text or HTML Code[/highslide]'
        } else {
            var out = '[highslide]Your Expander Text or HTML Code[/highslide]';
        }
        if (jQuery('#format').val()>0) win.send_to_editor(out + ' format="' + jQuery('#format').val() + '"]');
        else win.send_to_editor(out);
    });
/* ]]> */
</script>
</div>
</body>
</html>