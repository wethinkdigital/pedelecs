<?php 

// works for:
// location
// product type
// brand
// keywords

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
	
	    if(isset($_POST['this_prod'])) {
    	    $bike_stock = get_user_meta($dealer->ID,'bike_stock');
    	    $dealer->bike_query = $bike_stock[0]['bike_'.$_POST['this_prod']];
	    }

		$dealer->search_vars = explode(', ', $_POST['brands_stocked']);
		$dealer->keyword_vars = $_POST['dealer_name'];
		$dealer->meta = get_user_meta($dealer->ID);
		$dealer->brands_array = build_brand_list($dealer->ID);
		$dealer->logo_img = wp_get_attachment_image_src( get_user_meta($dealer->ID,'logo_id', true), 'dealerlogo');
		
		$data['lat2'] = get_user_meta($dealer->ID,'loc_lat', true);
		$data['long2'] = get_user_meta($dealer->ID,'loc_lng', true);
		
		if(get_user_meta($dealer->ID,'postcode', true) != '') {
			$dealer->check_userpostcode = $_POST['user_postcode'];
			$dealer->check_dealerpostcode = get_user_meta($dealer->ID,'postcode', true);
			$dealer->check_distance = calc_distance_ll($data);
			$dealer->check_data = $data;
			$dealer->check_role = $dealer->roles;
		}
		
		$match['is_dealer'] = is_a_dealer($dealer->roles);
		
		if($_POST['dealer_type'] != '') { $match['dealer_type'] = is_dealer_type($_POST['dealer_type'],$dealer->ID); }
		if($_POST['dealer_name'] != '') { $match['keyword'] = matches_keyword($_POST['dealer_name'],$dealer->ID); }

		
        if($_POST['products_stocked'] != '') {
		    $prod_types = array();
		    if(in_array('Bikes',explode(', ',$_POST['products_stocked']))) $prod_types[] = 'bike';
            if(in_array('Conversion kits',explode(', ',$_POST['products_stocked']))) $prod_types[] = 'ckit';
            
            $match['product_type'] = true;
		    foreach($prod_types as $prod_type){
		        if(stocks_prod_type($prod_type,$dealer->ID) == false) {
		            $match['product_type'] = false;
                } else {
                    $dealer->data->stocks_prod_type[$prod_type] = true;
                }
            }
		}


		if($_POST['brands_stocked'] != '') {
		    if(isset($prod_types)) $match['brands'] = false;
		    foreach($prod_types as $prod_type){
		        if(stocks_this_brand(explode(', ', $_POST['brands_stocked']),$dealer->ID,$prod_type)){
		            $match['brands'] = true;
                }
            }
		}

        if(isset($_POST['this_prod']) && $_POST['this_prod'] != ''){
            $match['this_prod'] = stocks_this_prod($dealer->ID,$_POST['prod_type'],$_POST['this_prod']);
        }
		
		if(!in_array(false, $match)) {
		    $dealer->data->matchedvars = $match;
		    unset($dealer->data->user_pass);
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



function strip_postcode_spaces($postcode){
	return preg_replace('/\s+/', '', $postcode);
}

// product type matching
function stocks_prod_type($prodtype,$dealer_id){
    $this_stock = get_user_meta($dealer_id,$prodtype.'_stock',true);
    if($prodtype != 'bike') {
        return array_key_exists_r('stocked', $this_stock);
    } else {
        return true;
    }
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

function build_brand_list($prodtype,$dealer_id){
	foreach(get_user_meta($dealer_id,$prodtype.'_stock',true) as $prod=>$details){
        
        if(isset($details['stocked'])) {
            $prod_id = explode('_', $prod);
    		$brand_list[] = get_brand($prod_id[1]);
		}
	}
	return array_values(array_unique($brand_list));
}

function get_brand($bike_id){
	return get_post_meta($bike_id,'brand',true);
}

// specific product matching
function stocks_this_prod($dealer_id,$prod_type,$prod_id){
    $all_prods = get_user_meta($dealer_id,$prod_type.'_stock',true);
    return (isset($all_prods[$prod_type.'_'.$prod_id]['stocked']) ? true : false);
}



// keyword matching
function matches_keyword($keyword,$dealer_id){
	if(stristr(get_user_meta($dealer_id,'nickname',true), stripslashes($keyword)) != false) {
		return true;
	} else {
		return false;
	}
	
}

// recursive array key exists
function array_key_exists_r($needle, $haystack)
{
    $result = array_key_exists($needle, $haystack);
    if ($result) return $result;
    foreach ($haystack as $v) {
        if (is_array($v)) {
            $result = array_key_exists_r($needle, $v);
        }
        if ($result) return $result;
    }
    return $result;
}

$matched_dealers = (array) $matched_dealers;

/*
ob_start();
echo '<pre>'; print_r($matched_dealers); echo '</pre>';
$dealer_print = ob_get_contents();
ob_end_clean();
wp_mail('david@ideasbyeden.co.uk', 'returned dealers', $dealer_print);
*/

/*
foreach ($matched_dealers as $key => $row) {
    $distance[$key] = $row['distance']; 
}

array_multisort($distance, SORT_ASC, $in_range);
*/



echo json_encode($matched_dealers);


?>