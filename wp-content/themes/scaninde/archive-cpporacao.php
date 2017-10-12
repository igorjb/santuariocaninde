<?php get_header(); ?>

	<hr />

	<div id="content"> 
		<div class="container"> 
			<?php if (function_exists('webbreadcrumbs')) { ?><?php webbreadcrumbs(); ?><?php } ?>

			<div id="content-page">
				<h1 class="page-title"><a href="/pedidos-oracao/" title="Fotos">Pedidos de Oração</a></h1>
			
				<p><br /><br />
				<a href="/benfeitores/pedido-oracao/" title="Faça o seu pedido de oração"><img src="<?php echo SITE_TEMPLATEURL; ?>/images/bt-pedoracao.gif" alt=" o seu pedido de oração" /></a><br /><br />
				Abaixo teremos algumas pessoas que já nos enviaram seus pedidos. Junte-se a nós intercedendo também por eles.
				</p>
			
				<?php if (have_posts()) : $count = 0; ?>
				<ul class="archive-fotos"> 
					<?php
					while (have_posts()):the_post();
						$titulo	 	= get_the_title();
						$cidade		= get_post_meta($post->ID, 'ecpt_cidade', true);
						$uf			= get_post_meta($post->ID, 'ecpt_uf', true);
					?> 
							<li class="post-box">
								<?php 
								echo '<span class="ped-oracao"><img src="'.SITE_TEMPLATEURL.'/images/vela-anim.gif" />';
								echo '<strong>'.$titulo.'</strong><br />
								'.$cidade.'-'.$uf.'
								</span>';
								?>
							</li>
					<?php
					endwhile;
					?>
				</ul>
				<?php
				endif;
				?>

				<div class="content-pagination">
					<?php if (function_exists('webpagination')) { ?><?php webpagination(); ?><?php } ?>
				</div> 
			</div> <!--content-archive-->
			
			
			<div id="sidebar">
				<?php get_sidebar(); ?>
			</div> <!-- sidebar -->
			
		</div> <!-- container -->
</div> <!-- content -->

<hr />

<?php get_footer(); ?>