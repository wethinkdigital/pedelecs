<?php 

header('Content-Type: application/json'); 

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

	
$args = array( 'number' => 9999 );
				
$dealers = new WP_User_Query($args);


if ( ! empty( $dealers->results ) ) {	
	
	foreach ( $dealers->results as $dealer ) {

		$dealer->meta = get_user_meta($dealer->ID);		
		$data['lat2'] = get_user_meta($dealer->ID,'loc_lat', true);
		$data['long2'] = get_user_meta($dealer->ID,'loc_lng', true);
				
		$match['is_dealer'] = is_a_dealer($dealer->roles);
		
        $prod_types = array('bike','ckit');
	    foreach($prod_types as $prod_type){
	        if(stocks_prod_type($prod_type,$dealer->ID)) {
                $dealer->data->stocks_prod_type[$prod_type] = true;
            }
        }

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

// product type matching
function stocks_prod_type($prodtype,$dealer_id){
    $this_stock = get_user_meta($dealer_id,$prodtype.'_stock',true);
    return array_key_exists_r('stocked', $this_stock);
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
echo json_encode($matched_dealers);


?>