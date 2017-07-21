<?php 	

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
				
$deletevideo_result['bool'] = delete_post_meta($_POST['post_id'], 'videolink', $_POST['video_id']);

echo json_encode($deletevideo_result);
		
?>
