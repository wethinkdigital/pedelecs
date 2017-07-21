<?php 	

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );	
		
get_currentuserinfo();

if($_POST['user_id']) {
    $current_user->ID = $_POST['user_id'];
}

$images = get_user_meta($current_user->ID,'image_id',true);

// limit display 3 images
$images = array_slice(array_filter($images), 0, 3);

//echo '<pre>'; print_r($images); echo '</pre>';

if(is_array($images) && !empty($images)) {


    foreach($images as $image) {
    
    $image_src = wp_get_attachment_image_src( $image, 'dealersmall' );   
        
    echo '<div class="mainimage" id="user_id_'.$current_user->ID.'">';
    echo '<div class="imageholder" id="'.$image.'">';
    echo '<img src="'.$image_src[0].'" />';   
    echo '</div>';   
    echo '</div>';   
    
    }
    

    echo '<div class="thumbnails"><div class="sortable footer">';
    
    foreach($images as $image) {

    	echo '<div class="thumb imagethumb" id="image_'.$image.'" attachment_id="'.$image.'" user_id="'.$current_user->ID.'">'; 
    	echo wp_get_attachment_image( $image, 'prodthumb' );
    	echo '<div class="delete hovershow purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div>';
    	echo '</div>';

    }
    
    
    echo '<label>Drag images to reorder, click <div class="delete demo purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div> to delete</label></div></div>';
    }
			 
?>