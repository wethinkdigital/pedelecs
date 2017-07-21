<?php function front_section_landing_buttons() { 
	
	$guides_args =  array (
						'post_type' => 'page',
						'post_parent' => get_the_id(),
						'posts_per_page' => -1
	);

	
	
	$guides = new WP_Query($guides_args);
	
	while( $guides->have_posts() ) : $guides->the_post();
	
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'bikethumblarge' );
    //pre($thumb);	
	echo '<a href="'; the_permalink(); echo '">';
	echo '<div class="fl palegrey" style="width: 470px; height: 100px; margin: 0 10px 10px 0;">';
	echo '<div class="fl" style="width: 180px; height: 100px; background-color: #EEEEEE; background-image: url('.get_bloginfo('template_url').'/img/guides_button_arrow.png), url('.$thumb[0].'); background-position: right center; background-repeat: no-repeat"></div>';	
	echo '<div class="fl" style="width: 280px; padding: 10px 10px 10px 0;">';
	the_title('<h4 class="purple" style="margin-bottom:3px;">','</h4>');
	the_excerpt('<p class="grey">','</p>');
	echo '</div>';
	echo '</div>';
	echo '</a>';
	
	
	endwhile; 
		
	
	
	wp_reset_postdata();

} ?>