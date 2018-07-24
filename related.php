<?php

/* new related posts stuff
from webpage: https://netmospherics.com/blog/wordpress-related-posts-without-plugin/

*/
echo '<div id="relatedposts"><h3>Related Posts</h3><div class="relatedcontent">';

// Get the tags for the current post
$orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);
// If the post has tags, run the related post tag query
if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
// Build our tag related custom query arguments
$custom_query_args=array(
	'tag__in' => $tag_ids, // Select posts with related tags
	'posts_per_page' => 3, // Number of related posts to display
	'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
	'orderby' => 'rand', // Randomize the results
);

} else {
	// Build our category based custom query arguments
	$custom_query_args = array(
		'posts_per_page' => 3, // Number of related posts to display
		'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
		'orderby' => 'rand', // Randomize the results
	);
}
// Initiate the custom query
if( $custom_query->have_posts() ) {
} else {
  $custom_query_args = array(
    'posts_per_page' => 3, // Number of related posts to display
    'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
    'orderby' => 'rand', // Randomize the results
  );
}

$custom_query = new WP_Query( $custom_query_args );



// Run the loop and output data for the results
if ( $custom_query-> have_posts() ) :
  ?>

	<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
      <?php if ( has_post_thumbnail() ) : ?>
      <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
        <?php /* the_post_thumbnail(); */ ?>
      <?php else : ?> <!-- add a fallback image incase there is no featured image -->
          <?php $backgroundImg[0] = "/images/post_thumb2.jpg"; ?>
      <?php endif ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
          <div class="relatedpost-img" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat center center; background-size:cover;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; ">
        </div></a>
          <h3><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
          <div class="excerpt-limit">
                <?php strip_shortcodes(custom_excerpt(12)); ?>
          </div>
          <p class="readMore">
            <a id="readmore-btn" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Read more</a>
          </p>
    </article>
	<?php endwhile; ?>
<?php else : ?>
		<p>Sorry, no related articles to display.</p>

<?php
echo '</div></div>'; /* rlated posts and related content */

endif;
// Reset postdata
wp_reset_postdata();

?>
