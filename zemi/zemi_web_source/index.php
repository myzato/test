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

	<div class="content-area masonry" >
								
						<?php if ( have_posts() ) : ?>

								<?php /* The loop */ ?>
										<?php $num=0; while ( have_posts() ) : the_post(); ?>
								<?php //get_template_part( 'content', get_post_format() ); ?>
								<?php
									$image_id = get_post_thumbnail_id();
									$image_url = wp_get_attachment_image_src($image_id, true);
									//$num = 1;
									$num++;
								?>
									
							<!--	<div class="<?php //the_title(); ?> transitions-enabled masonry">-->
							
									<!--
									<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
									<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
									-->


									<?php
										//echo $num;
									
										switch($num){ case "1":
									?>	
											
											<div class="col1 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text">
													
													<span class="post_title" href="<?php echo the_permalink(); ?>">

													<?php
														if(mb_strlen($post->post_title)>17) { 
															$title= mb_substr($post->post_title,0,17) ; echo $title. ･･･ ;
														} else {
															echo $post->post_title;
														}
													?>
													</span><!-- post_title -->	
													<!--	
													<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('Y-m-d'); ?></span>
													-->	
												</div><!-- post_text -->	
											</div><!-- col_first -->


									<?php	
											break;
																			
										case "2":
											
									
									?>	
											
											<div class="col4 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<!--<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>-->	
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>20) { $title= mb_substr($post->post_title,0,20) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span> 													
												</div><!-- post_text -->	

											</div><!-- col4 -->


									<?php	
											break;
										case "3":
									?>	
											<div class="col4 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<!--<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>-->  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>20) { $title= mb_substr($post->post_title,0,20) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span> 												
												</div><!-- post_text -->	

											</div><!-- col1 -->
											

									<?php	
											break;
										case "4":
									?>	

											<div class="col2 box masonry-brick like_box">
												
											<?php

											function device_fb(){
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

											if (device_fb() == pc){
											?>

												<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fzemiyamori&amp;width=300px&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=705936116102215" scrolling="no" frameborder="0" style="border:none; overflow:scroll; width:300pxpx; height:290px;" allowTransparency="true"></iframe>

											<?
											}else{

											?>		
												<a href="https://www.facebook.com/zemiyamori"><img src="http://miyamori-zemi.com/wp-content/themes/copy/images/fb_icon.png" class="top_thumb"></a>

											<?
											}

											?>

                                                					</div><!-- like_box -->
										
									<?php	
											break;
										case "5":
									?>	
											
										<div class="col2 box masonry-brick tweet">
																			
										<?php

										function device_tw(){
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

										if (device_tw() == pc){
										?> 
										  
											<a class="twitter-timeline" href="https://twitter.com/zemiyamori" data-widget-id="392203365972590592">@zemiyamori からのツイート</a>

											  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 

										<? 
										}else{
										?> 
								
		 									<a href="https://twitter.com/zemiyamori"><img src="http://miyamori-zemi.com/wp-content/themes/copy/images/tw_icon.jpeg" class="top_thumb"></a>

										<? 
										}
										?>

										</div><!-- tweet -->


									<?php	
											break;
										case "6":
									?>	
											
											<div class="col1 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<!--<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>-->  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>17) { $title= mb_substr($post->post_title,0,17) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span> 													
												</div><!-- post_text -->
											</div><!-- col1 -->

									<?php	
											break;
										case "7":
									?>	
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<!--<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>-->  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>9) { $title= mb_substr($post->post_title,0,9) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span> 													
												</div><!-- post_text -->
											</div><!-- col1 -->

									<?php	
											break;
										case "8":
									?>	
											
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<!--<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>-->  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>9) { $title= mb_substr($post->post_title,0,9) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span> 												
												</div><!-- post_text -->	

											</div><!-- col2 -->
									<?php	
											break;
										case "9":
									?>	
											
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												
											<?php if(device_check() == pc){ ?>										

												<div class="post_text"> 
														<span class="post_title" href="<?php echo the_permalink(); ?>">
															<?php
																if(mb_strlen($post->post_title)>9) {
																	$title = mb_substr($post->post_title,0,9) ; echo $title. ･･･ ;
																} else {
																	echo $post->post_title;
																}

															?>
														</span> 													
												</div><!-- post_text -->	
											<?php } ?>


											</div><!-- col3 -->

									<?php	
											break;
										case "10":
									?>	
											
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
											
											<?php if(device_check() == pc){ ?>
												<div class="post_text"> 
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>9) { $title= mb_substr($post->post_title,0,9) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span> 												
												</div><!-- post_text -->
											<?php } ?>
											

											</div><!-- col1 -->
									<?php	
											break;
										case "11":
									?>	
											
											<div class="col_1 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
											<?php if(device_check() == pc){ ?>	
													<div class="post_text">	
														<span class="post_title" href="<?php echo the_permalink(); ?>">
															<?php
															if(mb_strlen($post->post_title)>17) { $title= mb_substr($post->post_title,0,17) ; echo $title. ･･･ ;
															} else {echo $post->post_title;}?>
														</span> 													
													</div><!-- post_text -->	
											<?php } ?>	
											</div>

									<?php	
											break;
																			
										case "12":
									?>	
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<!--<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>-->	
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>10) { $title= mb_substr($post->post_title,0,10) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span> 													
												</div><!-- post_text -->	

											</div><!-- col2 -->


									<?php	
											break;
										case "13":
									?>	
											
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<!--<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>-->  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>10) { $title= mb_substr($post->post_title,0,10) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span>   													
												</div><!-- post_text -->	

											</div><!-- col1 -->
									<?php	
											break;
										case "14":
									?>	
											
											<div class="col2 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>10) { $title= mb_substr($post->post_title,0,10) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span>   													
												</div><!-- post_text -->
											</div><!-- col2 -->	

									<?php	
											break;
										case "15":
									?>	
											
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>5) { $title= mb_substr($post->post_title,0,5) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span>   												
												</div><!-- post_text -->
											</div><!-- col3 -->

									<?php	
											break;
										case "16":
									?>	
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>10) { $title= mb_substr($post->post_title,0,10) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span>   												
												</div><!-- post_text -->
											</div><!-- col1 -->

									<?php	
											break;
										case "17":
									?>	
											
											<div class="col3 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>10) { $title= mb_substr($post->post_title,0,10) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span>   												
												</div><!-- post_text -->
											</div><!-- col1 -->
									<?php	
											break;
										case "18":
									?>	
											
											<div class="col1 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>17) { $title= mb_substr($post->post_title,0,17) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span>   												
												</div><!-- post_text -->	

											</div><!-- col2 -->

									<?php	
											break;
										case "19":
									?>	
											
											<div class="col1 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>5) { $title= mb_substr($post->post_title,0,5) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span>   												
												</div><!-- post_text -->	

											</div><!-- col3 -->

									<?php	
											break;
										case "20":
									?>	
											
											<div class="col1 box masonry-brick">
												<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" class="top_thumb"><?php //the_title(); ?></a>
												<div class="post_text"> 
													<span class="post_date" href="<?php echo the_permalink(); ?>"><?php the_time('m/d'); ?></span>  
													<span class="post_title" href="<?php echo the_permalink(); ?>">
                                                                                                                <?php
                                                                                                                if(mb_strlen($post->post_title)>10) { $title= mb_substr($post->post_title,0,10) ; echo $title. ･･･ ;
                                                                                                                } else {echo $post->post_title;}?>
                                                                                                        </span>   												
												</div><!-- post_text -->	
											</div><!-- col1 -->
									<?php	
											break;
										
										}


									?>




								<!--</div>--><!-- title -->

						<?php endwhile; ?>
								<?php //twentythirteen_paging_nav(); ?>
						<?php else : ?>
								<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>


						
	</div><!-- #primary,.content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
