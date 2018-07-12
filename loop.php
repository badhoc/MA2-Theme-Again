<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage moneyaware2
 * @since Twenty Ten 1.0
 */
?>

<?php /* If on a category page or not the homepage change the number of posts shown from 7 to 6 */ ?>
<?php
global $query_string;
parse_str( $query_string, $args );
if(!is_home() && !is_search() ){
    $args['posts_per_page'] = 6;
    query_posts($args);
} elseif (is_search() && !is_home() ){
  $args ['posts_per_page'] = 9;
  query_posts($args);
} elseif (is_home()){
  $args ['posts_per_page'] = 7;
  query_posts($args);
} ?>

<main class="page page--cat">
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'moneyaware2' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'moneyaware2' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>


<section class="flex-container">


<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
	 <?php if (!is_home()) { /* only display on categories not homepage or search */ ?>
				<div class="page--cat post cat-desc">
					<h1 class="border-v"><?php
					if (is_search()) {
						echo $wp_query->found_posts.' results found for: '.get_search_query();
					}
          if (is_tag()){
            echo "Posts tagged with: ";
          }
          single_cat_title();
					?></h1>
					<?php /*kick out a description or search details depending on which page we're on */
										$category_description = category_description();
										if ( ! empty( $category_description ) )
											echo $category_description;
										if (is_search()) {
											echo 'Not what you were looking for? Search again: ';
											get_search_form();
										}
				 ?>

				</div>
<?php } ?>

<?php $counter = 0;
			while ( have_posts() ) : the_post();
			$counter++;
			?>

<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'moneyaware2' ) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'moneyaware2' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="entry-meta">
				<?php twentyten_posted_on(); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'moneyaware2' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'moneyaware2' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-utility">
			<?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
				<a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'moneyaware2' ); ?>"><?php _e( 'More Galleries', 'moneyaware2' ); ?></a>
				<span class="meta-sep">|</span>
			<?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'moneyaware2' ) ) ) : ?>
				<a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'moneyaware2' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'moneyaware2' ); ?>"><?php _e( 'More Galleries', 'moneyaware2' ); ?></a>
				<span class="meta-sep">|</span>
			<?php endif; ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'moneyaware2' ), __( '1 Comment', 'moneyaware2' ), __( '% Comments', 'moneyaware2' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'moneyaware2' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'moneyaware2' ) )  ) : ?>
		aside
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading &raquo;', 'moneyaware2' ) ); ?>
			</div><!-- .entry-content -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading &raquo;', 'moneyaware2' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php twentyten_posted_on(); ?>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'moneyaware2' ), __( '1 Comment', 'moneyaware2' ), __( '% Comments', 'moneyaware2' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'moneyaware2' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

<?php else : //change the post to the specific popular post.
      if( is_home() ){
        global $post;
        global $poppostIDs;
        $poppostIDs = [7331,7226,7065];
        switch($counter) {
            case 5:
              $post = get_post( $poppostIDs[0], OBJECT );
              setup_postdata( $post );
              break;
            case 6:
              $post = get_post( $poppostIDs[1], OBJECT );
              setup_postdata( $post );
              break;
            case 7:
              $post = get_post( $poppostIDs[2], OBJECT );
              setup_postdata( $post );
              break;
      }
    }

    ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			<?php if ( has_post_thumbnail() ) : ?>
      <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
				<?php /* the_post_thumbnail(); */ ?>
      <?php else : ?> <!-- add a fallback image incase there is no featured image -->
          <?php $backgroundImg[0] = "http://s19367.pcdn.co/wordpress/wp-content/uploads/Freebies-featured-306x151.jpg"; ?>
      <?php endif ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><div class="post-img" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat center center; background-size:cover;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; ">
            <?php if(is_home() && $counter > 4){ echo '<div class="popular">&bigstar; Popular</div>'; }; ?>
        </div></a>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				      <h2 class="entry-title"><?php the_title(); ?></h2>
				</a>
        <div class="excerpt-limit">
				      <?php custom_excerpt(); ?>
        </div>
				<p class="readMore">
					<a id="readmore-btn" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Read more</a>
				</p>

		<!-- .entry-utility -->

		</article><!-- #post-## -->


	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>
<?php if ($counter == 3 && !is_home() && !is_search() && !is_tag() || $counter == 4 && is_home() && !is_search()  && !is_tag())
{
echo "<div class='moneyawareBlurb'>
			<div class='blurb'>
				<h2>What is MoneyAware?</h2>
				<p>StepChange Debt Charity&#39;s blog MoneyAware provides income-boosting, money-saving and budgeting tips to help you make the most of your money and keep debt stress at bay.</p>
			</div>
			<div class='sixtySecond-category'>
			<p>Worried about money?<br>Take the 60-second debt test</p>
			<a href='worried-about-money'>Take the test</a></div>
			</div>";
		}
?>
<?php endwhile; // End the loop. Whew. ?>
<?php
if ( !is_home() && $wp_query->max_num_pages > 1 )
 echo '<div class="loadMorePosts">Load more posts</div>';
 ?>
</section>
</main>
