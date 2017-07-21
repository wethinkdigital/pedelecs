<?php function front_home_reviews($count = 10) { 
	
	$stickyreviews = new WP_Query(  array (
						'post_type' => 'review',
						'posts_per_page' => $count,
						'meta_query' => array(
                              array(
                                   'key'     => '_stickypost',
                                   'value'   => 'yes',
                                   'compare' => 'LIKE'
                                   )
                              )
	));

	$n = $count - $stickyreviews->post_count + 1;
	
	
	if($n > 0) {
		
    	$reviews = new WP_Query(  array (
    						'post_type' => 'review',
    						'posts_per_page' => $n,
    						'meta_query' => array(
                                  'relation' => 'OR',
                                  array(
                                       'key'     => '_stickypost',
                                       'value'   => 'yes',
                                       'compare' => 'NOT LIKE'
                                       ),
                                  array(
                                       'key'     => '_stickypost',
                                       'value'   => 'yes',
                                       'compare' => 'NOT EXISTS'
                                       )
                                  )
    	));

        $combined_reviews =  array_merge($stickyreviews->posts,$reviews->posts);
	
	} else {
    	
	    $combined_reviews = $stickyreviews->posts;
    	
	}
	
	$featured_review = array_shift($combined_reviews);
	
	faeo('#hide');
	//echo '<pre id="hide">'.$n; print_r($stickyreviews); echo '</pre>';
	
	echo '<h2 class="purple"><a href="/electric-bike-guides/electric-bike-reviews/">Latest Electric Bike Reviews</a></h2>';
	
	echo '<div class="purplegrad" style="width: 616px; padding: 10px; margin-bottom: 10px;">';
	
	$imgpos = 'thumb_'.get_post_meta($featured_review->ID, '_thumbnailpos', true);
	if($imgpos == 'thumb_') { $imgpos .= 'left'; }
		
	echo '<a href="'.get_permalink($featured_review->ID).'">'.get_the_post_thumbnail($featured_review->ID, 'newsfeature', array('class' => $imgpos)).'</a>';
	echo '<h2 class="white"><a href="'.get_permalink($featured_review->ID).'">'.get_the_title($featured_review->ID).'</a></h2>';
	echo '<p class="white">'.strip_tags(excerpt($featured_review->ID,80,false)).'... ';
	echo '<a href="'.get_permalink($featured_review->ID).'">Read More</a>';
	echo '</p>';
	echo '<div class="clear"></div></div>';
		
	
	echo '<div class="newstiles">';

	
	foreach($combined_reviews as $post) { 
	//echo '<pre id="hide">'.$n; print_r($post); echo '</pre>';
		
	$imgpos = 'thumb_'.get_post_meta($post->ID, '_thumbnailpos', true);
	if($imgpos == 'thumb_') { $imgpos .= 'left'; } ?>
		
	<div class="newsitem">
		<?php echo get_the_post_thumbnail($post->ID, $imgpos, array('class' => $imgpos)); ?>
		<div class="text">
			<h4><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h4>
			<p><?php echo wp_trim_words($post->post_content, 25, '... <a class="green" href="'.get_permalink($post->ID).'">Read&nbsp;more</a>'); ?></p>
		</div>
		<div class="clear"></div>
	</div>

		
	<?php }
	
	echo '</div>';
	
	echo '<h4 style="text-align: right;"><a href="/electric-bike-guides/electric-bike-reviews/">More electric bike reviews...</a></h4>';
	
	//echo '<pre>'; print_r($combined_reviews); echo '</pre>';

	wp_reset_postdata();

} ?>