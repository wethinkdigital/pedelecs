<?php 	

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
			
			
	$mainatts = array(
	'class'	=> 'main',
	);
	$return['imagetag'] = wp_get_attachment_image( $_POST['imageid'], 'bikemain', $mainatts );
	//$return['imagetag'] = $_POST['imageid'];
	//mail('david@ideasbyeden.co.uk', 'new image tag', $return['imagetag']);

	
	echo json_encode($return);
	 
?>