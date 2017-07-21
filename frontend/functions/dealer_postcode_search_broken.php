<?php 

header('Content-Type: application/json'); 

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

	
$args = array( 'number' => 100000 );
				
$dealers = new WP_User_Query($args);


if ( ! empty( $dealers->results ) ) {

	$user_latlng = latlng($_POST['user_postcode']);
	$data['lat1'] = $user_latlng['lat'];
	$data['long1'] = $user_latlng['lng'];
	$data['user_distance'] = $_POST['user_distance'];
	$data['dealer_type'] = $_POST['dealer_type'];
	
	
	foreach ( $dealers->results as $dealer ) {

		$dealer->search_vars = explode(', ', $_POST['brands_stocked']);
		$dealer->keyword_vars = $_POST['dealer_name'];
		$dealer->meta = get_user_meta($dealer->ID);
		$dealer->brands_array = build_brand_list($dealer->ID);
		
		$data['lat2'] = get_user_meta($dealer->ID,'loc_lat', true);
		$data['long2'] = get_user_meta($dealer->ID,'loc_lng', true);
		
		
		if(get_user_meta($dealer->ID,'postcode', true) != '') {
			$dealer->check_userpostcode = $_POST['user_postcode'];
			$dealer->check_dealerpostcode = get_user_meta($dealer->ID,'postcode', true);
			$dealer->check_distance = calc_distance_ll($data);
			$dealer->check_data = $data;
			$dealer->check_role = $dealer->roles;
		}
		
		if($_POST['user_distance'] != '') { $match['distance'] = is_in_range($data); }
		if($_POST['dealer_type'] != '') { $match['dealer_type'] = is_dealer_type($_POST['dealer_type'],$dealer->ID); }
		if($_POST['dealer_name'] != '') { $match['keyword'] = matches_keyword($_POST['dealer_name'],$dealer->ID); }
		
		if($_POST['products_stocked'] != '') {
		    $prod_types = array();
		    if(in_array('Bikes',explode(', ',$_POST['products_stocked']))) $prod_types[] = 'bike';
            if(in_array('Conversion kits',explode(', ',$_POST['products_stocked']))) $prod_types[] = 'ckit';
            
            $match['products'] = true;
		    foreach($prod_types as $prod_type){
		        if(!stocks_prod_type($prod_type,$dealer->ID)) $match['products'] = false;
            }
		}
		
		
		
		if($_POST['brands_stocked'] != '') {
		    if(isset($prod_types)) $match['brands'] = false;
		    foreach($prod_types as $prod_type){
		        if(stocks_this_brand(explode(', ', $_POST['brands_stocked']),$dealer->ID,$prod_type)){ $match['brands'] = true; }
            }
		}
		
		if(isset($_POST['prod_id']) && $_POST['prod_id'] != '' && 1==2) {
    		//$match['stocks_this_product'] = stocks_this_product($_POST['prod_id'],$dealer->ID,$_POST['prod_type']);
		}
		
		$match['is_dealer'] = is_a_dealer($dealer->roles);
		
		
		if(!in_array(false, $match)) {
			$matched_dealers[] = $dealer;
		}
		
	}
}


// dealer matching
function is_a_dealer($roles) {
	$a = array('dealer','dealer_premium');
	$intersect = array_intersect($a, $roles);
	if(count($intersect) > 0) { return true; } else { return false;}
}

// dealer type matching
function is_dealer_type($dealer_type,$dealer_id) {
    return ($dealer_type == 'any' || $dealer_type == get_user_meta($dealer_id,'dealer_type',true) ? true : false );
}


// distance matching
function is_in_range($data){

	if(calc_distance_ll($data) <= $data['user_distance']){
		return true;
	} else {
		return false;
	}
}

function strip_postcode_spaces($postcode){
	return preg_replace('/\s+/', '', $postcode);
}

// product type matching
function stocks_prod_type($prod_type,$dealer_id){
    $result = false;
    foreach(get_user_meta($dealer_id,$prod_type.'_stock',true) as $prod=>$details){
        if(isset($details['stocked'])) $result = true;
    }
    return $result;
}

// brand matching	
function stocks_this_brand($brand_array,$dealer_id,$prodtype){
	$result = false;
	foreach($brand_array as $brand){
		if(in_array($brand, build_brand_list($prodtype,$dealer_id))){
			$result = true;
		}
	}
	return $result;
}

// brand matching	
/*
function stocks_this_product($prod_id,$dealer_id,$prod_type){
	$all_products = get_user_meta($dealer_id,$prod_type.'_stock',true);
	return (isset($all_products[$prod_type.'_'.$prod_id]['stocked']) ? true : false);
}
*/


function build_brand_list($prodtype,$dealer_id){
	//parse_str(get_user_meta($dealer_id,'bike_stock',true),$stock);
	foreach(get_user_meta($dealer_id,$prodtype.'_stock',true) as $prod=>$details){
        
        if(isset($details['stocked'])) {
            $prod_id = explode('_', $prod);
    		$brand_list[] = get_brand($prod_id[1]);
		}
	}
	return array_values(array_unique($brand_list));
}

function get_brand($prod_id){
	return get_post_meta($prod_id,'brand',true);
}


// keyword matching
function matches_keyword($keyword,$dealer_id){
	if(stristr(get_user_meta($dealer_id,'nickname',true), stripslashes($keyword)) != false) {
		return true;
	} else {
		return false;
	}
	
}


$matched_dealers = (array) $matched_dealers;
echo json_encode($matched_dealers);


?>