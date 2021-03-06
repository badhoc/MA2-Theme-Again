<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage moneyaware2
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css" />
<meta name="twitter:site" content="@MoneyAware">
<meta property="twitter:account_id" content="1592145024" />
<meta property="fb:app_id" content="393971940674968"/>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="p:domain_verify" content="b7bacd6ec49f99a26a86bf8919d827ab"/>
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- add in responsive -->
<meta name="DCS.dcsipa" content="1" />
<!-- Hotjar Tracking Code for https://moneyaware.co.uk/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:972626,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'moneyaware2' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-Q2QFD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-Q2QFD');</script>
<!-- End Google Tag Manager -->
<script type="text/plain" data-cookieconsent="preferences">(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=393971940674968";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header class="u-bg--white">
	<div class="pageheader">
		<div class="header-top">
		<a class="logo" href="/" alt="MoneyAware logo" /><img class="header-logo" src="<?php echo get_template_directory_uri(); ?>/images/money-aware-logo.png"></a>
<!-- old menu design was in here -->
<div id="access" role="navigation">
	<?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'moneyaware2' ); ?>"><?php _e( 'Skip to content', 'moneyaware2' ); ?></a></div>
</div>

<!-- new menu starts here -->
	<div class="burger">
		<div class="burger-container" onclick="toggleMenu()">
		  <div class="bar bar1"></div>
		  <div class="bar bar2"></div>
		  <div class="bar bar3"></div>
		</div>
	<!--	<p class="menuLabel">Menu</p> -->
	</div>
</div>
		<nav class="nav2 hide-it" role="navigation">
			<?php wp_nav_menu( array(
				'menu' => 'Nav Menu'
			)); ?>
		</nav>
	</div>
</header>

<div id="wrapper" class="hfeed">


<!-- change the banner image based on which page you're on -->
	<div id="main"><?php
		$imageClass = '';
	if (is_home()) { //homepage
			$imageClass = 'home-img';
	} elseif (is_search()) { //search
			$imageClass = 'search-img';
	} elseif (is_404() ) { //404 page
			$imageClass = 'not-found-img';
	} elseif (is_page()) { //odd pages out
			global $post;
			$imageClass=$post->post_name."-img";
	} elseif (is_archive() ){ //for categories
			$categories = get_the_category();
			$catname = esc_html( $categories[0]->name );
			$imageClass = sanitize_title_with_dashes($catname)."-img";
	} elseif (is_singular() ) {
		$category = get_the_category();
		$firstCategory = sanitize_title_with_dashes($category[0]->cat_name);
		$imageClass= strtolower($firstCategory."-img");
	}
		echo '<div class="banner-image '.$imageClass.'"></div>'
?>
