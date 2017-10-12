=== Highslide 4 Wordpress *reloaded* ===
Contributors: solariz
Donate link: http://solariz.de/donate
Tags: images, highslide, lightbox, popup, image, slideshow, zoom, imagebox, expander
Requires at least: 2.9
Tested up to: 3.3.1
Stable tag: 1.28


Enable the usage of lates Highslide Features in your Blog, Autoinsert, style Select, HTML Expands, CDN support, optimized for Pagespeed.

== Description ==
This Plugin automatically insert Highslide Script to your Blog without the need of any further configuration
or Shorttags or editing of old posts. As soon the Plugin is activated all existing thumped images using Highslide
to expand. But this isn`t all, the Plugin offers several Options to configure the look and behaviour of Highslide
in your Blog. For Advanced users there is also the option to specify own HS Parameters at the Option page.

Still that`s not all. Some other plugins dealing very dirty with the code of your blog.
Highslide 4 Wordpress *reloaded* is tested and optimized for Pagespeed also it offers a function to use the global
Coral CDN for CSS / JS delivery which, in many circumstances, save you bandwidth and improves page load speed.

As a new Feature, compared to existing Highslide Addons, you have the possibility to use HTML as a Highslide Popup
from within your Articles / Posts. For Example: If you put [highslide]This is a test[/highslide] somewhere in your
text wordpress just renders a link. If somebody click the link a highslide Windows expands showing "This is a test"
You are free to use HTML Tags / Formating inside the tag. Also you can specify a caption and a Linkname; Syntax:
[highslide](Caption;Link Name)Text to display[/highslide] for Example copy and Paste this one into a blogpost:
[highslide](This is the Caption;MyLink)I'm a interesting text, you can also format me or insert pictures.
Feel free to try.[/highslide]

Summary:

* Using latest Highslide Scripts
* Optimized and JS packed
* Optimized HS Graphics
* Possibility to use HTML Expands
* Easy config option
* Advanced setup possible
* optimized to pagespeed and yslow rulesets


== Installation ==

1. Upload the Folder `highslide-4-wordpress-reloaded` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin, Settings -> Highslide 4 Wordpress

== Frequently Asked Questions ==

= Is there a additional Manual ? =
Something like; I put on a detailed page on my website with some detailed information
and a kind of manual / instructions. http://solariz.de/highslide-wordpress-reloaded

= I have a problem or suggestion =
You can find a small Forum related to my Plugins at http://solariz.de feel free to ask.

= Is a commecial use possible ? =
Yes but the Original Highslide Script requires you to buy a official license,
it`s not expensive but this should be mentioned. On my Side I don`t request
money but if you want to use any of my scripts in a commercial way or on a
commecial webpage please check out my amazon wishlist there are several things
from cheap to expensive.   http://solariz.de/donate

== Screenshots ==

1. Plugin Settings
2. Plugin Advanced Options
3. supporting HTML Highslide Windows
4. supporting HS gallery + slideshow
5. choose many styles or set your own in Advanced

== Changelog ==


= 1.28 =
* Fixed missing gallery controls since v1.26
* Added option to enable Thumbstrips at the bottom of Galleries
* Note: The CDN Poll won`t be there forever, just as long I have enough oppinions on this topic.

= 1.27 =
* Fixed a 1.26 introduced bug. Thanks for reporting: damjang, kazancexpert, yakos
* Fixed a small possible PHP-Notice on first time installations

= 1.26 =
* Switched to YUI compressor 2.4.7
* Fixed CSS gray Transition Bug reported by Kiri
* Several minor cleanups
* Removed Coral CDN due to the fact that it isnt working anymore. Please fill in my Poll ( http://poll.fm/3h8kk ) if you are used this option before!
* Tested with WP 3.3.1
* Added JSMin by Douglas Crockford to keep a small footprint of the embeded HS config (can be disabled in settings)

= 1.25 =
* Small fixes for WP 3.3:
* Line 672 Error fixed
* Translated Language not showing up, fixed
* z_Index default to 10003

= 1.24 =
* Hotfix, in 1.23 I used mb_convert_Encoding a function wich only exists in PHP 5.3.x causing a non functional Script in previous PHP Versions. Sorry for this.

= 1.23 =
* Update to latest Highslide revision 4.1.13
* Fixed page dimming problems with iOS and Android
* Removed Flattr API Call in wp-admin
* Hopefully fully Fixed the nasty UTF-8 language encoding Bug
* Fix for wp-admin options dialog. Some Checkbox Settings weren`t saved correctly
* Fixed IE JS warning reported by neverno & friend if using custom language
* Added more descriptive warning on sites using Multi WP and NextGen

= 1.22 =
* Update to latest Highslide revision 4.1.12
* * Fixed IE legacy problems
* * Fixed Ajax loading problem in IE9
* * Fixed dimming in IE9
* CSS now compressed by YUIcompressor 2.4.6 instead of 2.4.2
* Wordpress Multisite Support, read for info: http://bit.ly/mni0m9
* HTML Encoding of Special chars for custom Language is done before saving to DB instead on each pageload. So to update your encoding please go to hs4wp settings and do a save!
* Fixed a bug where special chars in Language could cause a empty string output
* Fixed a bug caused "Heading source" to be ignored (image title)
* Added compatibility warning on enabled NextGen JavaScript Effects
* Added Tweet Button to Config page. Tell others about this Plugin! Thanks
* btw. received some coffee beans, books and tee. Thanks for all Donators !

= 1.21 =
* Added Settings Link to Plugin List Page
* Added Ipad Autodetection and optimized usability for Ipad users
* Added Config Option to force disable ipad optimization
* Added Close Button + Settings option to disable it.
* Corrected some Typos

= 1.20 =
* Fix: Sorry for the fast update but I left some nasty testing stuff active, removed.

= 1.19 =
* New: You can now specify a img url instead a expander text title more details see forum post bit.ly/epstZZ
* Fix: in the new integrated HS JS Files, HS center didnt work probably
* Fix: if using custom language strings I missed to apply a encoding, fixed. Shouldnt break the function anymore on any special chars.

= 1.18 =
* Included new minified JS and CSS files
* Option in Advanced Options to toggle between minified and full JS/CSS version
* Included more Highslide JS lib codes for centering and slideshow
* New config option to configure the text output of the plugin, now you can translate the plugins output as you prefer
* removed CSS Border on hover
* added requirement check of PHP5.x
* changed plugin activation message to appear in admin only
* update to the lic. agreement text
* Workaround for attachment images not working, reported by heliblog 12/10
* added advanced config to manually change the z-index of hs window
* added option to disable slideshow bar

= 1.17 =
* Added admin warning msg if lic. agreement was not accepted
* Upgraded highslide.css
* Update to the readme & faq
* Integrated Flattr Button in the Admin config Page
* Fixed custom conf loading bug mentioned by Juno in the Forum, thx

= 1.16 =
* Upgrade to latest highslide source 1.1.9
* Fixed problems with Google Chrome
* Added IE6 special CSS workaround
* upgrade to img sets
* Tested with WP 3.0.1

= 1.15 =
* fix for HTML expanders in <p> tags, false linebreak shouldn`t occure anymore

= 1.14 =
* Workaround for multiple HTML expander linebreak bug
* Added link tu manual page
* Added "Like It ?" to settings
* Tested up to: 2.9.2
* New Options Page
* Added possibility to add Titel & Caption
* Added Manual / Help Links
* fixed minor bugs

= 1.13 =
* Version No. Change due to sucking Wordpres Version management ;( Changing a simple update on X different locations is a pain in my...

= 1.12 =
* Bugfix: Highslide expands displays title and additional information correct, thanks to Tom
* Bugfix: expands now align text left to right by default

= 1.11 =
* Bugfix: Highslide expands now as it should on integrated WP gallerys
* Bugfix: Highslide expands now as it should on attachment images
* Change: The [highslide] HTML Box now have a larger default width, you can edit the default style in the CSS file. Search for .highslide-html-content
* New: HTML Expand Box description extended you can now manually specify the widht and hight. (Subject;LinkTitle;640;480) will open the windows in 640×480px

= 1.10 =
* Added Option to Force to “only use header” for JS include. Some themes have problems with footer included JS files. reported by Max
* Fix in [highslide] detection
* Include positioning in JS
* Option for highslide to automaticaly align center
* Option to specify Slideshow delay
* Changed some informative links (donate, homepage)
* Adv. use custom Highslide CSS File
* Display ICO Gfx on HTML Expand links

= 1.0 =
* init, first release


== Upgrade Notice ==

= 1.0 =
Initial Version
