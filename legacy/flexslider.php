<div class="flex-container">
<div class="flexslider">
<ul class="slides">

<?php

$args = array (	'post_type' => 'slide',
				'order' => 'ASC',
				'orderby' => 'date',
				'posts_per_page' => '-1',
				);
				
$slides = new WP_Query($args);

while( $slides->have_posts() ) : $slides->the_post();


?>
			<?php 
			
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id,'full', true);
			$thumburl = $image_url[0];  
			//$link = get_post_meta(get_the_id(), 'link_url', true);

			?>
			
	    
	    	<li class="slide">
		    	<img src="<?php echo $thumburl; ?>">
	    	</li>
	    
	    	
<? endwhile; wp_reset_postdata();?>
	    	
	    </ul>
	    </div>

</div>