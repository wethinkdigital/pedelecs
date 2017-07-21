<input type="hidden" id="uniform" value="TRUE" />

<div class="wrapper dropshad" style="margin-bottom: 20px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>



<div class="wrapper" id="prodspec">

	
		<div id="prodheader">
			
			<?php session_start(); ?>
			
				<form action="/buy/find-an-electric-bike/" method="post">
					<input type="submit" value="Back to search" />
				</form>
			<?php  ?>

			<h1 style="margin: 0px;"><?php echo get_post_meta(get_the_id(),'brand',true).' '; the_title(); ?></h1>
		</div>
	
		<div id="images" style="height: 450px;">
		
			<div class="gallery">
				<?php
				$attach_args = array(
				'post_type' => 'attachment',
				'post_mime_type' => array('image','video'),
				'posts_per_page' => -1,
				'post_status' => null,
				'post_parent' => $post->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC'
				);
				
				$attachments = get_posts($attach_args);
									
					if(count($attachments) > 0){
				
						echo '<div class="mainimage">';
		foreach ($attachments as $attachment) {
			
			echo '<div class="imageholder" id="'.$attachment->ID.'">'; echo wp_get_attachment_image( $attachment->ID, 'prodmain', $mainatts ); echo '</div>';
		}
		
		
	$videos = get_post_meta($post->ID, 'videolink');
	
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
					
					echo '<div class="thumbnails"><div class="footer">';

foreach ($attachments as $attachment) {

	echo '<div class="thumb imagethumb" id="image_'.$attachment->ID.'" attachment_id="'.$attachment->ID.'" post_id="'.$_POST['post_id'].'" style="margin: -30px 10px 0 0;">'; 
	echo wp_get_attachment_image( $attachment->ID, 'prodthumb' );
	echo '</div>';
}

// get videolink metadata
$videos = get_post_meta($post->ID, 'videolink');
		foreach($videos as $video) {
		
			if(is_numeric($video)) { // is Vimeo
			

				echo '<div class="thumb videothumb" post_id="'.$post->ID.'" attachment_id="video_'.$video.'" style="margin: -30px 10px 0 0;">'; 
				echo '<iframe width="60" height="60" src="http://player.vimeo.com/video/'.$video.'" frameborder="0"></iframe>';
				echo '<img class="coverslip" src=""/>';
				echo '</div>';
								
			} else { // is Youtube
							
				echo '<div class="thumb videothumb" post_id="'.$post->ID.'" attachment_id="video_'.$video.'" style="margin: -30px 10px 0 0;">'; 
				echo '<iframe width="60" height="60" src="http://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0"></iframe>';
				echo '<img class="coverslip" src=""/>';
				echo '</div>';
			}

		}
					 
					 echo '</div></div>'; // end .thumbnails
				
				 ?>
				
			</div>

		</div>
		
	<div class="stage purplegrad" style="margin-bottom: 30px;">
	
	        <?php session_start(); ?>
			<!-- <pre>Session: <?php print_r($_SESSION); ?></pre> -->


		<div id="speclist">

			<div id="leftcol" class="palegrey">
		
				
				
			<h3 class="purple">Description</h3>
			
			<p style="margin-bottom: 20px;"><?php echo wpautop(get_post_meta(get_the_id(), 'description', true)); ?></p>
		
			<h3 class="purple">Specification</h3>
			
				<div class="formcol">
				
					<ul class="speclist">
						<li><label>Brand</label><div class="value"><?php echo get_post_meta(get_the_id(), 'brand', true); ?></div><div class="clear"></div></li>
						<li><label>Model</label><div class="value"><?php echo get_post_meta(get_the_id(), 'model', true); ?></div><div class="clear"></div></li>
						<li><label>RRP</label><div class="value"><?php if(get_post_meta(get_the_id(), 'rrp', true)) echo '&pound;'; echo get_post_meta(get_the_id(), 'rrp', true); ?></div><div class="clear"></div></li>
					</ul>

					<ul class="speclist">
						<li><label style="width: 100px;">Use</label>
							<div class="value">
								<?php $uses = array();
									if(get_post_meta(get_the_id(), 'commuting_town', true)) { $uses[] = 'Commuting & Town'; }
									if(get_post_meta(get_the_id(), 'general_leisure', true)) { $uses[] = 'General leisure'; }
									if(get_post_meta(get_the_id(), 'trail_mountain', true)) { $uses[] = 'Trail & Mountain'; }
									if(get_post_meta(get_the_id(), 'touring', true)) { $uses[] = 'Touring'; }
									echo implode(', ', $uses);
								?>
							</div>
							<div class="clear"></div>
						</li>
						<li><label>Frame Type</label><div class="value"><?php echo get_post_meta(get_the_id(), 'frame_type', true); ?></div><div class="clear"></div></li>
						<li><label>Frame Style</label><div class="value"><?php echo get_post_meta(get_the_id(), 'frame_style', true); ?></div><div class="clear"></div></li>
						<li><label>Frame material</label><div class="value"><?php echo get_post_meta(get_the_id(), 'frame_material', true); ?></div><div class="clear"></div></li>
						<li><label>Place of manufacture</label><div class="value"><?php echo get_post_meta(get_the_id(), 'place_manufacture', true); ?></div><div class="clear"></div></li>
						<li><label>Motor power (W)</label><div class="value"><?php echo get_post_meta(get_the_id(), 'motor_power', true); ?></div><div class="clear"></div></li>
						<li><label>Motor position</label><div class="value"><?php echo get_post_meta(get_the_id(), 'motor_position', true); ?></div><div class="clear"></div></li>
						<li><label>Motor description</label><div class="value"><?php echo get_post_meta(get_the_id(), 'motor_description', true); ?></div><div class="clear"></div></li>
						<li><label>Battery details</label><div class="value">
								<?php echo get_post_meta(get_the_id(), 'battery_details', true); ?>
							</div><div class="clear"></div><div class="clear"></div></li>
						<li><label>Max. range (miles)</label><?php echo get_post_meta(get_the_id(), 'max_range', true); ?></li>
						<li class="norule"><label style="width: 125px;">Throttle / Pedal Assist</label>
							<div class="value">
								<?php echo get_post_meta(get_the_id(), 'throttle', true); ?>
							</div><div class="clear"></div>
						</li>
					</ul>
					
				</div>

				<div class="formcol" style="margin: 0px;">
				
					<ul class="speclist">
						
						<li><label>Suspension</label><div class="value"><?php echo get_post_meta(get_the_id(), 'suspension', true); ?></div><div class="clear"></div></li>
						<li><label>Brakes</label><div class="value"><?php echo get_post_meta(get_the_id(), 'brakes', true); ?></div><div class="clear"></div></li>
						<li><label>Gears</label><div class="value"><?php echo get_post_meta(get_the_id(), 'gears', true); ?></div><div class="clear"></div></li>
						<li><label>Stem</label><div class="value"><?php echo get_post_meta(get_the_id(), 'stem', true); ?></div><div class="clear"></div></li>
						<li><label>Saddle</label><div class="value"><?php echo get_post_meta(get_the_id(), 'saddle', true); ?></div><div class="clear"></div></li>
						<li><label>Wheel size (in)</label><div class="value"><?php echo get_post_meta(get_the_id(), 'wheel_size', true); ?></div><div class="clear"></div></li>
						<li><label>Tyres</label><div class="value"><?php echo get_post_meta(get_the_id(), 'tyres', true); ?></div><div class="clear"></div></li>
						<li><label>Controls</label><div class="value"><?php echo get_post_meta(get_the_id(), 'controls', true); ?></div><div class="clear"></div></li>
						<li><label>Fork</label><div class="value">
								<?php echo get_post_meta(get_the_id(), 'fork', true); ?>
							</div><div class="clear"></div></li>
						<li><label>Handlebars</label><div class="value"><?php echo get_post_meta(get_the_id(), 'handlebars', true); ?></div><div class="clear"></div></li>
						<li><label>Weight with battery (kg)</label><div class="value"><?php echo get_post_meta(get_the_id(), 'weight', true); ?></div><div class="clear"></div></li>
						<li style="height: 40px;"><label>Warranty (frame and battery)</label><div class="value"><?php echo get_post_meta(get_the_id(), 'warranty', true); ?></div><div class="clear"></div></li>
						<?php if(get_post_meta(get_the_id(), 'discontinued', true)) { echo '<p style="margin-top: 10px;"><strong>This bike has been discontinued</strong></p>'; } ?>
						
					</ul>

					
				</div>
				
								<div class="clear"></div>

				
				
				
				<hr>
				
				<h3 class="purple">Service & Repair options</h3>
				<p>
				<?php
				    if(get_post_meta(get_the_id(), 'service_repair', true) == '') { echo 'Awaiting information'; } else {
				echo wpautop(get_post_meta(get_the_id(), 'service_repair', true));
				} ?>
				</p>

				<hr>
				
				<h3 class="purple">Optional extras</h3>
				<p>
				<?php if(get_post_meta(get_the_id(), 'optional_extras', true) == '') { echo 'Awaiting information'; } else {
				echo wpautop(get_post_meta(get_the_id(), 'optional_extras', true));
				} ?>
				</p>

				
				<hr>
				<h3 class="purple">Certification</h3>
								<?php if(get_post_meta(get_the_id(), 'cert', true)) { ?>
				<p style="margin-top: 20px;">The manufacturer states this bike adheres to the following European standard: EN 15194 standard for 'Electronically Power Assisted Cycles' (EPAC)</p>
				<?php } ?>

				<?php if(get_post_meta(get_the_id(), 'battery_certification', true) == 'lithium') { ?>
				<p>Lithium battery conforms to UN standard 38.3</p>
				<?php } ?>
				
				<?php if(get_post_meta(get_the_id(), 'battery_certification', true) == 'non-lithium') { ?>
				<p>Non-lithium - UN38.3 not applicable</p>
				<?php } ?>

				
				<hr>
				<h3 class="purple">Manuals</h3>
				
				<?php $args = array(
					'post_type' => 'attachment',
					'numberposts' => null,
					'post_status' => null,
					'post_parent' => get_the_id(),
					'post_mime_type' => array('application/pdf'),
				);
				
				$attachments = get_posts($args);
				
				
				if(count($attachments == 0)) { echo 'Awaiting information'; } else {
				
				foreach($attachments as $attachment) { ?>
					<div class="pdf_panel fl" style="width: 180px;" attachment_id="<?php echo $attachment->ID; ?>" post_id="<?php echo $_POST['post_id']; ?>">
						<a href="<?php echo $attachment->guid; ?>" target="_blank">
							<img src="<?php bloginfo('template_url'); ?>/img/pdf-icon.png" /><br />
							<?php echo $attachment->post_title; ?>
						</a>
					</div>
				<?php }
				
                }				
				
				?>
				
			</div>
		
			<div id="rightcol" >
							
				
				<h4 style="color: white;">Dealers near you</h4>

				<form id="distance_search" action="" method="POST">
				
				<input type="hidden" name="this_prod" value="<?php echo get_the_id(); ?>" />
				<input type="hidden" name="prod_type" value="bike" />
 				<input type="text" name="user_postcode" class="fl" placeholder="Postcode" value="<?php if($_SESSION['user_postcode']) echo $_SESSION['user_postcode']; ?>" />
				<select name="user_distance">
					<option value="" <?php echo ($_SESSION['user_distance'] == '' ? 'SELECTED' : ''); ?>>Distance</option>
					<option value="5" <?php echo ($_SESSION['user_distance'] == '5' ? 'SELECTED' : ''); ?>>5 miles</option>
					<option value="10" <?php echo ($_SESSION['user_distance'] == '10' ? 'SELECTED' : ''); ?>>10 miles</option>
					<option value="20" <?php echo ($_SESSION['user_distance'] == '20' ? 'SELECTED' : ''); ?>>20 miles</option>
					<option value="50" <?php echo ($_SESSION['user_distance'] == '50' ? 'SELECTED' : ''); ?>>50 miles</option>
					<option value="9999" <?php echo ($_SESSION['user_distance'] == '9999' ? 'SELECTED' : ''); ?>>National</option>
				</select>
				<input type="button" value="Search" class="greenbutton" id="bike_dealer_search" />
				</form>
								
				<div id="in_range_dealers">
					
				</div>
				<div id="online_dealers">
				
				</div>
				
				<?php //echo '<pre>'; print_r(get_user_meta('121','bike_stock',true)); echo '</pre>'; ?>
	
				
			</div>
	
		</div>

	<div class="clear"></div>
	
	</div>
</div>

<script>
$(function(){
    $('.imageholder').each(function(){
        var img = $(this).children('img');
        var css;
        var ratio=$(img).width() / $(img).height();
        var pratio=$(this).width() / $(this).height();
        if (ratio<pratio) css={width:'auto', height:'100%'};
        else css={width:'100%', height:'auto'};
        $(img).css(css);
        $(this).css(css);
    });
});
</script>