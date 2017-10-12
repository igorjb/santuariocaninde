<?php get_header(); ?>

	<hr />

	<div id="content"> 
		<div class="container"> 
			<?php if (function_exists('webbreadcrumbs')) { ?><?php webbreadcrumbs(); ?><?php } ?>

			<div id="content-page">
				<h1 class="page-title"><a href="/videos-webtv/" title="Vídeos Web TV">Vídeos Web TV</a></h1>
			
				<?php if (have_posts()) : $count = 0; ?>
				<ul class="archive-fotos"> 
					<?php
					   while (have_posts()):the_post();
						$permalink 	= get_permalink();
						$titulo	 	= get_the_title();
						$thumb	 	= get_the_post_thumbnail( $post->ID, 'thumb-292x156' );
						$excerpt 	= $post->post_excerpt;
					?> 
							<li class="post-box">
								<?php 
								echo '<a href="'.$permalink.'" title="'.$titulo.'">';
								if ( has_post_thumbnail() ) 
								{ 
									echo $thumb;
								} 
								echo '<strong>'.$titulo.'</strong></a>';
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
				<?php cp_posts_mais_vistos('Vídeos Mais Visitados','cpwebtv',5,'thumb-44x44') ?>
				<?php get_sidebar(); ?>
			</div> <!-- sidebar -->
			
		</div> <!-- container -->
</div> <!-- content -->

<hr />

<?php get_footer(); ?>