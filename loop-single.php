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
							<span id="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 80 ) ); ?></span>
							<span id="author-text"><p class="caption">Posted by <?php the_author_posts_link(); ?>  <?php printf( __( '<span class="%1$s"> in</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
							<?php /* the date */ echo '<p class="post_date">'.get_the_time('d')." ".get_the_time('M')." ".get_the_time('Y').'</p>';
								?>
							</p></span>
						</div><!-- #author-avatar -->

					</div><!-- #entry-author-info -->
<?php endif; ?>
				<span class="tag-links post-links">
					<?php twentyten_posted_in(); ?>
				</span>

					<div class="entry-utility">
						<?php /* new related posts sutff */
							$orig_post = $post;
							global $post;
							$tags = wp_get_post_tags($post->ID);
								if ($tags) {
									$tag_ids = array();
									foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
									$args=array(
										'tag__in' => $tag_ids,
										'post__not_in' => array($post->ID),
										'posts_per_page'=>3, // Number of related posts that will be shown.
										'caller_get_posts'=>1
									);
									$my_query = new wp_query( $args );
									if( $my_query->have_posts() ) {

										echo '<div id="relatedposts"><h3>Related Posts</h3><div class="relatedcontent">';

										while( $my_query->have_posts() ) {
											$my_query->the_post(); ?>
											<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
												<?php if ( has_post_thumbnail() ) : ?>
									      <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
													<?php /* the_post_thumbnail(); */ ?>
									      <?php else : ?> <!-- add a fallback image incase there is no featured image -->
									          <?php $backgroundImg[0] = "http://s19367.pcdn.co/wordpress/wp-content/uploads/Freebies-featured-306x151.jpg"; ?>
									      <?php endif ?>
									        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														<div class="relatedpost-img" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat center center; background-size:cover;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; ">
									        </div></a>
														<h3><a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
														<div class="excerpt-limit">
																	<?php custom_excerpt(12); ?>
														</div>
														<p class="readMore">
															<a id="readmore-btn" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Read more</a>
														</p>
											</article>
											<?
										}
										echo '</div></div>';
									}
								}
								$post = $orig_post;
								wp_reset_query(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->


				<?php comments_template( '', true ); ?>
</main>
<?php endwhile; // end of the loop. ?>
