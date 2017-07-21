<?  include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
	
	if(strstr($_POST['videolink'], 'youtube')){
    	parse_str(parse_url($_POST['videolink'], PHP_URL_QUERY), $embed_array);
    	$video_key = $embed_array['v'];
	} else {
	    $embed_array = explode('/', $_POST['videolink']);
    	$video_key = end($embed_array);
	}
	
			
add_post_meta($_POST['post_id'], 'videolink', $video_key);
$result['message'] = 'Video was added';
	
echo json_encode($result);