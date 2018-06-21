<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->

	<footer role="contentinfo">
		<div class="page">

				<div id="colophon">

					<?php
						/* A sidebar in the footer? Yep. You can can customize
						 * your footer with four columns of widgets.
						 */
						get_sidebar( 'footer' );
					?>

					<div id="footer-nav">
							<ul class="list-menu">
								<li>
									<a href="#link" class="icon--twitter">&nbsp;</a>
								</li>
								<li>
										<a href="#link" class="icon--facebook">&nbsp;</a>
								</li>
								<li>
									<a href="#">Home</a>
								</li>
								<li>
									<a href="#">Privacy&Cookies</a>
								</li>
								<li>
									<a href="#">About</a>
								</li>
								<li>
									<a href="#">Contact</a>
								</li>
							</ul>
					</div>

					<div id="site-generator">
							<div class="footer-logo"></div>
							<?php do_action( 'twentyten_credits' ); ?>
							<a href="<?php echo esc_url( __( 'http://www.stepchange.org/', 'twentyten' ) ); ?>" title="<?php esc_attr_e( 'Debt Charity', 'twentyten' ); ?>" rel="generator">&copy; <?php printf( __( 'StepChange Debt Charity', 'twentyten' ), 'WordPress' ); ?> <script type="text/javascript">
							var theDate=new Date()
							document.write(theDate.getFullYear())
							</script></a>
					</div><!-- #site-generator -->

				</div><!-- #colophon -->
		    <p class="disclaimer">Foundation for Credit Counselling (trading as StepChange Debt Charity) is a company limited by guarantee registered in England and Wales (Company No: 2757055 ) and a charity registered in England and Wales (Registered Charity No: 1016630). Registered office: Wade House, Merrion Centre, Leeds, LS2 8NG. Consumer Credit Counselling Service (Scotland) trading as StepChange Debt Charity Scotland is a company limited by guarantee registered in Scotland (Company No: SC162719) and a charity registered in Scotland (Registered Charity No:SC024413). Registered office: 33 Bothwell Street, Glasgow G2 6NL. Authorised and regulated by the Financial Conduct Authority.</p>
			</div>
	</footer><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<!-- <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/scripts.js?v=1"></script> -->


<!-- START OF SmartSource Data Collector TAG -->
<!-- Copyright (c) 1996-2012 Webtrends Inc. All rights reserved. -->
<!-- Version: 9.4.0 -->
<!-- Tag Builder Version: 4.1 -->
<!-- Created: 9/26/2012 11:28:39 AM -->
<script src="http://www.stepchange.org/scripts/moneyaware_dcs.js" type="text/javascript"></script>
<!-- ----------------------------------------------------------------------------------- -->
<!-- Warning: The two script blocks below must remain inline. Moving them to an external -->
<!-- JavaScript include file can cause serious problems with cross-domain tracking. -->
<!-- ----------------------------------------------------------------------------------- -->
<script type="text/javascript">
//<![CDATA[
var _tag=new WebTrends();
_tag.dcsGetId();
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
_tag.dcsCustom=function(){
// Add custom parameters here.
//_tag.DCSext.param_name=param_value;
}
_tag.dcsCollect();
//]]>
</script>
<noscript>
<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="//webstats.wthosting.co.uk/dcsphygtqvdn881gxsbddyzjv_5q8z/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=9.4.0&amp;dcssip=www.moneyaware.co.uk"/></div>
</noscript>
<!-- END OF SmartSource Data Collector TAG -->

</body>
</html>
