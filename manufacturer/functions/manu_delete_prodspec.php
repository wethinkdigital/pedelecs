<?  

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

		if(wp_delete_post($_POST['post_id']) != FALSE){		
		
		$deleteprod_result['post_id'] = $_POST['post_id'];
		$deleteprod_result['prod_type'] = $_POST['prod_type'];
		
		}

echo json_encode($deleteprod_result);

?>