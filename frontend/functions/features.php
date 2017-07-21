<?php

function features() { 

$args = array( 'post_type' => 'feature',
				'posts_per_page' => -1,
				'orderby' => 'rand',
				'order' => 'ASC'

);
		
$features = new WP_Query($args);

while( $features->have_posts() ) : $features->the_post();

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'feature' ); $url = $thumb['0']; ?>


	<li class="feature" style="background-image:url(<?php echo $url; ?>);">
		<div class="text">
			<?php the_content(); ?>
		</div>
		<a class="featurelink" href="<?php echo get_post_meta(get_the_id(), '_featurelink', true); ?>">
	</li>
</a>

<? endwhile; wp_reset_postdata(); } ?>