<? 

header('Content-Type: application/json'); 

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );
			
add_user_meta($_POST['user_id'], 'videolink', $_POST['videolink']);
$result['message'] = 'Video was added';
	
echo json_encode($result);

?>