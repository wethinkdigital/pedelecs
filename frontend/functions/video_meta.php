<?php
				 
/* video meta box */

add_action( 'add_meta_boxes', 'video_add' );
add_action( 'save_post', 'video_save' );

// register new meta panel  

function video_add()  {
	add_meta_box( 'video_control', 'Video link', 'video_cb', 'video', 'normal', 'high' );
}

// render meta panel

function video_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$video = isset( $values['_video'] ) ? esc_attr( $values['_video'][0] ) :'';		
	
	wp_nonce_field( 'video_nonce', 'video_meta_box_nonce' );
?>
<p>   
    <label>Video embed code </label><input type="text" name="video" id="video" value="<?php echo $video; ?>" class="widefat"/>
</p>   
    
<?php } 

// save meta panel input

function video_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['video_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['video_meta_box_nonce'], 'video_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['video'] ) )  
    update_post_meta( $post_id, '_video', $_POST['video'] );
}

?>