<?php

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

	$newprod_result = array();


	$newproddata = array(	'post_type' => $_POST['prod_type'],
							'post_title' => $_POST['model'],
							'post_author' => $_POST['user_id'],
							'post_status' => 'publish'
							);
							
	$saveID = wp_insert_post($newproddata);
	
	switch($_POST['prod_type']) {
    	case 'bike' :
    	
    	$validpost = array('description','brand','model','rrp','commuting_town','general_leisure','trail_mountain','touring','frame_type','frame_style','frame_material','place_manufacture','motor_power','motor_position','motor_description','battery_details','battery_certification','max_range','throttle','suspension','brakes','gears','stem','saddle','wheel_size','tyres','controls','fork','handlebars','weight','warranty','cert','discontinued','service_repair','optional_extras');
    	
    	break;
    	
    	case 'ckit' :
    	
    	$validpost = array('description','brand','model','rrp','commuting_town','general_leisure','trail_mountain','touring','frame_type','frame_style','frame_material','place_manufacture','motor_power','motor_position','motor_description','battery_details','battery_certification','max_range','throttle','suspension','brakes','gears','stem','saddle','wheel_size','tyres','controls','fork','handlebars','weight','warranty','cert','discontinued','service_repair','optional_extras');

        break;

	}
	
		
	
	foreach($validpost as $field) {
		update_post_meta($saveID, $field, $_POST[$field]);
		$newprod_result[$field] = $_POST[$field];		
	}
			
			
	
	$newprod_result['alert'] = 'Your '.$_POST['prod_type'].' has been created';
	$newprod_result['prod_type'] = $_POST['prod_type'];
	$newprod_result['model'] = $_POST['model'];
	$newprod_result['post_id'] = $saveID;

echo json_encode($newprod_result);

?>