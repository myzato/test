<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 * * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<!--<div class="se-slope">-->	
		<div id="content" class="site-content" role="main">

			<input type="button" value="About Us" class="about_button" onClick="window.open('http://zato.moo.jp/okinawa/?page_id=31')">
			<!--<button class="about_button">Abount Us</button>-->

			<section class="se-container">
			<div class="top_second">	
				<div class="first-se-slope"><!-- first -->
					<article class="se-content">
						<h3>Each of us has an <span>entrepreneurial spirit.</span></h3>	
						<p>
							<span>A passion that—if unleashed—can inspire others to act.</span>
							<span>A talent that—if developed—can create opportunity for</span>
							<span>ourselves, our families and our communities. An idea</span>
							<span>that—if cultivated—can build a healthier,</span>
							<span>more prosperous and peaceful world.</span>
						</p>	
					</article>
				</div><!-- first-se-slope -->
			</div><!-- top_second -->

			<div class="top_third">
				<div class="second-se-slope"><!-- second -->
					<article class="se-content">
						<h3>We are a <span>community</span></h3>
						<p>of people who understand the transformative power of entrepreneurship in spirit and practice. We believe that the creativity and rigor and accountability that ensure businesses will flourish are just as essential to creating the circumstance for humankind to thrive.</p>	
					</article>
				</div><!-- se-slope -->
			</div><!-- top_third -->

			<div class="top_fouth">
				<div class="third-se-slope"><!-- third -->
					<article class="se-content">
						<h3>Together we pledge <br><span>to take action.</span></h3>
						<p>
							<span>Together we commit to apply our passions and talents</span>
							<span>and ideas to impact as many lives as we can. Not to</span>
							<span>hand out help to people in need, but to work</span>
							<span>side-by-side with them to create opportunity. So every</span>
							<span>person and community we touch is empowered to live</span>
							<span>up to their fullest potential.</span>
						</p>	
						
						<?php if ( have_posts() ) : ?>

								<?php /* The loop */ ?>
										<?php while ( have_posts() ) : the_post(); ?>
								<?php //get_template_part( 'content', get_post_format() ); ?>
								<?php
									$image_id = get_post_thumbnail_id();
									$image_url = wp_get_attachment_image_src($image_id, true);
								?>
									<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"></a>
						<?php endwhile; ?>
								<?php twentythirteen_paging_nav(); ?>
						<?php else : ?>
								<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>

					</article>
				</div><!-- se-slope -->	
			</div><!-- top_fourth -->

			<div class="top_fifth">                                                                                                                              
				<div class="fourth-se-slope"><!-- fourth -->
					<article class="se-content">
						<h3>私達はEnactusです</h3>
						<div class="flex-video"><div class="vid" id="medvid2"></div></div>
							<a href="http://enactus.org/social-stream/" class="hbutton-orange"><span>See the conversation</span></a>
							<script type="text/javascript">
							    jwplayer("medvid2").setup({
								flashplayer: "/wp-content/themes/enactus/js/jwplayer/player.swf",
								file: "http://enactus.s3.amazonaws.com/video/manifesto.mp4",
								image: "/wp-content/themes/enactus/images/weareenactus/home-video-thumb.png",
								height: '100%',
								width: '100%'
							    });
							</script>
						</div><!-- flex-video -->	
					</article>
				</div><!-- se-slope -->
			</div><!-- top_fifth -->

			</section>
			</div><!-- #content,.site-content -->
		<!--</div>--><!-- .se-slope -->
	</div><!-- #primary,.content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
