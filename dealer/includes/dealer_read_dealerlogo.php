<?php 	

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );

get_currentuserinfo();

echo wp_get_attachment_image( get_user_meta($current_user->ID, 'logo_id', true), 'dealerlogo');
	 
?>