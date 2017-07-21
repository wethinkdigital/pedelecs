<?php function front_home_agg($count = 10) { 
    
	
	$stickynews = new WP_Query(  array (
						'post_type' => array('news','review'),
						//'category__in' => array( 3, 5 ),
						'posts_per_page' => $count,
						'meta_query' => array(
                              array(
                                   'key'     => '_stickypost',
                                   'value'   => 'yes',
                                   'compare' => 'LIKE'
                                   )
                              )
	));

	$n = $count - $stickynews->post_count + 1;
	
	//echo 'count: '.$count.'<br />';
	//echo 'n: '.$n.'<br />';
	
	if($n > 0) {
		
    	$news = new WP_Query(  array (
							'post_type' => array('news','review'),
    						//'category__in' => array( 3, 5 ),
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

        $combined_news =  array_merge($stickynews->posts,$news->posts);
	
	} else {
    	
	    $combined_news = $stickynews->posts;
    	
	}
	
	$feature = array_shift($combined_news);
	
	faeo('#hide');
	//echo '<pre id="hide">'.$n; print_r($combined_news); echo '</pre>';
	
	echo '<h2 class="purple">Latest Electric Bike News & Features</h2>';
	
	echo '<div class="purplegrad" style="width: 616px; padding: 10px; margin-bottom: 10px;">';
	
	$imgpos = 'thumb_'.get_post_meta($feature->ID, '_thumbnailpos', true);
	if($imgpos == 'thumb_') { $imgpos .= 'left'; }
		
	echo '<a href="'.get_permalink($feature->ID).'">'.get_the_post_thumbnail($feature->ID, 'newsfeature', array('class' => $imgpos)).'</a>';
	echo '<h2 class="white"><a href="'.get_permalink($feature->ID).'">'.get_the_title($feature->ID).'</a></h2>';
	//echo '<p class="white">'.excerpt($feature->ID).'... <a href="'.get_permalink($feature->ID).'">Read more</a></p>';
	echo '<p class="white">'.excerpt($feature->ID,80,false).'... <a href="'.get_permalink($feature->ID).'">Read more</a></p>';
	echo '<div class="clear"></div></div>';
		
	
	echo '<div class="newstiles">';

	
	foreach($combined_news as $post) { 
	//echo '<pre id="hide">'.$n; print_r($post); echo '</pre>';
		
	$imgpos = 'thumb_'.get_post_meta($post->ID, '_thumbnailpos', true);
	if($imgpos == 'thumb_') { $imgpos .= 'left'; } ?>
		
	<div class="newsitem">
		<?php echo get_the_post_thumbnail($post->ID, $imgpos, array('class' => $imgpos)); ?>
		<div class="text">
			<h4><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h4>
			<p><?php echo strip_shortcodes(wp_trim_words($post->post_content, 25, '... <a class="green" href="'.get_permalink($post->ID).'">Read&nbsp;more</a>')); ?></p>
		</div>
		<div class="clear"></div>
	</div>

		
	<?php }
	
	echo '</div>';
	
    echo '<h4 style="text-align: right;"><a href="/electric-bike-news-features/">More News & Features...</a></h4>';

	
	//echo '<pre>'; print_r($combined_news); echo '</pre>';

	wp_reset_postdata();

} ?>