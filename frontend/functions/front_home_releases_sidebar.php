<?php function front_home_releases_sidebar($count = 2) { 
	
	$releases_args =  array (
						'post_type' => 'news',
						'cat' => 4,
						'posts_per_page' => $count
	);

	
	
	
	$releases = new WP_Query($releases_args);

	//echo '<pre>'; print_r($releases); echo '</pre>';

	
	if($releases->post_count > 0) {
	
	//echo '<div class="events fr"><h2 class="purple">Latest Releases</h2><div class="palegrey" style="padding: 20px;">';
	echo '<div class="events fr"><h3 class="white purplegrad" style="margin-bottom:0px; padding: 8px;"><a href="/electric-bike-news-features/electric-bike-releases/">New Bikes</a></h3><div class="palegrey" style="padding: 0px;">';
	
	while( $releases->have_posts() ) : $releases->the_post();
	
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