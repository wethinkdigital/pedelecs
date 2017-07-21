<?php 	

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );	
		
get_currentuserinfo();			
$images = get_user_meta($current_user->ID,'image_id');
$videos = get_user_meta($current_user->ID,'videolink');

//echo '<pre>'; print_r($current_user); echo '</pre>';
	
$mainatts = array(
	'class'	=> 'main',
);

// load attachments as main images
if(count($images) > 0 || count($videos) > 0){ echo '<div class="mainimage">'; }

	foreach ($images as $image) {
		echo '<div class="imageholder" id="'.$image.'">'; echo wp_get_attachment_image( $image, 'dealermain', $mainatts ); echo '</div>';
	}
		
	foreach($videos as $video) {
	
		if(is_numeric($video)) { // is Vimeo
		
			$vimeo_xml = simplexml_load_string(file_get_contents('http://vimeo.com/api/oembed.xml?url=http://vimeo.com/'.$video));
			$vimeo_width = $vimeo_xml->width;
			$vimeo_height = $vimeo_xml->height;
			$iframe_width = (450/$vimeo_height)*$vimeo_width;

			echo '<div class="imageholder videoholder" id="video_'.$video.'">';
			echo '<iframe width="'.$iframe_width.'" height="450" src="http://player.vimeo.com/video/'.$video.'" frameborder="0"></iframe>';
			echo '</div>';
							
		} else { // is Youtube
		
			$yt_xml = simplexml_load_string(file_get_contents('https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v='.$video.'&format=xml'));
			$yt_width = $yt_xml->width;
			$yt_height = $yt_xml->height;
			$iframe_width = (450/intval($yt_height))*intval($yt_width);
			
			echo '<div class="imageholder videoholder" id="video_'.$video.'">';
			echo '<iframe width="'.$iframe_width.'" height="450" src="http://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0"></iframe>';
			echo '</div>';
		}

	}

if(count($images) > 0 || count($videos) > 0){ echo '</div>'; }


// iterate through images and videos to create thumbnails
echo '<div class="thumbnails"><div class="sortable footer">';

/*
foreach ($images as $image) {
	echo '<div class="thumb imagethumb" id="image_'.$image.'" attachment_id="'.$image.'" post_id="'.$_POST['post_id'].'">'; 
	echo wp_get_attachment_image( $image, 'bikethumb' );
	echo '<div class="delete hovershow purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div>';
	echo '</div>';
}


foreach($videos as $video) {

	if(is_numeric($video)) { // is Vimeo
	

		echo '<div class="thumb videothumb" post_id="'.$_POST['post_id'].'" attachment_id="video_'.$video.'">'; 
		echo '<iframe width="100" height="100" src="http://player.vimeo.com/video/'.$video.'" frameborder="0"></iframe>';
		echo '<img class="coverslip" src=""/>';
		echo '<div class="delete hovershow purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div>';
		echo '</div>';
						
	} else { // is Youtube
					
		echo '<div class="thumb videothumb" post_id="'.$_POST['post_id'].'" attachment_id="video_'.$video.'">'; 
		echo '<iframe width="100" height="100" src="http://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0"></iframe>';
		echo '<img class="coverslip" src=""/>';
		echo '<div class="delete hovershow purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div>';
		echo '</div>';
	}

}

echo '<label style="color: white;">Drag images to reorder, click <div class="delete demo purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div> to delete</label>';
*/

echo '</div></div>';
	 
?>