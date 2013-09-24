<p><?php wp_enqueue_script('jquery'); ?></p>
<?php get_header(); ?>
     <div id="content">
     <?php if(is_home()):  ?>

             <?php query_posts('pagename=message');  ?>
         <?php if(have_posts()):
                          while(have_posts()): the_post(); ?>
         <h2><?php the_content();  ?></h2>
         <?php endwhile; endif;  ?>
<?php else: ?>
         <?php if(have_posts()):
         while(have_posts()): the_post(); ?>
         <h2><?php the_title();  ?></h2>
         <?php the_content();  ?>
         <?php endwhile; endif; ?>
<?php endif; ?>

     </div>

     <?php get_footer(); ?> 
