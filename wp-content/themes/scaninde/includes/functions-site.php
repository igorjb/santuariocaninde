<?php

//Removendo l1on e jquery padrao do site
add_action( 'init', 'remove_jsjqueryls1on' );
function remove_jsjqueryls1on() {
if ( !is_admin() ) {
    wp_deregister_script('jquery');
	wp_deregister_script('l10n');
  }
}

/*
//Adiciona rel=lightbox a todos os links para imagens nos posts
add_filter('the_content', 'my_addlightboxrel');
function my_addlightboxrel($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 rel="lightbox" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}
*/



//Registrando Sidebar	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'sidebar',
	'before_widget' => '<div class="sidebar-box">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

// Pagination
function webpagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;
     global $paged;

     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;

         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";

         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";

         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}



//Funcao para Extrair ultimo termo selecionado de uma taxonomia referente a um post
//extraiUltimoTermoPost ($post->id, 'nome-taxonomia')
function extraiUltimoTermoPost($id,$taxonomia)
{
	$terms = get_the_terms( $id, $taxonomia );
	if ( ($terms) && (! is_wp_error($terms))) {
		$draught_links = array();
		foreach ($terms as $term) {
			$draught_links[] = $term->name;
		}
		$tam_vetor = count($draught_links)-1;
		echo $draught_links[$tam_vetor]; //mostra somente o ultimo termo
	}
}



//Funcao para EXTRAIR TODOS OS TERMOS DE UM POST
//extraiTodosTermosPost ($post->id, 'nome-taxonomia')
function extraiTodosTermosPost($id,$taxonomia)
{
	$termos = get_the_terms( $id, $taxonomia );

	if ( ($termos) && (! is_wp_error($termos))) {

		$vetor_termos = array();

		$lista_termos 		= '<ul class="post-termos">';
		foreach ($termos as $termo) {
			$lista_termos 	.= '<li>'.$termo->name.'</li>';
		}
		$lista_termos 		.= '</ul>';

		echo $lista_termos; //mostra todos os termos

	}
}



//Funcao para EXTRAIR TODOS OS TERMOS DE UMA TAXONOMIA
//extraiTodosTermosTax ('nome-taxonomia',0)
function extraiTodosTermosTax($taxonomia,$quantidade)
{

	$taxonomy     = $taxonomia;
	$orderby      = 'name';
	$show_count   = 1;      // 1 para sim, 0 para não
	$pad_counts   = 1;      // 1 para sim, 0 para não
	$hierarchical = 1;      // 1 para sim, 0 para não
	$title        = '';
	$empty        = 1; 		// 1 para sim, 0 para não
	$number		  = $quantidade; // 0 - exibe todos
	
	$args = array(
	  'taxonomy'     => $taxonomy,
	  'orderby'      => $orderby,
	  'show_count'   => $show_count,
	  'pad_counts'   => $pad_counts,
	  'hierarchical' => $hierarchical,
	  'title_li'     => $title,
	  'hide_empty'   => $empty,
	  'number'   => $number
	);

	echo '<ul>';
	wp_list_categories( $args );
	echo '</ul>';
}



// Verifica se post é descendente de uma determinada categoria

function post_is_in_descendant_category( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');

		if ( $descendants && in_category( $descendants, $_post ) )
		return true;
	}
return false;
}



// Limitar os caracteres do post (pega introducao e insere reticencias)
// Como usar, basta inserir na listagem o codigo abaixo
/* <?php limit_chars($post->post_content, $length = 120); ?> */

function limit_chars($content, $length)
{
	$content = strip_shortcodes( $content );
	$content = apply_filters('the_content', $content);
	$content = strip_tags($content);

	if(strlen($content) > $length)
	{
		$content = substr($content, 0, $length);
		$content = substr($content, 0, strrpos($content, " "));
	}

	print $content;
}



// webbreadcrumbs
function webbreadcrumbs() {

	$delimiter = '&raquo;';
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb

	if ( !is_home() && !is_front_page() || is_paged() ) {

		echo '<div class="breadcrumb">';

		global $post;

		_e('<a href="'.SITE_URL.'" title="Início">Início</a> ', 'Website');
		echo $delimiter.' ';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);

			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before;
			echo single_cat_title('', false).$after;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {

			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {

			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {

			if ( get_post_type() != 'post' ) {

				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;

			} else {

				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {

			echo $before . 'Tópico "' . single_tag_title('', false) . '"' . $after;

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {

			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {

			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {

			echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {

			$parent_id  = $post->post_parent;
			$breadcrumbs = array();

			while ($parent_id) {

				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;

			}

			$breadcrumbs = array_reverse($breadcrumbs);

			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';

			echo $before . get_the_title() . $after;

		} elseif ( is_search() ) {

			echo $before;
			_e ('Resultado da busca por ', 'Website');
			echo get_search_query() . '"' . $after;

		} elseif ( is_author() ) {

			global $author;
			$userdata = get_userdata($author);
			echo $before;
			_e ('Artigos postados por ', 'Website');
			echo $userdata->display_name . $after;

		} elseif ( is_404() ) {

			echo $before . 'Error 404' . $after;

		}

		if ( get_query_var('paged') ) {

			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';

		}

		echo '</div>';
	}
}



//Function para 'Galeria Destaque'
function galfotos() {

	global $post;
	$imgs 		 = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
	$num_de_imgs = count($imgs)+1;
	$inicio		 = 0;
	$pare 		 = 12; //Limite de fotos a ser exibido.

	$i = 1;
	foreach ($imgs as $img) { //Loop nas imgs do post
		if ($inicio <= $i and $i <= $pare) {
			$img_title 			= $img->post_title;   // titulo
			$img_description 	= $img->post_content; // descricao
			$img_caption 		= $img->post_excerpt; // caption
			$img_url 			= wp_get_attachment_url($imagem->ID); // url da imagem full
			$img_thumb_array 	= image_downsize( $img->ID, 'thumb-40x40' );
			$img_thumb 			= $img_thumb_array[0]; // thumbnail
			$img_ampliada_array = image_downsize( $img->ID, 'thumb-370x205' );
			$img_ampliada 		= $img_ampliada_array[0]; // imagem ampliada
			$html_fts_panes 	.= '<div><img src="'.$img_ampliada.'" alt="'.$img_title.'" /></div>';
			$html_fts_nav 		.= '<li><a href="#'.$i.'"><img src="'.$img_thumb.'" /></a></li>';
		}
		$i++;
	}

	//HTML Galeria
	$html_galeria .= '<div id="galeria">';
		//Html panes
		$html_galeria .= '	<!-- tab panes -->
							<div id="panes">
								'.$html_fts_panes.'
							</div>';
		//Html navigator
		$html_galeria .= '	<!-- navigator -->
							<div id="nav">
								<ul>
								'.$html_fts_nav.'
								</ul>
							</div>';
	$html_galeria .= '</div>'; 
	//Fim HTML galeria
	
	//Retorna o html_galeria montado
	echo $html_galeria;
}



//Função para exibir X custom posts relacionados por alguma taxonomia
//Ex: relacionados_por_cp_tax('Notícias relacionadas','cpnoticias','topico',5);
function relacionados_por_cp_tax($titulo,$custom_post,$taxonomia,$num_posts,$tam_thumb){
	global $post;

	//Get the terms for the current post
	$terms = get_the_terms( $post->ID , $taxonomia, 'string');

	if ($terms) {
		$potentials = array();
		$c = 0;
		$totalFound = 0;

		//Gather your posts for each term
		foreach($terms as $term){     //changed to $term
		   $term_name = $term->slug;  //new
		   $q = array(
			'topico' => $term_name, //term to retrieve from custom taxonomy
			'numberposts' => $num_posts,  //limit posts
			'post_type' => $custom_post, //get only posts
			'exclude' => $post->ID //exclude current post
		   );
		   $posts = get_posts($q);
		   $totalFound+= count($posts);
		   $potentials[$c++] = array_reverse($posts); //reverse the array so 'pop' grabs the 'first' element
		}
	}

	//Html inicial
	if ($totalFound) {
		echo '<div class="posts-sidebar">
				<strong>'.$titulo.'</strong>
				<ul>';
	}
	
	$count = 0;  //The number of good posts we've found

	$index = 0;  //Number of posts we've tried
	$max = $totalFound > 4 ? 4 : $totalFound;  //The max we can find
	$posts = array();

	//Now pick one post from each term until we reach our quota,
	//or have checked them all
	while($count < $max){

	  //Pop off a post to use
	  $rpost = array_pop($potentials[$index++]);

	  //if we got a post (if there was one left)
	  if($rpost){
		//don't take duplicates
		if(!isset($posts[$rpost->ID])){
		  $posts[$rpost->ID] = $rpost;
		  $count++;
		}
	  }
	  $index = ($index % count($terms)); //rotate through the n term arrays
	}

	foreach($posts as $rpost){
		//print your related posts
		$permalink = get_permalink( $rpost->ID );
		$titulo	 = $rpost->post_title;
		$thumb	 = get_the_post_thumbnail( $rpost->ID, $tam_thumb );
		//$excerpt = $rpost->post_excerpt;
	  
		echo 	'<li>
					<a href="'.$permalink.'" title="'.$titulo.'">
						'.$thumb.$titulo.'
					</a>
				</li>';
	}
	//Finaliza html
	if ($totalFound) {
		echo '</ul>
		</div>';
	}
}



//Functions referentes a contagem de visitas nos posts

	//Pega e exibe o numero de visualizações
	function getPostViews($postID){
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 Visualização";
		}
		return $count.' Visualizações';
	}

	//Conta +1 visita para o post
	function setPostViews($postID) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}



//Function 'Posts mais Visualizados'
function cp_posts_mais_vistos($titulo,$custom_post_escolhido,$num_posts,$tam_thumb) {

	global $post;
	$query = new WP_Query( 'post_type='.$custom_post_escolhido.'&meta_key=post_views_count&orderby=meta_value_num&posts_per_page='.$num_posts.'&order=DESC' );
	
	//Titulo
	if ($query->have_posts()) {
		echo '<div class="posts-sidebar">
			<strong>'.$titulo.'</strong>
				<ul>';
		// The Loop
		while ( $query->have_posts() ) : $query->the_post();
			$permalink = get_permalink( $post->ID );
			$titulo	 = $post->post_title;
			$thumb	 = get_the_post_thumbnail( $post->ID, $tam_thumb );
			//$excerpt = $post->post_excerpt;
		  
			echo 	'<li>
						<a href="'.$permalink.'" title="'.$titulo.'">
							'.$thumb.$titulo.'
						</a>
					</li>';
		endwhile;
		
		echo '</ul>
		</div>';
	}
		
	// Reset Post Data
	wp_reset_postdata();
}



//Function 'Santuario Informa'
function santuario_informa($titulo,$num_posts) {

	global $post;
	$query = new WP_Query( 'post_type=cpsantinfo&orderby=rand&posts_per_page='.$num_posts );
	
	//Titulo
	if ($query->have_posts()) {
		echo '	<strong>'.$titulo.'</strong>';
		// The Loop
		while ( $query->have_posts() ) : $query->the_post();
			if ( get_post_meta($post->ID, 'ecpt_txtanuncio', true) ) :
				$txtanuncio = get_post_meta($post->ID, 'ecpt_txtanuncio', true);
				$urldestinf = get_post_meta($post->ID, 'ecpt_urldestinf', true);
				echo '<div><a href="'.$urldestinf.'" title="'.$txtanuncio.'">'.$txtanuncio.'</a></div>';
			endif;
		endwhile;
	}
		
	// Reset Post Data
	wp_reset_postdata();
}


?>