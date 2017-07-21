<?php
				 
// stickypost meta box
add_action( 'add_meta_boxes', 'stickypost_add' );
add_action( 'save_post', 'stickypost_save' );

// register new meta panel  
function stickypost_add()  {
	add_meta_box( 'stickypost_control', 'Sticky', 'stickypost_cb', 'news', 'side', 'default' );
	add_meta_box( 'stickypost_control', 'Sticky', 'stickypost_cb', 'review', 'side', 'default' );
}

// render meta panel
function stickypost_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$_stickypost = isset( $values['_stickypost'] ) ? esc_attr( $values['_stickypost'][0] ) :'';		
	
	wp_nonce_field( 'stickypost_nonce', 'stickypost_meta_box_nonce' ); ?>

	<input type="checkbox" name="_stickypost" value="yes" <?php checked( $_stickypost, 'yes' ); ?>/> <label>Make this item sticky</label>

	
	    
<?php } 

// save meta panel input
function stickypost_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['stickypost_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['stickypost_meta_box_nonce'], 'stickypost_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    $chk = isset( $_POST['_stickypost'] ) && $_POST['_stickypost'] ? 'yes' : 'no';  
    update_post_meta( $post_id, '_stickypost', $chk );
}

?>