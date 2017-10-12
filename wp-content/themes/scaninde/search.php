<?php get_header(); ?>

	<hr />

	<div id="content">
		<div class="container">
			<div id="content-page">
			<?php
			$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$s = get_query_var('s');
			query_posts( array('post_type' => array('page', 'cpnoticias', 'cpfotos', 'cpvideos', 'cpvideocat', 'cpmsgreito', 'cpnotactce', 'cppublicac', 'cpwebtv', 'cpsantinfo', 'cpcanticos'), 's' => $s) );
			
			echo '<h1>Resultado de sua pesquisa por "'.$s.'"</h1>';
			?>		
			
				<?php if (have_posts()) : $count = 0; ?>
				<ul>
					<?php
					   while (have_posts()):the_post();
					?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</li>

			<?php
				endwhile;
			?>
				</ul>
			<?php
			else:
			?>	
					<div id="content-category">
						<p>
							<span class="catTitulo"><?php _e("Nenhum resultado encontrado em sua pesquisa", "Website"); ?> <strong>'<?php echo $s ?>'</strong>.</span>
							<br /><span class="catComent"><?php _e("Por gentileza, efetue uma nova pesquisa utilizando outro termo.", "Website"); ?></span>
						</p>
					</div>
			<?php 
			endif;
			?>

			<div class="more_entries wrap">
				<?php if (function_exists('wp_pagenavi')) { ?><?php wp_pagenavi(); ?><?php } ?>
			</div>

		</div> <!-- content-category - Fim -->
	
		</div> <!-- container - Fim -->
	</div> <!-- content - Fim -->

	<hr />
	
<?php get_footer(); ?>