<?php 	

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );
				
$deletevideo_result['bool'] = delete_user_meta($_POST['user_id'], 'videolink', $_POST['video_id']);

echo json_encode($deletevideo_result);
		
?>
