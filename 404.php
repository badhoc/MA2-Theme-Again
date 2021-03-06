<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage moneyaware2
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<div id="container" class="mb2">
		<div id="content" role="main">

			<div id="post-0" class="type-page post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Page Not Found', 'moneyaware2' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'moneyaware2' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
