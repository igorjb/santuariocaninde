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
				<strong class="cat-title"><a href="/canticos-e-louvores/" title="Cânticos e Louvores">Cânticos e Louvores</a></strong>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php include_once "includes/incl_compartilhe.php"; ?>
				<?php
				//Audio Player
				if ( get_post_meta($post->ID, 'ecpt_filelouvor', true) ) :
					$audiofile = get_post_meta($post->ID, 'ecpt_filelouvor', true);
					echo '<div class="meta-audio"><span>Clique em Play para reproduzir o áudio</span><embed type="application/x-shockwave-flash" flashvars="audioUrl='.$audiofile.'" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="27" quality="best" wmode="transparent"></embed></div>';
				endif;
				?>
				<br />
				<?php the_content(); // o conteudo do post ?>
				<?php wp_link_pages('before=<p><strong>Páginas complementares deste artigo: </strong>&after=</p>&next_or_number=number'); ?>
			</div> <!-- content page -->
			
			<div id="sidebar">
				<?php cp_posts_mais_vistos('Cânticos Mais Visitados','cpcanticos',5,'thumb-44x44') ?>
				<?php get_sidebar(); ?>
			</div> <!-- sidebar -->

		<?php endwhile; else: ?>
			<p><?php _e("Nenhuma artigo encontrado.", "Website"); ?></p>
		<?php endif; ?>

		</div> <!-- container -->
</div> <!-- content -->

<?php get_footer(); ?>