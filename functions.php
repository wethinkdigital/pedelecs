<?php

//flush_rewrite_rules();

// changing excerpt length
function new_excerpt_length($length) {
	return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');
 
 
// changing default excerpt more
function new_excerpt_more($more) {
	global $post;
		return '... <a class="green" href="'. get_permalink($post->ID) . '" >Read&nbsp;more</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


// add excerpt function to pages
add_action( 'init', 'add_excerpts_to_pages' );
function add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


// custom excerpt function with count control and without read more link 
function excerpt($id,$limit = null,$images = true) {
	$post_object = get_post($id);
	if(!$limit) { $limit = 25; }
	$excerpt = explode(' ', wpautop($post_object->post_content), $limit);
	if (count($excerpt)>=$limit) {
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt);
	} else {
	$excerpt = implode(" ",$excerpt);
	} 
	
	if(!$images){
    	$excerpt = preg_replace("/<img[^>]+\>/i", "", $excerpt);
	}
	
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	$excerpt = preg_replace('/\Â£/','&pound;',$excerpt);
	
	// Use DOMDocument to clean up HTML and close opened tags
	$doc = new DOMDocument();
	$doc->loadHTML($excerpt);
	$excerpt = $doc->saveHTML();
	
	return $excerpt;
}


// enable wordpress menus
register_nav_menus( array(
	'main' => 'Main Navigation',
	'smallnav' => 'Small Navigation'
) );


//wp_menu filtering
function dropdown_menu_class( $classes, $item ){
 
    global $post;
    
    $children = get_pages('child_of='.$post->ID.'&parent=0');
    if(count($children) != 0) {
	     $classes[] = 'show_dropdown';
    }
  
    return $classes;
 
}
 
add_filter( 'nav_menu_css_class', 'dropdown_menu_class', 10, 2 );



// load other functions
include ("frontend/functions/features.php");
include ("frontend/functions/news.php");
include ("frontend/functions/front_news_landing_feature.php");
include ("frontend/functions/front_news_landing_headlines.php");
include ("frontend/functions/openx_ads.php");
include ("frontend/functions/video_meta.php");
include ("frontend/functions/front_home_featured_video.php");
include ("frontend/functions/brands_array.php");
include ("frontend/functions/calc_distance.php");
include ("frontend/functions/calc_distance_ll.php");
include ("frontend/functions/newsloop_shortcode.php");
include ("frontend/functions/dropdown_walker.php");
include ("frontend/functions/stockists.php");
include ("frontend/functions/front_home_news.php");
include ("frontend/functions/front_home_news_dev.php");
include ("frontend/functions/front_home_reviews.php");
include ("frontend/functions/front_home_reviews_sidebar.php");
include ("frontend/functions/front_home_events.php");
include ("frontend/functions/front_home_events_sidebar.php");
include ("frontend/functions/front_home_releases.php");
include ("frontend/functions/front_home_releases_sidebar.php");
include ("frontend/functions/front_home_agg.php");
include ("frontend/functions/custom_router.php");
include ("frontend/functions/front_newscat_leftcol.php");
include ("frontend/functions/front_newscat_rightcol.php");
include ("frontend/functions/front_related_articles.php");
include ("frontend/functions/latlng_php.php");
include ("frontend/functions/stock_brands.php");
include ("frontend/functions/front_section_landing_buttons.php");
include ("frontend/functions/front_dealer_list.php");
include ("frontend/functions/front_dealer_bike_stock.php");
include ("frontend/functions/front_reviews_leftcol.php");
include ("frontend/functions/front_reviews_rightcol.php");


include ("wpadmin/functions/boxads_meta.php");
include ("wpadmin/functions/featurelink_meta.php");
include ("wpadmin/functions/stickypost_meta.php");
include ("wpadmin/functions/thumbnailpos_meta.php");
include ("wpadmin/functions/homenews_meta.php");
include ("wpadmin/functions/news_promotion_meta.php");
include ("wpadmin/functions/reviews_promotion_meta.php");
include ("wpadmin/functions/home_show_video.php");

include ("dealer/functions/dealer_update.php");
include ("dealer/functions/dealer_all_prods.php");


include ("frontend/functions/bike_permalinks.php");


//include ("wpadmin/functions/array_merge.php");


// image sizes
add_theme_support( 'post-thumbnails' );
add_image_size('feature', 960, 380, true);
add_image_size('prodmain', 960, 450);
add_image_size('prodthumb', 60, 60, true);
add_image_size('bikethumblarge', 180, 120, true);
add_image_size('bikethumblarge', 180, 120, true);
add_image_size('bikethumbsmall', 144, 96, true);
add_image_size('dealermain', 960, 240, true);
add_image_size('dealersmall', 9999, 240);
add_image_size('dealerlogo', 200, 200);
add_image_size('dealerlogo_small', 80, 80);
add_image_size('dealerlogo_tiny', 60, 60);
add_image_size('thumb_left', 130, 9999);
add_image_size('thumb_right', 130, 9999);
add_image_size('thumb_top', 313, 9999);
add_image_size('newsfeature', 293, 9999);
add_image_size('home_minithumb', 90, 999);
add_image_size('home_minithumb_top', 250, 999);


// stop the_post_thumbnail from returning dimensions
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


// register dynamic sidebars
$sidebar0 = array(
	'name'          => sprintf(__('Sidebar'), $i ),
	'id'            => 'xenforo',
	'description'   => '',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<p class="title">',
	'after_title'   => '</p>' );

register_sidebar( $sidebar0 );	


// register post type - feature
add_action('init', 'feature_register_post_type');

function feature_register_post_type() {
    register_post_type('feature', array(
        'labels' => array(
            'name' => 'Homepage slides',
            'singular_name' => 'Homepage slide',
            'add_new' => 'Add new homepage slide',
            'edit_item' => 'Edit homepage slide',
            'new_item' => 'New homepage slide',
            'view_item' => 'View homepage slide',
            'search_items' => 'Search homepage slides',
            'not_found' => 'No homepage slides found',
            'not_found_in_trash' => 'No homepage slides found in Trash'
        ),
        'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'slides', 'with_front' => true ),
		'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'comments',
            'page-attributes'
        ),
        'taxonomies' => array('category')
    ));
}



// register post type - guide
add_action('init', 'guide_register_post_type');

function guide_register_post_type() {
    register_post_type('guide', array(
        'labels' => array(
            'name' => 'Guides',
            'singular_name' => 'Guide',
            'add_new' => 'Add new guide',
            'edit_item' => 'Edit guide',
            'new_item' => 'New guide',
            'view_item' => 'View guide',
            'search_items' => 'Search guides',
            'not_found' => 'No guides found',
            'not_found_in_trash' => 'No guides found in Trash'
        ),
        'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'guides', 'with_front' => true ),
		'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'comments',
            'page-attributes'
        ),
        'taxonomies' => array('category')
    ));
}


// register post type - news
add_action('init', 'news_register_post_type');

function news_register_post_type() {
    register_post_type('news', array(
        'labels' => array(
            'name' => 'News',
            'singular_name' => 'News',
            'add_new' => 'Add news',
            'edit_item' => 'Edit news',
            'new_item' => 'New news',
            'view_item' => 'View news',
            'search_items' => 'Search news',
            'not_found' => 'No news found',
            'not_found_in_trash' => 'No news found in Trash'
        ),
        'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'news', 'with_front' => true ),
		'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'comments',
            'page-attributes',
        ),
        'taxonomies' => array('category','post_tag')
    ));
}

// register post type - bike
add_action('init', 'bike_register_post_type');

function bike_register_post_type() {
    register_post_type('bike', array(
        'labels' => array(
            'name' => 'Bikes',
            'singular_name' => 'Bike',
            'add_new' => 'Add new bike',
            'edit_item' => 'Edit bike',
            'new_item' => 'New bike',
            'view_item' => 'View bike',
            'search_items' => 'Search bikes',
            'not_found' => 'No bikes found',
            'not_found_in_trash' => 'No bikes found in Trash'
        ),
        'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'bikes', 'with_front' => true ),
		//'rewrite' => false,
		'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'comments',
            'page-attributes'
        ),
    ));
}

// register post type - conversion kit
add_action('init', 'ckit_register_post_type');

function ckit_register_post_type() {
    register_post_type('ckit', array(
        'labels' => array(
            'name' => 'Conversion kits',
            'singular_name' => 'Conversion kit',
            'add_new' => 'Add new conversion kit',
            'edit_item' => 'Edit conversion kit',
            'new_item' => 'New conversion kit',
            'view_item' => 'View conversion kit',
            'search_items' => 'Search conversion kits',
            'not_found' => 'No conversion kits found',
            'not_found_in_trash' => 'No conversion kits found in Trash'
        ),
        'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'conversion-kits', 'with_front' => true ),
		'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'comments',
            'page-attributes'
        ),
    ));
}

// register post type - review
add_action('init', 'review_register_post_type');

function review_register_post_type() {
    register_post_type('review', array(
        'labels' => array(
            'name' => 'Reviews',
            'singular_name' => 'Review',
            'add_new' => 'Add new review',
            'edit_item' => 'Edit review',
            'new_item' => 'New review',
            'view_item' => 'View review',
            'search_items' => 'Search reviews',
            'not_found' => 'No reviews found',
            'not_found_in_trash' => 'No reviews found in Trash'
        ),
        'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'electric-bike-reviews', 'with_front' => false ),
		'query_var' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'comments',
            'page-attributes'
        ),
    ));
}


// Add to admin_init function
add_filter('manage_edit-bike_columns', 'add_new_bike_columns');

function add_new_bike_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Gallery Name', 'column name');
    $new_columns['author'] = __('Author');
    $new_columns['date'] = _x('Date', 'column name');
 
    return $new_columns;
}



// register post type - video
add_action('init', 'video_register_post_type');

function video_register_post_type() {
    register_post_type('video', array(
        'labels' => array(
            'name' => 'Videos',
            'singular_name' => 'Video',
            'add_new' => 'Add new video',
            'edit_item' => 'Edit video',
            'new_item' => 'New video',
            'view_item' => 'View video',
            'search_items' => 'Search videos',
            'not_found' => 'No videos found',
            'not_found_in_trash' => 'No videos found in Trash'
        ),
        'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'videos', 'with_front' => true ),
		'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'comments',
            'page-attributes'
        ),
    ));
}

// register post type - jargon
add_action('init', 'jargon_register_post_type');

function jargon_register_post_type() {
    register_post_type('jargon', array(
        'labels' => array(
            'name' => 'Jargon',
            'singular_name' => 'Jargon',
            'add_new' => 'Add new jargon',
            'edit_item' => 'Edit jargon',
            'new_item' => 'New jargon',
            'view_item' => 'View jargon',
            'search_items' => 'Search jargon',
            'not_found' => 'No jargon found',
            'not_found_in_trash' => 'No jargon found in Trash'
        ),
        'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'jargon', 'with_front' => true ),
		'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
        ),
        'taxonomies' => array('category')
    ));
}



///////////////////////////////////////////// script functions ///////////////////////////////////////////////


// dequeue jquery
function jquery() {
	wp_dequeue_script('jquery');
}

add_action( 'wp_footer', 'jquery' );


// enqueue cufon
function cufon() {
	wp_enqueue_script('cufon',get_template_directory_uri() . '/js/cufon-yui.js',array('jquery'));
	wp_enqueue_script('uni-sans',get_template_directory_uri() . '/js/Uni_Sans_Book_400.font.js',array('jquery'));
}

add_action( 'wp_enqueue_scripts', 'cufon' );


// enqueue homepage slider
function pedelecs_slider() {
	wp_enqueue_script('pedelecs-slider',get_template_directory_uri() . '/js/pedelecs-slider.js',array('jquery'));
}

add_action( 'wp_enqueue_scripts', 'pedelecs_slider' );


// enqueue masonry
function masonry_load() {
	wp_enqueue_script('jquery-masonry');
}

add_action( 'wp_enqueue_scripts', 'masonry_load' );




///////////////////////////////////////////// user functions ///////////////////////////////////////////////

//login failure redirect
add_action( 'wp_login_failed', 'manufacturer_login_fail' );  // hook failed login

function manufacturer_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}


//create new user roles
$caps = array(	'delete_posts' => true,
					'delete_published_posts' => true,
					'edit_posts' => true,
					'edit_published_posts' => true,
					'publish_posts' => true,
					'read' => true,
					'upload_files' => true
					);
					
add_role( 'manufacturer', 'Manufacturer', $caps );
add_role( 'dealer', 'Dealer', $caps );
add_role( 'dealer_premium', 'Dealer (Premium)', $caps );


//modify user fields
function modify_contact_methods($profile_fields) {
	$profile_fields['image_url'] = 'Image URL';
	$profile_fields['address'] = 'Address';
	$profile_fields['postcode'] = 'Postcode';
	$profile_fields['telephone'] = 'Telephone';
	$profile_fields['bike_stock'] = 'Bike stock';
	$profile_fields['accessory_stock'] = 'Accessory stock';
	
	unset($profile_fields['aim']);
	unset($profile_fields['yim']);
	unset($profile_fields['jabber']);

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');


// disable front end toolbar for new user registrations
add_action('user_register','trash_public_admin_bar');
function trash_public_admin_bar($user_ID) {
    update_user_meta( $user_ID, 'show_admin_bar_front', 'false' );
}


//update user
add_action('wp_ajax_dealer_update', 'dealer_update');
add_action('wp_ajax_nopriv_dealer_update', 'dealer_update');
//add_action('edit_user_profile_update', 'dealer_update');
 

//load custom router for dealers
add_action( 'wp', 'custom_router');


////////////////////////////////////// admin functions ///////////////////////////////////////

// make editor movable on jobs
add_action( 'add_meta_boxes', 'jb_make_wp_editor_movable', 0 );
function jb_make_wp_editor_movable() {
    global $_wp_post_type_features;
    if (isset($_wp_post_type_features['job']['editor']) && $_wp_post_type_features['job']['editor']) {
        unset($_wp_post_type_features['job']['editor']);
        add_meta_box(
            'description_sectionid',
            __('Job description'),
            'jb_inner_custom_box',
            'job', 'normal', 'high'
        );
    }
}
function jb_inner_custom_box( $post ) {
    the_editor($post->post_content);
}


// auto inheritance of ads
add_action('wp_insert_post', 'set_default_custom_fields');
 
function set_default_custom_fields($post_id){
    if ( $_GET['post_type'] == 'classified' ) {
        add_post_meta($post_id, 'inherit_ads', '726', true);
    }
    return true;
}


// disable admin bar for users (except admin)
add_action('init', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}


// disallow access to wp-admin for non admins
add_action( 'admin_init', 'redirect_non_admin_users' );
function redirect_non_admin_users() {
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url() );
		exit;
	}
}


// security
remove_action('wp_header', 'wp_generator');





////////////////////////////////////// misc functions ///////////////////////////////////////


// control who can see which pages
function can_see_this(){

	$roles = func_get_args();
	$current_user = wp_get_current_user();
	$user = new WP_User($current_user->ID);
	if(!in_array($user->roles[0], $roles) && is_user_logged_in()) {
		header('Location: /index.php');
	}

}


// only admin can view this block
function faeo(){

	$items = func_get_args();
	$current_user = wp_get_current_user();
	$user = new WP_User($current_user->ID);
	if($user){
	if(!in_array($user->roles[0], 'administrator') && !is_user_logged_in()) {
		foreach ($items as $item) { echo '<style>'.$item.' { display: none; }</style>'; }
	}
    }
}


function isdlr($switch = 'on'){
	if($switch == 'off'){
		return false;
	} else {
		return $_SERVER['REMOTE_ADDR'] == '212.56.101.219';
	}
	
}

function isadmin(){
	return current_user_can('administrator');
}

// only admin users can see this page
function only_admin(){

	/*
$current_user = wp_get_current_user();
	$user = new WP_User($current_user->ID);
	
	if(is_user_logged_in() || $_SERVER['REMOTE_ADDR'] == '212.56.101.219' || $_SERVER['REMOTE_ADDR'] == '86.26.5.102') {
		if($user->roles[0] == 'manufacturer') { // is a manufacturer
			header('Location: /manufacturer-admin');
		} 
		if($user->roles[0] == 'dealer' || $user->roles[0] == 'dealer_premium') { // is a dealer
			header('Location: /dealer-admin');
		}
	} else {
		header('Location: /dealer-admin');
	}
*/
}


// show contents of array
function pre($array){
	echo '<pre>Pre output:<br />'; print_r($array); echo '</pre>';
}


// get image attachment id
function get_attachment_id_by_src ($image_src) {

    global $wpdb;
	$prefix = $wpdb->prefix;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='" . $image_src . "';"));
	return $attachment[0];

}


// get intro image from thumbnail or content
function get_intro_image($post_id,$imgsize = null){

	$img = null;
	
	$imgpos = 'thumb_'.get_post_meta($post_id, '_thumbnailpos', true);
	if($imgpos == 'thumb_') { $imgpos .= 'left'; }
	
	if(!isset($imgsize)) $imgsize = $imgpos; 
	
	if(has_post_thumbnail($post_id)) {
		$img = get_the_post_thumbnail($post_id, $imgsize, array('class' => $imgpos));
		if($imgpos == 'thumb_top') $img .= '<div class="clear"></div>';
	} else {
	
		$content_post = get_post($post_id);
		$content = $content_post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);

		$sourceDOM = new DOMDocument();
		$sourceDOM->loadHTML($content);
		$sourceDOM_xpath = new DOMXPath($sourceDOM);
		
		$images = $sourceDOM->getElementsByTagName('img');
		
		if($images->item(0)){
			if(strstr($images->item(0)->getAttribute('src'), 'pedelecs.co.uk/wp-content')) {
				$img_id = get_attachment_id_by_src($images->item(0)->getAttribute('src'));
				$img = wp_get_attachment_image($img_id, $imgsize, 0, array('class' => $imgpos));
			} else {
				$img = '<img src="'.$images->item(0)->getAttribute('src').'" style="max-width: 100%;" />';
			}
		}
		
	}
	
	return $img;
}


function get_the_excerpt_by_ID($post_id) {
    global $post;  
    $save_post = $post;
    $post = get_post($post_id);
    $output = get_the_excerpt();
    $post = $save_post;
    return $output;
}
?>