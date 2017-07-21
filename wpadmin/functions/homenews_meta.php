<?php
				 
// homenews meta box
global $thispage; $thispage = $_GET['post'];

if($thispage == 399) {
add_action( 'add_meta_boxes', 'homenews_add' );	
}
add_action( 'save_post', 'homenews_save' );

// register new meta panel  
function homenews_add()  {
	add_meta_box( 'homenews_control', 'Homepage news items', 'homenews_cb', 'page', 'side', 'default' );
}

// render meta panel
function homenews_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$_latest_news = isset( $values['_latest_news'] ) ? esc_attr( $values['_latest_news'][0] ) :'';		
	$_events = isset( $values['_events'] ) ? esc_attr( $values['_events'][0] ) :'';		
	$_releases = isset( $values['_releases'] ) ? esc_attr( $values['_releases'][0] ) :'';		
	
	wp_nonce_field( 'homenews_nonce', 'homenews_meta_box_nonce' ); ?>
	
		<div style="margin-bottom: 8px;">
			<label style="margin-bottom: 2px; display: inline-block; width: 40%;">Latest news</label>
			<input type="text" style="width: 50%;" name="_latest_news" value="<?php echo $_latest_news; ?>" />
		</div>
	
		<div style="margin-bottom: 8px;">
			<label style="margin-bottom: 2px; display: inline-block; width: 40%;">Latest events</label>
			<input type="text" style="width: 50%;" name="_latest_events" value="<?php echo $_latest_events; ?>" />
		</div>
	
		<div>
			<label style="margin-bottom: 2px; display: inline-block; width: 40%;">Latest releases</label>
			<input type="text" style="width: 50%;" name="_latest_releases" value="<?php echo $_latest_releases; ?>" />
		</div>
	
		
	    
<?php } 

// save meta panel input
function homenews_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['homenews_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['homenews_meta_box_nonce'], 'homenews_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['_latest_news'] ) )  
    update_post_meta( $post_id, '_latest_news', $_POST['_latest_news'] );

    if( isset( $_POST['_latest_events'] ) )  
    update_post_meta( $post_id, '_latest_events', $_POST['_latest_events'] );

    if( isset( $_POST['_latest_releases'] ) )  
    update_post_meta( $post_id, '_latest_releases', $_POST['_latest_releases'] );
}


?>