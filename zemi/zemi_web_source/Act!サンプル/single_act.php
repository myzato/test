<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<link rel="stylesheet" href="http://zato.moo.jp/enactus/wp-content/themes/Original/single.css" type="text/css" media="all" >

<div class="single_contents">

	<div class="clearfix"><div>
	<div class="main_contents">
		<div class="content">

			<?php while ( have_posts() ) : the_post(); ?>

				<div class="post_title">	
				<a class="post_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div><!-- post_title -->

				<div class="post_contents">
					<?php get_template_part( 'content', get_post_format() ); ?>
					<?php the_content(); ?>
				</div><!-- post_contents -->
				
				<?php //comments_template( '', true ); ?>
	
			<div class="fb_comments">
			<fb:comments href="<?php the_permalink(); ?>" width="470"></fb:comments>
			</div><!-- fb_comments -->			

			<nav class="nav-single">
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- main_content -->

<div class ="side_contents">
	<div class="cat_list">
		<h1 class="cat_title">関連記事</h1>

<?php
			   $cat = get_the_category();	
			   $cat = $cat[0];
			   $cat_id = $cat->cat_ID;
			   $posts = get_posts("numberposts=5&category=$cat_id");
			   global $post;

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

	<!--<ul>-->	
		<li>
			<a href = "<?php the_permalink();?>" class="cat_list_a"><?php the_title();?></a>
		</li>
	<!--</ul>-->
	</ul><!--relative_post-->

	<?php endforeach; endif;?>

	</div><!-- relative_all_post -->

</div><!--cat_list-->



	<?php if (function_exists('get_most_viewed')): ?>
	<ul class ="post_rank">
	<h2 id = "post_rank_title">記事ランキング</h2>    
	<?php get_most_viewed('post',5); ?>
		
	</ul>
	<?php endif; ?>


</div><!--side_contents-->

</div><!-- .single_contents -->
</div>

<?php get_footer(); ?>



