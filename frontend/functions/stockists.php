<?php

function stockists($bike_id) { 

$args = array(
	'meta_query' => array(
		array(
			'key' => 'bike_stock',
			'value' => $bike_id,
			'compare' => 'LIKE'
		),
	)
 );
 
$user_query = new WP_User_Query( $args );
foreach($user_query->results as $user) {
	$user_array[] = $user->ID;
}

return $user_array;

} ?>