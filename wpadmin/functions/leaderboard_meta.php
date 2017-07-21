<?php
				 
// leaderboard meta box
add_action( 'add_meta_boxes', 'leaderboard_add' );
add_action( 'save_post', 'leaderboard_save' );

// register new meta panel  
function leaderboard_add()  {
	add_meta_box( 'leaderboard_control', 'Leaderboard control', 'leaderboard_cb', 'page', 'normal', 'high' );
	add_meta_box( 'leaderboard_control', 'Leaderboard control', 'leaderboard_cb', 'post', 'normal', 'high' );
	add_meta_box( 'leaderboard_control', 'Leaderboard control', 'leaderboard_cb', 'bike', 'normal', 'high' );
	add_meta_box( 'leaderboard_control', 'Leaderboard control', 'leaderboard_cb', 'news', 'normal', 'high' );
	add_meta_box( 'leaderboard_control', 'Leaderboard control', 'leaderboard_cb', 'guide', 'normal', 'high' );
}

// render meta panel
function leaderboard_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$_leaderboard = isset( $values['_leaderboard'] ) ? esc_attr( $values['_leaderboard'][0] ) :'';		
	
	wp_nonce_field( 'leaderboard_nonce', 'leaderboard_meta_box_nonce' ); ?>

	<p>To show a specific leaderboard, enter the OpenX banner id below</p>
	<input type="text" name="_leaderboard" value="<?php echo $_leaderboard; ?>" /></div>
	
	    
<?php } 

// save meta panel input
function leaderboard_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['leaderboard_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['leaderboard_meta_box_nonce'], 'leaderboard_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['_leaderboard'] ) )  
    update_post_meta( $post_id, '_leaderboard', $_POST['_leaderboard'] );
}

?>