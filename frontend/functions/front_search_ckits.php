<?php

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );

session_start();
if($_POST['user_postcode']) {$_SESSION['user_postcode'] = $_POST['user_postcode']; }
if($_POST['user_distance']) {$_SESSION['user_distance'] = $_POST['user_distance']; }


$searchlog_vars = array('brands');

foreach($_POST as $k => $v) {
	if(in_array($k, $searchlog_vars)) {
		$search[$k] = $v;
	}
}
$wpdb->insert( 'ckitsearches', $search); 


// create array for final data send back to script
$returned_ckits = array();


///////////////////// keyword search using wpdb ////////////////////////

			

//set up initial ckits query
$args = array( 	'post_type' => 'ckit',
				'posts_per_page' => 999,
);

// keyword search
if($_POST['keywords'] != ''){
	$keywords = sanitize_text_field( $_POST['keywords'] );
	
	// multiword search?
	//$keywords_array = $keywords;
	
	// search meta data
	$post_ids_meta = $wpdb->get_col( " SELECT DISTINCT post_id FROM {$wpdb->postmeta} WHERE meta_key NOT LIKE '\_%' AND meta_value LIKE '%".mysql_real_escape_string($keywords)."%'" );
	
	// Search in post_title and post_content
	$post_ids_post = $wpdb->get_col( " SELECT DISTINCT ID FROM {$wpdb->posts} WHERE post_title LIKE '%".mysql_real_escape_string($keywords)."%' OR post_content LIKE '%".mysql_real_escape_string($keywords)."%' ");
		
	$args['post__in'] = array_merge( $post_ids_meta, $post_ids_post );
}

//sorting
if($_POST['sorting'] == 'price_asc' || $_POST['sorting'] == ''){
	$args['meta_key'] = 'rrp';
	$args['orderby'] = 'meta_value_num';
	$args['order'] = 'ASC';
}

if($_POST['sorting'] == 'price_desc'){
	$args['meta_key'] = 'rrp';
	$args['orderby'] = 'meta_value_num';
	$args['order'] = 'DESC';
}

if($_POST['sorting'] == 'brand_asc'){
	$args['meta_key'] = 'brand';
	$args['orderby'] = 'meta_value';
	$args['order'] = 'ASC';
}

if($_POST['sorting'] == 'brand_desc'){
	$args['meta_key'] = 'brand';
	$args['orderby'] = 'meta_value';
	$args['order'] = 'DESC';
}

if($_POST['sorting'] == 'model_asc'){
	$args['meta_key'] = 'brand';
	$args['orderby'] = 'meta_value';
	$args['order'] = 'ASC';
}

if($_POST['sorting'] == 'model_desc'){
	$args['meta_key'] = 'brand';
	$args['orderby'] = 'meta_value';
	$args['order'] = 'DESC';
}


// define expected $_POST vars
$validpost = array('use','frame_type','frame_style','motor_position','throttle','place_manufacture','wheel_size','weight','motor_power','discontinued');

// iterate through $_POST, checking that each var is expected and build additional meta_query array
foreach($_POST as $k=>$v){
	if($v != '' && in_array($k, $validpost)){
		
		$newmeta = array();
		$newmeta['key'] = $k;
		if(strstr($v, '/')) {
			$newmeta['value'] = explode('/', $v);
			$newmeta['compare'] = 'BETWEEN';
		} else {
			$newmeta['value'] = $v;
			$newmeta['compare'] = 'LIKE';
		}
		
		$args['meta_query'][] = $newmeta;
	}
	
}

// brands query
if(isset($_POST['brands'])) {
	$brands = explode(', ', $_POST['brands']);
	$brandsmeta = array(
		'key' => 'brand',
		'value' => $brands,
		'compare' => 'IN'
	);
	$args['meta_query'][] = $brandsmeta;
}

// query ckits

if(isset($args['post__in']) && count($args['post__in']) == 0 ){ $args['post__in'] = array('0'); }

$ckits = new WP_Query($args);
while( $ckits->have_posts() ) : $ckits->the_post();

// keyword search
if(isset($_POST['keywords'])) {
	$keywords_array = explode(' ', $_POST['keywords']);
	$allmeta = get_post_custom(get_the_id());
	if(in_array($keywords_array, $allmeta)){
		
	}
}


// build a data array for each ckit found
$ckit_array = array();
$ckit_array['brand'] = get_post_meta(get_the_id(), 'brand', TRUE);
$ckit_array['model'] = get_post_meta(get_the_id(), 'model', TRUE);
$ckit_array['weight'] = get_post_meta(get_the_id(), 'weight', TRUE);
$ckit_array['motor_power'] = get_post_meta(get_the_id(), 'motor_power', TRUE);
$ckit_array['rrp'] = get_post_meta(get_the_id(), 'rrp', TRUE);
$ckit_array['description'] = get_post_meta(get_the_id(), 'description', TRUE);
$ckit_array['permalink'] = get_permalink(get_the_id());
$ckit_array['id'] = get_the_id();


// build args array to query each ckit's images
$attach_args = array(
				'post_type' => 'attachment',
				'post_mime_type' => array('image'),
				'posts_per_page' => '1',
				'post_status' => null,
				'post_parent' => get_the_id(),
				'orderby' => 'menu_order',
				'order' => 'ASC'
);

// query attachments for the ckit we've found
$attachments = get_posts($attach_args);

	
// add the URL of the first attachment to our ckit array
if(count($attachments) > 0){
	$ckit_array['image'] = wp_get_attachment_image( $attachments[0]->ID, 'bikethumblarge' );
}
	

// combine into one array to be returned to the script
$returned_ckits[] = $ckit_array;
//$returned_ckits['args'] = $args;

endwhile;
wp_reset_postdata();

echo json_encode($returned_ckits);

?>