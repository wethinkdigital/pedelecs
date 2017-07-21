<?php

session_start();

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );

// build array of dealers in range
$in_range = array();

foreach(stockists($_SESSION['bike_id'],'bike') as $stockist_id){
	$stockist_postcode = get_user_meta($stockist_id, 'postcode', TRUE);
	$dist = calc_distance(preg_replace('/\s+/', '', $_SESSION['user_postcode']),preg_replace('/\s+/', '', $stockist_postcode));
	if($dist <= $_SESSION['user_distance']) {
		$stockist['id'] = $stockist_id;
		$stockist['name'] = get_user_meta($stockist_id, 'nickname', TRUE);
		$stockist['website'] = get_user_meta($stockist_id, 'url', TRUE);
		$logo = wp_get_attachment_image_src( get_user_meta($stockist_id, 'logo_id', TRUE), 'dealerlogo_tiny' );
		$stockist['logo'] = $logo[0];
		$stockist['distance'] = $dist;
		$user = new WP_User($stockist_id);
		$stockist['role'] = $user->roles[0];
		$stockist['page'] = $user->user_nicename;
		$stockist['type'] = get_user_meta($stockist_id, 'dealer_type', TRUE);
		$in_range[] = $stockist;
	}
}

// sort dealers by distance
foreach ($in_range as $key => $row) {
    $distance[$key] = $row['distance']; 
}

array_multisort($distance, SORT_ASC, $in_range);

echo '<h5 style="margin-top: 30px; color: white;">Your closest stockists</h5>';


// iterate through premium dealers first...
echo '<ul>';
foreach($in_range as $dealer) {
	if($dealer['role'] == 'dealer_premium' && $dealer['type'] != 'online') {
		echo '<li>';
		if($dealer['logo']) { echo '<img src="'.($dealer['logo']).'" class="fl"/>'; }
		echo '<p style="font-size: 14px; display: block; max-width: 170px;"><strong><a href="/dealer/'.$dealer['page'].'">'.$dealer['name'].'</a></strong></p>';
		echo '<p><a href="">More on this stockist</a></p>';
		echo '<label class="distance">'.$dealer['distance'].' miles</label>';
		echo '<div class="clear"></div>';
		echo '</li>';
	}
}
echo '</ul>';


// ...then standard dealers...
echo '<ul>';
foreach($in_range as $dealer) {
	if($dealer['role'] != 'dealer_premium' && $dealer['type'] != 'online') {
		echo '<li>';
		echo '<p style="font-size: 14px; display: block; max-width: 170px;"><strong><a href="/dealer/'.$dealer['page'].'">'.$dealer['name'].'</a></strong></p>';
		echo '<label class="distance">'.$dealer['distance'].' miles</label>';
		echo '</li>';
	}
}
echo '</ul>';


echo '<h5 style="margin-top: 30px; color: white;">Buy onlinne now</h5>';


// .. and finally online retailers
echo '<ul>';
foreach($in_range as $dealer) {
	if($dealer['type'] != 'retail') {
		echo '<li>';
		echo '<p style="font-size: 14px; display: block; max-width: 170px;"><strong><a href="/dealer/'.$dealer['page'].'">'.$dealer['name'].'</a></strong></p>';
		echo '<label class="distance"><a href="http://'.$dealer['website'].'">Visit website</a></label>';
		echo '<label>'.$dealer['type'].'</label>';
		echo '<div class="clear"></div>';
		echo '</li>';
	}
}
echo '</ul>';


?>

<pre style="color: white"><?php //print_r($in_range); ?></pre>