<?php
// Suporte a menus personalizados wp
add_theme_support('nav-menus');


 
// Suporte a thumbnails wp
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 200, 200 ); // tamanho padrao para o thumb



// Dimensoes de thumbs gerados
//add_image_size( 'front-thumb', 300, 9999 ); //300 pixels largura (e altura ilimitada)
add_image_size( 'thumb-220x250', 220, 220, true );
add_image_size( 'thumb-150x150', 150, 150, true );
add_image_size( 'thumb-108x108', 108, 108, true );
add_image_size( 'thumb-72x72', 72, 72, true );
add_image_size( 'thumb-44x44', 44, 44, true );
add_image_size( 'thumb-800x600', 800, 600, true );
add_image_size( 'thumb-640x480', 640, 480, true );
add_image_size( 'thumb-292x156', 292, 156, true );
add_image_size( 'thumb-286x193', 286, 193, true );
add_image_size( 'thumb-244x158', 244, 158, true );
add_image_size( 'ads-292', 292, 9999 ); //292 pixels largura e altura ilimitada


// Substitui a imagem de login no wp-admin
function my_custom_login_logo() {
echo '<style type="text/css">
h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo-wpadmin.png) !important; }
</style>';
}
add_action('login_head', 'my_custom_login_logo');



//Suporte a excerpt em pages 
add_post_type_support( 'page', 'excerpt' );



// Removendo Menus Desnecessarios do Admin
function remove_menu_items() {
	global $menu;
	$restricted = array(__('Posts'),__('Links'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
		unset($menu[key($menu)]);
		}
	}
}
add_action('admin_menu', 'remove_menu_items');



// Remover o xmlrpc se não for usar o live writer on domain.com/xmlrpc.php?rsd
remove_filter('atom_service_url','atom_service_url_filter');



// Limpando o Dashboard
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );



// Removendo os box desnecessarios na edicao
function remove_default_page_screen_metaboxes() {
	//page
	remove_meta_box( 'postcustom','page','normal' );
	remove_meta_box( 'commentstatusdiv','page','normal' );
	remove_meta_box( 'commentsdiv' , 'page' , 'normal' );
	remove_meta_box( 'authordiv' , 'page' , 'normal' );
	remove_meta_box( 'revisionsdiv','page','normal' );
	//post
	remove_meta_box( 'postcustom','post','normal' );
	remove_meta_box( 'revisionsdiv','post','normal' );
}
add_action('admin_menu','remove_default_page_screen_metaboxes');


// Remove palavras negativas do slug automaticamente
add_filter('sanitize_title', 'remove_false_words');
function remove_false_words($slug) {
    if (!is_admin()) return $slug;
    $slug = explode('-', $slug);
    foreach ($slug as $k => $word) {
		//palavras negativas
		$keys_false = 'a,ao,aos,as,ate,da,de,do,das,dos,dum,duma,e,em,es,na,no,nas,nos,num,numa,o,os,que,um,uma';
		$keys = explode(',', $keys_false);
		foreach ($keys as $l => $wordfalse) {
			if ($word==$wordfalse) {
				unset($slug[$k]);
			}
		}
    }
    return implode('-', $slug);
}



// Desativar o WP Frontend Admin Bar
add_filter( 'show_admin_bar', '__return_false' );

	// Remover instruções desnecessárias no wp_head Frontend
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    //remove_action('wp_head', 'start_post_rel_link');
    //remove_action('wp_head', 'index_rel_link');
    //remove_action('wp_head', 'adjacent_posts_rel_link');
	function remove_generator() {
	return '';
}
add_filter('the_generator', 'remove_generator');



// Widgets
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));
?>