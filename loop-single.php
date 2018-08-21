<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage moneyaware2
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


			<main class="page article u-bg--white">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
						if ( !empty( $categories ) ) {
							 printf( '<h1 class="border-v cat%1$s">%2$s</h1>',
								esc_html( $categories[0]->term_id ),
								esc_html( get_the_title() )
							);
						} else {
							echo "<h1 class=''>".get_the_title()."</h1>";
						}
					?>

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'moneyaware2' ), 'after' => '</div>' ) ); ?>
				<!-- .entry-content -->


					<div>
						<div id="author-avatar">
							<span id="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 80 ) ); ?></span>
							<span id="author-text"><p class="caption">Posted by <?php the_author_posts_link(); ?>  <?php printf( __( '<span class="%1$s"> in</span> %2$s', 'moneyaware2' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
							<?php /* the date */ echo '<p class="post_date">'.get_the_time('d')." ".get_the_time('M')." ".get_the_time('Y').'</p>';
								?>
							</p></span>
						</div><!-- #author-avatar -->

					</div><!-- #entry-author-info -->

				<span class="tag-links post-links">
					<?php twentyten_posted_in(); ?>
				</span>

					<div class="entry-utility">
						<?php get_template_part('related'); ?>

					</div><!-- .entry-utility -->
					<?php edit_post_link( __( 'Edit', 'moneyaware2' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>
		</main>
<?php endwhile; // end of the loop. ?>
