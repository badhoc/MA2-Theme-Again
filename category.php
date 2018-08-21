<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage moneyaware2
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				<?php
				get_template_part( 'loop', 'category' );
				?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
