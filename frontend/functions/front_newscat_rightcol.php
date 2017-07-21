<?php function front_newscat_rightcol($count = 2,$ID) {

	switch ($ID) {
    case 368: $cat = 3; break;
    case 370: $cat = 4; break;
    case 372: $cat = 5; break;
    case 374: $cat = 6; break;
	} 
	
	// featured news
	
	$featured_news = new WP_Query(  array (
						'post_type' => 'news',
						'category__in' => array($cat),
						'posts_per_page' => $count,
						'meta_query' => array(
                              array(
                                   'key'     => '_promocat_'.$cat,
                                   'value'   => 'feature',
                                   'compare' => 'LIKE'
                                   )
                              )
	));

		
	
	while( $featured_news->have_posts() ) : $featured_news->the_post(); 
		

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