<?php get_header(); ?>
<div id="content">
	<div class="container">
		<?php
		// titulo da pagina atual
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			if($post->post_parent)
			{
				$ancestors=get_post_ancestors($post->ID);
				$root=count($ancestors)-1;
				$parent = $ancestors[$root];
				$pag_titulo = get_the_title($parent);
				$pag_id = get_the_id($parent);
				$pag_permalink = get_permalink($parent);
			}
			else
			{
				$pag_titulo = get_the_title($post->ID);
				$pag_id = get_the_id($post->ID);
				$pag_permalink = get_permalink($post->ID);
				$parent = $post->ID;
			}

			// breadcrumb
			if (function_exists('webbreadcrumbs')) { webbreadcrumbs(); }
			?>
			<div id="content-page">
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php include_once "includes/incl_compartilhe.php"; ?>
				<?php the_content(); ?>
				<?php

				//Audio Player
				if ( get_post_meta($post->ID, 'ecpt_fileaudio', true) ) :
					$audiofile = get_post_meta($post->ID, 'ecpt_fileaudio', true);
					echo '<div class="meta-audio"><span>Clique em Play para reproduzir o áudio</span><embed type="application/x-shockwave-flash" flashvars="audioUrl='.$audiofile.'" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="27" quality="best" wmode="transparent"></embed></div>';
				endif;

				//Maps Custom Field
				if ( get_post_meta($post->ID, 'ecpt_googlemaps', true) ) :
					$metamaps = get_post_meta($post->ID, 'ecpt_googlemaps', true);
					echo '<div class="meta-maps">'.$metamaps.'</div>';

				endif;

				//Agenda Custom Field
				if ( get_post_meta($post->ID, 'ecpt_agenda', true) ) :
					$metaagenda = get_post_meta($post->ID, 'ecpt_agenda', true);
					echo '<div class="meta-agenda">'.$metaagenda.'</div>';
				endif;
				
				
				//Outro Custom Field html embed
				if ( get_post_meta($post->ID, 'ecpt_htmlembed', true) ) :
					$metaembed = get_post_meta($post->ID, 'ecpt_htmlembed', true);
					echo '<div class="meta-embedoutro">'.$metaembed.'</div>';

				endif;
				
				//Download
				if ( get_post_meta($post->ID, 'ecpt_filedownload', true) ) :
					$titledownload = get_post_meta($post->ID, 'ecpt_titledownload', true);
					$metadownload = get_post_meta($post->ID, 'ecpt_filedownload', true);
					echo '<div class="meta-download"><a href="'.$metadownload.'" title="Baixar '.$titledownload.'">'.$titledownload.'<span class="downloadinstr">Clique para baixar o arquivo</span></a></div>';
				endif;

				
				?>
				<?php wp_link_pages('before=<p><strong>Páginas complementares: </strong>&after=</p>&next_or_number=number'); ?>
			</div> <!-- content page -->
			<div id="sidebar">
				<?php
				// menu secundario etc
				$children = wp_list_pages("title_li=&child_of=".$parent."&echo=0&sort_column=menu_order&depth=0");
				if ($children) {
				?>
					<div class="menu-secundario">
						<strong>Menu <?php echo $pag_titulo; ?></strong>
						<ul>
							<?php echo $children; ?>
						</ul>
					</div>
				<?php
				}
				?>
				<?php get_sidebar(); ?>
			</div> <!-- sidebar -->
		<?php endwhile; else: ?>
			<p><?php _e("Nenhuma página encontrada.", "Website"); ?></p>
		<?php endif; ?>
	</div> <!-- fim container -->
</div> <!-- fim content -->
<hr />
<?php get_footer(); ?>