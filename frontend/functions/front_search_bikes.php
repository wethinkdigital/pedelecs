<?php

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );

session_start();
/*
if(isset($_POST)) {
    foreach($_POST as $k=>$v) {
        $_SESSION[$k] = $_POST[$v];
    }
    $_SESSION['fromsearchfunction'] = 'yeah';
}
*/

if(isset($_POST)) { $_SESSION = $_POST; }

        
/*
if($_POST['user_postcode']) {$_SESSION['user_postcode'] = $_POST['user_postcode']; }
if($_POST['user_distance']) {$_SESSION['user_distance'] = $_POST['user_distance']; }
*/
//$_SESSION['user_postcode'] = 'my postcode';




$searchlog_vars = array('use','frame_type','frame_style','motor_position','keywords','brands','place_manufacture','throttle','wheel_size','weight','motor_power','discontinued');

foreach($_POST as $k => $v) {
	if(in_array($k, $searchlog_vars)) {
		$search[$k] = $v;
	}
}
$wpdb->insert( 'bikesearches', $search); 


// create array for final data send back to script
$returned_bikes = array();


///////////////////// keyword search using wpdb ////////////////////////

			

//set up initial bikes query
$args = array( 	'post_type' => 'bike',
				'posts_per_page' => -1,
);

// keyword search
if(isset($_POST['keywords']) && $_POST['keywords'] != ''){
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
$validpost = array('frame_type','frame_style','motor_position','throttle','place_manufacture','wheel_size','weight','motor_power');

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
			$newmeta['compare'] = '=';
		}
		
		$args['meta_query'][] = $newmeta;
	}
	
}


$args['meta_query'][] = $disc;

// use query
if(isset($_POST['use']) && $_POST['use'] != '') {
	$usemeta = array(
		'key' => $_POST['use'],
		'value' => 'TRUE',
		'compare' => 'LIKE'
	);
	$args['meta_query'][] = $usemeta;
    
}

// brands query
if(isset($_POST['brands']) && $_POST['brands'] != '') {
	$brands = explode(', ', $_POST['brands']);
	$brandsmeta = array(
		'key' => 'brand',
		'value' => $brands,
		'compare' => 'IN'
	);
	$args['meta_query'][] = $brandsmeta;
}

// query bikes

if(isset($args['post__in']) && count($args['post__in']) == 0 ){ $args['post__in'] = array('0'); }



$bikes = new WP_Query($args);
while( $bikes->have_posts() ) : $bikes->the_post();

    // keyword search
    /*
if(isset($_POST['keywords'])) {
    	$keywords_array = explode(' ', $_POST['keywords']);
    	$allmeta = get_post_custom(get_the_id());
    	if(in_array($keywords_array, $allmeta)){
    		
    	}
    }
*/
    
    // price matching
    if((floatval(get_post_meta(get_the_id(), 'rrp', TRUE)) >= floatval($_POST['rrp-min']) && floatval(get_post_meta(get_the_id(), 'rrp', TRUE)) <= floatval($_POST['rrp-max'])) || get_post_meta(get_the_id(), 'rrp', TRUE) == '') {
    
        if($_POST['discontinued'] == get_post_meta(get_the_id(), 'discontinued', true)) {
        
        // build a data array for each bike found
        $bike_array = array();
        $bike_array['brand'] = get_post_meta(get_the_id(), 'brand', TRUE);
        $bike_array['model'] = get_post_meta(get_the_id(), 'model', TRUE);
        $bike_array['weight'] = get_post_meta(get_the_id(), 'weight', TRUE);
        $bike_array['motor_power'] = get_post_meta(get_the_id(), 'motor_power', TRUE);
        $bike_array['rrp'] = floatval(get_post_meta(get_the_id(), 'rrp', TRUE));
        $bike_array['frame_type'] = get_post_meta(get_the_id(), 'frame_type', TRUE);
        $bike_array['frame_style'] = get_post_meta(get_the_id(), 'frame_style', TRUE);
        $bike_array['description'] = get_post_meta(get_the_id(), 'description', TRUE);
        $bike_array['permalink'] = get_permalink(get_the_id());
        $bike_array['id'] = get_the_id();
        
        
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
        	
        
        // combine into one array to be returned to the script
        $returned_bikes[] = $bike_array;
    
        }
    
     }

endwhile;
wp_reset_postdata();

//$returned_bikes['args'] = $args;

echo json_encode($returned_bikes);

?>