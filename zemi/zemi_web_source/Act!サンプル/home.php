<?php get_header(); ?>
<?php wp_enqueue_script('masonry', '/wp-content/themes/Original/js/jquery.masonry.min.js',array(jquery)); ?>
<?php wp_enqueue_script('sample', '/wp-content/themes/Original/js/sample.js',array(jquery)); ?>
<?php //wp_enqueue_script('sample', '/wp-content/themes/Original/js/jquery.min.js',array(jquery)); ?>
<script src="<?php bloginfo('template_url'); ?>/js/css_browser_selector.js" type="text/javascript"></script>
<!--<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />-->

	<!--<section class="se-container">
				<div class="se-slope">
					<article class="se-content">
					<h3>Some headline</h3>
					</article>
				</div>
				<div class="se-slope">
					<article class="se-content">
						<h3>Some headline2</h3>
					</article>
				</div>
				<div class="se-slope">
					<article class="se-content">
						<h3>Some headline3</h3>
					</article>
				</div>
				<div class="se-slope">
					<article class="se-content">
						<h3>Some headline3</h3>
					</article>
				</div>-->
				<!--<div class="se-slope">
					<article class="se-content">
						<h3>Some headline3</h3>
					</article>
				</div>
				<div class="se-slope">
					<article class="se-content">
						<h3>Some headline3</h3>
					</article>
				</div>-->
	<!--</section>-->
<div class = "container">
   <!--<div class="posts">-->

	<div class="most_contents">	
		<div class="home_conents">
         <!--<div class="post_title">-->

			<?php echo do_shortcode("[metaslider id=4]"); ?>		

		<div class="maincontent">
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
                                _e( '記事一覧', 'appliance' );

                        }
                ?>
               </h1>
                 </div><!-- maincontent -->
	
		<!--<div class ="center_contents">-->
		<!--<div class="middle_contents">-->	
		<div class="posts">
                <?php while (have_posts()) : the_post(); ?>


<div class="postbg <?php $cat = get_the_category(); $cat = $cat[0];{echo $cat->category_nicename;} ?> masonry">
                        <div class="postimage"><a href="<?php the_permalink()?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a></div>
			
<div class="expect_image">
	<div class="postcontent">
			<div class="postdate"><?php echo get_the_date('Y年m月d日'); ?></div>	
			<h3><a href="<?php the_permalink()?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title()?></a></h3>
                        <div class="posttext"><?php the_excerpt(); ?></div>
        </div><!-- postcontent -->
                        <div class="postreadmore"><h5><a href="<?php the_permalink()?>" title="<?php _e('Read more on','appliance');?> <?php the_title_attribute(); ?>" rel="bookmark"><?php _e('続きを読む','appliance');?></a></h5></div>
		
			<div class="postcats">
			<a class="<?php $category = get_the_category(); echo $category[0]->slug;?>" href="<?php echo site_url()?>/?cat=<?php $category = get_the_category(); echo $category[0]->term_id;?>"><?php $category = get_the_category(); echo $category[0]->cat_name;?></a>
			<a class="<?php $category = get_the_category(); echo $category[1]->slug;?>" href="<?php echo site_url()?>/?cat=<?php $category = get_the_category(); echo $category[1]->term_id;?>"><?php $category = get_the_category(); echo $category[1]->cat_name;?></a>
			<a class="<?php $category = get_the_category(); echo $category[2]->slug;?>" href="<?php echo site_url()?>/?cat=<?php $category = get_the_category(); echo $category[1]->term_id;?>"><?php $category = get_the_category(); echo $category[2]->cat_name;?></a>
			<a class="<?php $category = get_the_category(); echo $category[3]->slug;?>" href="<?php echo site_url()?>/?cat=<?php $category = get_the_category(); echo $category[1]->term_id;?>"><?php $category = get_the_category(); echo $category[3]->cat_name;?></a>
			
			</div><!-- postcats -->
                        <!--<div class="postcomments"><a href="<?php the_permalink()?>#comments" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'appliance' ), number_format_i18n( get_comments_number() ) ); ?></a></div>-->


	</div><!-- expect_image -->
</div><!-- postbg -->


                <?php endwhile; ?>
                <?php else : ?>
                <?php endif; ?>


	</div><!-- posts -->
	<!--<div class="prevnext">
		<p class="prev"><?php previous_posts_link('&laquo;前へ'); ?></p>
		<p class="next"><?php next_posts_link('次へ&raquo;'); ?></p>
	</div>-->

<!--</div>--><!-- post_title -->
		
<!--<div class="likebox">-->
		<!--<iframe class="likebox" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F%E5%AD%A6%E7%94%9F%E7%B7%8F%E5%90%88%E3%83%A1%E3%83%87%E3%82%A3%E3%82%A2-Act%2F233885343340813&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; height:340px; overflow:hidden;" allowTransparency="true"></iframe>-->
<iframe class="likebox" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F%E5%AD%A6%E7%94%9F%E7%B7%8F%E5%90%88%E3%83%A1%E3%83%87%E3%82%A3%E3%82%A2-Act%2F233885343340813&amp;width=292&amp;height=300&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="yes" frameborder="0" style="border:none; overflow:hidden;  height:300px;" allowTransparency="true"></iframe>	

<!--</div>--><!-- likebox -->


		<ul id="menu">
		<?php dynamic_sidebar(); ?>
		</ul>
		
		<!--</div>--><!-- middle_contents -->
			<!--</div>--><!-- center_contents -->

		<div class="page_nation">
		<?php if (function_exists("pagination")) {
		    pagination($additional_loop->max_num_pages);
		    } ?>
		</div><!-- page_nation -->
	

</div><!-- home_contents -->
	

       <div class="side_contents">
	<div class="sidebar">
		<!--<ul id="menu">
		<?php //dynamic_sidebar(); ?>
		</ul>-->
	</div><!-- sidebar -->


      </div><!-- side_contents -->
	
	<!--</div>--><!-- posts -->

	</div><!--most_contents -->
</div><!-- container -->

<?php get_footer(); ?>
