<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
<title><?php
if ( is_front_page() )
{
echo SITE_NAME;
echo ' - '; //separador
bloginfo('description');
}
else // nao eh pagina inicial
{
if (is_page() || is_category() || is_single()) {
if (!is_category()) {
echo get_the_title();
}
if (is_category()) {
$category = get_the_category();
echo $category[0]->cat_name;
}
$post_ancestors = get_post_ancestors($post->ID);
$post_ancestors = array_reverse($post_ancestors);
if ($post_ancestors[0]) {
$titulo_novo0 = ' « '.get_the_title($post_ancestors[0]);
}
if ($post_ancestors[1]) {
$titulo_novo1 = ' « '.get_the_title($post_ancestors[1]);
}
if ($post_ancestors[2]) {
$titulo_novo2 = ' « '.get_the_title($post_ancestors[2]);
}
if ($post_ancestors[3]) {
$titulo_novo3 = ' « '.get_the_title($post_ancestors[3]);
}
if ($post_ancestors[4]) {
$titulo_novo4 = ' « '.get_the_title($post_ancestors[4]);
}
if ($titulo_novo4) {
echo $titulo_novo4;
} else {
	if ($titulo_novo3) {
		echo $titulo_novo3;
	} else {
		if ($titulo_novo2) {
			echo $titulo_novo2;
		} else {
			if ($titulo_novo1) {
				echo $titulo_novo1;
			} else {
				if ($titulo_novo0) {
					echo $titulo_novo0;
				}
			}
		}
	}
}
}
if (is_tax('topico')) { //categoria é uma taxonomia dos pacotes
echo 'Tópico: ';
}
if (is_singular()) {
	if (is_singular('cpnoticias')) {
	echo ' « Notícias';
	}
	if (is_singular('cpfotos')) {
	echo ' « Fotos';
	}
	if (is_singular('cpjornal')) {
	echo ' « Jornal do Santuário';
	}
	if (is_singular('cpporacao')) {
	echo ' « Pedido de Oração';
	}
	if (is_singular('cpvideos')) {
	echo ' « Vídeos';
	}
	if (is_singular('cpcanticos')) {
	echo ' « Cânticos e Louvores';
	}
}
if (is_archive()) {
wp_title( ' ', true, 'right' );
}
if ( is_search() ) {
_e('Resultado da pesquisa por ->', 'HPF');  /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(' '); echo $key; _e(' - '); echo $count . ' ';
_e('registros', 'HPF'); wp_reset_query(); }
if ( is_404() ) {
_e('Erro 404 - Página Não Encontrada', 'HPF');
}
if ( get_query_var('paged') ) {
if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
echo __('Page') . ' ' . get_query_var('paged');
if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
}
echo ' | Santuário de Canindé';
}
?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	<meta name="language" content="pt-br" />
	<?php
	if (is_front_page()) {
	?>
		<meta name="description" content="Portal do Santuário de Canindé, informações sobre a paróquia, romaria, missas, história, fotos, vídeos e mais" />
	<?php
	} else {
		if (is_page() || is_single()) {
		$post_data = get_post( $post->ID ); // pega o conteudo do post
		$excerpt = apply_filters('excerpt', $post_data->post_excerpt); // pega o excerpt
			if ($excerpt) {
	?>
			<meta name="description" content="<?php echo $excerpt; ?>" />
	<?php
			}
		}
	}
	?>
	<meta content="IE=8" http-equiv="X-UA-Compatible" />
	<link rel="alternate" type="application/rss+xml" title="<?php echo SITE_NAME; ?> RSS Feed" href="http://feeds.feedburner.com/arqfortaleza" />
	<link rel="alternate" type="application/atom+xml" title="<?php echo SITE_NAME; ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="icon" href="<?php echo SITE_TEMPLATEURL; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
	<link rel="icon" href="<?php echo SITE_TEMPLATEURL; ?>/favicon.ico" type="image/x-icon" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATEURL; ?>/js/default.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATEURL; ?>/js/jquery.tools.min.js" type="text/javascript"></script>
	<style type="text/css" media="screen">
	@import "<?php echo SITE_STYLESHEET; ?>";
	.primeiroplano {
	color:#fff;
	}
	</style>
	<style type="text/css" media="print">
	@import "<?php echo SITE_TEMPLATEURL; ?>/print.css";
	.primeiroplano {
	color:#fff;
	}
	</style>
	<!--[if IE 7]><link href="<?php echo SITE_TEMPLATEURL; ?>/ie7.css" rel="stylesheet" type="text/css" /><![endif]-->


	<script type="text/javascript">
	$(document).ready(function(){

		$("ul.sub-menu").parent().append("<span></span>"); //menu dropdown

		$("ul.menu li span").click(function() { //quando gatilho é clicado...

			//Movimento cima e baixo do submenu
			$(this).parent().find("ul.sub-menu").slideDown('fast').show(); //Drop down the subnav on click

			$(this).parent().hover(function() {
			}, function(){
				$(this).parent().find("ul.sub-menu").slideUp('normal'); //quando o mouse é retirado,o submenu é oculto
			}); 

			//Seguindo eventos aplicados ao gatilho
			}).hover(function() {
				$(this).addClass("subhover"); //Quando comportamento hover, aplica classe
			}, function(){	//Quando sai o hover
				$(this).removeClass("subhover"); //Remove classe "subhover"
		});

	});
	</script>

	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-27671769-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
	
<!-- Header Wordpress -->
<?php wp_head(); ?>

	
</head>
<body <?php	body_class() ?>>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=203468683071795";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
 
<div id="general">
	<div id="bar-top">
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</div>
	<div id="bg">
		<div id="header">
			<div class="container">
				<span class="header-skip"><a href="#content" title="<?php _e('Pular para o conteúdo', 'Website'); ?>"><?php _e("Pular para o conteúdo", "Website"); ?></a></span>
				<span class="logo"><a href="/" title="<?php echo SITE_NAME; ?>"><?php echo '<img src="'.SITE_TEMPLATEURL.'/images/h-logo.jpg" alt="'.SITE_NAME.'" />'; ?></a></span>
				<?php wp_nav_menu(array('menu' => 'cabecalho', 'container_class' => 'menu-header')); ?>
			</div>
		</div> <!-- header -->