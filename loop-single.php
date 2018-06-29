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
 * @subpackage Twenty_Ten
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
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
				<!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div>
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 80 ) ); ?>
							<p class="caption">posted by <?php the_author_posts_link(); ?>  <?php printf( __( '<span class="%1$s"> in</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
						</br>
							<?php
									//the_date('M d');
									echo '<div class="post_date">'.'<span>'.get_the_time('M').'</span>'.get_the_time('d').'</div>';
								?>
							</p>
						</div><!-- #author-avatar -->

					</div><!-- #entry-author-info -->
<?php endif; ?>

					<div class="entry-utility">
						<?php echo do_shortcode( "[yuzo_related]" ); ?>
					<span class="tag-links post-links">
						<?php twentyten_posted_in(); ?>
					</span>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->


				<?php comments_template( '', true ); ?>
</main>
<?php endwhile; // end of the loop. ?>
