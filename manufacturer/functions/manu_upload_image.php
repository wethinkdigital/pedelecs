<?  
	if ($_FILES) {
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
	
	$attach_id = media_handle_upload('bikeImage', $_POST['post_id'] );
	
	//echo $_FILES['bikeImage']['name'].' uploaded';

	unset($_FILES);
	
		  
	}
?>