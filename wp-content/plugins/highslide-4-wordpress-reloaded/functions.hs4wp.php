<?php

/**
 * function hs4wp_prepare_header
 * Add neccesary includes / CSS to WP Header
 * @version 1.11
 * @author Marco 'solariz' Goetze
 * @return bool
 */
function hs4wp_prepare_header() {
    GLOBAL $hs4wp_plugin_uri,$hs4wp_ver_hs,$hs4wp_ver_plugin;
    $custom_css = hs4wp_getConf('hs4wp_custom_css');

    // check if min or full versions should be used
    $CSSJS = array();
    if(hs4wp_getConf('hs4wp_useFullJS') == 'on') {
        // FULL
        $CSSJS['hs']        = 'highslide.full.css';
        $CSSJS['hsmsie']    = 'highslide-ie6.full.css';
        $CSSJS['hsjs']      = 'highslide.full.js';
    } else {
        // DEFAULT - minified versions
        $CSSJS['hs']        = 'highslide.min.css';
        $CSSJS['hsmsie']    = 'highslide-ie6.min.css';
        $CSSJS['hsjs']      = 'highslide.min.js';
    }

    $hs_css_uri = (strlen($custom_css)>=5)?$custom_css."?ver=".$hs4wp_ver_hs."v".$hs4wp_ver_plugin:$hs4wp_plugin_uri.$CSSJS['hs']."?ver=".$hs4wp_ver_hs."v".$hs4wp_ver_plugin;
    $coralize= false;  // Currently forced off, not working anymore
    if($coralize != "" && $coralize != false) {
        $hs_css_uri = hs4wp_coralize_uri($hs_css_uri);
    }
    $OUT = '<link rel="stylesheet" href="'.$hs_css_uri.'" type="text/css" media="screen" />'."\n";
    $OUT .= "<!--[if lt IE 7]>\n";
    $OUT .= '<link rel="stylesheet" type="text/css" href="'.$hs4wp_plugin_uri.$CSSJS['hsmsie'].'" />'."\n";
    $OUT .= "<![endif]-->\n";

    echo $OUT;
}//EoFu: hs4wp_prepare_header

/**
 * function hs4wp_prepare_footer
 * Add neccesary JS to footer
 * @version 1.02
 * @author Marco 'solariz' Goetze
 * @return bool
 */
function hs4wp_prepare_footer() {
    GLOBAL $hs4wp_plugin_uri,$hs4wp_ver_hs,$hs4wp_ver_plugin,$hs4wp_img_count;
    $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');

    // check if min or full versions should be used
    if(hs4wp_getConf('hs4wp_useFullJS') == 'on') {
        $hsjs = 'highslide.full.js';
    } else {
        $hsjs = 'highslide.min.js';
    }
    $coralize= false; // Off, not working anymore
    $hs_script_uri = $hs4wp_plugin_uri.$hsjs."?ver=".$hs4wp_ver_hs."v".$hs4wp_ver_plugin;
    $hs_graphics_uri = $hs4wp_plugin_uri."graphics/";
    if($coralize != "" && $coralize != false) {
        $hs_script_uri      = hs4wp_coralize_uri($hs_script_uri);
        $hs_graphics_uri    = hs4wp_coralize_uri($hs_graphics_uri);
    } else {
        $hs_graphics_uri = str_ireplace("http://".$_SERVER['HTTP_HOST'],"",$hs_graphics_uri);
        $hs_script_uri   = str_ireplace("http://".$_SERVER['HTTP_HOST'],"",$hs_script_uri);
    }
    $OUT = "<!-- HighSlide4Wordpress Footer JS Includes -->\n";
    if(hs4wp_getConf('hs4wp_disable_ipadfix') != true && $isiPad) {
        $OUT .= '<div id="closebutton" class="highslide-overlay closebutton_ipad" onclick="return hs.close(this)" title="Close"></div>'."\n";
    } elseif(hs4wp_getConf('hs4wp_disable_closebutton') != true && hs4wp_getConf('hs4wp_hs_heading') == false) {
        $OUT .= '<div id="closebutton" class="highslide-overlay closebutton" onclick="return hs.close(this)" title="Close"></div>'."\n";
    }
    $OUT .= '<script type="text/javascript" src="'.$hs_script_uri.'"></script>';
    $OUT .= '<script type="text/javascript">'."\n";
    $OUT .= "hs.graphicsDir = '".$hs_graphics_uri."';\n";
    $OUT .= (hs4wp_getConf('hs4wp_credits')!="on")?"hs.showCredits = true;\n":"hs.showCredits = false;\n";
    if(hs4wp_getConf('hs4wp_disable_ipadfix') != true && $isiPad == false)  $OUT .= (hs4wp_getConf('hs4wp_fadeinout')=="on")?"hs.fadeInOut = true;\nhs.transitions = ['expand', 'crossfade'];\n":"hs.fadeInOut = false;\n";
    $OUT .= (hs4wp_getConf('hs4wp_align_center')=="on")?"hs.align = 'center';\n":"";
    $OUT .= "hs.padToMinWidth = true;\n";

    // Caption Mode
    switch(hs4wp_getConf('hs4wp_hs_caption')) {
        CASE 1:
            $OUT .= "hs.captionEval = 'this.thumb.title';\n";
            break;
        CASE 2:
            $OUT .= "hs.captionEval = 'this.thumb.alt';\n";
            break;
        CASE 3:
            $OUT .= "hs.captionEval = 'this.a.title';\n";
            break;
        DEFAULT:
            break;
    }//end switch
    // Caption as Title
    switch(hs4wp_getConf('hs4wp_hs_heading')) {
        CASE 1:
            $OUT .= "hs.headingEval = 'this.thumb.title';\n";
            break;
        CASE 2:
            $OUT .= "hs.headingEval = 'this.thumb.alt';\n";
            break;
        CASE 3:
            $OUT .= "hs.headingEval = 'this.a.title';\n";
            break;
        DEFAULT:
            break;
    }


    // Style Definitions
    switch(hs4wp_getConf('hs4wp_hs_appearance')) {
        CASE 1:
            $OUT .= "hs.outlineType = 'rounded-white';\n";
            #$OUT .= "hs.wrapperClassName = 'draggable-header';\n";
            break;
        CASE 2:
            $OUT .= "hs.wrapperClassName = 'wide-border';\n";
            break;
        CASE 3:
            $OUT .= "hs.wrapperClassName = 'borderless';\n";
            break;
        CASE 4:
            $OUT .= "hs.outlineType = 'outer-glow';\n";
            $OUT .= "hs.wrapperClassName = 'outer-glow';\n";
            break;
        CASE 5:
            $OUT .= "hs.outlineType = null;\n";
            break;
        CASE 6:
            $OUT .= "hs.outlineType = 'glossy-dark';\n";
            $OUT .= "hs.wrapperClassName = 'dark';\n";
            break;
        CASE 7:
            $OUT .= "hs.wrapperClassName = 'dark borderless floating-caption';\n";
            break;
        CASE 99:
            break;
        DEFAULT:
            $OUT .= "hs.outlineType = 'rounded-white';\n";
            break;
    }//end switch

    // Closebutton auf Ipad immer einblenden
    if(hs4wp_getConf('hs4wp_disable_closebutton') != true || (hs4wp_getConf('hs4wp_disable_ipadfix') != true && $isiPad) ) $OUT .= "hs.registerOverlay({\noverlayId: 'closebutton',\nposition: 'top right',\nfade: 0\n});\n";

    // Ipad Fix: No Backgroudn Dimming on Ipad because of huge lag
    if(hs4wp_getConf('hs4wp_disable_ipadfix') != true && $isiPad) {
      $OUT .= "<!-- No HS Dimming on Ipad -->";
      $OUT .= "hs.dimmingGeckoFix = true;\n";
      $OUT .= "hs.dimmingDuration = 0;\n";
      $OUT .= "hs.fadeInOut = false;\n";
      $OUT .= "hs.loadingOpacity = 1;\n";
      $OUT .= "hs.transitionDuration = 0;\n";
      $OUT .= "hs.transitions = [\"none\"];\n";
      $OUT .= "hs.enableKeyListener = false;\n";
    }
     else {
        switch(hs4wp_getConf('hs4wp_hs_dimming')) {
            CASE 1:
                //$OUT .= "hs.dimmingOpacity = 0;\n";
                break;
            CASE 2:
                $OUT .= "hs.dimmingOpacity = 0.1;\n";
                break;
            CASE 3:
                $OUT .= "hs.dimmingOpacity = 0.2;\n";
                break;
            CASE 4:
                $OUT .= "hs.dimmingOpacity = 0.3;\n";
                break;
            CASE 5:
                $OUT .= "hs.dimmingOpacity = 0.4;\n";
                break;
            CASE 6:
                $OUT .= "hs.dimmingOpacity = 0.5;\n";
                break;
            CASE 7:
                $OUT .= "hs.dimmingOpacity = 0.6;\n";
                break;
            CASE 8:
                $OUT .= "hs.dimmingOpacity = 0.7;\n";
                break;
            CASE 9:
                $OUT .= "hs.dimmingOpacity = 0.8;\n";
                break;
            CASE 10:
                $OUT .= "hs.dimmingOpacity = 0.9;\n";
                break;
            CASE 11:
                $OUT .= "hs.dimmingOpacity = 1;\n";
                break;
            DEFAULT:
                break;
        }
    }
    // Advanced Section
      $OUT .= hs4wp_getConf('hs4wp_advanced');
	// Add the controlbar
    if($hs4wp_img_count > 1 && hs4wp_getConf('hs4wp_disable_slideshow') == false) {
      $OUT .= "if (hs.addSlideshow) hs.addSlideshow({\n";
      //$OUT .= "hs.addSlideshow({";
      //$OUT .= "slideshowGroup: 'group1',";
      $interval = intval(hs4wp_getConf('hs4wp_slideshow_delay')*1000);
      if($interval < 1000) $interval = 5000;
      $OUT .= "\tinterval: ".$interval.",\n";
      $OUT .= "\trepeat: false,\n";
      $OUT .= "\tuseControls: true,\n";
      $OUT .= "\tfixedControls: 'fit',\n";
      // Bottom Thumbstrip
      if( hs4wp_getConf('hs4wp_show_thumbstrip') == true ) {
          $OUT .= "thumbstrip: {\n";
          $OUT .= "position: 'bottom center',\n";
          $OUT .= "mode: 'horizontal',\n";
          $OUT .= "relativeTo: 'viewport'\n";
          $OUT .= "},\n";
      }



      $OUT .= "\toverlayOptions: {\n";

      if(hs4wp_getConf('hs4wp_align_center')=="on") {
            $OUT .= "\t\tposition: 'center center',\n";
      } else {
            $OUT .= "\t\tposition: 'bottom center',\n";
      }
      if(hs4wp_getConf('hs4wp_disable_ipadfix') != true && $isiPad) {
          $OUT .= "\t\topacity: 1,\n";
          $OUT .= "\t\thideOnMouseOut: false\n";
      } else {
          $OUT .= "\t\topacity: .6,\n";
          $OUT .= "\t\thideOnMouseOut: true\n";
      }


      $OUT .= "\t}\n";
      $OUT .= "});\n";
    }
    $hszIndex = hs4wp_getConf('hs4wp_custom_zindex');
    if( $hszIndex != false ) {
        $OUT .= "hs.zIndexCounter = ".$hszIndex.";\n";
    }
    // Custom language / translation option
    if( hs4wp_getConf('hs4wp_use_lang')=='on' ) {

        $cust_lang    = hs4wp_getConf('hs4wp_langtext');
        // Fix for Foreign Char Encodings
        foreach ($cust_lang as $k => $v) {
            $cust_lang[$k] =    addslashes(unhtmlentities($v));
        }

        $OUT .= "hs.lang = {";
        if($cust_lang[0]) $OUT .= "loadingText : '".$cust_lang[0]."',\n";
        if($cust_lang[1]) $OUT .= "loadingTitle : '".$cust_lang[1]."',\n";
        if($cust_lang[2]) $OUT .= "focusTitle : '".$cust_lang[2]."',\n";
        if($cust_lang[3]) $OUT .= "restoreTitle : '".$cust_lang[3]."',\n";
        if($cust_lang[4]) $OUT .= "fullExpandTitle : '".$cust_lang[4]."',\n";
        if($cust_lang[5]) $OUT .= "previousText : '".$cust_lang[5]."',\n";
        if($cust_lang[6]) $OUT .= "nextText : '".$cust_lang[6]."',\n";
        if($cust_lang[7]) $OUT .= "closeText : '".$cust_lang[7]."',\n";
        if($cust_lang[8]) $OUT .= "moveText : '".$cust_lang[8]."',\n";
        if($cust_lang[8]) $OUT .= "moveTitle : '".$cust_lang[8]."',\n";
        if($cust_lang[9]) $OUT .= "closeTitle : '".$cust_lang[9]."',\n";
        if($cust_lang[10]) $OUT .= "resizeTitle : '".$cust_lang[10]."',\n";
        if($cust_lang[11]) $OUT .= "playText : '".$cust_lang[11]."',\n";
        if($cust_lang[12]) $OUT .= "playTitle : '".$cust_lang[12]."',\n";
        if($cust_lang[13]) $OUT .= "pauseText : '".$cust_lang[13]."',\n";
        if($cust_lang[14]) $OUT .= "pauseTitle : '".$cust_lang[14]."',\n";
        if($cust_lang[15]) $OUT .= "previousTitle : '".$cust_lang[15]."',\n";
        if($cust_lang[16]) $OUT .= "nextTitle : '".$cust_lang[16]."'\n";
        $OUT .= "};";
    }
    // Gallery Config Object
    $OUT .= "\n";
    $OUT .= "</script>\n";
    // JSMin minify config:
    if(hs4wp_getConf('hs4wp_disableJSmin') != true) {
        require_once'jsmin.php';
        $OUT = JSMin::minify($OUT);
    }
    echo $OUT;
}//EoFu: hs4wp_prepare_footer


/**
 * function unhtmlentities
 * Convert String to UTF-8 without Entities
 * @version 1.0
 * @return string
 */
function unhtmlentities($string) { // From php.net for < 4.3 compat
            $trans_tbl = get_html_translation_table(HTML_ENTITIES);
            $trans_tbl = array_flip($trans_tbl);
            $output = strtr($string, $trans_tbl);
            if(check_utf8($output) == true) {
                return $output;
            } else {
                return utf8_encode($output);
            }
}


/**
 * function hs4wp_add_to_footer
 * Add HTML Expander DIV`s to footer
 * @version 1.0
 * @author Marco 'solariz' Goetze
 * @return bool
 */
function hs4wp_add_to_footer() {
    GLOBAL $hs4wp_insert_into_footer;
    $OUT = "";
    if(isset($hs4wp_insert_into_footer) == false OR $hs4wp_insert_into_footer == "") {
        echo $OUT;
        return false;
    } else {
        $OUT = "<!-- HighSlide4Wordpress Footer HTML Expander DIVs -->\n";
        $OUT .= $hs4wp_insert_into_footer;
        $OUT .= "\n";
        echo $OUT;
        return true;
    }
}


/**
 * function hs4wp_config_page
 * Add & Manage config pages in WP Admin
 * @version 1.0
 * @author Marco 'solariz' Goetze
 * @return bool
 */
function hs4wp_config_page() {
    GLOBAL $hs4wp_plugin_path;
    if (current_user_can('manage_options'))
    {
        if (function_exists('add_options_page'))
        {
            require_once($hs4wp_plugin_path.'options.hs4wp.php');
            add_options_page('highslide 4 Wordpress *reloaded* Settings', 'Highslide 4 Wordpress', 8, __FILE__, 'hs4wp_options_page');
        }
    }
}

/**
 * function hs4wp_coralize_uri
 * rewrites a input URL to use Coral CDN service
 * @version 1.0
 * @param string URL
 * @author Marco 'solariz' Goetze
 * @return string
 */
function hs4wp_coralize_uri($uri) {
    if(stristr($uri,"http://") == false) return $uri;
    $tmp = explode("/",$uri,4);
    $cor = $tmp[0].'/'.$tmp[1].'/'.$tmp[2].'.nyud.net/'.$tmp[3];
    return $cor;
}

/**
 * function hs4wp_auto_set
 * Add auto Filter to Content. Searching for href images and [highlside] tags
 * @version 1.0
 * @param string $content
 * @author Marco 'solariz' Goetze
 * @return string
 */
function hs4wp_auto_set($content) {
	global $post,$hs4wp_load_hs;
    // Add HS to Images.
	$content = preg_replace_callback('/<a ([^>]+)>/i', 'hs4wp_callback_img', $content);
    // Add HS to HTML Tags if present
    if(strstr($content,"[highslide]") AND strstr($content,"[/highslide]")) {
       $content = preg_replace_callback('#\[highslide]((?:[^\[]|\[(?!/?highslide])|(?R))+)\[/highslide]#', 'hs4wp_callback_htm', $content);
    }
    return $content;
}

/**
 * function hs4wp_callback_htm
 * Callback Function of hs4wp_auto_set
 * @version 1.05
 * @see hs4wp_auto_set
 * @param string preg
 * @author Marco 'solariz' Goetze
 * @return string
 */
function hs4wp_callback_htm($a) {
    global $post,$hs4wp_plugin_uri,$hs4wp_insert_into_footer;
    $str = trim($a[1]);
    $contentID = $post->ID.md5($str);
    // get options
    $options  = preg_match('#\((.*)\)#',$str,$reg)?explode(";",$reg[1],4):false;
    if(isset($options[0])&&isset($options[1])) {
        $subject  = $options[0];
        $linkName = $options[1];
    } else {
        $subject  = false;
        $linkName = false;
    }
    $width    = intval($options[2]);
    $height   = intval($options[3]);
    if($width > 1 && $height > 1)
        $style = ' align="left" style="width:'.$width.'px;height:'.$height.'px;"';
    else
        $style = ' align="left"';
    $OUT = (hs4wp_getConf('hs4wp_ptag_workaround') == 'on')?'</p>':'';
    $OUT .= '<a class="highslide" onclick="return hs.htmlExpand(this, {wrapperClassName: \'draggable-header\',contentId: \'highslide-html_'.$contentID.'\'';
    $img = (hs4wp_getConf('hs4wp_ext_icon') == 'on')?'<img src="'.$hs4wp_plugin_uri.'img/ext.png" width="11" height="9" border="0" alt="" style="border:none;">':'';
    if($subject != false) {
      $OUT .= ",headingText:'".htmlentities($subject,ENT_QUOTES,'UTF-8')."'";
      // Check if LinkName == URL specifying an image; If So display the image instead the link name
      $Print_linkName = htmlentities($linkName,ENT_QUOTES,'UTF-8');
      $regex = "((https?|ftp)\:\/\/)?"; // SCHEME
      $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
      $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
      $regex .= "(\:[0-9]{2,5})?"; // Port
      $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path
      $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
      $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor
      if(preg_match("/^".$regex."$/i",$linkName)) {
        // check for known image types
          if(preg_match("/\.[jpe?g|gif|png]/i", $linkName)) {
            $Print_linkName = "<img src=\"".$linkName."\" class=\"highslide-expander-image\" alt=\"".htmlentities($subject,ENT_QUOTES,'UTF-8')."\" title=\"".htmlentities($subject,ENT_QUOTES,'UTF-8')."\">";
          }
      }




      $OUT .= '} )" href="#">'.$img." ".$Print_linkName.'</a>';
      $str = str_replace($reg[0],"",$str);
    } else {
      $OUT .= '} )" href="#">'.$img.' info</a>';
    }
//    $OUT .= "\n";
    // opener

    $hs4wp_insert_into_footer .= '<div id="highslide-html_'.$contentID.'" class="highslide-html-content"'.$style.'>';
    // HTML Box Header
	$hs4wp_insert_into_footer .= '<div class="highslide-header">
                <ul>
                    <li class="highslide-move"><a href="#" onclick="return false">&nbsp;</a></li>
                    <li class="highslide-close"><a href="#" onclick="return hs.close(this)">&nbsp;</a></li>
                </ul>
             </div>';

    // Flash handler
    if(hs4wp_getConf('hs4wp_handle_swf') == 'on') {
      $extension = strtolower(substr($str,strlen($str)-4));
      if($extension == ".swf") {
          if($width  < 100) $width  = "500";
          if($height < 100) $height = "370";
          // Flash size reduce by x percent
          $F_Width  = $width;
          $F_Height = floor($height/100*88);
          $swf = $str;
          $str = "";
          $str .= '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="swf_'.$contentID.'" width="'.$F_Width.'" height="'.$F_Height.'">'."\n";
          $str .= '<param name="movie" value="'.$swf.'" />'."\n";
          $str .= '<param name="wmode" value="opaque" />'."\n";
          $str .= '<!--[if !IE]>-->'."\n";
          $str .= '<object type="application/x-shockwave-flash" data="'.$swf.'" width="'.$F_Width.'" height="'.$F_Height.'" wmode="opaque">'."\n";
          $str .= '<!--<![endif]-->'."\n";
          $str .= 'Flash plugin is required to view this object.'."\n";
          $str .= '<!--[if !IE]>-->'."\n";
          $str .= '</object>'."\n";
          $str .= '<!--<![endif]-->'."\n";
          $str .= '</object> '."\n";
      }
    }

    // HTML Box Body
    $hs4wp_insert_into_footer .= '<div class="highslide-body">'.$str.'</div>';
    // HTML Box Footer
    $hs4wp_insert_into_footer .= '<div class="highslide-footer"><div><span class="highslide-resize" title="Resize">&nbsp;</span></div></div>';
    // closer
    $hs4wp_insert_into_footer .= '</div>';
    $hs4wp_insert_into_footer .= "\n";
    return $OUT;

//    return htmlentities($OUT);
}

/**
 * function hs4wp_callback_img
 * Callback Function of hs4wp_auto_set
 * @version 1.01
 * @see hs4wp_auto_set
 * @param string preg
 * @author Marco 'solariz' Goetze
 * @return string
 */
function hs4wp_callback_img($a) {
	global $post,$hs4wp_img_count;
	$str = $a[1];
    // Standard replace for linked images
	if ( preg_match('/href=[\'"][^"\']+\.(?:gif|jpe|jpg|jpeg|png)/i', $str) ) {
	    if(stripos($str,"highslide") == false && stripos($str,"onclick") == false && is_attachment() == false) {
            ++$hs4wp_img_count;
		    if ( false !== strpos(strtolower($str), 'class=') )
			    return '<a ' . preg_replace('/(class=[\'"])/i', '$1highslide', $str) . ' onclick="return hs.expand(this)">';
		    else
    			return '<a class="highslide img_'.$hs4wp_img_count.'" ' . $str . ' onclick="return hs.expand(this)">';
        }
	}
    return $a[0];
}


/**
 * function hs4wp_auto_set_attachmentURL
 * Function containing STRING to add on found href img
 * @version 1.02
 * @param string $url
 * @author Marco 'solariz' Goetze
 * @return string
 */
function hs4wp_auto_set_attachmentURL($url) {
    GLOBAL $attachment_id,$hs4wp_attachment_workaround;
    #if($attachment_id < 1 || wp_attachment_is_image($attachment_id) != true) return $url;
    // chek if URL already contain highslide parts
    if(stripos($url,"highslide") == false && stripos($url,"onclick") == false && is_attachment() == true) {

        if($hs4wp_attachment_workaround == 1) {

            $url = wp_get_attachment_url($attachment_id);
            $url = $url."\" class=\"highslide\" onclick=\"return hs.expand(this)";
            #die("attachment handler 3: $url");
        }
        ++$hs4wp_attachment_workaround;
    }
    return $url;
}

/**
 * function hs4wp_selector
 * Function to fill <select> with <option>'s
 * @version 1.0
 * @param array $array
 * @param bool $selected
 * @author Marco 'solariz' Goetze
 * @return string
 */
function hs4wp_selector($array,$selected=false) {
    $OUT = '';
    foreach($array as $k=>$v) {
        $s=($k==$selected&&$selected!=false)?' selected ':'';
        $OUT .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>';
    }
    return $OUT;
}//EoFu:hs4wp_selector




function hs4wp_admin_init()
{
    GLOBAL $hs4wp_plugin_uri;
    $hs4wpOptionsCSS = $hs4wp_plugin_uri."options.full.css";
    if (is_ssl()) $hs4wpOptionsCSS = preg_replace( '/^http:\/\//', 'https://',  $hs4wpOptionsCSS );
    wp_register_style('hs4wpOptionsCSS', $hs4wpOptionsCSS);
    wp_enqueue_style( 'hs4wpOptionsCSS');
}

function hs4wp_add_media_button()
{
  	GLOBAL $hs4wp_plugin_uri;
	$url = $hs4wp_plugin_uri.'media-button-expander.php?tab=add&TB_iframe=true&amp;height=300&amp;width=640';
	if (is_ssl()) $url = preg_replace( '/^http:\/\//', 'https://',  $url );
	echo '<a href="'.$url.'" class="thickbox" title="'.__('Add Highslide HTML Expander','highslide-4-wordpress').'"><img src="'.$hs4wp_plugin_uri.'/img/media-button-expander.png" alt="'.__('Add Highslide HTML Expander','highslide-4-wordpress').'"></a>';
}



function hs4wp_act(){
    if( is_admin() ) {
        if(hs4wp_getConf('hs4wp_lic_agreement')!='on' && isset($_POST['submitted']) != true) {
           $msg_status = "<div id='hs4wp-warning' class='updated fade'><p><strong>".__('Highslide 4 Wordpress *reloaded* is almost ready.')."</strong> ".sprintf(__('You must accept the License Agreement and <a href="%1$s">configure</a> it to work.'), "./options-general.php?page=highslide-4-wordpress-reloaded/functions.hs4wp.php")."</p></div>";
           _e($msg_status);
        }
        // compatibility checks:
            // NextGen Effects:
            $TEMP = hs4wp_getConf('ngg_options');
            if($TEMP['thumbEffect'] && $TEMP['thumbEffect'] != "none") {
                $msg_status = "<div id='hs4wp-warning' class='updated fade'><p><strong>".__('Highslide 4 Wordpress *reloaded* compatibility Warning!')."</strong><br/> ".sprintf(__('You are using NextGen Galley with enabled JS Image effects. With this settings Highslide won`t work in your site. Please go to the <a href="%1$s">NextGEN Config dialogue</a> and set JavaScript Thumbnail Effect to none.<br><br>If you using wordpress on a WP Multi site please first select the networksite using NextGEN and than turn of the NextGEN JS Effect for this site.'), "admin.php?page=nggallery-options#effects")."</p></div>";
                _e($msg_status);
            }
            unset($TEMP);
    }
    return;
}



/**
 * function hs4wp_prepare_adminheader
 * Add neccesary JS to Admin Head - only on HS4WP Page
 * @version 1.1
 * @author Marco 'solariz' Goetze
 * @return bool
 */
function hs4wp_prepare_adminheader() {
       // Since v 1.23 of this plugin no additional JS is needed
}


// Add settings link on plugin page
function hs4wp_plugin_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=highslide-4-wordpress-reloaded/functions.hs4wp.php">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}



/**
 * function hs4wp_getConf
 * read the Config from WP in case of multisite it return the multisite value as default
 * @version 1.0
 * @author Marco 'solariz' Goetze
 * @return value
 */
function hs4wp_getConf($key)
{
    $value = get_option($key);
    if($value == false)
    {
        // If Multisite installation try to get the global network default
        if(function_exists('is_multisite'))
        {
            if(is_multisite())
            {
                $value = get_site_option($key);
            }
        }
    }
    if(@$value == "off" || isset($value) != true) $value = false;
    return $value;
}

/**
 * function check_utf8
 * RFC3629 check if a string is encoded correctly in utf-8
 * @version 1.0
 * @author javalc6 at gmail dot com
 * @return value
 */
function check_utf8($str) {
    $len = strlen($str);
    for($i = 0; $i < $len; $i++){
        $c = ord($str[$i]);
        if ($c > 128) {
            if (($c > 247)) return false;
            elseif ($c > 239) $bytes = 4;
            elseif ($c > 223) $bytes = 3;
            elseif ($c > 191) $bytes = 2;
            else return false;
            if (($i + $bytes) > $len) return false;
            while ($bytes > 1) {
                $i++;
                $b = ord($str[$i]);
                if ($b < 128 || $b > 191) return false;
                $bytes--;
            }
        }
    }
    return true;
} // end of check_utf8