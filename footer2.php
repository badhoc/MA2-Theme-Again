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

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

			<div id="site-info">
				<h5>Helping you become debt free ...</h5>
				<p> "I wish to thank your staff for all the great help they gave me when I was in so much debt. They were a pillar of support to me." (Leslie, Essex)</p>
                            	<p style="font-style:normal; font-size:0.8em;"><b>Authorised and regulated by the Financial Conduct Authority.</b></p>	
</div><!-- #site-info -->

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
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<script type="text/javascript">

 $(document).ready(function() {
      
      	var yOffset;
	    yOffset = -40;
	
	    //On hover of tooltip element.
	    $("#author-avatar").hover(function (e) {
	        var heightForTool = $('#author-description').height();
	        //Add CSS to position tooltip above the hover element.
	        $("#author-description").css("top", (yOffset - heightForTool) + "px").fadeIn("fast");
	        $('#author-description').show();
	    },
	    function () {
	        $('#author-description').fadeOut("fast");
	    });
	    
	    $('.widget_search').addClass('clearfix');
	    
	   /* $('#secondary ul.xoxo li').each(function (index) {
	    	if(index==0){
		    	$(this).parents('#secondary').prepend('<div class="module-tabs clearfix"><ul class="the-tabs"></ul></div>');
	    	}
	    	if($(this).hasClass('widget_tag_cloud') || $(this).hasClass('widget_archive') || $(this).hasClass('widget_categories')) {
		    	//var theHTML = $(this).html;
		    	var titleOfTab = $(this).find('h3');
		    	var titleOfTabText = titleOfTab.text();
		    	titleOfTab.remove();
		    	
		    	if(index==0) {
			    	$(this).parents('.xoxo').siblings('.module-tabs').children('ul').append('<li class="selected"><a href="tabs-'+(index+1)+'">'+titleOfTabText+'</a></li>');
		    	} else {
			    	$(this).parents('.xoxo').siblings('.module-tabs').children('ul').append('<li><a href="tabs-'+(index+1)+'">'+titleOfTabText+'</a></li>');
		    	}
		    			    	
		    	var htmlTab = $(this).html();
		    	$(this).parents('.xoxo').siblings('.module-tabs').append('<div class="tab" id="tabs-'+(index+1)+'">'+htmlTab+'</div>');
		    	
		    	$(this).remove();
	    	}
	    });*/
	    
	    var clicked = false;
	    $(".view-more").live('click', function () {
	    	if(clicked) {
		    	clicked = false;
		    	$(this).html('View more');
		    	$(".module-tabs").css('height','344px');
	    	} else {
		    	clicked = true;
		    	$(this).html('View less');
		    	$(".module-tabs").css('height','auto');
	    	}
	    });
	    
	    
	    var isAnimating = false;
    //On tab click
    $(".module-tabs ul.the-tabs li a").live('click', function () {
    	
        //Check tab isn't currently animating.
        if (!isAnimating) {
            //Now the tab is animating set to true.
            isAnimating = true;
            //Grab the tab element.
            var el = $(this);
            //Get the 'tabs' container. This is the tab buttons parent.
            var parent = el.parents('.module-tabs');
            //Get the tab number. Where it is in the sequence.
            var index = $(this).parent().index();
            //Remove all classes from the tabs so none are set to 'selected'.
            $(this).parent().siblings().removeClass();
            //Add 'selected' class to the clicked <a> tags parent <li>.
            $(this).parent().addClass('selected');
            var idOfTab = $(this).attr("title");
            idOfTab = idOfTab.substring(5);
            //Add one to the index, as indexing starts at 0.
            index++;
            //Fade out all 'tab' content.
            $(parent).find('.module-content').find('.tab-content').fadeOut(120);
            setTimeout(function () {
                //Fade in the tab content div that matches the clicked tab index.
                $('#tabs-' + idOfTab).fadeIn(120);
                setTimeout(function () {
                    //Once finished set animating to false.
                    isAnimating = false;
                }, 125);
            }, 125);

        }
        //Exit function.
        return false;
    });
   
 $('#searchform').submit(function(e) { 
        var s = $( this ).find("#s"); 
        if (!s.val()) { e.preventDefault(); alert("Please enter a search term"); $('#s').focus(); }
    });

 });
	
	
</script>
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
<input name="ScrollTop" type="hidden" id="ScrollTop" />
<input name="__dnnVariable" type="hidden" id="__dnnVariable" value="`{`__scdoff`:`1`}" />
<script type="text/javascript" src="/Resources/Shared/scripts/initWidgets.js" ></script>


</body>
</html>