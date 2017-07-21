<?php

function dealer_stock_data($dealer_id = null){

    //$stock['dealer_id'] = $dealer_id;
	
	if($dealer_id){
	
        foreach (get_user_meta($dealer_id,'bike_stock',true) as $bike=>$details){
        
            if(isset($details['stocked'])) {
        
                $bike_id = explode('_', $bike);
                
                // set up brand and model entry
                $stock[brand_name($bike_id[1])][$bike_id[1]]['model'] = model_name($bike_id[1]);
                
                // build args array to query each bike's images
            	$attach_args = array(
            					'post_type' => 'attachment',
            					'post_mime_type' => array('image'),
            					'posts_per_page' => '1',
            					'post_status' => null,
            					'post_parent' => $bike_id[1],
            					'orderby' => 'menu_order',
            					'order' => 'ASC'
            	);
            	
            	// query attachments for the bike we've found
            	$attachments = get_posts($attach_args);
            		
            	// add the URL of the first attachment to our bike array
            	if(count($attachments) > 0){
            		$stock[brand_name($bike_id[1])][$bike_id[1]]['image'] = wp_get_attachment_image( $attachments[0]->ID, 'bikethumbsmall' );
            	} 
        	
        	}           
            
        }
        
    }

        return $stock;

}

function brand_name($bike_id){
    return get_post_meta($bike_id,'brand',true);
}

function model_name($bike_id){
    return get_post_meta($bike_id,'model',true);
}


?>