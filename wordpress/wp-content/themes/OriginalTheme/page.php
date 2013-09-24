<?php get_header(); ?>

<link rel="stylesheet" href="/wordpress/wp-content/themes/OriginalTheme/page.css" type="text/css" media="all" >	

<div id="content">
         <?php if(have_posts()):
         while(have_posts()): the_post(); ?>
         <h2><?php the_title(); ?></h2> 
         <?php the_content();  ?>
         <?php endwhile; endif;  ?>
</div>

<?php get_footer(); ?>
