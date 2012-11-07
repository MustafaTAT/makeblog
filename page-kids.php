<?php
/**
 * Template Name: Kids
 */
?>


<?php get_header(); ?>
		
		<div class="clear"></div>

		<div class="sand superpage">

			<div class="container">

				<div class="row">

					<div class="span12">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php the_title('<h1>','</h1>'); ?>

						<div class="row">

							<div class="span8">

								<h3 class="red">Kids &amp; Family on the Blog</h3>	

								<div class="new-grid top">

									<div class="row">

										<div class="span8">

											<?php $the_query = new WP_Query( 'cat=129975&posts_per_page=6' ); ?>

											<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						
											<article <?php post_class('row'); ?>>
												
												<div class="span2 blurb-thumbnail">

													<?php the_post_thumbnail( 'new-thumb' ); ?>

												</div>

												<div class="span6 blurb-blurb">

													<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
													
													<p><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?> <a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>

													<p class="meta">By <?php the_author_posts_link(); ?>, <?php the_date(); ?> @ <?php the_time(); ?></p>
												
												</div>
											
											</article>

											<hr />

											<?php endwhile; wp_reset_postdata(); ?>

											<p><a href="http://blog.makezine.com/category/kids/"><span class="pull-right light aqua seeall right">See All Posts</span></a></p>

										</div>

									</div>

								</div>

								<?php the_content(); ?>
								<?php endwhile; ?>
								<!-- post navigation -->
								<?php else: ?>
								<!-- no posts found -->
								<?php endif; ?>

							</div>


							<div class="span4 sidebar">

								<div class="sidebar-ad">

									<div id='div-gpt-ad-664089004995786621-2'>
										<script type='text/javascript'>
											googletag.display('div-gpt-ad-664089004995786621-2');
										</script>
									</div>

								</div>

								<h3 class="red">Maker Faire</h3>

								<div class="new-grid top">

									<div class="row">

										<div class="span4">

											<?php $the_query = new WP_Query( 'cat=92075710&posts_per_page=3' ); ?>

											<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						
											<article <?php post_class(); ?>>
												
												<div class="blurb-thumbnail">

													<?php the_post_thumbnail( 'side-thumb' ); ?>

												</div>

												<div class="blurb-blurb">

													<h4><a class="aqua" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
													<?php echo wp_trim_words(get_the_content(), 16, '...') ; ?>
												
												</div>
											
											</article>

											<hr />

											<?php endwhile; wp_reset_postdata(); ?>

										</div>

									</div>

								</div>

								
								<div class="blue-box">

									<h3>Get Free Exclusive Content!</h3>

									<form class="form-inline" action="http://makermedia.createsend.com/t/r/s/jjuylk/" method="post" id="subForm">
										<input type="text" name="cm-jjuylk-jjuylk" id="jjuylk-jjuylk" class="input" placeholder="Enter your email">
										<button type="submit" class="btn btn-danger">GO!</button>
									</form>

									<p><strong>Join the <span class="red">Make:</span> newsletter and receive exclusive discounts and news!</strong></p>

								</div>

								<div class="categories">

									<div class="row">

										<div class="span2">

											<ul>
												<li><a href="http://blog.makezine.com/category/art-design/">Art &amp; Design</a></li>
												<li><a href="http://blog.makezine.com/category/desktop-manufacturing-2/">Desktop Manufacturing</a></li>
												<li><a href="http://blog.makezine.com/category/computers-mobile/">Computers &amp; Mobile</a></li>
												<li><a href="http://blog.makezine.com/category/craft-2/">Craft</a></li>
												<li><a href="http://blog.makezine.com/category/electronics/">Electronics</a></li>
												<li><a href="http://blog.makezine.com/category/energy/">Energy</a></li>
												<li><a href="http://blog.makezine.com/category/events-holidays/">Events &amp; Holidays</a></li>
												<li><a href="http://blog.makezine.com/category/flight-projectiles/">Flight &amp; Projectiles</a></li>
												<li><a href="http://blog.makezine.com/category/green/">Green</a></li>
												<li><a href="http://blog.makezine.com/category/home-and-garden/">Home &amp; Garden</a></li>
												
											</ul>

										</div>

										<div class="span2">

											<ul>
												<li><a href="http://blog.makezine.com/category/imaging/">Imaging</a></li>
												<li><a href="http://blog.makezine.com/category/kids-family/">Kids</a></li>
												<li><a href="http://blog.makezine.com/category/makers/">Makers</a></li>
												<li><a href="http://blog.makezine.com/category/microcontrollers-2/">Microcontrollers</a></li>
												<li><a href="http://blog.makezine.com/category/recreation-entertainment/">Recreation &amp; Entertainment</a></li>
												<li><a href="http://blog.makezine.com/category/robotics/">Robots</a></li>
												<li><a href="http://blog.makezine.com/category/science/">Science</a></li>
												<li><a href="http://blog.makezine.com/category/shop-craft/">Shop Craft</a></li>
												<li><a href="http://blog.makezine.com/category/toys_and_games/">Toys &amp; Games</a></li>
												<li><a href="http://blog.makezine.com/category/workshop-tools/">Workshops &amp; Tools</a></li>
												<li><a href="http://blog.makezine.com/category/vehicles-2/">Vehicles</a></li>
											</ul>

										</div>
									
									</div>

								</div>	

								<div class="new-dotw">

									<?php
										
										$the_query = new WP_Query( 'post_type=from-the-maker-shed&posts_per_page=1' );

										while ( $the_query->have_posts() ) : $the_query->the_post();
											$ftms_link = get_post_custom_values( 'ftms_link' );
											if( !isset($ftms_link[0]) ){
												$ftms_link[0] = 'http://www.makershed.com/';
											}
											echo '<a href="'. esc_url( $ftms_link[0] ).'">';
											the_post_thumbnail('ftms-thumb');
											echo '</a>';
										endwhile;

										// Reset Post Data
										wp_reset_postdata();

									?>

								</div>

							</div>

						</div>

					</div><!-- Main Div -->


				</div>

			<?php get_footer(); ?>
