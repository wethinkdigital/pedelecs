<?php

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

$data = get_post_custom($_POST['post_id']);

foreach($data as $k=>$v) {
	if($k[0] != '_'){
	$newdata[$k] = preg_replace('/\\\\/','',$v[0]);
	}
}
$newdata['rrp'] = number_format($newdata['rrp'], 2, '.', ',');
$newdata['post_id'] = $_POST['post_id'];
$newdata['prod_type'] = $_POST['prod_type'];

echo json_encode($newdata);

?>