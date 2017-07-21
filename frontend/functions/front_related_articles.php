<?php function front_related_articles($cat,$post_id,$post_type = null) { 

	if(!$post_type) $post_type = 'news';
	
	// get data for the post we're on
	foreach(get_the_tags($post_id) as $tag){
		$tags[] = $tag->name;
	}
		
	$matching_posts = array();
	
	// get posts with matching tags
	$related_tag_args =  array (
						'post_type' => $post_type,
						'post__not_in' => array($post_id),
						'posts_per_page' => -1
	);

	$related = new WP_Query($related_tag_args);
	
	while( $related->have_posts() ) : $related->the_post();
	
		$this_tags = array();
		foreach(get_the_tags(get_the_id()) as $this_tag){
			$this_tags[] = $this_tag->name;
		}
				
		if(count(array_intersect($tags, $this_tags)) > 0){
			$matching_post['ID'] = get_the_id();
			$matching_post['tags'] = array_intersect($tags, $this_tags);
			$matching_post['tag_count'] = count(array_intersect($tags, $this_tags));
			$matching_posts[] = $matching_post;
		}
	
		foreach ($matching_posts as $key => $row)
		{
		    $tagcount[$key] = $row['tag_count'];
		}
		array_multisort($tagcount, SORT_DESC, $matching_posts);
	
	endwhile; wp_reset_postdata();
	
	
	// fill out array with posts from same category
	if(count($matching_posts) < 2 ) {
	
		$fillers = 2 - count($matching_posts);

		$related_cat_args =  array (
							'post_type' => $post_type,
							'cat' => $cat,
							'post__not_in' => array($post_id),
							'posts_per_page' => $fillers
		);
		
		$related_cat = new WP_Query($related_cat_args);
		
		while( $related_cat->have_posts() ) : $related_cat->the_post();
		
			$matching_post['ID'] = get_the_id();
			$matching_posts[] = $matching_post;
			
		endwhile;
		wp_reset_postdata();

	} 
	
	
	// render out related articles
	if(count($matching_posts) > 0) {
		
		echo '<h4 class="purple">Related articles</h4>';
		
		for($i=0; $i < 2; $i++){
			echo '<h5>';	
			echo '<a href="'.get_permalink($matching_posts[$i]['ID']).'">';
			echo get_the_title($matching_posts[$i]['ID']);
			echo '</a>';
			echo '</h5>';
		}
		
		echo '<div class="clear"></div>';
	
	}

	

} ?>