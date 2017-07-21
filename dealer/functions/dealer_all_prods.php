<?php

function all_prods($prod_type = null){
	
	foreach(brand_array($prod_type) as $brand){
		$prods[$brand] = prods_array($brand,$prod_type);
	}

	
	return $prods;	
}

function brand_array($prod_type = null){
	global $wpdb;
	$all_brands = $wpdb->get_results(  "SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'brand' " );
	
	foreach($all_brands as $brand) {
		$brands[] = $brand->meta_value;
	}
	asort($brands);
	return array_filter($brands);
}



function prods_array($brand,$prod_type){

	$args = array('post_type' => $prod_type,
					'posts_per_page' => -1,
					'meta_query' => array(
						array(
							'key' => 'brand',
							'value' => $brand,
							'compare' => 'LIKE'
						)
					)
				);
					
	$all_prods = new WP_Query($args);
	while( $all_prods->have_posts() ) : $all_prods->the_post();
	
		$ID = get_the_ID();
		$model = get_post_meta(get_the_id(), 'model', true);
		$prods[$ID] = $model;
							
	endwhile; wp_reset_postdata();
	return $prods;
}



?>