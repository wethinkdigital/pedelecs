<?php

function front_news_landing_feature() { 

// get featured item from news landing page admin
//$latest_feature_id = get_post_meta(get_the_id(), 'latest_feature', TRUE); 
//$feature = get_post($latest_feature_id);

$args = array('posts_per_page' => 1,
                'post_type' => 'news');
                
$features = new WP_Query($args);
//echo '<pre>'; print_r($features->posts); echo '</pre>';
//echo $features->posts[0]->ID;
while( $features->have_posts() ) : $features->the_post();?>


<div class="stage purplegrad" style="padding: 20px; box-sizing: border-box; margin-bottom: 10px;">
	<h1 class="purple emboss">Latest</h1>
	    <div class="fl" style="margin: 0 20px 20px 0;"><a href="<?php the_permalink(); ?>"><?php echo get_intro_image(get_the_ID()); ?></a></div>
		<h2 style="color: white;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p style="color: white !important;"><?php the_excerpt(); ?></p>
		<div class="clear"></div>
</div>


<?php endwhile; wp_reset_postdata(); } ?>