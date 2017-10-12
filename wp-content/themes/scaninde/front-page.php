<?php get_header(); ?>

	<div id="content-slide">
		<div class="container">
		
			<?php fp_notdstqs('cpnoticias',3,'thumb-286x193'); ?>
			
		</div> <!-- fim container -->
	</div> <!-- fim content-slide -->
	
	<div id="content">
		<div class="container">
			<div class="content-fp">
				<?php fp_banner_destaques(3); ?>
				
				<hr />
				
				<div class="fp-bar">
					<!-- fp-acontece -->
					<div class="fp-abasgeral fp-acontece">
						<h2>Acontece</h2>
						<div class="box-abas">
							<!-- main navigator - abas -->
							<ul class="main_navi">
								<li class="active">
									<strong>Notícias</strong>
								</li>
								<li>
									<strong>Agenda Pastoral</strong>
								</li>
							</ul>

							<!-- root element for the main scrollable - conteudo abas --> 
							<div class="main">

								<!-- root element for pages -->
								<div class="pages">

									<!-- page #1 - noticias -->
									<div class="pagey aba-noticias">
										<!-- sub navigator #1 -->
										<div class="navi"></div>
										<!-- inner scrollable #1 -->
										<div class="scrollable">
											<!-- root element for scrollable items -->
											<div class="items">
												<!-- items  -->
												<?php cp_news('cpnotactce',3,'thumb-108x108'); ?>
											</div> <!-- items -->
										</div> <!-- scrollable -->
										<div class="maisitens"><a href="/noticias-acontece/" title="Mais notícias">Mais notícias »</a></div>
									</div> <!-- pagey -->

									<!-- page #2 - calendario pastoral -->
									<div class="pagey aba-calendar">
										<div class="navi"></div>
										<!-- inner scrollable #2 -->
										<div class="scrollable">
											<!-- root element for scrollable items -->
											<div class="items">
												<!-- items on the second page -->
												<div class="item">
												<?php 
												$page_id = 188;
												$page_data = get_page( $page_id ); // pega o conteudo da pagina
												$title = apply_filters('title', $page_data->post_title); // pega o title
												$excerpt = apply_filters('excerpt', $page_data->post_excerpt); // pega o excerpt
												$permalink = get_permalink( $page_id ); // pega o permalink
												$thumb = get_the_post_thumbnail($page_id, 'thumb-108x108'); // thumbnail
												echo 	'<a title="'.$title.'" href="'.$permalink.'" >
															'.$thumb.'
															<strong>'.$title.'</strong>
															<span>'.$excerpt.'</span>
														</a>';

												?>
												</div> <!-- item -->

											</div> <!-- items -->
										</div> <!-- scrollable -->
										<div class="maisitens"><a href="/paroquia/agenda-pastoral/" title="Sobre a agenda">Sobre a agenda »</a></div>
									</div> <!-- pagey -->
									
								</div> <!-- pages -->
							</div> <!-- main -->
						</div> <!-- box-abas -->

					</div> <!-- fp-acontece -->
					
					
					<!-- fp-comunic -->
					<div class="fp-abasgeral fp-comunic">
						<h2>Comunicação</h2>
						<div class="box-abas">
							<!-- main navigator - abas -->
							<ul class="main_navi">
								<li class="active">
									<strong>Web TV</strong>
								</li>
								<li class="navi_center">
									<strong>Jornal O Santuário</strong>
								</li>
								<li>
									<strong>Rádios</strong>
								</li>
							</ul>

							<!-- root element for the main scrollable - conteudo abas --> 
							<div class="main">

								<!-- root element for pages -->
								<div class="pages">

									<!-- page #1 - web tv-->
									<div class="pagey aba-webtv">
										<!-- sub navigator #1 -->
										<div class="navi"></div>
										<!-- inner scrollable #1 -->
										<div class="scrollable">
											<!-- root element for scrollable items -->
											<div class="items">
												<!-- items  -->
												<?php cp_news('cpwebtv',3,'thumb-244x158'); ?>
											</div> <!-- items -->
										</div> <!-- scrollable -->
										<div class="maisitens"><a href="/videos-webtv/" title="Mais vídeos">Mais vídeos »</a></div>
									</div> <!-- pagey -->

									<!-- page #2 - jornal -->
									<div class="pagey aba-jornal">
										<div class="navi"></div>
										<!-- inner scrollable #2 -->
										<div class="scrollable">
											<!-- root element for scrollable items -->
											<div class="items">
												<!-- items on the second page -->
												<?php cp_news('cpjornal',3,'thumb-108x108'); ?>

											</div> <!-- items -->
										</div> <!-- scrollable -->
										<div class="maisitens"><a href="/jornal-santuario/" title="Mais jornais">Mais jornais »</a></div>
									</div> <!-- pagey -->
									
									<!-- page #3 -->
									<div class="pagey aba-radios">
										<div class="navi"></div>
										<!-- inner scrollable #2 -->
										<div class="scrollable">
											<!-- root element for scrollable items -->
											<div class="items">
												<!-- items on the second page -->
												<div class="item">
												<?php 
												$page_id = 829;
												$page_data = get_page( $page_id ); // pega o conteudo da pagina
												$title = apply_filters('title', $page_data->post_title); // pega o title
												$excerpt = apply_filters('excerpt', $page_data->post_excerpt); // pega o excerpt
												$permalink = get_permalink( $page_id ); // pega o permalink
												$thumb = get_the_post_thumbnail($page_id, 'thumb-108x108'); // thumbnail
												echo 	'<a title="'.$title.'" href="'.$permalink.'" >
															'.$thumb.'
															<strong>'.$title.'</strong>
															<span>'.$excerpt.'</span>
														</a>';

												?>
												</div>
												
												<div class="item">
												<?php 
												$page_id = 840;
												$page_data = get_page( $page_id ); // pega o conteudo da pagina
												$title = apply_filters('title', $page_data->post_title); // pega o title
												$excerpt = apply_filters('excerpt', $page_data->post_excerpt); // pega o excerpt
												$permalink = get_permalink( $page_id ); // pega o permalink
												$thumb = get_the_post_thumbnail($page_id, 'thumb-108x108'); // thumbnail
												echo 	'<a title="'.$title.'" href="'.$permalink.'" >
															'.$thumb.'
															<strong>'.$title.'</strong>
															<span>'.$excerpt.'</span>
														</a>';

												?>
												</div>

											</div> <!-- items -->
										</div> <!-- scrollable -->
										<div class="maisitens"><a href="/comunicacao/radios/" title="Sobre as rádios">Sobre as rádios »</a></div>
									</div> <!-- pagey -->
									
								</div> <!-- pages -->
							</div> <!-- main -->
						</div> <!-- box-abas -->

					</div> <!-- fp-comunic -->
					
					
					<!-- fp-multimidia -->
					<div class="fp-abasgeral fp-mmidia">
						<h2>Multimídia</h2>
						<div class="box-abas">
							<!-- main navigator - abas -->
							<ul class="main_navi">
								<li class="active">
									<strong>Fotos</strong>
								</li>
								<li class="navi_center">
									<strong>Vídeos</strong>
								</li>
								<li>
									<strong>Mensagem do Reitor</strong>
								</li>
							</ul>

							<!-- root element for the main scrollable - conteudo abas --> 
							<div class="main">

								<!-- root element for pages -->
								<div class="pages">

									<!-- page #1 - fotos -->
									<div class="pagey aba-fotos">
										<!-- sub navigator #1 -->
										<div class="navi"></div>
										<!-- inner scrollable #1 -->
										<div class="scrollable">
											<!-- root element for scrollable items -->
											<div class="items">
												<?php cp_news('cpfotos',3,'thumb-108x108'); ?>
											</div> <!-- items -->
										</div> <!-- scrollable -->
										<div class="maisitens"><a href="/fotos/" title="Mais galerias de fotos">Mais galerias »</a></div>
									</div> <!-- pagey -->

									<!-- page #2 - videos -->
									<div class="pagey aba-videos">
										<div class="navi"></div>
										<!-- inner scrollable #2 -->
										<div class="scrollable">
											<!-- root element for scrollable items -->
											<div class="items">
												<!-- items on the second page -->
												<?php cp_news('cpvideos',3,'thumb-244x158'); ?>

											</div> <!-- items -->
										</div> <!-- scrollable -->
										<div class="maisitens"><a href="/videos-santuario/" title="Mais vídeos do Santuário">Mais vídeos »</a></div>
									</div> <!-- pagey -->
									
									<!-- page #3 - msg reitor -->
									<div class="pagey aba-msgreitor">
										<div class="navi"></div>
										<!-- inner scrollable #2 -->
										<div class="scrollable">
											<!-- root element for scrollable items -->
											<div class="items">
												<!-- items on the third page -->
												<?php cp_news('cpmsgreito',3,'thumb-108x108'); ?>
											</div> <!-- items -->
										</div> <!-- scrollable -->
										<div class="maisitens"><a href="/mensagens-reitor/" title="Mais mensagens">Mais mensagens »</a></div>
									</div> <!-- pagey -->
									
								</div> <!-- pages -->
							</div> <!-- main -->
						</div> <!-- box-abas -->
 
					</div> <!-- fp-mmidia -->

				</div> <!-- fp-bar -->
				
				<hr />
				
				<div class="fp-bar">
				
					<div class="fp-mop">
						<div class="fp-missas">
							<a href="/informacoes/horarios-missas/" title="Missas na Basílica - Praça da Gruta">
								<strong>Horários de Missas</strong><br />
								<img src="<?php echo SITE_TEMPLATEURL; ?>/images/fp-bnr-missas.jpg" alt="Missas na Basílica - Praça da Gruta"/>
							</a>
						</div>
						<div class="fp-oracao">
							<?php fp_oracao(1); ?>
						</div>
						<div class="fp-public">
								<strong>Publicidade</strong>
								<?php fp_public(1); ?>
						</div>
					</div>
				
				</div>
				
				<hr />
			
				<div class="fp-bar">
					<h2>Visite também</h2>
					<div class="fp-chamadas">
					<?php 
						//Máximo: 18 chamadas
						fp_chamadas(18);
					?>
					</div>
				</div>
				
			</div> <!-- fim content-fp -->
		</div> <!-- fim container -->
	</div> <!-- fim content -->

<?php get_footer(); ?>