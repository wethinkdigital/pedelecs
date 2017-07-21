<?php

//set up bikes query
$args = array( 	'post_type' => 'bike',
				'posts_per_page' => 10,
);


// query bikes		
$bikes = new WP_Query($args);
while( $bikes->have_posts() ) : $bikes->the_post(); 

	// build args array to query each bike's images
	$attach_args = array(
					'post_type' => 'attachment',
					'post_mime_type' => array('image'),
					'posts_per_page' => '1',
					'post_status' => null,
					'post_parent' => get_the_id(),
					'orderby' => 'menu_order',
					'order' => 'ASC'
	);
	
	// query attachments for the bike we've found
	$attachments = get_posts($attach_args);
		
	// add the URL of the first attachment to our bike array
	if(count($attachments) > 0){
		$bike_array['image'] = wp_get_attachment_image( $attachments[0]->ID, 'bikethumblarge' );
	}
	
	?>
	
	<div class="prodresult" id="<?php echo get_the_id(); ?>">
		<a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $attachments[0]->ID, 'bikethumblarge' ); ?></a>
		<div class="text fr">
			<h4><a href="<?php the_permalink(); ?>"><?php echo get_post_meta(get_the_id(), 'brand', true).' '.get_post_meta(get_the_id(), 'model', true); ?></a></h4>
			<div class="excerpt fl">
				<p>
					<?php echo implode(' ', array_slice(explode(' ', get_post_meta(get_the_id(), 'description', true)), 0, 25)); ?> <a class="green" href="<?php the_permalink(); ?>">...read more</a>
				</p>
			</div>
			<div class="spec fr">
				<?php if(get_post_meta(get_the_id(), 'frame_style', true) != '') { ?>
					<p>Style: <strong><?php echo get_post_meta(get_the_id(), 'frame_style', true); ?></strong></p>	
				<?php } ?>
				
				<?php if(get_post_meta(get_the_id(), 'motor_position', true) != '') { ?>
					<p>Motor: <strong><?php echo get_post_meta(get_the_id(), 'motor_position', true); ?></strong></p>	
				<?php } ?>
				
				<?php if(get_post_meta(get_the_id(), 'weight', true) != '') { ?>
					<p>Weight: <strong><?php echo get_post_meta(get_the_id(), 'weight', true); ?>kg</strong></p>	
				<?php } ?>
				
				<?php if(get_post_meta(get_the_id(), 'rrp', true) != '') { ?>
					<p>RRP: <strong>&pound;<?php echo get_post_meta(get_the_id(), 'rrp', true); ?></strong></p>	
				<?php } ?>
				
				
				
				<p class="purple add_to_shortlist">Add to shortlist</p><input type="hidden" name="prodname" value="<?php echo get_post_meta(get_the_id(), 'brand', true).' '.get_post_meta(get_the_id(), 'model', true); ?>" /><input type="hidden" name="prod_id" value="<?php echo get_the_id(); ?>" /></div></div><div class="clear"></div></div>

<?php endwhile;
wp_reset_postdata();

?>