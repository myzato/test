<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<link rel="stylesheet" href="http://myzato.moo.jp/zemi/wp-content/themes/copy/single.css" type="text/css" media="all" >
<?php wp_enqueue_script('selectivizr', '/wp-content/themes/copy/js/selectivizr.js',array(jquery)); ?> 

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<div class="single_contents">
				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php //comments_template(); ?>
				<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-colorscheme="light" data-numposts="5" data-width="500"></div>	
					
				<?php //twentythirteen_post_nav(); ?>
				
				<?php

					function device_check_nav(){
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

					if (device_check_nav() == pc){
						twentythirteen_post_nav(); 
					}

				?>

			</div><!-- single_contents -->


			<?php endwhile; ?>

					
		</div><!-- #content -->
			
			<div class="cat_list">
				<p class="ribbon"><span>おすすめ記事</span></p>

					<?php
				
						$get_cat = get_the_category();
						$cat = $get_cat[0];
						$cat_id = $cat->cat_ID;
						
						if($cat_id=='7'){	
						
							$posts = get_posts("numberposts=5&category=9");
							global $post;
						}else{
						
							$posts = get_posts("numberposts=5&category=7");
							global $post;
						}
					
					?>
			<div class="relative_all_post">

				<?php
						   //query_posts('posts_per_page=5'); 
						   if($posts): foreach($posts as $post): setup_postdata($post);
				?>

					<ul class = "relative_post">
						<div class = "side_image">
							<a href="<?php the_permalink(); ?>" id="side_iamge" ><img src="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id, ”, true); echo $image_url[0]; ?>" width="50" height="50" /></a>
						</div><!--side_image-->

							<li>
								<a href = "<?php the_permalink();?>" class="cat_list_a">
									<?php 

										$title = get_the_title();
										$title = str_replace(" ", "<br />", $title);

										if(mb_strlen($post->post_title)>20) { 
											$title= mb_substr($post->post_title,0,20) ; echo $title. ･･･ ;
										} else {
											echo $post->post_title;
										}	

										//the_title();
									?>
								</a>
							</li>
						

					</ul><!--relative_post-->

						<?php endforeach; endif;?>

				</div><!-- relative_all_post -->

			</div><!--cat_list-->

<!--<div clas="test_link">
	<?php 
		/*								
		$next_link = next_post_link(); 
		if(strlen($next_link)>5){
	
			echo "OK=$next_link";
		}else{
			echo $next_link;
		}
		*/
	?>
</div>-->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
