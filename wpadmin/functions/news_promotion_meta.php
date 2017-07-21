<?php
				 
// newspromotion meta box
add_action( 'add_meta_boxes', 'newspromotion_add' );
add_action( 'save_post', 'newspromotion_save' );

// register new meta panel  
function newspromotion_add()  {
	add_meta_box( 'newspromotion_control', 'News promotion', 'newspromotion_cb', 'news', 'side', 'default' );
}

// render meta panel
function newspromotion_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	
	$values = get_post_custom( $post->ID );
	foreach($values as $k=>$v) {
		if(strpos($k, 'promocat')) {
			$promos[$k] = $v;
		}
	}

	
	wp_nonce_field( 'newspromotion_nonce', 'newspromotion_meta_box_nonce' ); ?>
	
	
	<?php foreach(wp_get_post_categories($post->ID) as $cat){ 
	
		if(array_key_exists('_promocat_'.$cat, $promos)) {
			$this_promo = isset($promos['_promocat_'.$cat]) ? $promos['_promocat_'.$cat][0] : '';
		}
	
		echo '<p><label style="display:inline-block;width: 140px;">'.get_category($cat)->name.'</label>'; ?>
		
		<select name="_promocat_<?php echo $cat; ?>">
			<option value="" <?php if($this_promo == '') echo 'SELECTED'; ?>>Don't promote</option>
			<option value="headline" <?php if($this_promo == 'headline') echo 'SELECTED'; ?>>Headline</option>
			<option value="featured" <?php if($this_promo == 'featured') echo 'SELECTED'; ?>>Featured</option>
		</select>
		
		</p>
	
	<?php } 
 } 

// save meta panel input
function newspromotion_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['newspromotion_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['newspromotion_meta_box_nonce'], 'newspromotion_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['_newspromotion'] ) ) { 
    	update_post_meta( $post_id, '_newspromotion', $_POST['_newspromotion'] );
    }
    
    
    foreach ( $_POST as $k=>$v ) {
    	if(strpos($k, 'promocat')){ 
    		if($v == '') {
    			delete_post_meta( $post_id, $k );
    		} else {
    			update_post_meta( $post_id, $k, $v );
    		}
    	}
    }
	    

}

?>