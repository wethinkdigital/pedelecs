<?

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
	
	$imageOrder = explode('image[]=', $_POST['images']);
	
	$i=0;
	
	foreach(array_filter($imageOrder) as $image) {
	
		$thisattachment['ID'] = trim($image,'&');
		$thisattachment['menu_order'] = $i;
		wp_update_post($thisattachment);
		$i++;
				
	}
	
	$result['yes'] = 'reordered';
	
	echo json_encode($result);
?>