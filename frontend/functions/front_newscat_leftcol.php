<?php function front_newscat_leftcol($count,$ID) {

	switch ($ID) {
    case 368: $cat = 3; break;
    case 370: $cat = 4; break;
    case 372: $cat = 5; break;
    case 374: $cat = 6; break;
	} 
	
	
	
	// pagination settings
	$ppp = 6;
	$page=$_GET['newspage']; if(!$page) $page = 1;
	$showstart = ($page-1)*$ppp;
	$showend = $showstart + ($ppp - 1);
	
		
	
	// headline news
	$headline_news = new WP_Query(  array (
						'post_type' => 'news',
						'category__in' => array($cat),
						'posts_per_page' => 1,
						'meta_query' => array(
                              array(
                                   'key'     => '_promocat_'.$cat,
                                   'value'   => 'headline',
                                   'compare' => 'LIKE'
                                   )
                              )
	));

	while( $headline_news->have_posts() ) : $headline_news->the_post();
	
		$headline_post = get_the_id(); 
	
		if($page == 1) {
	
			echo '<div class="purplegrad" style="width: 616px; padding: 10px; margin-bottom: 10px;">';
			echo get_intro_image(get_the_id(),'newsfeature');
			echo '<h2 class="white"><a href="'.get_permalink().'">'.get_the_title(get_the_id()).'</a></h2>';
			echo '<p class="white">'.get_the_excerpt(get_the_id()).'</p>';
			echo '<div class="clear"></div></div>';
		
		}

	endwhile; wp_reset_postdata();
	
	
	// other news
	$news = new WP_Query(  array (
						'post_type' => 'news',
						'post__not_in' => array($headline_post),
						'category__in' => array($cat),
						'posts_per_page' => $count - 1,
						'meta_query' => array(
                              'relation' => 'OR',
                              array(
                                   'key'     => '_promocat_'.$cat,
                                   'value'   => 'feature',
                                   'compare' => 'NOT LIKE'
                                   ),
                              array(
                                   'key'     => '_promocat_'.$cat,
                                   'value'   => '',
                                   'compare' => 'NOT EXISTS'
                                   ),
                              )
	));


	echo '<div id="newstiles">';
	
	while( $news->have_posts() ) : $news->the_post(); 
	
	if(($news->current_post >= $showstart) && ($news->current_post <= $showend)) { ?>


	<div class="newsitem fl">
		<?php echo get_intro_image(get_the_id()); ?>
		<div class="text">
			<h5><a href="<?php the_permalink(); ?>"><?php echo get_the_title(get_the_id()); ?></a></h5>
			<?php echo get_the_excerpt(get_the_id()); ?>
		</div>
	</div>
		
	<?php } endwhile; wp_reset_postdata();
	
	echo '</div>';
	
	
	//page navigation
	
	//$url = '/jobsearch?';

	echo '<div class="pagenavi fl">';
		$pages = ceil($news->post_count/$ppp);
		if($pages > 1) {
			for($i=1; $i <= $pages; $i++) { ?>
				<a href="<?php echo '?newspage='.$i ?>">
					<div class="pagelink fl <?php if($page == $i) echo 'active'; ?>"><?php echo $i; ?></div>
				</a>
			<?php }
		} 
	echo '</div>';

	


} ?>