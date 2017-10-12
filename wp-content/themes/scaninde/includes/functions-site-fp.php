<?php 

//Function lista Notícias Destaque
function fp_notdstqs($custompost,$num_posts,$tam_thumb) {

	global $post;
	$query = new WP_Query( 'post_type='.$custompost.'&order=DESC&posts_per_page='.$num_posts );
	
	//Titulo
	if ($query->have_posts()) {
		//The Loop
		while ( $query->have_posts() ) : $query->the_post();
				$permalink = get_permalink( $post->ID );
				$titulo	 = $post->post_title;
				$thumb	 = get_the_post_thumbnail( $post->ID, $tam_thumb );
				$excerpt = $post->post_excerpt;
				$i=$i+1;
			  
				//abas
				if ($i==1) { $html_abas .= '<li class="active">'; } else { $html_abas .= '<li>'; }
				$html_abas	.=	'<a href="'.$permalink.'" title="'.$titulo.'">
									<strong>'.$titulo.'</strong>
								</a>
								</li>';
						
				//conteudos noticias destaques
				$html_dstqcontent .= '<!-- page #'.$i.' - noticia destaque '.$i.' -->
						<div class="pager aba-destaque'.$i.'">
							<!-- sub navigator #'.$i.' -->
							<div class="navi"></div>
							<!-- inner scrollable #'.$i.' -->
							<div class="scrollslide">
								<!-- root element for scrollable items -->
								<div class="items">
									<!-- items  -->
									<div class="item">
										<a href="'.$permalink.'" title="'.$titulo.'">
										'.$thumb.'<strong>'.$titulo.'</strong>
										<span>
									'.$excerpt.'...</span></a>
									</div> <!-- item -->
								</div> <!-- items -->
							</div> <!-- scrollslide -->
						</div> <!-- pager -->';
						
		endwhile;
		
			echo '	
			<div class="fp-slide">
				
				<div class="navprinc">
					<!-- main navigator - abas -->
					<ul class="main_navidstq">
						'.$html_abas.'
					</ul>
					<a href="/noticias-destaques/" class="mais-dtsqs" title="Mais destaques">Mais destaques »</a>
 				</div>

				<!-- root element for the main scrollable - conteudo abas --> 
				<div class="maindstq">

					<!-- root element for pages -->
					<div class="pages">

						'.$html_dstqcontent.'
						
					</div> <!-- pages -->
				</div> <!-- main -->
			</div> <!-- fp-slide -->';
			
			
	} else {
		echo '<div class="item">
			Nenhum item inserido até o momento.
		</div>';
	}
		
	//Reset Post Data
	wp_reset_postdata();
}



//Function 'FP Banner Destaques'
function fp_banner_destaques($num_posts) {

	global $post;
	$query = new WP_Query( 'post_type=destbanner&orderby=rand&posts_per_page='.$num_posts );
	
	//Titulo
	if ($query->have_posts()) {
		echo '<ul class="bnrdstqs">';
		// The Loop
		while ( $query->have_posts() ) : $query->the_post();
			if ( get_post_meta($post->ID, 'ecpt_imgbnrdstq', true) ) :
				$i = $i+1;
				$txtchmddstq = get_post_meta($post->ID, 'ecpt_txtchmddstq', true);
				$urldestdstq = get_post_meta($post->ID, 'ecpt_urldestdstq', true);
				$imgbnrdstq  = get_post_meta($post->ID, 'ecpt_imgbnrdstq', true);
				echo '<li class="bnrdstq_'.$i.'"><a href="'.$urldestdstq.'" title="'.$txtchmddstq.'"><img src="'.$imgbnrdstq.'" alt="'.$txtchmddstq.'"><br />'.$txtchmddstq.'</a></li>';
			endif;
		endwhile;
		echo '</ul>';
	}
		
	// Reset Post Data
	wp_reset_postdata();
}



//Function lista 'Custom post'
function cp_news($custompost,$num_posts,$tam_thumb) {

	global $post;
	$query = new WP_Query( 'post_type='.$custompost.'&order=DESC&orderby=ID&posts_per_page='.$num_posts );
	
	//Titulo
	if ($query->have_posts()) {
		//The Loop
		while ( $query->have_posts() ) : $query->the_post();
				$permalink = get_permalink( $post->ID );
				$titulo	 = $post->post_title;
				$thumb	 = get_the_post_thumbnail( $post->ID, $tam_thumb );
				$excerpt = $post->post_excerpt;
			  
				echo 	'<div class="item">
							<a href="'.$permalink.'" title="'.$titulo.'">
								'.$thumb.'<strong>'.$titulo.'</strong>
								<span>';
								limit_chars($excerpt,85);
				echo	'...</span></a>
						</div>';
		endwhile;
	} else {
		echo '<div class="item">
			Nenhum item inserido até o momento.
		</div>';
	}
		
	//Reset Post Data
	wp_reset_postdata();
}



//Function 'FP Peça a Sua Oração'
function fp_oracao($num_posts) {

	global $post;
	$query = new WP_Query( 'post_type=cpporacao&orderby=rand&posts_per_page='.$num_posts );
	
	//Titulo
	if ($query->have_posts()) {
	
		echo '<ul>';
		// The Loop
		while ( $query->have_posts() ) : $query->the_post();
				$i = $i+1;
				$txtnome 	= $post->post_title;
				$txtcidade 	= get_post_meta($post->ID, 'ecpt_cidade', true);
				$txtuf		= get_post_meta($post->ID, 'ecpt_uf', true);
				$txtpedido	= get_post_meta($post->ID, 'ecpt_pedido', true);
				echo '<li>';
				echo '<a href="/benfeitores/pedido-oracao/" title="Peça a sua oração">
					<strong>Peça a sua Oração</strong><br />
					<span>';
					limit_chars($txtpedido, 80);
				echo '...<br />
					<b>';
					limit_chars($txtnome,30);
				echo '</b><br />
					'.$txtcidade.'-'.$txtuf.'
					</span>
				</a>';
				echo '</li>';
		endwhile;
		echo '</ul>';
		
	}
		
	// Reset Post Data
	wp_reset_postdata();
}



//Function 'FP Publicidade'
function fp_public($num_posts) {

	global $post;
	$query = new WP_Query( 'post_type=adbanner&orderby=rand&posts_per_page='.$num_posts );
	
	//Titulo
	if ($query->have_posts()) {
	
		echo '<ul>';
		// The Loop
		while ( $query->have_posts() ) : $query->the_post();
				$i = $i+1;
				$imgbanner 	= get_post_meta($post->ID, 'ecpt_imgbanner', true);
				$flashbanner 	= get_post_meta($post->ID, 'ecpt_flashbanner', true);
				$txturl		= get_post_meta($post->ID, 'ecpt_urldestino', true);
				
				if ( get_post_meta($post->ID, 'ecpt_imgbanner', true) ) { //banner é imagem
					$html_banner = '<a href="'.$txturl.'">
										<img src="'.$imgbanner.'" />
									</a>';
				} else { //banner é em flash
					if ( get_post_meta($post->ID, 'ecpt_flashbanner', true) ) {
						$html_banner = '<script type="text/javascript">embeds("'.$flashbanner.'", 292, 106);</script>';
					}
				}
				
				
				echo '<li>';
				echo $html_banner;
				echo '</li>';
		endwhile;
		echo '</ul>';
		
	}
		
	// Reset Post Data
	wp_reset_postdata();
}



//Function 'FP Chamadas'
function fp_chamadas($num_posts) {

	global $post;
	$query = new WP_Query( 'post_type=cpchamadas&posts_per_page='.$num_posts );
	
	//Titulo
	if ($query->have_posts()) {
	
		echo '
	<!-- "previous page" action -->
	<a class="anterior browse left"></a>

	<!-- root element for scrollable -->
	<div class="scrollchamadas">   
	   
	   <!-- root element for the items -->
	   <div class="items">
			<div>
				<ul>
		';
		// The Loop
		$i				= 0;
		$prox_div_ini 	= 6;

		while ( $query->have_posts() ) : $query->the_post();

			//finaliza e inicia nova div e soma + 8
			if ($i == $prox_div_ini) {
				$prox_div_ini = $prox_div_ini+8;
				echo '
					</ul>
				</div>
				<div>
					<ul>';
			}
				$txttitle 	= $post->post_title;
				$txtchmd	= get_post_meta($post->ID, 'ecpt_txtchmd', true);
				$urlchmd	= get_post_meta($post->ID, 'ecpt_urlchmd', true);
				$imgchmd	= get_post_meta($post->ID, 'ecpt_imgchmd', true);
				echo '<li><a href="'.$urlchmd.'" title="'.$ecpt_txtchmd.'"><img src="'.$imgchmd.'" alt="'.$txtchmd.'"/><span>'.$txttitle.'</span></a></li>';
				$i = $i+1;
		endwhile;
		echo '		</ul>
				</div>
				  
			   </div>
			   
			</div>

			<!-- "next page" action -->
			<a class="proxima browse right"></a>

			<br clear="all" />';
		
	}
		
	// Reset Post Data
	wp_reset_postdata();
}
?>