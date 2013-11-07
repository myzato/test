<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<!--<link rel="stylesheet" href="http://zemiyamori.com/wp-content/themes/copy/style.css" type="text/css" />-->	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_enqueue_script('jquery', '/wp-content/themes/copy/js/jquery.min.js',array(jquery)); ?>	
	<?php //wp_enqueue_script('bigTarget', '/wp-content/themes/copy/js/keepinview.js',array(jquery)); ?>	
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
	<link rel="stylesheet" href="/wp-content/themes/copy/css/jquery.pageslide.css">


	<?php
		function device(){
		    $agent =  $_SERVER['HTTP_USER_AGENT']; 
		    $rtn = "";
		    if(ereg("UP\.Browser|DoCoMo|J-PHONE|Vodafone|SoftBank|emobile|WILLCOM",$agent)){
			$rtn = "mb";
		    }else if(ereg("iPhone|iPod|Android|dream|CUPCAKE|blackberry|webOS|incognito|webmate",$agent)){    
			$rtn = "sp";
		    }else{
			$rtn = "pc";
		    }
		    return($rtn);
		}

		if (device() == pc){
			 wp_enqueue_script('bigTarget', '/wp-content/themes/copy/js/keepinview.js',array(jquery));  
		}
	?>
		
	<?php wp_enqueue_script('masonry', '/wp-content/themes/copy/js/masonry.js',array(jquery)); ?>	
	<?php wp_enqueue_script('css_browser_selector', '/wp-content/themes/copy/js/css_browser_selector.js',array(jquery)); ?> 	
	<?php wp_enqueue_script('selectivizr', '/wp-content/themes/copy/js/selectivizr.js',array(jquery)); ?>	
	<!--<script type="text/javascript" src="/wp-content/themes/copy/js/jquery.mobile-menu.js"></script>	-->
	<?php wp_enqueue_script('mobile-menu', '/wp-content/themes/copy/js/jquery.pageslide.min.js',array(jquery)); ?>	

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=705936116102215";
	      fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>

					<?php

						function device_check(){
						    $agent =  $_SERVER['HTTP_USER_AGENT']; 
						    $rtn = "";
						    if(ereg("UP\.Browser|DoCoMo|J-PHONE|Vodafone|SoftBank|emobile|WILLCOM",$agent)){
							$rtn = "mb";
						    }else if(ereg("iPhone|iPod|Android|dream|CUPCAKE|blackberry|webOS|incognito|webmate",$agent)){    
							$rtn = "sp";
						    }else{
							$rtn = "pc";
						    }
						    return($rtn);
						}

						if (device_check() == pc){
								wp_nav_menu( array( 'menu' => 'menu1'/*'theme_location' => 'primary', 'menu_class' => 'nav-menu'*/ ) );
								 get_search_form(); 

						}else{
					?>	
							<div class="mobile_nav">	
								<a class="logo_zemi" href="http://miyamori-zemi.com/"><img src="/wp-content/themes/copy/images/logo_zemi_test.png"></img></a>	
								<a class="first" href="#modal">MENU</a>	
								<!--<a href="#modal" class="first"><img src="/wp-content/themes/copy/images/check-list.png"></img></a>-->	
						


								<ul id="modal">	
									<li class="menu_home"><a href="http://miyamori-zemi.com/">ホーム</a></li>
									<li class="menu_zemi"><a href="http://miyamori-zemi.com/?page_id=4">宮森ゼミとは</a></li>
									<li class="menu_form"><a href="http://miyamori-zemi.com/?page_id=6">お問い合わせ</a></li>	
								
								</ul><!-- modal -->


								<script src="/wp-content/themes/copy/js/jquery.pageslide.min.js"></script>


								<script>
									/* mobile-menu */
								
									/* Default pageslide, moves to the right */
									jQuery(document).ready(function($){	
										$(".first").pageslide({direction:"left"});
									});
									
								</script>
							</div><!-- mobile_nav -->


					<?php
						}

					?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->

			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>

		</header><!-- #masthead -->

		<script type="text/javascript">
		jQuery(document).ready(function($){
			$(".navbar").keepInView({zindex:2});
		});	
		</script>


		<script src="/wp-content/themes/copy/js/jquery.mobile-menu.js"></script>	

		<script>

		var flag;
		var min_width = 540;

		jQuery(document).ready(function($){
				if ( $('html').width() < min_width ) {
					if ( flag ) {
						$('#container').masonry('destroy');
						flag = 0;
					}
					} else {
					$('.masonry').masonry({
						itemSelector: '.box',
						columnWidth: 206,
						isAnimated: true,
						isFitWidth: true
						 	    
					});
					flag = 1;
				}
			}

		);	



		</script>	


		<div id="main" class="site-main">
