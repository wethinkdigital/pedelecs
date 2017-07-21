<div class="wrapper dropshad" id="adpanel" style="margin-bottom: 10px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>

<div class="wrapper">
	<div class="stage">
		<h1>Conversion Kit comparison</h1>
	</div>
</div>

<?php 

	
	foreach($_POST as $k=>$v) { 
		$ckit_id = explode('_', $k);
		$ckit['ID'] = $ckit_id[1];
		$ckit_data = get_post_custom($ckit_id[1]);
		
		foreach ($ckit_data as $k => $v) { $ckit[$k] = $v[0];  }
		
		
		$ckit['header'] = '<h4>'.$ckit['brand'].' '.$ckit['model'].'</h4>';
		$ckit['rrp'] = '&pound;'.$ckit['rrp'];
		
		$attach_args = array(
				'post_type' => 'attachment',
				'post_mime_type' => array('image'),
				'posts_per_page' => '1',
				'post_status' => null,
				'post_parent' => $ckit_id[1],
				'orderby' => 'menu_order',
				'order' => 'ASC'
		);
		
		$attachments = get_posts($attach_args);
		
		if(count($attachments) > 0){
			$ckit['image'] = wp_get_attachment_image( $attachments[0]->ID, 'bikethumblarge' );
		} else {
			$ckit['image'] = '';
		}

		$ckits[] = $ckit;
	}	
	
	function print_data($k,$link) {
		global $ckits; 
		for($i = 0; $i < count($ckits); $i++) {
			echo '<label class="data">';
			echo (($link) ? '<a href="/?p='.$ckits[$i]['ID'].'">' : '');
			echo (isset($ckits[$i][$k]) ? $ckits[$i][$k] : '');
			echo (($link) ? '</a>' : '');
			echo '</label>';
		}		
	}
		


?>

<div class="wrapper" id="ckitspec">

	<div class="stage palegrey" style="margin-bottom: 30px;">
	
	<pre><?php //print_r($ckits); echo count($ckits);?></pre>


		<div id="comparetable">
		
				<div class="column-header">
					<label></label>
					<?php print_data('header',TRUE) ?>
					
					<div class="clear" style="margin-bottom: 6px;"></div>
					
					<label></label>
					<?php print_data('image',TRUE) ?>
					
				</div>
				
				
			
				<div class="row" id=""><label>RRP</label><?php print_data('rrp'); ?></div>
				
				<pre><?php //print_r($data); ?></pre>
				
				<div class="row" id="use"><label>Use</label><?php print_data('uses'); ?></div>				
				<div class="row" id="frame_type"><label>Frame Type</label><?php print_data('frame_type'); ?></div>
				<div class="row" id="frame_style"><label>Frame Style</label><?php print_data('frame_style'); ?></div>
				<div class="row" id="frame_material"><label>Frame material</label><?php print_data('frame_material'); ?></div>
				<div class="row" id="place_manufacture"><label>Place of manufacture</label><?php print_data('place_manufacture'); ?></div>
				<div class="row" id="motor_power"><label>Motor power (W)</label><?php print_data('motor_power'); ?></div>
				<div class="row" id="motor_position"><label>Motor position</label><?php print_data('motor_position'); ?></div>
				<div class="row" id="battery_details"><label>Battery details</label><?php print_data('battery_details'); ?></div>
				<div class="row" id="max_range"><label>Max. range (miles)</label><?php print_data('max_range'); ?></div>
				<div class="row" id="throttle"><label>Throttle / Pedal Assist</label><?php print_data('throttle'); ?></div>

				<div class="row" id="suspension"><label>Suspension</label><?php print_data('suspension'); ?></div>
				<div class="row" id="brakes"><label>Brakes</label><?php print_data('brakes'); ?></div>
				<div class="row" id="gears"><label>Gears</label><?php print_data('gears'); ?></div>
				<div class="row" id="saddle"><label>Saddle</label><?php print_data('saddle'); ?></div>
				<div class="row" id="wheel_size"><label>Wheel size (in)</label><?php print_data('wheel_size'); ?></div>
				<div class="row" id="tyres"><label>Tyres</label><?php print_data('tyres'); ?></div>
				<div class="row" id="controls"><label>Controls</label><?php print_data('controls'); ?></div>
				<div class="row" id="fork"><label>Fork</label><?php print_data('fork'); ?></div>
				<div class="row" id="handlebars"><label>Handlebars</label<?php print_data('handlebars'); ?></div>
				<div class="row" id="weight"><label>Weight with battery (kg)</label><?php print_data('weight'); ?></div>
				<div class="row" id="warranty"><label>Warranty (frame and battery)</label><?php print_data('warranty'); ?></div>

				<div class="row" id="discontinued"><label></label></div>
				<div class="clear"></div>
				<div id="moreinfo" style="padding: 8px 0;"><label></label>
					<?php for($i = 0; $i < count($ckits); $i++) {
						echo '<label class="data">';
						echo '<a href="/?p='.$ckits[$i]['ID'].'">';
						echo '<input type="button" class="purplegrad" value="More info and where to buy" style="width: 170px; padding: 6px; text-decoration: none !important;"/>';
						echo '</a>';
						echo '</label>';
					} ?>
				</div>

				
					
		</div>
		

	<div class="clear"></div>
	
	</div>
	
</div>

