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
$args ['posts_per_page'] = 9;
query_posts($args);
?>

<main class="page page--cat">
<?php /* If there are no posts to display, such as an empty archive page */ ?>

<section class="flex-container">

<?php
	/* Start the Loop.
	 *
	 * Without further ado, the loop:
	 */ ?>
				<div class="page--cat post cat-desc">
					<h1 class="border-v"><?php echo $wp_query->found_posts.' results found for: '.get_search_query();	?></h1>
					<?php echo 'Not what you were looking for? Search again: '; get_search_form(); ?>
				</div>

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

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

<?php else : //change the post to the specific popular post.

    ?>

    <?php if (is_home() && $counter == 1){ ?>
      <article id="homepage-info" class="post type-post" >
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <h1 id="hometitle">MoneyAware</h1>
          </a>
          <div id="home-text">
                <p>StepChange Debt Charity’s blog MoneyAware provides income-boosting, money-saving and budgeting tips to help you make the most of your money and keep debt stress at bay.</p>
          </div>
        </article>
    <?php } else {?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
      <?php if(is_home() && $counter > 4){ echo '<div class="popular">&bigstar; Popular</div>'; }; ?>
			<?php if ( has_post_thumbnail() ) : ?>
      <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
				<?php /* the_post_thumbnail(); */ ?>
      <?php else : ?> <!-- add a fallback image incase there is no featured image -->
          <?php $backgroundImg[0] = get_template_directory_uri().'/images/post_thumb2.jpg' ?>
      <?php endif ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><div class="post-img" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat center center; background-size:cover;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; ">

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


	<?php } endif; // This was the if statement that broke the loop into three parts based on categories. ?>
<?php if ($counter == 3 && !is_home() && !is_search() && !is_tag() || $counter == 4 && is_home() && !is_search()  && !is_tag())
{
echo "<div class='moneyawareBlurb'>
			<div class='sixtySecond-category'>
			<p>Worried about money? Take the 60-second debt test</p>
			<a href='".site_url()."/worried-about-money'>Take the test</a></div>
			</div>";
		}
?>
<?php endwhile; // End the loop. Whew. ?>
<?php
if (!is_home() && $wp_query->max_num_pages > 1 )
 echo '<div class="loadMorePosts">Load more posts</div>';
 ?>
</section>
</main>
