
<?php get_header(); ?>

<link rel="stylesheet" href="http://zato.moo.jp/enactus/wp-content/themes/Original/reset.css" type="text/css" media="all" >

<?php wp_enqueue_script('masonry', '/wp-content/themes/Original/js/jquery.masonry.min.js',array(jquery)); ?>
<?php wp_enqueue_script('sample', '/wp-content/themes/Original/js/sample.js',array(jquery)); ?>


   <div class="posts">
	<div id="home_conents">
         <div id="post_title">

                <div id="maincontent">
                <?php if (have_posts()) : ?>
                <h1 id="archives">
                <?php
	        	if ( is_category() ) {
		        	printf( __( 'Category Archives: %s', 'appliance' ), '<span>' . single_cat_title( '', false ) . '</span>' );
                        } elseif ( is_tag() ) {
                                printf( __( 'Tag Archives: %s', 'appliance' ), '<span>' . single_tag_title( '', false ) . '</span>' );

                        } elseif ( is_author() ) {
                                printf( __( 'Author News Archive %s', 'appliance' ), '<span>' . single_tag_title( '', false ) . '</span>' );

                        } elseif ( is_day() ) {
                                printf( __( 'Daily Archives: %s', 'appliance' ), '<span>' . get_the_date() . '</span>' );

                        } elseif ( is_month() ) {
                                printf( __( 'Monthly Archives: %s', 'appliance' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

                        } elseif ( is_year() ) {
                                printf( __( 'Yearly Archives: %s', 'appliance' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

                        } else {
                                _e( 'Archives', 'appliance' );

                        }
                ?>
               </h1>
                 </div><!-- maincontent -->

                <?php while (have_posts()) : the_post(); ?>


			<div class="postbg" id="<?php $cat = get_the_category(); $cat = $cat[0];{echo $cat->category_nicename;} ?>">
                        <div class="postimage"><a href="<?php the_permalink()?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a></div>
			
<div class="expect_image">
			<div class="postcontent">
                        <h3><a href="<?php the_permalink()?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title()?></a></h3>
                        <div class="posttext"><?php the_excerpt(); ?></div>
                        </div><!-- postcontent -->
                        <div class="postreadmore"><h5><a href="<?php the_permalink()?>" title="<?php _e('Read more on','appliance');?> <?php the_title_attribute(); ?>" rel="bookmark"><?php _e('Read more','appliance');?></a></h5></div>
                        <div class="smldivider"></div>
                        <div class="postcats"><a href="<?php echo site_url()?>/?cat=<?php $category = get_the_category(); echo $category[0]->term_id;?>"><?php $category = get_the_category(); echo $category[0]->cat_name;?></a></div>
                        <!--<div class="postcomments"><a href="<?php the_permalink()?>#comments" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'appliance' ), number_format_i18n( get_comments_number() ) ); ?></a></div>-->
			
		</div><!-- expect_image -->
	</div><!-- postbg -->



                <?php endwhile; ?>
                <?php else : ?>
                <?php endif; ?>

	<div class="prevnext">
	<p class="prev"><?php previous_posts_link('&laquo;前へ'); ?></p>
	<p class="next"><?php next_posts_link('次へ&raquo;'); ?></p>
	</div><!-- prevnext -->

</div><!-- home_contents -->

</div><!-- posts -->


	<div id="sidebar">
		<ul id="menu">
		<?php dynamic_sidebar(); ?>
		</ul>
	</div><!-- sidebar -->

<?php get_footer(); ?>
