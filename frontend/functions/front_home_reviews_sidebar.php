<?php function front_home_reviews_sidebar($count = 2) { 
	
	$reviews_args =  array (
						'post_type' => 'review',
						'posts_per_page' => $count
	);

	
	
	$reviews = new WP_Query($reviews_args);

	if($reviews->post_count > 0) {
	
	echo '<div class="events fr"><h3 class="white purplegrad" style="margin-bottom:0px; padding: 8px;"><a href="/electric-bike-reviews/">Reviews</a></h3><div class="palegrey" style="padding: 0px;">';
	
	while( $reviews->have_posts() ) : $reviews->the_post();
	
	$imgpos = (get_post_meta(get_the_id(), '_thumbnailpos', true) == '' ? 'left' : get_post_meta(get_the_id(), '_thumbnailpos', true));
	$imgsize = ($imgpos == 'top' ? 'home_minithumb_top' : 'home_minithumb');

	echo '<div class="fl">';	
	echo '<a href="'; the_permalink(); echo '">';
	echo get_the_post_thumbnail(get_the_id(), 'newsfeature');
	echo '</a>';
	echo '<a href="'; the_permalink(); echo '">';
	the_title('<h5 style="padding: 8px 12px;">','</h5>');
	echo '</a>';
	echo '</div>';
	
	
	endwhile; 
	
	echo '<div class="clear"></div></div></div>';
	
	}
	
	wp_reset_postdata();

} ?>