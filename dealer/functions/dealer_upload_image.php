<?  
	if ($_FILES) {
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
	
	$attach_id = media_handle_upload('dealerImage', '0' );
	
	$images = get_user_meta($_POST['user_id'], 'image_id', true);
	if(!is_array($images) || empty($images)) { $images = array(); }
     	$images[] = strval($attach_id);
	
	update_user_meta($_POST['user_id'], 'image_id', $images);

	unset($_FILES);
	
		  
	}
?>