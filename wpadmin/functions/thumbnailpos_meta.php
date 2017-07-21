<?php
				 
// thumbnailpos meta box
add_action( 'add_meta_boxes', 'thumbnailpos_add' );
add_action( 'save_post', 'thumbnailpos_save' );

// register new meta panel  
function thumbnailpos_add()  {
	add_meta_box( 'thumbnailpos_control', 'Item thumbnail position', 'thumbnailpos_cb', 'news', 'side', 'default' );
	add_meta_box( 'thumbnailpos_control', 'Item thumbnail position', 'thumbnailpos_cb', 'guide', 'side', 'default' );
	add_meta_box( 'thumbnailpos_control', 'Item thumbnail position', 'thumbnailpos_cb', 'review', 'side', 'default' );
}

// render meta panel
function thumbnailpos_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$_thumbnailpos = isset( $values['_thumbnailpos'] ) ? esc_attr( $values['_thumbnailpos'][0] ) :'';		
	
	wp_nonce_field( 'thumbnailpos_nonce', 'thumbnailpos_meta_box_nonce' ); ?>

	<p>Homepage thumbnail position:</p>
	<select name="_thumbnailpos">
		<option value="top" <?php if($_thumbnailpos == 'top') { echo 'SELECTED';} ?>>Top</option>
		<option value="left" <?php if($_thumbnailpos == 'left') { echo 'SELECTED';} ?>>Left</option>
		<option value="right" <?php if($_thumbnailpos == 'right') { echo 'SELECTED';} ?>>Right</option>
	</select>
	
	    
<?php } 

// save meta panel input
function thumbnailpos_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['thumbnailpos_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['thumbnailpos_meta_box_nonce'], 'thumbnailpos_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['_thumbnailpos'] ) )  
    update_post_meta( $post_id, '_thumbnailpos', $_POST['_thumbnailpos'] );
}

?>