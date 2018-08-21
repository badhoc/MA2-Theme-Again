<?php
/**
 * TwentyTen functions and definitions
 *
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */

function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'moneyaware2', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'moneyaware2' ),
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', array(
		// Let WordPress know what our default background color is.
		'default-color' => 'ffffff',
	) );

	// The custom header business starts here, deleted as we hardcoded it

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/woman-looking-right.jpg',
			'thumbnail_url' => '%s/images/headers/woman-looking-right-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Woman looking right', 'moneyaware2' )
		),
		'hanoi' => array(
			'url' => '%s/images/headers/hanoi.jpg',
			'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hanoi Plant', 'moneyaware2' )
			)

	) );
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment-bubble" id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'moneyaware2' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'moneyaware2' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta comment-date commentmetadata">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'moneyaware2' ), get_comment_date(),  get_comment_time() ); ?>
				<?php edit_comment_link( __( '(Edit)', 'moneyaware2' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php //_e( 'Pingback:', 'moneyaware2' ); ?> <?php //comment_author_link(); ?><?php //edit_comment_link( __( '(Edit)', 'moneyaware2' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'moneyaware2' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'moneyaware2' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'moneyaware2' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'moneyaware2' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'moneyaware2' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'moneyaware2' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'moneyaware2' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'moneyaware2' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'moneyaware2' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'moneyaware2' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'moneyaware2' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'moneyaware2' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );


add_filter('tiny_mce_before_init', 'add_custom_classes');
function add_custom_classes($arr_options) {
	$arr_options['theme_advanced_styles'] = "Purple Pop Out=purple-module;Blue Pop Out=blue-module;Orange Pop Out=orange-module";
	$arr_options['theme_advanced_buttons2_add_before'] = "styleselect";
	return $arr_options;
}
/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'moneyaware2' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'moneyaware2' ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() { // Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', '' );
	if ( $tag_list ) {
		$posted_in = __( '<span class="entry-utility-prep-tag-links">Tags</span> %1$s %2$s', 'moneyaware2' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'moneyaware2' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'moneyaware2' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( '' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


//function added 22/6/18 to add in 60second debt test show_recent_comments_widget_style

function sixtySecondDiv() {
	return '<div class="dr-tool">
            <p class="DR-text">Worried about money?<br>Take the 60 second debt test
            </p>
            <div class="DR-button"><a id="DR-btn" href="'.site_url().'/worried-about-money">Take the test now</a></div>
        </div>';
}

add_shortcode('sixtySecond','sixtySecondDiv');

/* Exclude pages from WordPress Search mainly as they break the formatting */

if (!is_admin()) {
	function our_search_filter($query) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
		return $query;
	}
add_filter('pre_get_posts','our_search_filter');
}

/* add the link title as the class to register_nav_menus */

add_filter( 'nav_menu_css_class', 'custom_add_item_label_as_class', 10, 3 );

function custom_add_item_label_as_class( $classes, $item, $args ) {
        $classes[] = 'menu-' . sanitize_title_with_dashes( $item->title );
    return $classes;
}

/* create the custom excerpt length */
// strip the shortcode added as the captions were still pulling through.
function custom_excerpt($numberOfWords){
	$articleContent ='nothing to display';
	if (has_excerpt()){ //take the excerpt if it has it
		$articleContent = wp_trim_words(strip_shortcodes(get_the_excerpt()), $numberOfWords, "...");
	} else { //if it doesnt take the content
		$articleContent = wp_trim_words(strip_shortcodes(get_the_excerpt()), $numberOfWords, "...");
	}
	echo wpautop($articleContent,0); //strip formatting
}

/* load more posts button */
function my_load_more_scripts() {

	global $wp_query;

	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');

	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_template_directory_uri().'/myloadmore.js', array('jquery') );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'my_loadmore_params', array(
		'ajaxurl' => get_site_url().'/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );

 	wp_enqueue_script( 'my_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'my_load_more_scripts' );


function my_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :

		// run the loop
		while( have_posts() ): the_post();

			/* bring in the same loop that we use for the normal archive */

			?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
				<?php if ( has_post_thumbnail() ) : ?>
				<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
				<?php else : ?> <!-- add a fallback image incase there is no featured image -->
						<?php $backgroundImg[0] = get_template_directory_uri() . '/images/post_thumb2.jpg'; ?>
				<?php endif ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><div class="post-img" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat center center; background-size:cover;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; ">
							<?php if(is_home() && $counter > 4){ echo '<div class="popular">&bigstar; Popular</div>'; }; ?>
					</div></a>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h2 class="entry-title"><?php the_title(); ?></h2>
					</a>
					<div class="excerpt-limit">
								<?php custom_excerpt(20); ?>
					</div>
					<p class="readMore">
						<a id="readmore-btn" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Read more</a>
					</p>
			<!-- .entry-utility -->
			</article><!-- #post-## -->
				<?php
			// for the test purposes comment the line above and uncomment the below one
			//the_title();

		endwhile;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!

}

add_action('wp_ajax_loadmore', 'my_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'my_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

//Custom function for author info
function author_info() {
	do_action('author_info');
}

// remove links from images, from WPMUDev
add_filter( 'the_content', 'attachment_image_link_remove_filter' );
function attachment_image_link_remove_filter( $content ) {
$content =
preg_replace(
array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}',
'{ wp-image-[0-9]*" /></a>}'),
array('<img','" />'),
$content
);
return $content;
}
