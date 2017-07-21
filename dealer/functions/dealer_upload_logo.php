<?  
	if ($_FILES) {
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
	
	$attach_id = media_handle_upload('dealerLogo', '0' );
	$attach_url = wp_get_attachment_image_src( $attach_id, 'dealerlogo_small' );
	
	update_user_meta($_POST['user_id'], 'logo_id', $attach_id);
	update_user_meta($_POST['user_id'], 'logo_url', $attach_url[0]);

	unset($_FILES);
	
		  
	}
?>