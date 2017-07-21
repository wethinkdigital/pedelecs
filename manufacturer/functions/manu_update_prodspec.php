<? 

header('Content-Type: application/json'); 

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );


switch($_POST['prod_type']) {

	case 'bike' :
	
	$validpost = array('description','brand','model','rrp','commuting_town','general_leisure','trail_mountain','touring','frame_type','frame_style','frame_material','place_manufacture','motor_power','motor_position','motor_description','battery_details','battery_certification','max_range','throttle','suspension','brakes','gears','stem','saddle','wheel_size','tyres','controls','fork','handlebars','weight','warranty','cert','discontinued','service_repair','optional_extras');
	
	break;
	
	case 'ckit' :
	
	$validpost = array('description','components','brand','model','rrp','motor_manufacturer','motor_power','motor_position','battery_charger','battery_certification','max_range','throttle','controls_display','brakes','wheel_size','weight','wiring_harness','installation','warranty','cert','service_repair','optional_extras');

    break;

}
		
// clear all previous meta data
foreach($validpost as $metakey) {
	delete_post_meta($_POST['post_id'], $metakey);
}

foreach($_POST as $k=>$v) {
	
	// remove non-decimal characters where appropriate
	$decimals = array('rrp','wheel_size','weight','motor_power','max_range');
	if(in_array($k, $decimals)) {
		$v = preg_replace('#[^0-9-.]#', '', $v);
	}

	// decimalise rrp
	if($k == 'rrp'){ $v = number_format($v, 2, '.', ''); }
	
	
        // update meta values with new data
    	if(in_array($k, $validpost)) { 
    		update_post_meta($_POST['post_id'], $k, $v);
    		$updatedspec[$k] = $v;
	}
	
}

$updatedspec['prod_type'] = $_POST['prod_type'];

// update post title to reflect model name
if($_POST['model']){
	$update_prod_post = array('ID' => $_POST['post_id'], 'post_title' => $_POST['model']);
	wp_update_post($update_prod_post);
}



echo json_encode($updatedspec);

?>