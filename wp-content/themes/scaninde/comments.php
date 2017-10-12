<div id ="comments">
<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('Esta página é protegida por senha. Digite a senha para visualizar os comentários.', 'Website'); ?></p>
	<?php
		return;
	}
?>

	<h3 id="comments"><?php comments_number(__('Seja o primeiro a comentar','Website'), __('1 Comentário','Website'), '% '.__('Comentários','Website') ); ?>
	<?php if ( comments_open() ) : ?>
	         <a href="#postcomment" title="<?php _e("Deixe um comentário", "Website"); ?>">&raquo;</a>
	<?php endif; ?>
	</h3>


<?php if ( have_comments() ) : ?>

	<ul id="commentlist">

	<?php wp_list_comments(); ?>

	</ul>


<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comentários estão fechados.','Website'); ?></p>

	<?php endif; ?>
<?php endif; ?>

<hr />
<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h4 style="padding-left:0px;"><?php comment_form_title( __('Deixe seu Comentário','Website'), __('Deixe uma resposta para %s','Website' )); ?></h4>
<div class="cancel-comment-reply">
	<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('Você deve ser','Website')?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('Logado como','Website') ?></a> <?php _e('para postar um comentário','Website') ?>.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Sair desta conta','Website') ?>">Log out &raquo;</a></p>

<?php else : ?>

<p><?php _e('Nome','Website') ?> <?php if ($req) _e('(necessário)','Website'); ?>
<br />
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></p>

<p><?php _e('E-mail (não será publicado)','Website') ?> <?php if ($req) _e('(necessário)','Website'); ?><br />
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></p>

<p>Website<br />
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
</p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p>
<input type="submit" name="btbusca" id="submit" alt="<?php _e('Enviar','Website')?>" value="<?php _e("Enviar", "Website"); ?>" title="<?php _e("Enviar", "Website"); ?>"  /> 
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>
</div>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div> <!-- comentarios -->