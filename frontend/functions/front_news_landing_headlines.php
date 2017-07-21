<?php

function front_news_landing_headlines($cat) { 

$feature_args = array('posts_per_page' => 1,
                'post_type' => 'news');
                
$feature = get_posts($feature_args);

$args = array('post_type' => 'news',
				'category_name' => $cat,
				'posts_per_page' => 5,
				'post__not_in' => array($feature[0]->ID)
);
				
$catnews = new WP_Query($args);

while( $catnews->have_posts() ) : $catnews->the_post();

if($catnews->current_post == 0) { ?>

	<?php echo get_intro_image($catnews->ID,'dealerlogo'); ?>
	<h3 class="purple"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
	<p><?php echo the_excerpt(); ?></p>
	<div class="clear"></div>
	
<?php } else { ?>

	<h4 class="purple"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	
<?php }

endwhile; wp_reset_postdata(); }?>