<?php get_header(); ?>

	<hr />

	<div id="content"> 
		<div class="container"> 
			<?php if (function_exists('webbreadcrumbs')) { ?><?php webbreadcrumbs(); ?><?php } ?>

			<div id="content-page">
				<h1 class="page-title"><a href="/mensagens-reitor/" title="Mensagens do Reitor">Mensagens do Reitor</a></h1>
			
				<?php if (have_posts()) : $count = 0; ?>
				<ul class="archive-posts">
					<?php
					   while (have_posts()):the_post();
						$permalink 	= get_permalink();
						$titulo	 	= get_the_title();
						$thumb	 	= get_the_post_thumbnail( $post->ID, 'thumb-72x72' );
						$excerpt 	= $post->post_excerpt;
					?> 
							<li class="post-box">
								<?php 
								echo '<a href="'.$permalink.'" title="'.$titulo.'">
									<strong>'.$titulo.'</strong>';
								if ( has_post_thumbnail() ) 
								{ 
									echo $thumb;
								} 
								echo $excerpt;
								echo '</a>';
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
				<?php cp_posts_mais_vistos('Mensagens Mais Lidas','cpmsgreito',5,'thumb-44x44') ?>
				<?php get_sidebar(); ?>
			</div> <!-- sidebar -->
			
		</div> <!-- container -->
</div> <!-- content -->

<hr />

<?php get_footer(); ?>