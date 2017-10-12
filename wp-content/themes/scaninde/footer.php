	<hr />

		<div id="footer">
			<div class="container">
				<div class="f-col1">
					<strong>Santuário nas Redes Sociais</strong>
					<a href="/comunicacao/redes-sociais/" title="Acesse e acompanhe o Santuário nas Redes Sociais">Santuário nas Redes Sociais - Twitter, Facebook, Orkut - Acesse e Acompanhe</a>
				</div> <!-- f-col1 -->
				<div class="f-col2">
					<?php santuario_informa('Santuário Informa',1); ?>
				</div> <!-- f-col2 -->
				<div class="f-col3">
					<strong>Novidades do Santuário em seu e-mail</strong>
					<div>
						<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=santcaninde', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true"><input type="text" class="footer-email" name="email"/><input type="hidden" value="santcaninde" name="uri"/><input type="hidden" name="loc" value="pt_BR"/><input class="footer-submit" type="submit" value="Enviar" /></form>	
					</div>
				</div> <!-- f-col3 -->
			</div> <!-- container -->
		</div> <!-- footer -->
	</div> <!-- bg -->
	<div id="bar-bottom">
		<address>
			<b>© 2011-<?php echo date('Y'); ?> - Santuário de São Francisco das Chagas</b><br />
			Praça da Basílica, 31, Centro - Canindé-CE - CEP 62700-000<br/>
			Fones: (85) 3343-9950 / 3343-0017 - Caixa Postal: D2
		</address>
		<a href="http://www.cactal.com/" title="Criação de Sites em Fortaleza" id="cactal">Cactal</a>
	</div> <!-- bar-bottom -->

</div> <!-- general -->

<?php wp_footer(); ?>

	<!-- Google+ SCript Button -->
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	  {lang: 'pt-BR'}
	</script>
	
	<?php if (is_front_page()) { //slideshow - somente para pagina inicial ?>

	<script>
	// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
	$(document).ready(function() {

	// main vertical scroll
	$(".maindstq").scrollable({

		// basic settings
		vertical: true,
		circular: true,
			
		// up/down keys will always control this scrollable
		//keyboard: 'static',

		// assign left/right keys to the actively viewed scrollable
		onSeek: function(event, i) {
			horizontal.eq(i).data("scrollable").focus();
		}

	// main navigator (thumbnail images)
	}).navigator(".main_navidstq").autoscroll({ autoplay: true, interval: 6000 });

	// horizontal scrollables. each one is circular and has its own navigator instance
	var horizontal = $(".scrollable").scrollable({ circular: true }).navigator(".navidstq");


	// when page loads setup keyboard focus on the first horzontal scrollable
	horizontal.eq(0).data("scrollable").focus();

	});
	</script>

	<script>
	// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
	$(document).ready(function() {

	// main vertical scroll
	$(".main").scrollable({

		// basic settings
		vertical: true,
		circular: true,
			
		// up/down keys will always control this scrollable
		//keyboard: 'static',

		// assign left/right keys to the actively viewed scrollable
		onSeek: function(event, i) {
			horizontal.eq(i).data("scrollable").focus();
		}

	// main navigator (thumbnail images)
	}).navigator(".main_navi");

	// horizontal scrollables. each one is circular and has its own navigator instance
	var horizontal = $(".scrollable").scrollable({ circular: true }).navigator(".navi");


	// when page loads setup keyboard focus on the first horzontal scrollable
	horizontal.eq(0).data("scrollable").focus();

	});
	</script>


	<!-- javascript coding -->
	<script>
	// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
	$(document).ready(function() {

	// heeeeeeeeeeere we go.
	$(".scrollchamadas").scrollable({next: ".proxima", prev: ".anterior", circular: true, mousewheel: true}).navigator().autoscroll({
		interval: 6000		
	});	
	});
	</script>
	<?php } ?>
</body>
</html>