<?php
				 
// reviewspromotion meta box
add_action( 'add_meta_boxes', 'reviewspromotion_add' );
add_action( 'save_post', 'reviewspromotion_save' );

// register new meta panel  
function reviewspromotion_add()  {
	add_meta_box( 'reviewspromotion_control', 'reviews promotion', 'reviewspromotion_cb', 'review', 'side', 'default' );
}

// render meta panel
function reviewspromotion_cb($post) {
	
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$this_promo = isset( $values['_promoreview'] ) ? esc_attr( $values['_promoreview'][0] ) :'';		

	
	wp_nonce_field( 'reviewspromotion_nonce', 'reviewspromotion_meta_box_nonce' ); ?>
	
	
	    <p>
		
		<select name="_promoreview">
			<option value="" <?php if($this_promo == '') echo 'SELECTED'; ?>>Don't promote</option>
			<option value="headline" <?php if($this_promo == 'headline') echo 'SELECTED'; ?>>Headline</option>
			<option value="featured" <?php if($this_promo == 'featured') echo 'SELECTED'; ?>>Featured</option>
		</select>
		
		</p>
	
	<?php 
 } 

// save meta panel input
function reviewspromotion_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['reviewspromotion_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['reviewspromotion_meta_box_nonce'], 'reviewspromotion_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['_promoreview'] ) ) { 
    	update_post_meta( $post_id, '_promoreview', $_POST['_promoreview'] );
    }
    	    

}

?>