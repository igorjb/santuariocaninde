<?php get_header(); ?>

	<hr />

	<div id="content">
		<div class="container">
			<?php if (function_exists('webbreadcrumbs')) { ?><?php webbreadcrumbs(); ?><?php } ?>

			<div id="content-category">
				<h2 class="category-title">Tópico: <?php single_tag_title(); ?></h2>
				
				<?php if (have_posts()) : $count = 0; ?>
				<div class="category-posts">
					<?php
					   while (have_posts()):the_post();
					?>
							<div>
								<h3 class="category-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<small>Publicado em: <?php the_time('d/m/Y'); ?> | Seção: <?php the_category(', '); ?><?php the_tags(' | Assunto: ',' • ',''); ?></small>
								<?php if ( has_post_thumbnail() ) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_post_thumbnail($post->ID, array(150,150) ); ?></a>
								<?php } ?>
								<?php the_excerpt(); ?>
							</div>
				<?php
						endwhile;
				?>
				</div>
				<?php
				endif;
					?>

				<div class="more_entries wrap">
					<?php if (function_exists('cactal_pagination')) { ?><?php cactal_pagination();; ?><?php } ?>
				</div>
			</div> <!--fim content-category-->
		</div>
</div> <!-- fim content -->


<hr />

<?php get_footer(); ?>