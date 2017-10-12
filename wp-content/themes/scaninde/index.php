<?php get_header(); ?>

	<hr />

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
		<!-- Exibe o conteudo -->
		<div id="content">
			<div class="container">
		
			<?php if (function_exists('webbreadcrumbs')) { ?><?php webbreadcrumbs(); ?><?php } ?>

		  <div id="conteudo_post">
			
			<small><?php _e("Publicado em", "Website"); ?> <?php the_time('d/m/Y'); ?> <?php _e("por", "Website"); ?> <?php the_author(); ?></small>
			
			<h2><?php the_title(); ?></h2>

			<?php the_content(); // o conteudo do post ?>
			
			<?php wp_link_pages('before=<p><strong>Páginas complementares deste artigo: </strong>&after=</p>&next_or_number=number'); ?>
			
			<ul class="options">
				<li class="oimprimir"><a onclick="javascript:window.print();" onkeypress="javascript:window.print();" title="<?php _e("Na impressão somente texto e imagens do artigo serão impressos", "Website"); ?>" href="#"><?php _e("Imprimir", "Website"); ?></a></li>
			</ul>
			
		<!-- Comentarios  -->
		<?php comments_template( $file, $separate_comments ); ?>


		<?php //posts relacionados via tag
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

				/*
				if ($parent=='5') { //noticias
					$categoria_relacionada='Dicas';
				}
				
				if ($parent=='6') { //dicas
					$categoria_relacionada='Noticias';
				}
				*/
				
				$args=array(
					'tag__in' => $tag_ids,
					'post__not_in' => array($post->ID),
					'showposts'=>3, // Quantidade de itens na lista
					'caller_get_posts'=>1
					//'category_name'=>$categoria_relacionada
				);
				$my_query = new wp_query($args);
				if( $my_query->have_posts() ) {
					echo '<div id="relacionados">';
				?>
						<h2><?php _e("Artigos Relacionados", "Website"); ?></h2><ul>';
				<?php
					while ($my_query->have_posts()) {
						$my_query->the_post();
					?>
						<li><?php the_time('d/m/Y'); ?> - <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
					<?php
					}
					echo '</ul></div>';
				}
			}
		?>
		
	</div> <!-- conteudo post -->
	
  <?php get_sidebar(); ?>
  
		<?php endwhile; else: ?>

			<p><?php _e("Nenhuma artigo encontrado.", "Website"); ?></p>

		<?php endif; ?>
	</div>
</div> <!-- fim content -->		

<?php get_footer(); ?>