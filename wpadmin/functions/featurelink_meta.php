<?php
				 
// featurelink meta box
add_action( 'add_meta_boxes', 'featurelink_add' );
add_action( 'save_post', 'featurelink_save' );

// register new meta panel  
function featurelink_add()  {
	add_meta_box( 'featurelink_control', 'Link this feature', 'featurelink_cb', 'feature', 'side', 'default' );
}

// render meta panel
function featurelink_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$_featurelink = isset( $values['_featurelink'] ) ? esc_attr( $values['_featurelink'][0] ) :'';		
	
	wp_nonce_field( 'featurelink_nonce', 'featurelink_meta_box_nonce' ); ?>

	<p>Link this feature to:</p>
	<input type="text" name="_featurelink" value="<?php echo $_featurelink; ?>" />
	
	    
<?php } 

// save meta panel input
function featurelink_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['featurelink_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['featurelink_meta_box_nonce'], 'featurelink_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['_featurelink'] ) )  
    update_post_meta( $post_id, '_featurelink', $_POST['_featurelink'] );
}

?>