<?php

// Options Page
function hs4wp_options_page()
{
    GLOBAL $hs4wp_plugin_uri,$hs4wp_plugin_path,$wpdb;

    $mypage = add_management_page( 'myplugin', 'myplugin', 9, __FILE__, 'myplugin_admin_page' );
    add_action( "admin_print_scripts-$mypage", 'hs4wp_prepare_adminheader' );


    // If form was submitted
	if (isset($_POST['submitted']))
	{
	        // Save Settings
            $lic_agreement      =(!isset($_POST['lic_agreement'])? 'off': $_POST['lic_agreement']);
            $coralize           = false; // STAY OFF DONT WORK !
            $credits            =(!isset($_POST['credits'])? 'off': $_POST['credits']);
            $fadeinout          =(!isset($_POST['fadeinout'])? 'off': $_POST['fadeinout']);
            //$attachment_filter  =(!isset($_POST['attachment_filter'])? 'off': $_POST['attachment_filter']);
            $attachment_filter='on';
            $only_use_header    =(!isset($_POST['only_use_header'])? 'off': $_POST['only_use_header']);
            $align_center       =(!isset($_POST['align_center'])? 'off': $_POST['align_center']);
            $ext_icon           =(!isset($_POST['ext_icon'])? 'off': $_POST['ext_icon']);
            $ptag_workaround    =(!isset($_POST['ptag_workaround'])? 'off': $_POST['ptag_workaround']);
            $media_icon         =(!isset($_POST['media_icon'])? 'off': $_POST['media_icon']);
            $useFullJS          =(!isset($_POST['useFullJS'])? 'off': $_POST['useFullJS']);
            $disableJSmin          =(!isset($_POST['disableJSmin'])? 'off': $_POST['disableJSmin']);
            $handle_swf         =(!isset($_POST['handle_swf'])? 'off': $_POST['handle_swf']);
            $disable_slideshow  =(!isset($_POST['disable_slideshow'])? 'off': $_POST['disable_slideshow']);
            $disable_ipadfix    =(!isset($_POST['disable_ipadfix'])? 'off': $_POST['disable_ipadfix']);
            $disable_closebutton=(!isset($_POST['disable_closebutton'])? 'off': $_POST['disable_closebutton']);
            $show_thumbstrip=(!isset($_POST['show_thumbstrip'])? 'off': $_POST['show_thumbstrip']);
            $use_lang           =(!isset($_POST['use_lang'])? 'off': $_POST['use_lang']);
            $input1             =(!isset($_POST['input1'])? 5: intval($_POST['input1']));
            $input2             =(!isset($_POST['input2'])? '': $_POST['input2']);
            $select1            =(!isset($_POST['select1'])? '': intval($_POST['select1']));
            $select2            =(!isset($_POST['select2'])? '': intval($_POST['select2']));
            $select3            =(!isset($_POST['select3'])? '': intval($_POST['select3']));
            $select4            =(!isset($_POST['select4'])? '': intval($_POST['select4']));
            $textarea1          =(!isset($_POST['textarea1'])? '': stripslashes($_POST['textarea1']));
            $zinput             =(!isset($_POST['zinput'])? '': intval($_POST['zinput']));
            if(!$zinput)        $zinput = 10003;


            // Language Inputs
            $inputL0            =(!isset($_POST['inputL0'])? false: stripslashes($_POST['inputL0']));
            $inputL1            =(!isset($_POST['inputL1'])? false: stripslashes($_POST['inputL1']));
            $inputL2            =(!isset($_POST['inputL2'])? false: stripslashes($_POST['inputL2']));
            $inputL3            =(!isset($_POST['inputL3'])? false: stripslashes($_POST['inputL3']));
            $inputL4            =(!isset($_POST['inputL4'])? false: stripslashes($_POST['inputL4']));
            $inputL5            =(!isset($_POST['inputL5'])? false: stripslashes($_POST['inputL5']));
            $inputL6            =(!isset($_POST['inputL6'])? false: stripslashes($_POST['inputL6']));
            $inputL7            =(!isset($_POST['inputL7'])? false: stripslashes($_POST['inputL7']));
            $inputL8            =(!isset($_POST['inputL8'])? false: stripslashes($_POST['inputL8']));
            $inputL9            =(!isset($_POST['inputL9'])? false: stripslashes($_POST['inputL9']));
            $inputL10           =(!isset($_POST['inputL10'])? false: stripslashes($_POST['inputL10']));
            $inputL11           =(!isset($_POST['inputL11'])? false: stripslashes($_POST['inputL11']));
            $inputL12           =(!isset($_POST['inputL12'])? false: stripslashes($_POST['inputL12']));
            $inputL13           =(!isset($_POST['inputL13'])? false: stripslashes($_POST['inputL13']));
            $inputL14           =(!isset($_POST['inputL14'])? false: stripslashes($_POST['inputL14']));
            $inputL15           =(!isset($_POST['inputL15'])? false: stripslashes($_POST['inputL15']));
            $inputL16           =(!isset($_POST['inputL16'])? false: stripslashes($_POST['inputL16']));

            // Encoding of the Language Array
            $LANGARRAY = array(
                0=>$inputL0,
                1=>$inputL1,
                2=>$inputL2,
                3=>$inputL3,
                4=>$inputL4,
                5=>$inputL5,
                6=>$inputL6,
                7=>$inputL7,
                8=>$inputL8,
                9=>$inputL9,
                10=>$inputL10,
                11=>$inputL11,
                12=>$inputL12,
                13=>$inputL13,
                14=>$inputL14,
                15=>$inputL15,
                16=>$inputL16
            );
            $TEMP = array();
            $CUST_ENC = array('À'=>'&Agrave;', 'à'=>'&agrave;', 'Á'=>'&Aacute;', 'á'=>'&aacute;', 'Â'=>'&Acirc;', 'â'=>'&acirc;', 'Ã'=>'&Atilde;', 'ã'=>'&atilde;', 'Ä'=>'&Auml;', 'ä'=>'&auml;', 'Å'=>'&Aring;', 'å'=>'&aring;', 'Æ'=>'&AElig;', 'æ'=>'&aelig;', 'Ç'=>'&Ccedil;', 'ç'=>'&ccedil;', 'Ð'=>'&ETH;', 'ð'=>'&eth;', 'È'=>'&Egrave;', 'è'=>'&egrave;', 'É'=>'&Eacute;', 'é'=>'&eacute;', 'Ê'=>'&Ecirc;', 'ê'=>'&ecirc;', 'Ë'=>'&Euml;', 'ë'=>'&euml;', 'Ì'=>'&Igrave;', 'ì'=>'&igrave;', 'Í'=>'&Iacute;', 'í'=>'&iacute;', 'Î'=>'&Icirc;', 'î'=>'&icirc;', 'Ï'=>'&Iuml;', 'ï'=>'&iuml;', 'Ñ'=>'&Ntilde;', 'ñ'=>'&ntilde;', 'Ò'=>'&Ograve;', 'ò'=>'&ograve;', 'Ó'=>'&Oacute;', 'ó'=>'&oacute;', 'Ô'=>'&Ocirc;', 'ô'=>'&ocirc;', 'Õ'=>'&Otilde;', 'õ'=>'&otilde;', 'Ö'=>'&Ouml;', 'ö'=>'&ouml;', 'Ø'=>'&Oslash;', 'ø'=>'&oslash;', 'Œ'=>'&OElig;', 'œ'=>'&oelig;', 'ß'=>'&szlig;', 'Þ'=>'&THORN;', 'þ'=>'&thorn;', 'Ù'=>'&Ugrave;', 'ù'=>'&ugrave;', 'Ú'=>'&Uacute;', 'ú'=>'&uacute;', 'Û'=>'&Ucirc;', 'û'=>'&ucirc;', 'Ü'=>'&Uuml;', 'ü'=>'&uuml;', 'Ý'=>'&Yacute;', 'ý'=>'&yacute;', 'Ÿ'=>'&Yuml;', 'ÿ'=>'&yuml;');
            foreach ($LANGARRAY as $key => $value) {
                $value = htmlentities($value, ENT_QUOTES | ENT_IGNORE,'UTF-8');
                foreach ($CUST_ENC as $s => $r) {
                    $value = str_replace($s, $r, $value);
                }
                $TEMP[$key] = $value;
            }
            $LANGARRAY = $TEMP;
            unset($TEMP,$key,$value,$s,$r,$CUST_ENC);

            $HS4WPOPTIONS = array(
                'hs4wp_lic_agreement' => $lic_agreement,
                'hs4wp_coralize' => $coralize,
                'hs4wp_credits' => $credits,
                'hs4wp_fadeinout' => $fadeinout,
                'hs4wp_attachment_filter' => $attachment_filter,
                'hs4wp_only_use_header' => $only_use_header,
                'hs4wp_align_center' => $align_center,
                'hs4wp_ext_icon' => $ext_icon,
                'hs4wp_ptag_workaround' => $ptag_workaround,
                'hs4wp_media_icon' => $media_icon,
                'hs4wp_handle_swf' => $handle_swf,
                'hs4wp_disable_slideshow' => $disable_slideshow,
                'hs4wp_disable_ipadfix' => $disable_ipadfix,
                'hs4wp_disable_closebutton' => $disable_closebutton,
                'hs4wp_useFullJS' => $useFullJS,
                'hs4wp_use_lang' => $use_lang,
                'hs4wp_slideshow_delay' => $input1,
                'hs4wp_custom_css' => $input2,
                'hs4wp_custom_zindex' => $zinput,
                'hs4wp_langtext' => $LANGARRAY,
                'hs4wp_hs_appearance' => $select1,
                'hs4wp_hs_dimming' => $select2,
                'hs4wp_hs_caption' => $select3,
                'hs4wp_hs_heading' => $select4,
                'hs4wp_advanced' => $textarea1,
                'hs4wp_disableJSmin'=> $disableJSmin,
                'hs4wp_show_thumbstrip'=>$show_thumbstrip
                );

            // Update Options
            foreach ($HS4WPOPTIONS as $key => $value) {
                //echo "update_option($key, $value)<br>\n";
                update_option($key, $value);
            }// End foreach


            // WPMU Save Global Options
            $MultiSiteMsg = '';
            if(function_exists('is_multisite')) // WP MULTISITE PART
            {
                if( is_multisite() && current_user_can('manage_network') )
                {
                   if($_POST['wpmuhs4wp'] != false)
                   {
                        foreach ($HS4WPOPTIONS as $key => $value) {
                            update_site_option($key, $value);
                        }// End foreach
                        $MultiSiteMsg = " Multisite Default values set.";
                   }
                }
            }


            // Show message
            $msg_status = 'Options saved.'.$MultiSiteMsg;
            _e('<div id="message" class="updated fade"><p>' . $msg_status . '</p></div>');
	}// End If is submitted



//******* Get current setup from DB


        $lic_agreement      =( hs4wp_getConf('hs4wp_lic_agreement')=='on' ) ? "checked":"";
        //$coralize           =   ( hs4wp_getConf('hs4wp_coralize')=='on' ) ? "checked":"";
        $credits            =( hs4wp_getConf('hs4wp_credits')=='on' ) ? "checked":"";
        $fadeinout          =( hs4wp_getConf('hs4wp_fadeinout')=='on' ) ? "checked":"";
        $attachment_filter  =( hs4wp_getConf('hs4wp_attachment_filter')=='on' ) ? "checked":"";
        $only_use_header    =( hs4wp_getConf('hs4wp_only_use_header')=='on' ) ? "checked":"";
        $align_center       =( hs4wp_getConf('hs4wp_align_center')=='on' ) ? "checked":"";
        $ext_icon           =( hs4wp_getConf('hs4wp_ext_icon')=='on' ) ? "checked":"";
        $ptag_workaround    =( hs4wp_getConf('hs4wp_ptag_workaround')=='on' ) ? "checked":"";
        $media_icon         =( hs4wp_getConf('hs4wp_media_icon')=='on' ) ? "checked":"";
        $handle_swf         =( hs4wp_getConf('hs4wp_handle_swf')=='on' ) ? "checked":"";
        $disable_slideshow  =( hs4wp_getConf('hs4wp_disable_slideshow')=='on' ) ? "checked":"";
        $disable_ipadfix    =( hs4wp_getConf('hs4wp_disable_ipadfix')=='on' ) ? "checked":"";
        $disable_closebutton=( hs4wp_getConf('hs4wp_disable_closebutton')=='on' ) ? "checked":"";
        $useFullJS          =( hs4wp_getConf('hs4wp_useFullJS')=='on' ) ? "checked":"";
        $use_lang           =( hs4wp_getConf('hs4wp_use_lang')=='on' ) ? "checked":"";
        $disableJSmin       =( hs4wp_getConf('hs4wp_disableJSmin')=='on' ) ? "checked":"";
        $show_thumbstrip =( hs4wp_getConf('hs4wp_show_thumbstrip')=='on' ) ? "checked":"";

        $slideshow_delay    =  hs4wp_getConf('hs4wp_slideshow_delay');
        $custom_css         =  hs4wp_getConf('hs4wp_custom_css');
        $textarea1          =  hs4wp_getConf('hs4wp_advanced');
        $hszIndex           =  hs4wp_getConf('hs4wp_custom_zindex');

        $hs4wp_langtext    = hs4wp_getConf('hs4wp_langtext');


    // Defaults
        if(!$slideshow_delay) $slideshow_delay = 5;

    // Configuration Page
        $imgpath = $hs4wp_plugin_uri."img/";
        // License red
        if($lic_agreement != "checked") $lic_style="color:red;";


        $hs4wp_select1 = hs4wp_selector(array(
        1=>"Highslide rounded-white",
        2=>"Polaroid Outline + Shadow",
        3=>"Borderless",
        4=>"Dark Outer-Glow",
        5=>"Plain and Simple",
        6=>"Dark and Glossy",
        7=>"Dark borderless, floating-caption",
        99=>"Use own definition in Advanced Section"
        ),hs4wp_getConf('hs4wp_hs_appearance'));

        $hs4wp_select2 = hs4wp_selector(array(
        1=>"0% , No Dimming",
        2=>"10%",
        3=>"20%",
        4=>"30%",
        5=>"40%",
        6=>"50%",
        7=>"60%",
        8=>"70%",
        9=>"80%",
        10=>"90%",
        11=>"100%, full black"
        ),hs4wp_getConf('hs4wp_hs_dimming'));

        $hs4wp_select3 = hs4wp_selector(array(
        0=>"none",
        1=>"Image Title",
        2=>"Image Alt",
        3=>"Link Title"
        ),hs4wp_getConf('hs4wp_hs_caption'));

        $hs4wp_select4 = hs4wp_selector(array(
        0=>"none",
        1=>"Image Title",
        2=>"Image Alt",
        3=>"Link Title"
        ),hs4wp_getConf('hs4wp_hs_heading'));

        echo <<<END
        <div id="hs4wOptions">
        <div class="wrap" style="max-width:900px !important;">
            <div id="icon-options-general" class="icon32"><br /></div>
        	<h2>Highslide 4 Wordpress</h2>
        	<div id="poststuff" style="margin-top:10px;">
            	<div id="sideblock">
        		 <h3>Information</h3>
                  <ul class="infoBox">

                    <img src="$imgpath/web.png"><a href="http://solariz.de" target="_blank" style="text-decoration:none;"> Author Homepage</a><br /><br />
                    <img src="$imgpath/help.png"><a href="http://solariz.de/highslide-wordpress-reloaded" target="_blank" style="text-decoration:none;"> Plugin Manual</a><br /><br />
                    <img src="$imgpath/donate.png"><a href="http://solariz.de/donate" target="_blank" style="text-decoration:none;"> How to Donate?</a> <br /><br />
                    <img src="$imgpath/star.png"><a href="http://wordpress.org/extend/plugins/highslide-4-wordpress-reloaded/" target="_blank" style="text-decoration:none;"> Rate this plugin</a><br /><br />
                    <a href="http://flattr.com/thing/116751/Plugin-Highslide-4-Wordpress-reloaded" target="_blank"><img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a><br /><br />
                    <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://bit.ly/hs4wp" data-text="Checkout this #Wordpress #Plugin - Highslide4Wordpress - Easy Image Expander!" data-count="none" data-via="solariz">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script><br />
                  </ul>
        		<h3>The Author</h3>
                    <div class="infoBox">
                    <small><img src="$imgpath/mg.png" style="float:right; margin-right: -16px; padding: 2px;">Just in some short words. I doing "web stuff" since my early youth, I had the possibility to accompany the development of the Internet since the early 90's. Currently I'm living in Bochum, Germany. You can find more information in my <a href="http://solariz.de/aboutme">blog/aboutme</a>.</small>
                    </div>
             	</div>
                <div id="mainblock" style="max-width:650px">
                    <div class="dbx-content">
		 	            <form name="sfiform" action="$action_url" method="post">
        					<input type="hidden" name="submitted" value="1" />
           				    <h3>About</h3>
                            <ul>
                              <p>This Plugin automatically insert Highslide Script to your Blog without the need of any further configuration or Shorttags or editing of old posts. As soon the Plugin is activated all existing thumped images using Highslide to expand. But this isn`t all, the Plugin offers several Options to configure the look and behaviour of Highslide in your Blog. For Advanced users there is also the option to specify own HS Parameters at the Option page.</p>
                            </ul>
                            <h3>License <img src="$imgpath/somerights20.png"></h3>
                            <ul>
                              <p>This Plugin contains major parts of "Highslide JS" by Torstein Honsi and is licensed under a <a href="http://creativecommons.org/licenses/by-nc/2.5/" target="_blank">Creative Commons Attribution-NonCommercial 2.5 License</a>. This means you need the permission of the Plugin Author to use this Plugin on commercial websites. Also you need to obtain a Commercial Highslide License from <a href="http://highslide.com/#licence" target="_blank">highslide.com</a> !</p>
                              <br/>
                              <p><b>What is a commercial website?</b><br/>A commercial website is a website which purpose is generating revenue or cash flow of any type, and that isn't under a non-profit organization. So if you're selling a product, selling advertisement, selling a service or just marketing a commercial business, your site is commercial. A company website is also commercial even if it doesn't sell anything, as it's purpose is to front a commercial company.</p>
                              <br/>
                              <p><b>I`m commercial in someway, and now?</b><br/>This plugin consists of two parts, 1) the Javascript by Torstein Honsi and on 2) the Wordpress part by me. Highslide itself needs a commercial license to use it for commecial projects, you can obtain it <a href="http://www.highslide.com">here</a>. The commercial use of the Wordpress plugin itself is donationware, so if you use it please use the "How to Donate Link" in the right bar to send me a donation. How much, choose what the plugin is worth to you but please send at least $1 to cover my hosting costs of my blog / webpage. Thanks.</p>
                                <br/>
                              <div>
                                  <input id="check0" type="checkbox" name="lic_agreement" $lic_agreement />
                                  <label for="check0" style="$lic_style">I Agree to the License Agreement</label>
                              </div>
                            </ul>
                            <h3><b>PLEASE READ CAREFUL:</b></h3>
                            <ul>
                              <div>
                              Like the most plugin writers I spent my spare time to write those plugins, I do not demand on money but if you like this plugin please be fair and do me a little favour and send a small donation (<a href="http://solariz.de/donate" target="_blank">how ? Information</a>). Thanks for any support, it helps to keep this plugin up to date and allows further development.
                              <p><h4>Any Commercial use, it`s Donationware:</h4>
                              Because nobody seems to care nowadays, again in short clear words: If you use this Plugin on a webpage with ANY kind of commercial background you need to Donate to use this plugin. No donation, no license, no usage allowed ! Thanks.
                              </p>

                              </div>
                            </ul>
                            <h3>Options<span>[<a href="http://solariz.de/highslide-wordpress-reloaded#options" target="hs4wpHelp">help</a>]</span></h3>
                            <ul>
                            <div>
                                <input id="check1" type="checkbox" name="coralize" DISABLED />
                                <label for="check1" style="color:silver">Use Coral CDN as JS/CSS source</label>
                                <br>(<span style="color: red; font-size: xx-small">Force disabled</span>) Due to problems with Coral CDN this Free CDN Method is now disabled. Caused more problems than it actually helped.
                                I Currently estimate if Highslide Users interested in using a Content Delivery Network (CDN) to improve the load of Highslide. Please take part on this little Poll to give me your <a href="http://polldaddy.com/poll/5843108/">oppinion</a>.<br>
                            </div>
                            <div>
                                <input id="check3" type="checkbox" name="fadeinout" $fadeinout />
                                <label for="check3">Enable Fade In/Out transition in Galleries ?</label>
                            </div>
                            <div>
                                <input id="check2" type="checkbox" name="credits" $credits />
                                <label for="check2">Disable Highslide Credits ?</label>
                            </div>
                            <div>
                                <input id="check4" type="checkbox" name="attachment_filter" checked DISABLED />
                                <label for="check4" style="color:silver">Disable  Highslide on Attachment Images ?</label><br>(<span style="color: red; font-size: xx-small">Since Wordpress 3.x it`s not possible to override the Next Attachment URL so this is currently disabled.</span>)
                            </div>
                            <div>
                                <input id="check5" type="checkbox" name="align_center" $align_center />
                                <label for="check5">Align expanded images to center ?</label>
                            </div>
                            <div>
                                <input id="check6" type="checkbox" name="ext_icon" $ext_icon />
                                <label for="check6">Add ext. Icon to [highslide]*[/highslide] Links ?</label>
                            </div>
                            <div>
                                <input id="check7" type="checkbox" name="handle_swf" $handle_swf />
                                <label for="check7">Handle SWF files auto. as Object in HTML Expander ?</label>
                            </div>
                            <div>
                                <input id="check8" type="checkbox" name="disable_slideshow" $disable_slideshow />
                                <label for="check8">Disable Slideshow functionality.</label>
                            </div>
                            <div>
                                <input id="check9" type="checkbox" name="disable_ipadfix" $disable_ipadfix />
                                <label for="check9">Disable iPad Auto-Fix.</label>
                            </div>
                            <div>
                                <input id="check10" type="checkbox" name="disable_closebutton" $disable_closebutton />
                                <label for="check10">Disable close button on expanded images.</label>
                            </div>
                            <div>
                                <input id="check11" type="checkbox" name="disableJSmin" $disableJSmin />
                                <label for="check11">Disable the use ofJSmin to minify embeded HS JS Code Config</label>
                            </div>
                            <div>
                                <input id="check12" type="checkbox" name="show_thumbstrip" $show_thumbstrip />
                                <label for="check12">Show a bottom Thumbstrip on Galleries</label>
                            </div>
                            <br/>
                            <!-- left aligned input -->
                            <table>
                              <tr>
                                  <td><label for="input1">Slideshow delay: </label></td>
                                  <td><input id="input1" type="text" size="2" name="input1" value="$slideshow_delay" /> seconds</td>
                              </tr>
                              <tr>
                                  <td><label for="select1">HS appearance: </label></td>
                                  <td><select id="select1" name="select1">$hs4wp_select1</select></td>
                              </tr>
                              <tr>
                                  <td><label for="select2">Dimming opacity: </label></td>
                                  <td><select id="select2" name="select2">$hs4wp_select2</select></td>
                              </tr>
                              <tr>
                                  <td><label for="select4">Heading source: </label></td>
                                  <td><select id="select4" name="select4">$hs4wp_select4</select></td>
                              </tr>
                              <tr>
                                  <td><label for="select3">Caption source: </label></td>
                                  <td><select id="select3" name="select3">$hs4wp_select3</select></td>
                              </tr>
                            </table>
                            </ul>
                            <div class="submit"><input type="submit" name="Submit" value="Save options" /></div>
                            <h3>Texts / Language / Translation<span>[<a href="http://solariz.de/highslide-wordpress-reloaded#language" target="hs4wpHelp">help</a>]</span></h3>
                            <ul>
                            <div>
                                <input id="Lcheck1" type="checkbox" name="use_lang" $use_lang />
                                <label for="Lcheck1">Use text below instead of default ?</label>
                            </div>
                                <input type="text" size="60" name="inputL0" value="$hs4wp_langtext[0]" /><i>(<label for="inputL0">Loading...</label>)</i></br>
                                <input type="text" size="60" name="inputL1" value="$hs4wp_langtext[1]" /><i>(<label for="inputL1">Click to cancel</label>)</i></br>
                                <input type="text" size="60" name="inputL2" value="$hs4wp_langtext[2]" /><i>(<label for="inputL2">Click to bring to front</label>)</i></br>
                                <input type="text" size="60" name="inputL3" value="$hs4wp_langtext[3]" title="Click to close image, click and drag to move. Use arrow keys for next and previous." /><i>(<label for="inputL3" title="Click to close image, click and drag to move. Use arrow keys for next and previous.">Click to close image, click...</label>)</i></br>
                                <input type="text" size="60" name="inputL4" value="$hs4wp_langtext[4]" /><i>(<label for="inputL4">Expand to actual size (f)</label>)</i></br>
                                <input type="text" size="60" name="inputL5" value="$hs4wp_langtext[5]" /><i>(<label for="inputL5">Previous</label>)</i></br>
                                <input type="text" size="60" name="inputL6" value="$hs4wp_langtext[6]" /><i>(<label for="inputL6">Next</label>)</i></br>
                                <input type="text" size="60" name="inputL7" value="$hs4wp_langtext[7]" /><i>(<label for="inputL7">Close</label>)</i></br>
                                <input type="text" size="60" name="inputL8" value="$hs4wp_langtext[8]" /><i>(<label for="inputL8">Move</label>)</i></br>
                                <input type="text" size="60" name="inputL9" value="$hs4wp_langtext[9]" /><i>(<label for="inputL9">Close (esc)</label>)</i></br>
                                <input type="text" size="60" name="inputL10" value="$hs4wp_langtext[10]" /><i>(<label for="inputL10">Resize</label>)</i></br>
                                <input type="text" size="60" name="inputL11" value="$hs4wp_langtext[11]" /><i>(<label for="inputL11">Play</label>)</i></br>
                                <input type="text" size="60" name="inputL12" value="$hs4wp_langtext[12]" /><i>(<label for="inputL12">Play slideshow (spacebar)</label>)</i></br>
                                <input type="text" size="60" name="inputL13" value="$hs4wp_langtext[13]" /><i>(<label for="inputL13">Pause</label>)</i></br>
                                <input type="text" size="60" name="inputL14" value="$hs4wp_langtext[14]" /><i>(<label for="inputL14">Pause slideshow (spacebar)</label>)</i></br>
                                <input type="text" size="60" name="inputL15" value="$hs4wp_langtext[15]" /><i>(<label for="inputL15">Previous (arrow left)</label>)</i></br>
                                <input type="text" size="60" name="inputL16" value="$hs4wp_langtext[16]" /><i>(<label for="inputL16">Next (arrow right)</label>)</i></br>
                            </ul>
                            <div class="submit"><input type="submit" name="Submit" value="Save options" /></div>

                            <h3>Advanced Options<span>[<a href="http://solariz.de/highslide-wordpress-reloaded#advanced" target="hs4wpHelp">help</a>]</span></h3>
                            <ul>
                            <div>
                                <input id="Acheck1" type="checkbox" name="only_use_header" $only_use_header />
                                <label for="Acheck1">Force Include of JS Code into Page Header instead of Footer.<br/>
                                <small>Some non API conform Themes require JS loads in the header</small></label>
                            </div>
                            <br/>
                            <div>
                                <input id="Acheck2" type="checkbox" name="ptag_workaround" $ptag_workaround />
                                <label for="Acheck2">Enable &lt;/p&gt; workaround.<br/>
                                <small>If you use lists with multiple [highslide] expander and notice that the breaks between the first expander and second expander are wrong please enable this workaroung. Full explanation <a href="http://solariz.de/forum?wpforumaction=viewtopic&t=132.00">here</a>.</small></label>
                            </div>
                            <br/>
                            <div>
                                <input id="Acheck3" type="checkbox" name="media_icon" $media_icon />
                                <label for="Acheck3">Disable the Highslide Media Icon.<br/>
                                <small>Since 1.14 this Plugin insert a small Media Icon into the WP-WYSIWYG Editor, by checking this you can disable this icon.</small></label>
                            </div>
                            <br/>
                            <div>
                                <input id="Acheck4" type="checkbox" name="useFullJS" $useFullJS />
                                <label for="Acheck4">Use uncompressed JS & CSS instead of the minified version<br/>
                                <small>Should be applied only if some JS / CSS problems occur.</small></label>
                            </div>
                            <br/>
                            <div>
                                <input id="zinput" type="text" size="4" name="zinput" value="$hszIndex" />
                                <label for="zinput"> Z-Index of highslide window.<br/>
                                <small>If neccesary raise this value to make Highslide appear on top. Empty for default (10003).</small></label>
                            </div>
                            <hr>
                            <div>
                                <label for="input2">Use custom <b>highslide.css</b> ?</label><br/>
                                <input id="input2" type="text" size="59" name="input2" value="$custom_css" /><br/>
                                <small>To avoid own CSS changes to be overwritten on Pluginupdate you can specify your own CSS file, please enter full URL. Leave empty for default. e.g.: http://mydomain.com/myhighslide.css</small>
                            </div>
                            <hr>
                            <b>Custom Highslide Config:</b><br/>
                            In this Textbox you can enter Advanced Highslide-JS Parameter. You can find a List of all possible custom Paramteres
                            <a href="http://highslide.com/ref/" target="_blank">here</a>. Each line one Statement.<br/>
                            <textarea id="textarea1" name="textarea1" cols="60" rows="5">$textarea1</textarea><br/>
                            <span style="color:red">Attention!</span>&nbsp;Insert only valid JS code, else it can break the plugin functionality.
                            If you have no clue what HS Parameters are just leave this textbox empty.
                            </ul>
                            <div class="submit"><input type="submit" name="Submit" value="Save options" /></div>
END;

// CDN POLL
echo '<script type="text/javascript" src="http://i0.poll.fm/survey.js" charset="UTF-8"></script>';
echo '<script type="text/javascript" charset="utf-8">';
echo 'var pd_tags = new Array;';
echo "pd_tags['customer_ref'] = '".get_settings('admin_email')."';";
echo "</script>";
echo '<script type="text/javascript" src="http://solariz.de/tmpjs/ws4wp_poll1.js" charset="UTF-8"></script>';



    if(function_exists('is_multisite')) // WP MULTISITE PART
    {
        if( is_multisite() && current_user_can('manage_network') )
        {
echo <<<END
    <h3>Multisite Options<span>[<a href="http://solariz.de/highslide-wordpress-reloaded#multisite" target="hs4wpHelp">help</a>]</span></h3>
    <ul>
    <div>
        Some HS4WP Users asked me to integrate a full Wordpress Multipage support. Well, this section is kind of. I`m never worked with WPMU for myself so its hard to get a full understanding of the different API functions. Also not every function is as well documented as it should. So please see this part currently just as a experimental enhanced workaround. <br />
        <h4>How does it work ?</h4>
        Well you only see this Section if you are in a level of a Networkadmin, normal site admins just see the default HS4WP settings without this part.
       <br/><br/>
        <div>
            <input id="input_wpmuhs4wp" type="checkbox" name="wpmuhs4wp" />
            <label for="input_wpmuhs4wp">Set current settings as Default Networkwide preconfiguration</label>
        </div>
    </div>
    <div class="submit"><input type="submit" name="Submit" value="Save options" /></div>
    </ul>
END;
        }
    }// END OF MULTISITE PART




echo "</form></div></div></div></div></div>";

}
// EOF
