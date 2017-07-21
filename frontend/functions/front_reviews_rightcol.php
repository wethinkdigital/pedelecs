<?php function front_reviews_rightcol($count = 2) {

	
	// featured reviews
	
	$featured_reviews = new WP_Query(  array (
						'post_type' => 'review',
						'posts_per_page' => $count,
						'meta_query' => array(
                              array(
                                   'key'     => '_promoreview',
                                   'value'   => 'feature',
                                   'compare' => 'LIKE'
                                   )
                              )
	));

		
	
	while( $featured_reviews->have_posts() ) : $featured_reviews->the_post(); 
		

	$img = get_intro_image(get_the_id());
		
	?>
		
	<div class="featured_newsitem fl">
		<?php echo $img; ?>
		<div class="text">
			<h4 class="purple"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(get_the_id()); ?></a></h4>
			<?php echo get_the_excerpt(get_the_id()); ?>
		</div>
	</div>
	
	<?php endwhile; wp_reset_postdata();
	
	

} ?>