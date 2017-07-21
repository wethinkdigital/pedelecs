<?php

function brands_array($prod_type = 'bike') { 

$args = array( 'post_type' => $prod_type,
				'posts_per_page' => -1

);
		
$bikes = new WP_Query($args);
while( $bikes->have_posts() ) : $bikes->the_post();
	$brands_array[] = get_post_meta(get_the_id(), 'brand', true);
endwhile;
natcasesort($brands_array);
wp_reset_postdata();
return array_filter(array_unique($brands_array));

} ?>