<?php 	

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );


//echo '<div class="mainimage"><div class="imageholder" id="'.get_user_meta($user->ID, 'image_id', true).'">';
//echo wp_get_attachment_image( get_user_meta($user->ID, 'image_id', true), 'dealermain');
//echo '</div></div>';

$images = get_user_meta($user->ID,'image_id');

//echo '<pre>'; print_r($images); echo '</pre>';

if(!empty($images)) {

    if(is_array($images[0])) { 

        foreach($images[0] as $image) {
            
            $image_src = wp_get_attachment_image_src( $image, 'dealersmall' );   
                
            echo '<div class="mainimage" id="user_id_'.$user->ID.'">';
            echo '<div class="imageholder" id="'.$image.'">';
            echo '<img src="'.$image_src[0].'" />';   
            echo '</div>';   
            echo '</div>';   
        
        }
        
    } else {
        
        $image_src = wp_get_attachment_image_src( $images[0], 'dealersmall' );   
            
        echo '<div class="mainimage" id="user_id_'.$user->ID.'">';
        echo '<div class="imageholder" id="'.$image.'">';
        echo '<img src="'.$image_src[0].'" />';   
        echo '</div>';   
        echo '</div>';   
        
    }
    
}			 

	 
?>