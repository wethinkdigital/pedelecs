<?php

function dealer_update(){

$update = array();

/*
foreach($_POST as $k=>$v) {
	if(strpos($k, 'bike') !== false) { $update['bikes_str'] .= $k.'='.$v.'&'; }
	if(strpos($k, 'accessory') !== false) { $update['accessories_str'] .= $k.'='.$v.'&'; }
}
*/


update_user_meta($_POST['user_id'], 'bike_stock', $_POST['bike_stock']);
update_user_meta($_POST['user_id'], 'ckit_stock', $_POST['ckit_stock']);
//update_user_meta($_POST['user_id'], 'accessory_stock', serialize($_POST['accessory']);
update_user_meta($_POST['user_id'], 'summary', $_POST['summary']);
update_user_meta($_POST['user_id'], 'description', $_POST['description']);
update_user_meta($_POST['user_id'], 'nickname', $_POST['dealer_name']);
update_user_meta($_POST['user_id'], 'address_1', $_POST['address_1']);
update_user_meta($_POST['user_id'], 'address_2', $_POST['address_2']);
update_user_meta($_POST['user_id'], 'town', $_POST['town']);
update_user_meta($_POST['user_id'], 'county', $_POST['county']);
update_user_meta($_POST['user_id'], 'postcode', $_POST['postcode']);
update_user_meta($_POST['user_id'], 'opening_hours', $_POST['opening_hours']);
update_user_meta($_POST['user_id'], 'telephone', $_POST['tel']);
update_user_meta($_POST['user_id'], 'url', prep_url($_POST['web']));
update_user_meta($_POST['user_id'], 'email', $_POST['email']);
update_user_meta($_POST['user_id'], 'dealer_type', $_POST['dealer_type']);


if($_POST['postcode'] != '') {
    $location = latlng($_POST['postcode']);
} else {
    $address = '';
    if($_POST['address_1']) $address .= $_POST['address_1'].', ';
    if($_POST['address_2']) $address .= $_POST['address_2'].', ';
    if($_POST['town']) $address .= $_POST['town'].', ';
    if($_POST['county']) $address .= $_POST['county'].', ';
    $location = latlng(substr($address,0,-2));
} 

update_user_meta($_POST['user_id'], 'loc_lat', $location['lat']);
update_user_meta($_POST['user_id'], 'loc_lng', $location['lng']);

$update['message'] = 'Your details have been updated';
echo json_encode($update);
die();
}

function prep_url($url) {
	return trim(preg_replace("(https?://)", "", $url),'/');
}

?>