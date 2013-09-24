<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<link rel="stylesheet" href="/wordpress/wp-content/themes/OriginalTheme/single.css" type="text/css" media="all" >

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
 				<?php the_content(); ?>
				<nav class="nav-single">
					<!--<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>-->
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<div class ="side_contents">
<div class="cat_list" id="cat_list">
<h1 class="cat_title">＜関連記事＞</h1>

<?php
			   $cat = get_the_category();	
			   $cat = $cat[0];
			   $cat_id = $cat->cat_ID;
			   $posts = get_posts("numberposts=0&category=$cat_id");
			   global $post;

?>
	<?php if($posts): foreach($posts as $post): setup_postdata($post); ?>

<div class = "relative_post">
<div class = "side_image">
<a href="<?php the_permalink(); ?>" id="side_iamge" ><img src="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id, ”, true); echo $image_url[0]; ?>" width="50" height="50" /></a>
</div><!--side_image-->

<ul>	
<li>
<a href = "<?php the_permalink();?>" class="cat_list_a"><?php the_title();?></a>
</li>
</ul>
</div><!--relative_post-->
	<?php endforeach; endif;?>

</div><!--cat_list-->



<?php if (function_exists('get_most_viewed')): ?>
<ul class ="post_rank">
<h2 id = "post_rank_title">記事ランキング</h2>    
<?php get_most_viewed('post',5); ?>
	
</ul>
<?php endif; ?>
</div><!--side_contents-->
<script type="text/javascript"> 
			   var element = document.getElementById('cat_list').offsetHeight;
			   var primary = document.getElementById('primary');
			   function minHeight(){
				   primary.style.height = element;
			   }  
			   window.onload = minHeight();
</script> 


<!--<?php get_sidebar(); ?>-->
<?php get_footer(); ?>



