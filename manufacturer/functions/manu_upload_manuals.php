<?  
	if ($_FILES) {
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
	
	$attach_id = media_handle_upload('pdf1', $_POST['post_id'] );
	$attachment['ID'] = $attach_id;
	$attachment['post_title'] = $_POST['title1'];
	if($_POST['title1']) wp_update_post( $attachment );
	
	$attach_id = media_handle_upload('pdf2', $_POST['post_id'] );
	$attachment['ID'] = $attach_id;
	$attachment['post_title'] = $_POST['title2'];
	if($_POST['title2']) wp_update_post( $attachment );
	
	$attach_id = media_handle_upload('pdf3', $_POST['post_id'] );
	$attachment['ID'] = $attach_id;
	$attachment['post_title'] = $_POST['title3'];
	if($_POST['title3']) wp_update_post( $attachment );
	
	
	//echo $_FILES['bikeImage']['name'].' uploaded';

	unset($_FILES);
	
		  
	}
?>