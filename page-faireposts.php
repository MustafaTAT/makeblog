<?php
/**
 * @package MakeZine
 * Template Name: Maker Faire Posts
 */
?>
<?php 
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 5,
	'ignore_sticky_posts' => 1,
	'cat' => 92075710
);
$query = new WP_Query($args);
?>
<div class="newsies">
	
	<div class="news post">
		
		<h3><a href="http://blog.makezine.com/category/events-3/maker-faire-events/">Latest Maker Faire News</a></h3>

		<?php if( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		
		<div class="row">

			<div class="span2">
				
				<?php get_the_image( array( 'image_scan' => true, 'size' => 'faire-thumb' ) ); ?>
			
			</div>

			<div class="span6">

				<p><?php echo get_the_excerpt() ; ?></p>
		
				<p class="read_more"><strong><a href="<?php the_permalink(); ?>" class="btn btn-primary btn-mini">Read full story &rarr;</a></strong></p>
				
				<ul class="unstyled">
					<li>Posted by <?php the_author_posts_link(); ?> | <?php the_time('F jS, Y g:i A') ?> <?php edit_post_link('Fix me...'); ?></li>
					<li>Categories: <?php the_category(', ') ?> | <?php comments_popup_link(); ?></li>
				</ul>

			</div>

		</div>
		
		<?php endwhile; endif; ?>

		<h4><a href="http://blog.makezine.com/category/events-3/maker-faire-events/">Read More &rarr;</a></h4>
		
	</div>

</div>
