<?php

function custom_router() {
	
	global $wp_query;
	$bits = explode("/",$_SERVER['REQUEST_URI']);
	$bits = array_filter($bits);
	
	//if ( $wp_query->is_404 ) {
		if($bits[1] == 'dealer') {
			$wp_query->is_404 = false;
			locate_template(array( 'template-dealer.php' ),true);
		}
		if($bits[1] == 'electric-bike-dealers') {
			$wp_query->is_404 = false;
			locate_template(array( 'template-dealer-list.php' ),true);
		}
		if($bits[2] == 'electric-bike-dealer-directory') {
			$wp_query->is_404 = false;
			//locate_template(array( 'template-dealer-search.php' ),true);
		}
	//}
	
	// This will explode if there is a page at /dealer
	
}

?>