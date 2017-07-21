<?php 

header('Content-Type: application/json'); 

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

	
$args = array( 'number' => 9999 );
$dealers = new WP_User_Query($args);


if ( ! empty( $dealers->results ) ) {
	foreach ( $dealers->results as $dealer ) {
		
		if(preg_replace('/ /','',get_user_meta($dealer->ID,'county', true)) == preg_replace('/ /','',$_POST['user_county'])) {
				$dealer->meta = get_user_meta($dealer->ID);
				$matched_dealers[] = $dealer;
			
		}
		
	}
}

$matched_dealers = (array) $matched_dealers;
echo json_encode($matched_dealers);
	
?>