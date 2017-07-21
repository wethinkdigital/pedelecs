<?php
				 
// showvideo meta box
add_action( 'add_meta_boxes', 'showvideo_add' );
add_action( 'save_post', 'showvideo_save' );

// register new meta panel  
function showvideo_add()  {

    global $post_id;

    if ( $post_id === (int) get_option( 'page_on_front' ) || $post_id == 4820){
        add_meta_box( 'showvideo_control', 'Video section', 'showvideo_cb', 'page', 'side', 'default' );
	}

	//
}

// render meta panel
function showvideo_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$_showvideo = isset( $values['_showvideo'] ) ? esc_attr( $values['_showvideo'][0] ) :'';		
	
	wp_nonce_field( 'showvideo_nonce', 'showvideo_meta_box_nonce' ); ?>

	<input type="checkbox" name="_showvideo" value="yes" <?php checked( $_showvideo, 'yes' ); ?>/> <label>Show the video section</label>

	
	    
<?php } 

// save meta panel input
function showvideo_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['showvideo_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['showvideo_meta_box_nonce'], 'showvideo_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    $chk = isset( $_POST['_showvideo'] ) && $_POST['_showvideo'] ? 'yes' : 'no';  
    update_post_meta( $post_id, '_showvideo', $chk );
}

?>