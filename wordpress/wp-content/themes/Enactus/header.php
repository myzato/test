<html>
 <head>
  <title>
       <p><?php wp_enqueue_script('jquery'); ?>;</p>
       <?php bloginfo('name'); ?><?php wp_title(':'); ?>
  </title>
  <link rel="stylesheet" href="http://zato.moo.jp/enactus/wp-content/themes/Original/reset.css" type="text/css" media="all">
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
 </head>
 <body <?php body_class(); ?>>
     
<!--<div id="container">-->
     <div id="head">
        <div id="header_bar">
          <a href="<?php echo home_url(); ?>"><img src="http://zato.moo.jp/enactus/wp-content/themes/Original/images/act_logo_white.png" alt="sample" class="act_logo"></a>
        </div>     
       <div id="box">
          <div class="boxin">
              <a href="#" id="circle1">css</a>
          </div>
          <div class="boxin">
              <a href="#" id="circle2">css3</a>
          </div>
          <div class="boxin">
              <a href="#" id="circle3">jquery</a>
          </div>
          <div class="boxin">
              <a href="#" id="circle4">tutorial</a>
          </div>
          <div class="boxin">
              <a href="#" id="circle5">Collect</a>
          </div>
      </div>
 
             <!--<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>-->
             <!--<p id="desc"><?php bloginfo('description'); ?></p> -->
              <p><img src ='<?php header_image(); ?>' alt="風景"title=""width="<?php echo HEADER_IMAGE_WIDTH; ?>"
              height="<?php echo HEADER_IMAGE_HEIGHT; ?>"  class="header_image"/></p>
	
              <div id="navbar">
                <?php wp_nav_menu(array('theme_location' => 'navbar')); ?>
              </div>     

     <!--</div>-->
</html>

