<?php function front_home_events($count = 2) { 
	
	$events_args =  array (
						'post_type' => 'news',
						'cat' => 6,
						'posts_per_page' => $count
	);

	
	
	$events = new WP_Query($events_args);

	if($events->post_count > 0) {
	
	//echo '<div class="events fr"><h2 class="purple">Latest Events</h2><div class="palegrey" style="padding: 20px;">';
		echo '<div class="events fr"><h3 class="white purplegrad" style="margin-bottom:0px; padding: 8px;"><a href="/electric-bike-news-features/exhibitions-events/">Events</a></h3><div class="palegrey" style="padding: 20px;">';
		
	while( $events->have_posts() ) : $events->the_post();
	
	$imgpos = (get_post_meta(get_the_id(), '_thumbnailpos', true) == '' ? 'left' : get_post_meta(get_the_id(), '_thumbnailpos', true));
	$imgsize = ($imgpos == 'top' ? 'home_minithumb_top' : 'home_minithumb');

	echo '<div class="fl">';	
	echo get_the_post_thumbnail(get_the_id(), $imgsize, array('class' => 'thumb_'.$imgpos));
	echo '<a href="'; the_permalink(); echo '">';
	the_title('<h5>','</h5>');
	echo '</a>';
	the_excerpt('<p>','</p>');
	echo '</div>';
	
	
	endwhile; 
	
	echo '<div class="clear"></div></div></div>';
	
	}
	
	wp_reset_postdata();

} ?>