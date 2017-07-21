<?php

function front_home_featured_video() { 

$args = array( 'post_type' => 'video',
				'posts_per_page' => 1,
				'orderby' => 'rand'

);
		
$video = new WP_Query($args);

while( $video->have_posts() ) : $video->the_post();

?>
<div class="fl" style="width: 460px;">
	<h4 class="white">Featured electric bike video:</h4>
	<h5 style="color: white"><?php the_title(); ?></h5>
	<div class="white"><?php the_content(); ?></div>
</div>

<div class="fr">
	<?php echo get_post_meta(get_the_id(), '_video', true); ?>
</div>

<div class="clear"></div>


<? endwhile;  wp_reset_postdata(); } ?>