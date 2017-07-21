<?php
				 
// banner meta box
add_action( 'add_meta_boxes', 'banner_add' );
add_action( 'save_post', 'banner_save' );

// register new meta panel  
function banner_add()  {
	add_meta_box( 'banner_control', 'Banner ad control', 'banner_cb', 'page', 'normal', 'high' );
	add_meta_box( 'banner_control', 'Banner ad control', 'banner_cb', 'post', 'normal', 'high' );
	add_meta_box( 'banner_control', 'Banner ad control', 'banner_cb', 'bike', 'normal', 'high' );
	add_meta_box( 'banner_control', 'Banner ad control', 'banner_cb', 'news', 'normal', 'high' );
	add_meta_box( 'banner_control', 'Banner ad control', 'banner_cb', 'guide', 'normal', 'high' );
}

// render meta panel
function banner_cb($post) {
	global $post, $post_id; $post_id = get_the_ID(); 
	$values = get_post_custom( $post->ID );
	$inherit_ads = isset( $values['_inherit_ads'] ) ? esc_attr( $values['_inherit_ads'][0] ) :'';		
	$leaderboard = isset( $values['_leaderboard'] ) ? esc_attr( $values['_leaderboard'][0] ) :'';		
	$skyscraper = isset( $values['_skyscraper'] ) ? esc_attr( $values['_skyscraper'][0] ) :'';		
	$boxad_0 = isset( $values['_boxad_0'] ) ? esc_attr( $values['_boxad_0'][0] ) :'';		
	$boxad_1 = isset( $values['_boxad_1'] ) ? esc_attr( $values['_boxad_1'][0] ) :'';		
	$boxad_2 = isset( $values['_boxad_2'] ) ? esc_attr( $values['_boxad_2'][0] ) :'';		
	$boxad_3 = isset( $values['_boxad_3'] ) ? esc_attr( $values['_boxad_3'][0] ) :'';		
	$boxad_4 = isset( $values['_boxad_4'] ) ? esc_attr( $values['_boxad_4'][0] ) :'';		
	$boxad_5 = isset( $values['_boxad_5'] ) ? esc_attr( $values['_boxad_5'][0] ) :'';		
	
	wp_nonce_field( 'banner_nonce', 'banner_meta_box_nonce' ); ?>
	
	<p>To place a specific advert, enter the OpenX banner ID in the relevant field below, otherwise ads will be inserted at random.</p>

	<div style="width: 100%; position: relative; float: left; clear; none;">
		<h4 style="margin-bottom: 2px;">Inherit ads from</h4>

		<select name="_inherit_ads" id="inherit_ads">
			<option value="">Don't inherit</option>
			<?php 
			$menu_args = array( 'post_type' => 'page',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'post__not_in' => array( $post->ID ),
								'post_parent' => 0
			
			);
			$pages = new WP_Query($menu_args);
			while( $pages->have_posts() ) : $pages->the_post(); ?>
				 <option name="_inherit_ads" value="<?php echo $post->ID; ?>" <?php if($inherit_ads ==  $post->ID) { echo 'selected'; } ?>><?php the_title(); ?></option>
				 <?php get_subpages($post->ID); ?>
			<?php endwhile; ?>
		</select> 
		
	</div>

	<div id="ad_ids">
		<div style="width: 25%; position: relative; float: left; clear; none;">
			<h4 style="margin-bottom: 2px;">Leaderboard</h4>
			<input class="ad_id" type="text" style="width: 80%;" name="_leaderboard" value="<?php echo $leaderboard; ?>" />
		</div>
	
		<div style="width: 25%; position: relative; float: left; clear; none;">
			<h4 style="margin-bottom: 2px;">Skyscraper</h4>
			<input class="ad_id" type="text" style="width: 80%;" name="_skyscraper" value="<?php echo $skyscraper; ?>" />
		</div>
		
		<div style="width: 50%; position: relative; float: left; clear: none;">
		<h4 style="margin-bottom: 2px;">150 x 150 box ads</h4>
			<input class="ad_id" type="text" style="width: 13%; margin-right: 1%;" name="_boxad_0" value="<?php echo $boxad_0; ?>" />
			<input class="ad_id" type="text" style="width: 13%; margin-right: 1%;" name="_boxad_1" value="<?php echo $boxad_1; ?>" />
			<input class="ad_id" type="text" style="width: 13%; margin-right: 1%;" name="_boxad_2" value="<?php echo $boxad_2; ?>" />
			<input class="ad_id" type="text" style="width: 13%; margin-right: 1%;" name="_boxad_3" value="<?php echo $boxad_3; ?>" />
			<input class="ad_id" type="text" style="width: 13%; margin-right: 1%;" name="_boxad_4" value="<?php echo $boxad_4; ?>" />
			<input class="ad_id" type="text" style="width: 13%; margin-right: 1%;" name="_boxad_5" value="<?php echo $boxad_5; ?>" />
		</div>
	</div>
	
	<div style="clear:both;"></div>
	
	<script>
		jQuery(function(){
			if(jQuery('#inherit_ads').val() != ''){
				jQuery('#ad_ids').hide();
			}

			jQuery('#inherit_ads').change(function(){
				if(jQuery(this).val() != ''){
					jQuery('#ad_ids').fadeOut(200);
				} else {
					jQuery('#ad_ids').fadeIn(200);
				}
			});
		});
	</script>
	    
<?php } 

// save meta panel input
function banner_save($post_id) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['banner_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['banner_meta_box_nonce'], 'banner_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['_inherit_ads'] ) )  
    update_post_meta( $post_id, '_inherit_ads', $_POST['_inherit_ads'] );

    if( isset( $_POST['_leaderboard'] ) )  
    update_post_meta( $post_id, '_leaderboard', $_POST['_leaderboard'] );

    if( isset( $_POST['_skyscraper'] ) )  
    update_post_meta( $post_id, '_skyscraper', $_POST['_skyscraper'] );

    if( isset( $_POST['_boxad_0'] ) )  
    update_post_meta( $post_id, '_boxad_0', $_POST['_boxad_0'] );

    if( isset( $_POST['_boxad_1'] ) )  
    update_post_meta( $post_id, '_boxad_1', $_POST['_boxad_1'] );

    if( isset( $_POST['_boxad_2'] ) )  
    update_post_meta( $post_id, '_boxad_2', $_POST['_boxad_2'] );

    if( isset( $_POST['_boxad_3'] ) )  
    update_post_meta( $post_id, '_boxad_3', $_POST['_boxad_3'] );

    if( isset( $_POST['_boxad_4'] ) )  
    update_post_meta( $post_id, '_boxad_4', $_POST['_boxad_4'] );

    if( isset( $_POST['_boxad_5'] ) )  
    update_post_meta( $post_id, '_boxad_5', $_POST['_boxad_5'] );
}


function get_subpages($id){
	$children = get_pages('child_of='.$id.'&parent='.$id);
		if( count( $children ) != 0 ) { 
			foreach($children as $child) { 
				$ancestors = get_post_ancestors($child->ID); $depth = count($ancestors);
				?>
				<option name="_inherit_ads" value="<?php echo $child->ID; ?>" <?php if($inherit_ads == $child->ID) { echo 'selected'; } ?>><?php echo str_repeat('- ',$depth).$child->post_title; ?></option>
				<?php get_subpages($child->ID);
			} 
	 }
				
}

?>