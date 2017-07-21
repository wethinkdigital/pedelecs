<?php 	

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

		if(wp_delete_post($_POST['post_id']) != FALSE){		
		
		$deletemanual_result['deleted_id'] = $_POST['post_id'];
		
		}

echo json_encode($deletemanual_result);
		
?>
