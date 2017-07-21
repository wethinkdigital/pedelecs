<?

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
	
	$images = explode('image[]=', $_POST['images']);
    for($i=0;$i<count($images);$i++){
        $images[$i] = trim($images[$i],'&');
    }
	
	update_user_meta($_POST['user_id'], 'image_id', $images);

?>