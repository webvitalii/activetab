<?php

define('ACTIVETAB_VERSION', '2.3');


if ( ! isset( $content_width ) ) {
	$content_width = 600;
}


if ( ! function_exists( 'activetab_enqueue_scripts_and_styles' ) ) :
	function activetab_enqueue_scripts_and_styles() {

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		//wp_enqueue_script( 'activetab-bootstrap-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ), $activetab_version );
		wp_enqueue_script( 'activetab-script', get_template_directory_uri() . '/js/activetab.js', array( 'jquery' ), ACTIVETAB_VERSION );

		wp_enqueue_style( 'activetab-bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.css', array(), ACTIVETAB_VERSION, 'all' );
		wp_enqueue_style( 'activetab-bootstrap-theme-style', get_template_directory_uri() . '/bootstrap/css/bootstrap-theme.css', array(), ACTIVETAB_VERSION, 'all' );
		wp_enqueue_style( 'activetab-style', get_stylesheet_uri(), array( 'activetab-bootstrap-style', 'dashicons' ), ACTIVETAB_VERSION, 'all' ); // get_stylesheet_directory_uri() . '/style.css'
	}
	add_action( 'wp_enqueue_scripts', 'activetab_enqueue_scripts_and_styles' );
endif; // activetab_enqueue_scripts_and_styles()


if ( ! function_exists( 'activetab_setup' ) ) :
	function activetab_setup() {

		add_filter( 'widget_text', 'do_shortcode' ); // execute shortcodes in sidebar widgets

		load_theme_textdomain( 'activetab', get_template_directory() . '/languages' ); // make theme available for translation

		add_editor_style(); // visual editor style match the theme style (add editor-style.css)

		add_theme_support( 'automatic-feed-links' ); // add RSS feed links to <head> for posts and comments

		add_theme_support( 'title-tag' ); // let WordPress manage the document title

		//add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat', ) ); // post formats for future

		register_nav_menu( 'primary-nav', __( 'Primary menu', 'activetab' ) ); // main nav menu in header

		add_theme_support( 'custom-background' );

		add_theme_support( 'post-thumbnails' ); // featured images
		set_post_thumbnail_size( 800, 9999 ); // unlimited height, soft crop

		$custom_header_args = array(
			'default-image'          => get_template_directory_uri() . '/img/headers/nature.jpg',
			'random-default'         => true, // random image rotation
			'header-text'            => false, // disable editing styles for text in header

			// set height and width, with a maximum value for the width
			'width'                  => 800,
			'height'                 => 500,
			'max-width'              => 2000,

			// support flexible height and width
			'flex-height'            => true,
			'flex-width'             => true

		);

		add_theme_support( 'custom-header', $custom_header_args ); // custom header See http://codex.wordpress.org/Custom_Headers

		register_default_headers( array( // default custom headers packaged with the theme (%s is a placeholder for the theme template directory URI)
			'nature' => array(
				'url' => '%s/img/headers/nature.jpg',
				'thumbnail_url' => '%s/img/headers/nature-thumbnail.jpg',
				'description' => __( 'Nature', 'activetab' )
			),
			'relax' => array(
				'url' => '%s/img/headers/relax.jpg',
				'thumbnail_url' => '%s/img/headers/relax-thumbnail.jpg',
				'description' => __( 'Relax', 'activetab' )
			),
			'space' => array(
				'url' => '%s/img/headers/space.jpg',
				'thumbnail_url' => '%s/img/headers/space-thumbnail.jpg',
				'description' => __( 'Space', 'activetab' )
			)
		) );


		/* ========== thumbnail size options ========== */
		//add_image_size( 'thumb-400', 400, 999, false );
		//add_image_size( 'thumb-200', 200, 999, false );
		//add_image_size( 'thumb-100', 100, 999, false );
		/*
		to add more sizes, simply copy a line from above and change the dimensions & name.
		As long as you upload a "featured image" as large as the biggest
		set width or height, all the other sizes will be auto-cropped.
		<?php the_post_thumbnail( 'thumb-200' ); ?> - shows the 200x200 sized image
		*/

	}
	add_action( 'after_setup_theme', 'activetab_setup' );
endif; // activetab_setup()


// register sidebars & footer widgets
if ( ! function_exists( 'activetab_register_widgets' ) ) :
	function activetab_register_widgets() {
		register_sidebar( array(
			'name' => __( 'Sidebar', 'activetab' ),
			'id' => 'sidebar',
			//'description' => 'Sidebar widgets description.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		register_sidebar( array(
			'name' => __( 'Footer', 'activetab' ),
			'id' => 'footer',
			//'description' => 'description',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
	}
	add_action( 'widgets_init', 'activetab_register_widgets' );
endif; // activetab_register_widgets()


if ( ! function_exists( 'activetab_list_pages' ) ) :
	function activetab_list_pages() {
		?>
		<nav class="nav-menu nav clearfix" role="navigation"><ul class="nav"><?php wp_list_pages( 'title_li=' ); ?></ul></nav>
		<?php
	}
endif; // activetab_list_pages()


if ( ! function_exists( 'activetab_comments' ) ) :
	function activetab_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p>
						<?php
							if( $comment->comment_type == 'pingback' ) {
								_e( 'Pingback:', 'activetab' );
							} else {
								_e( 'Trackback:', 'activetab' );
							}
						?>
						<?php comment_author_link(); ?>
						<?php edit_comment_link( '<span class="btn btn-default btn-xs"><i class="dashicons dashicons-edit"></i> '.__( 'Edit', 'activetab' ).'</span>', '<span class="edit-link '.$comment->comment_type.'-edit-link">', '</span>' ); ?>
					</p>
					<?php
				break;
			default :
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="clearfix">
						<header class="comment-header">
							<div class="comment-author vcard clearfix">
								<?php
								$avatar_size = 50;
								if ( $comment->comment_parent != '0' ){
									$avatar_size = 30; // small image for reply
								}
								$comment_author_url = esc_url( get_comment_author_url() );
								if ( ! empty( $comment_author_url ) ){ // create a link on avatar
									$comment_avatar_url_before = '<a href="'.$comment_author_url.'" title="'.get_comment_author( $comment->comment_ID ).'">';
									$comment_avatar_url_after = '</a>';
								} else {
									$comment_avatar_url_before = '<span title="'.get_comment_author( $comment->comment_ID ).'">';
									$comment_avatar_url_after = '</span>';
								}

								global $post;
								if( $comment->user_id === $post->post_author ) {
									$post_author_label = ' <span class="label label-info">'.__( 'Post author', 'activetab' ).'</span>';
								} else {
									$post_author_label = '';
								}
								echo '<div class="comment-avatar">'.$comment_avatar_url_before.get_avatar( $comment, $avatar_size ).$comment_avatar_url_after.'</div>';

								echo '<div class="comment-meta">';
								echo '<span class="comment-meta-item comment-meta-item-author fn"><i class="dashicons dashicons-admin-users" title="'.esc_attr( __( 'Author', 'activetab' ) ).'"></i> '.get_comment_author_link().$post_author_label.'</span> ';
								echo '<span class="comment-meta-item comment-meta-item-date"><i class="dashicons dashicons-calendar-alt" title="'.esc_attr( __( 'Published', 'activetab' ) ).'"></i> <a href="'.esc_url( get_comment_link( $comment->comment_ID ) ).'"><time datetime="'.get_comment_time( 'c' ).'" title="'.get_comment_time().'">'.get_comment_date().'</time></a></span>';

								edit_comment_link( '<span class="btn btn-default btn-xs"><i class="dashicons dashicons-edit"></i> '.__( 'Edit', 'activetab' ).'</span>', '<span class="edit-link comment-edit-link">', '</span>' );

								echo '</div> <!-- /.comment-meta -->';
								?>
							</div> <!-- /.comment-author /.vcard -->

							<?php if ( $comment->comment_approved == '0' ) : ?>
								<div class="alert alert-warning"><?php _e( 'Your comment is awaiting moderation.', 'activetab' ); ?></div>
							<?php endif; ?>

						</header><!-- /.comment-meta -->

						<div class="comment-content"><?php comment_text(); ?></div>

						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<span class="btn btn-default"><i class="dashicons dashicons-admin-comments"></i> '.__( 'Reply', 'activetab' ).'</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div> <!-- /.reply -->
					</article> <!-- /#comment-<?php comment_ID(); ?> -->

				<?php
				break;
		endswitch;
	}
endif; // activetab_comments()


if ( ! function_exists( 'activetab_post_date' ) ) :
	function activetab_post_date() {
		$post_date = '<span class="entry-meta-item entry-meta-date"><i class="dashicons dashicons-calendar-alt" title="'.esc_attr( __( 'Published', 'activetab' ) ).'"></i> '.'<a href="'.esc_url( get_permalink() ).'" title="'.get_the_time().'"><time class="entry-date" datetime="'.get_the_date( 'c' ).'" title="'.get_the_time().'">'.get_the_date().'</time></a></span>'."\n";
		return $post_date;
	}
endif; // activetab_post_date()


if ( ! function_exists( 'activetab_post_sticky' ) ) :
	function activetab_post_sticky() {
		$post_sticky = '';

		if( is_sticky() ) { // add 'sticky' label to sticky post
			$sticky = ' <span class="label label-info"><i class="dashicons dashicons-admin-post"></i>'.__( 'Sticky', 'activetab' ).'</span>';
			$post_sticky = '<span class="entry-meta-item entry-meta-sticky">'.$sticky.'</span>'."\n";
		}

		return $post_sticky;
	}
endif; // activetab_post_sticky()


if ( ! function_exists( 'activetab_post_author' ) ) :
	function activetab_post_author() { // author
		global $authordata;
		if ( !is_object( $authordata ) )
			return false;
		$post_author = '<span class="entry-meta-item entry-meta-author"><i class="dashicons dashicons-admin-users" title="'.esc_attr( __( 'Author', 'activetab' ) ).'"></i> <a href="'.esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ).'" title="'.esc_attr(  __( 'Author', 'activetab' ) ).'">'.get_the_author().'</a></span>'."\n";
		return $post_author;
	}
endif; // activetab_post_author()


if ( ! function_exists( 'activetab_comments_count' ) ) :
	function activetab_comments_count() {
		$post_comments_count = '';
		if ( get_comments_number() != '0' ) {
			$post_comments_count = '<span class="entry-meta-item entry-meta-comments-count"><i class="dashicons dashicons-admin-comments" title="'.esc_attr( __( 'Comments', 'activetab' ) ).'"></i> <a href="'.esc_url( get_permalink() ).'#comments" title="'.__( 'Comments', 'activetab' ).'">'.get_comments_number().'</a></span>'."\n";
		}
		return $post_comments_count;
	}
endif; // activetab_comments_count()


if ( ! function_exists( 'activetab_post_categories' ) ) :
	function activetab_post_categories() { // list of categories
		$post_categories = get_the_category_list( __( ', ', 'activetab' ) );
		if ( !empty( $post_categories ) ) {
			return '<span class="entry-meta-item entry-meta-categories"><i class="dashicons dashicons-category" title="'.esc_attr( __( 'Categories', 'activetab' ) ).'"></i> '.$post_categories.'</span>'."\n";
		} else {
			return ''; // no categories
		}
	}
endif; // activetab_post_categories()


if ( ! function_exists( 'activetab_post_tags' ) ) :
	function activetab_post_tags() { // list of tags
		$post_tags = get_the_tag_list( '', __( ', ', 'activetab' ), '' );
		if( !empty( $post_tags ) ){
			return '<span class="entry-meta-item entry-meta-tags"><i class="dashicons dashicons-tag" title="'.esc_attr( __( 'Tags', 'activetab' ) ).'"></i> '.$post_tags.'</span>'."\n";
		}else{
			return ''; // no tags
		}
	}
endif; // activetab_post_tags()


if ( ! function_exists( 'activetab_post_meta' ) ) :
	function activetab_post_meta() { // post meta
		$post_meta = '<div class="entry-meta-row">'."\n" . activetab_post_sticky() . activetab_post_date() . activetab_post_author() . activetab_comments_count() . activetab_post_categories() . '</div>'."\n";
		$post_tags = activetab_post_tags();
		if( !empty( $post_tags ) && is_single() ){
			$post_meta .= '<div class="entry-meta-row">'."\n" . $post_tags . '</div>'."\n";
		}

		return "\n".'<div class="entry-meta">'."\n".$post_meta.'</div> <!-- /.entry-meta -->'."\n";
	}
endif; // activetab_post_meta()


if ( ! function_exists( 'activetab_nav' ) ) :
	function activetab_nav( $class='top' ) { // show next/prev navigation links when needed
		global $wp_query;
		$nav = '';
		if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages
			if ( get_next_posts_link() ) :
				$nav .= '<li class="previous">'.get_next_posts_link( __( '&larr; Previous posts', 'activetab' ) ).'</li>';
			endif;
			if ( get_previous_posts_link() ) :
				$nav .= '<li class="next">'.get_previous_posts_link( __( 'Next posts &rarr;', 'activetab' ) ).'</li>';
			endif;
		endif;
		if ( ! empty( $nav ) ) { // do not show empty markup
			$nav = "\n".'<nav class="site-posts-navigation site-comments-navigation-'.$class.'" role="navigation"><ul class="pager">'.$nav.'</ul></nav> <!-- /.site-posts-navigation -->'."\n";
		}
		return $nav;
	}
endif; // activetab_nav()


if ( ! function_exists( 'activetab_excerpt_more' ) ) :
	function activetab_excerpt_more( $more ) { // "more-link" is bad for seo and for usability - http://web-profile.com.ua/web/web-principles/more-link/
		return '...';
	}
	add_filter('excerpt_more', 'activetab_excerpt_more');
endif; // activetab_excerpt_more()


if ( ! function_exists( 'activetab_is_homepage' ) ) :
	function activetab_is_homepage() {
		global $paged;
		// if( is_home() || is_front_page() ){} // simple way
		$show_on_front = get_option( 'show_on_front' ); // page or posts
		$page_on_front = get_option( 'page_on_front' ); // 0 or page_id
		$page_for_posts = get_option( 'page_for_posts' ); // 0 or page_id
		if ( ( $show_on_front == 'page' ) || ( $page_on_front != 0 ) ){
			if( is_front_page() ){
				return true;
			}
		} elseif ( ( $show_on_front == 'posts' ) || ( $page_for_posts == 0 ) ) {
			if( is_home() && $paged < 2 ) { // show link to homepage from paged pages
				return true;
			}
		} else {
			return false;
		}
	}
endif; // activetab_is_homepage()


if ( ! function_exists( 'activetab_wp_head' ) ) :
function activetab_wp_head() { // output content to the head section

	$favicon_url = of_get_option( 'favicon_url', '' );
	if ( ! empty( $favicon_url ) ) {
		echo "\n".'<link rel="shortcut icon" type="image/x-icon" href="'.$favicon_url.'">'."\n";
	}

	$code_head = of_get_option( 'code_head', '' );
	if ( ! empty( $code_head ) ) { // output js head code
		echo "\n".'<!-- activetab head code -->'."\n";
		echo $code_head;
		echo "\n".'<!-- /end of activetab head code -->'."\n";
	}

}
add_action( 'wp_head', 'activetab_wp_head' );
endif; // activetab_wp_head()


if ( ! function_exists( 'activetab_admin_head' ) ) :
	function activetab_admin_head() { // output content to the admin head section

		$favicon_url = of_get_option( 'favicon_url', '' );
		if ( ! empty( $favicon_url ) ) {
			echo "\n".'<link rel="shortcut icon" type="image/x-icon" href="'.$favicon_url.'">'."\n";
		}

	}
	add_action( 'admin_head', 'activetab_admin_head' );
endif; // activetab_admin_head()


if ( ! function_exists( 'activetab_wp_footer' ) ) :
	function activetab_wp_footer() { // output content to the footer section

		$code_footer = of_get_option( 'code_footer', '' );
		if ( ! empty( $code_footer ) ) { // output js head code
			echo "\n".'<!-- activetab footer code -->'."\n";
			echo $code_footer;
			echo "\n".'<!-- /end of activetab footer code -->'."\n";
		}

	}
	add_action( 'wp_footer', 'activetab_wp_footer' );
endif; // activetab_wp_footer()


// ========== options framework ==========

/*
 * Loads the Options Panel
 * If you're loading from a child theme use stylesheet_directory instead of template_directory
 */

if ( ! function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/options-framework/' );
	require_once dirname( __FILE__ ) . '/options-framework/options-framework.php';
}


/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() { // set theme option name to 'activetab_options' and save all options there

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace( "/\W/", "_", strtolower( $themename ) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename . '_options';
	update_option( 'optionsframework', $optionsframework_settings );

}


function activetab_optionscheck_change_santiziation() { // remove default and add custom filter for textarea in options framework
	remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
	add_filter( 'of_sanitize_textarea', 'activetab_custom_sanitize_textarea' );
}
add_action( 'admin_init', 'activetab_optionscheck_change_santiziation', 100 );

function activetab_custom_sanitize_textarea( $input ) { // allow script and style tags for textarea
	global $allowedposttags;
	$custom_allowedtags['script'] = array(
		'type' => array(),
		'src' => array(),
		'title' => array(),
		'media' => array(),
		'rel' => array(),
		'id' => array()
	);
	$custom_allowedtags['style'] = array(
		'type' => array(),
		'href' => array(),
		'title' => array(),
		'media' => array(),
		'rel' => array(),
		'id' => array()
	);
	$custom_allowedtags['link'] = array(
		'type' => array(),
		'href' => array(),
		'title' => array(),
		'media' => array(),
		'rel' => array(),
		'id' => array()
	);
	$custom_allowedtags = array_merge( $custom_allowedtags, $allowedposttags );
	$output = wp_kses( $input, $custom_allowedtags );
	return $output;
}
