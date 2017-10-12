<?php get_header(); ?>
<hr />
<div id="content">
	<div class="container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php
				//Conta visualização
				setPostViews($post->ID);
			 
				// breadcrumb
				if (function_exists('webbreadcrumbs')) { webbreadcrumbs(); } 
			?>

			<div id="content-page"> 
				<strong class="cat-title"><a href="/videos-catolicos/" title="Vídeos Católicos">Vídeos Católicos</a></strong>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<div class="post-info"><small>Publicado em: <?php the_time('d/m/Y'); ?></small></div>
				<?php include_once "includes/incl_compartilhe.php"; ?>
				<?php the_content(); // o conteudo do post ?>
				<?php wp_link_pages('before=<p><strong>Páginas complementares deste artigo: </strong>&after=</p>&next_or_number=number'); ?>
				<div class="post-comments">
					<h2 id="comments"><?php comments_number(__('Seja o primeiro a comentar','Website'), __('1 Comentário','Website'), '% '.__('Comentários','Website') ); ?>
					<?php if ( comments_open() ) : ?>
						<a href="#postcomment" title="<?php _e("Deixe um comentário", "Website"); ?>">&raquo;</a>
					<?php endif; ?>
					</h2>
					<!-- Comentarios  -->
					<?php comments_template( $file, $separate_comments ); ?>
				</div> <!-- post-comments -->
			</div> <!-- content page -->
			
			<div id="sidebar">
				<?php cp_posts_mais_vistos('Vídeos Mais Visitados','cpvideocat',5,'thumb-44x44') ?>
				<?php relacionados_por_cp_tax('Vídeos Relacionados','cpvideocat','topico',5,'thumb-44x44'); ?>
				<?php get_sidebar(); ?>
			</div> <!-- sidebar -->

		<?php endwhile; else: ?>
			<p><?php _e("Nenhuma artigo encontrado.", "Website"); ?></p>
		<?php endif; ?>

		</div> <!-- container -->
</div> <!-- content -->

<?php get_footer(); ?>