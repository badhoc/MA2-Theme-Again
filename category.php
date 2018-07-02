<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
<!--
				<h1 class="page-title category-page-title">--> <?php
			/*		printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			*/	?></h1>
				<?php
				/*	$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';
*/
				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>
				<?php
global $wp_query; // you can remove this line if everything works for you

// don't display the button if there are not enough posts
if (  $wp_query->max_num_pages > 1 )
	echo '<div class="loadMorePosts">Older Posts (not working yet)</div>'; // you can use <a> as well
?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
