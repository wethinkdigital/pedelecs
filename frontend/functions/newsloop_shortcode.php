<?php

function newsloop_shortcode( $atts ) { 
 
    extract( shortcode_atts( array(
    	'type' => 'news', 
    	'elements' => 'T/H4/D/E', 
        'cat' => NULL,  
		'count' => 99,
    ), $atts ) );  

	$loop_args = array('post_type' => $type,
						'category_name' => $cat,
						'posts_per_page' => $count,
						'orderby' => 'date',
						'order' => 'DESC'
						);
						
						
	$elements = explode('/', strtoupper($elements));

    $loop = new WP_Query($loop_args);  

    if($loop){ $output .= '<div id="looptiles">';
        while ($loop->have_posts()){  
             $loop->the_post();  
                 $output .= '<div class="loop_item"><div class="content">';
                 
                 foreach($elements as $element) {
	                 
	                 if($element == 'T') {
	                 	//$output .= '<a href="'.get_permalink().'">'.get_intro_image(get_the_id()).'</a>';
	                 	$output .= get_intro_image(get_the_id());
	                 }
	
	                 if($element == 'H2') {
	                 	$output .= '<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
	                 }
	
	                 if($element == 'H3') {
	                 	$output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
	                 }
	
	                 if($element == 'H4') {
	                 	$output .= '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	                 }
	
	                 if($element == 'H5') {
	                 	$output .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
	                 }
	                 
	                 if($element == 'D') {
	                 	$output .= '<p class="date">'.get_the_date().'</p>';
	                 }	                 
	
	                 if($element == 'E') {
	                 	$output .= '<p>'.get_the_excerpt().'</p>';
	                 }
	                 
                 }
                 
                 $output .= '</div></div>';
                 
			}
            $output .= '</div>';
        }  
    
    return $output;  
}  
	
add_shortcode('newsloop', 'newsloop_shortcode');