<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die ('Do not load this page directly!');
	}

	if ( post_password_required() ) {
?>
		<div class="alert alert-message info">
			<?php _e( 'This post is password protected. Enter the password to view comments.', 'activetab' ); ?>
		</div>
<?php
		return;
	}
?>


<div id="comments" class="comments-area">

<?php if ( have_comments() ) : ?>

	<h3 class="comments-title">
		<?php
		printf( _n( '1 comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'activetab' ),
			number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
		global $post;
		echo '<a href="'.get_post_comments_feed_link( $post->ID ).'" class="rss-feed-link" title="'.esc_attr( __( 'Post comments RSS feed', 'activetab' ) ).'"><i class="dashicons dashicons-rss"></i></a>';
		?>
	</h3>



	<?php if ( get_previous_comments_link() || get_next_comments_link() ) : ?>
	<nav class="site-comments-navigation site-comments-navigation-top" role="navigation">
		<ul class="pager">
			<?php
			if ( get_previous_comments_link() ) :
				echo '<li class="previous">'.get_previous_comments_link( __( '&larr; Previous comments', 'activetab' ) ).'</li>';
			endif;
			if ( get_next_comments_link() ) :
				echo '<li class="next">'.get_next_comments_link( __( 'Next comments &rarr;', 'activetab' ) ).'</li>';
			endif;
			?>
		</ul>
	</nav> <!-- /.site-comments-navigation -->
	<?php endif; ?>


	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'activetab_comments' ) );?>
	</ol>


	<?php if ( get_previous_comments_link() || get_next_comments_link() ) : ?>
	<nav class="site-comments-navigation site-comments-navigation-bottom" role="navigation">
		<ul class="pager">
			<?php
			if ( get_previous_comments_link() ) :
				echo '<li class="previous">'.get_previous_comments_link( __( '&larr; Previous comments', 'activetab' ) ).'</li>';
			endif;
			if ( get_next_comments_link() ) :
				echo '<li class="next">'.get_next_comments_link( __( 'Next comments &rarr;', 'activetab' ) ).'</li>';
			endif;
			?>
		</ul>
	</nav> <!-- /.site-comments-navigation -->
	<?php endif; ?>

<?php endif; // end of if( have_comments() ) ?>


<?php if ( comments_open() ) : ?>

	<section id="respond" class="respond-form">

		<div id="cancel-comment-reply">
			<p><?php cancel_comment_reply_link( '<span class="btn btn-default"><i class="dashicons dashicons-no-alt"></i> '.__( 'Cancel reply', 'activetab' ).'</span>' ); ?></p>
		</div>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	    <div class="help">
	        <p><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'activetab' ), wp_login_url( get_permalink() ) ) ?></p>
	    </div>
		<?php else : ?>

		<div class="well">
		<?php
			global $post;
			$post_id = $post->ID;
			$commenter = wp_get_current_commenter();
			$user = wp_get_current_user();
			//$user_identity = $user->exists() ? $user->display_name : '';
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " required='required'" : '' );
			$comment_form_args = array(
				'fields' => array(
					'author' => '<div class="form-group comment-form-author"> <label class="control-label" for="author"><strong>'.__( 'Name', 'activetab' ).'</strong></label> <div class="input-group"><span class="input-group-addon"><i class="dashicons dashicons-admin-users"></i></span><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ( $req ? ' required ' : '' ) . '></div></div>',
					'email'  => '<div class="form-group comment-form-email"> <label class="control-label" for="email"><strong>'.__( 'Email', 'activetab' ).'</strong> <span class="text-muted smaller-text">'.__( 'Email will not be published', 'activetab' ).'</span></label> <div class="input-group"><span class="input-group-addon"><i class="dashicons dashicons-email-alt"></i></span><input id="email" class="form-control" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" ' . $aria_req . ( $req ? ' required ' : '' ) . '></div> </div>',
					'url'    => '<div class="form-group comment-form-url"> <label class="control-label" for="url"><strong>'.__( 'Website', 'activetab' ).'</strong> <span class="text-muted smaller-text">'.__( 'Example: http://google.com', 'activetab' ).'</span></label> <div class="input-group"><span class="input-group-addon"><i class="dashicons dashicons-admin-links"></i></span><input id="url" class="form-control" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '"></div> </div>',
				),
				'comment_field'        => '<div class="form-group comment-form-comment"> <label class="control-label" for="comment"><strong>'.__( 'Comment', 'activetab' ).'</strong></label> <div class="input-group"><span class="input-group-addon"><i class="dashicons dashicons-admin-comments"></i></span><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" required="required"></textarea></div></div>',
				'must_log_in'          => '<div class="form-group must-log-in"><span class="help-block text-muted smaller-text">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'activetab' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</span></div>',
				'logged_in_as'         => '<div class="form-group logged-in-as"><span class="help-block text-muted smaller-text">' . sprintf( __( 'You logged in as <a href="%1$s">%2$s</a>. <a href="%3$s">Log out</a>', 'activetab' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</span></div>',
				'comment_notes_before' => '',
				'comment_notes_after'  => '<div class="form-group form-allowed-tags"><span class="help-block text-muted smaller-text">' . __( 'Allowed HTML tags:', 'activetab' ). ' <span>' . '&lt;a href="http://google.com"&gt;<a href="http://google.com">google</a>&lt;/a&gt; &lt;strong&gt;<strong>bold</strong>&lt;/strong&gt; &lt;em&gt;<em>emphasized</em>&lt;/em&gt; &lt;code&gt;<code>code</code>&lt;/code&gt; &lt;blockquote&gt;<blockquote style="display: inline; padding: 4px 8px;">quote</blockquote>&lt;/blockquote&gt; ' . '</span></span></div>', // allowed_tags()
				'id_form'              => 'commentform',
				'id_submit'            => 'submit',
				'title_reply'          => __( 'Submit comment', 'activetab' ),
				'title_reply_to'       => __( 'Submit reply to %s', 'activetab' ),
				'cancel_reply_link'    => __( 'Cancel reply', 'activetab' ),
				'label_submit'         => __( 'Submit comment', 'activetab' ),
			);
			comment_form( $comment_form_args );
		?>
		</div>

		<?php endif; // if registration required and not logged in ?>
	</section> <!-- /#respond -->

<?php else: ?>

	<?php // comments are closed ?>

<?php endif; // end of if( comments_open() ) ?>

</div> <!-- /#comments /.comments-area -->
