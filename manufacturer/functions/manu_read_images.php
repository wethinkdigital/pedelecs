<?php 	

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
			

// attachments query
$attach_args = array(
				'post_type' => 'attachment',
				'post_mime_type' => array('image','video'),
				'posts_per_page' => '6',
				'post_status' => null,
				'post_parent' => $_POST['post_id'],
				'orderby' => 'menu_order',
				'order' => 'ASC'
);

$attachments = get_posts($attach_args);
	
$mainatts = array(
	'class'	=> 'main',
);

// load attachments as main images
if(count($attachments) > 0){

	echo '<div class="mainimage">';
		foreach ($attachments as $attachment) {
			
			echo '<div class="imageholder" id="'.$attachment->ID.'">';
			echo wp_get_attachment_image( $attachment->ID, 'prodmain', $mainatts );
			echo '</div>';
		}
		
		
	$videos = get_post_meta($_POST['post_id'], 'videolink');
	
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


	echo '</div>';
}

// iterate through attachments to create thumbnails
echo '<div class="thumbnails"><div class="sortable footer">';

foreach ($attachments as $attachment) {

	echo '<div class="thumb imagethumb" id="image_'.$attachment->ID.'" attachment_id="'.$attachment->ID.'" post_id="'.$_POST['post_id'].'">'; 
	echo wp_get_attachment_image( $attachment->ID, 'prodthumb' );
	echo '<div class="delete hovershow purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div>';
	echo '</div>';
}

// get videolink metadata
$videos = get_post_meta($_POST['post_id'], 'videolink');
		foreach($videos as $video) {
		
			if(is_numeric($video)) { // is Vimeo
			

				echo '<div class="thumb videothumb" post_id="'.$_POST['post_id'].'" attachment_id="video_'.$video.'">'; 
				echo '<iframe width="60" height="60" src="http://player.vimeo.com/video/'.$video.'" frameborder="0"></iframe>';
				echo '<img class="coverslip" src=""/>';
				echo '<div class="delete hovershow purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div>';
				echo '</div>';
								
			} else { // is Youtube
							
				echo '<div class="thumb videothumb" post_id="'.$_POST['post_id'].'" attachment_id="video_'.$video.'">'; 
				echo '<iframe width="60" height="60" src="http://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0"></iframe>';
				echo '<img class="coverslip" src=""/>';
				echo '<div class="delete hovershow purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div>';
				echo '</div>';
			}

		}

	 echo '<label>Drag images to reorder, click <div class="delete demo purplegrad"><img src="'.get_bloginfo('template_url').'/img/image-delete.png" unselectable="on" /></div> to delete. The leftmost image will display to represent this model.</label></div></div>';
	 
?>