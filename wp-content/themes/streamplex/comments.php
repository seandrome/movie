<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<strong>This post is password protected. Enter the password to view comments.</strong>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<div class="clear"></div>

<?php if ( have_comments() ) : ?>

	<h3><?php comments_number('No Comments', '1 Comment', '% Comments' );?></h3>
	
	<ol id="commentlist">
	<?php wp_list_comments('callback=comment_template'); ?>
	</ol>
						
	<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
	<div class="page-comments"><?php paginate_comments_links(); ?></div>
	<?php endif; ?>	
	
	<div class="clear"></div>

<?php endif; ?>

<div class="clear"></div>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Posting as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" class="required" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="email" id="email" class="email required" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="url" id="url" class="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea name="comment" id="comment" class="required" cols="100%" rows="10" tabindex="4"></textarea></p>

<input name="submit" type="submit" id="submit" tabindex="5" value="Post" />

<p><?php if (function_exists('show_subscription_checkbox')) { show_subscription_checkbox(); } ?></p>

<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>