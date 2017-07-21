<?php 	

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );

// get this dealers images (array)
// remove unwanted element
// resave array as usermeta

$dealer_images = get_user_meta($_POST['user_id'],'image_id',true);
unset($dealer_images[array_search($_POST['post_id'], $dealer_images)]);
update_user_meta($_POST['user_id'],'image_id',$dealer_images);

$result['user_id'] = $_POST['user_id'];

echo json_encode($result);
		
?>
