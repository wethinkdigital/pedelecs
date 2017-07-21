<div class="wrapper dropshad" id="adpanel" style="margin-bottom: 10px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>

<div class="wrapper">
	<div class="stage">
		<h1>Bike comparison</h1>
	</div>
</div>

<?php 

	
	foreach($_POST as $k=>$v) { 
		$bike_id = explode('_', $k);
		$bike['ID'] = $bike_id[1];
		$bike_data = get_post_custom($bike_id[1]);
		
		foreach ($bike_data as $k => $v) { $bike[$k] = $v[0];  }
		
		$uses = array();
		if($bike['commuting_town']) { $uses[] = 'Commuting & Town';}
		if($bike['general_leisure']) { $uses[] = 'General leisure';}
		if($bike['trail_mountain']) { $uses[] = 'Trail & Mountain';}
		if($bike['touring']) {$uses[] = 'Touring';}
		$bike['uses'] = implode(', ', $uses);
		
		$bike['header'] = '<h4>'.$bike['brand'].' '.$bike['model'].'</h4>';
		$bike['rrp'] = '&pound;'.$bike['rrp'];
		
		$attach_args = array(
				'post_type' => 'attachment',
				'post_mime_type' => array('image'),
				'posts_per_page' => '1',
				'post_status' => null,
				'post_parent' => $bike_id[1],
				'orderby' => 'menu_order',
				'order' => 'ASC'
		);
		
		$attachments = get_posts($attach_args);
		
		if(count($attachments) > 0){
			$bike['image'] = wp_get_attachment_image( $attachments[0]->ID, 'bikethumblarge' );
		} else {
			$bike['image'] = '';
		}

		$bikes[] = $bike;
	}	
	
	function print_data($k,$link) {
		global $bikes; 
		for($i = 0; $i < count($bikes); $i++) {
			echo '<label class="data">';
			echo (($link) ? '<a href="/?p='.$bikes[$i]['ID'].'">' : '');
			echo (isset($bikes[$i][$k]) ? $bikes[$i][$k] : '');
			echo (($link) ? '</a>' : '');
			echo '</label>';
		}		
	}
		


?>

<div class="wrapper" id="bikespec">

	<div class="stage palegrey" style="margin-bottom: 30px;">
	
	<pre><?php //print_r($bikes); echo count($bikes);?></pre>


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
					<?php for($i = 0; $i < count($bikes); $i++) {
						echo '<label class="data">';
						echo '<a href="/?p='.$bikes[$i]['ID'].'">';
						echo '<input type="button" class="purplegrad" value="More info and where to buy" style="width: 170px; padding: 6px; text-decoration: none !important;"/>';
						echo '</a>';
						echo '</label>';
					} ?>
				</div>

				
					
		</div>
		

	<div class="clear"></div>
	
	</div>
	
</div>

