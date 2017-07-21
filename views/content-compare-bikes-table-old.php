<div class="wrapper dropshad" style="margin-bottom: 10px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>


<div class="wrapper" id="bikespec">

		
	<div class="stage palegrey" style="margin-bottom: 30px;">

		<div id="comparetable">
			
				<div class="comparecol fl">
				
					<ul class="compare_label">
						<li><label>Brand</label>
						<li><label>Model</label>
						<li><label>RRP</label>
					</ul>

					<ul class="compare_label">
						<li><label style="width: 100px;">Use</label></li>
						<li><label>Frame Type</label></li>
						<li><label>Frame Style</label></li>
						<li><label>Frame material</label></li>
						<li><label>Place of manufacture</label></li>
						<li><label>Motor power (W)</label></li>
						<li><label>Motor position</label></li>
						<li><label>Battery details</label></li>
						<li><label>Max. range (miles)</label></li>
						<li class="norule"><label style="width: 125px;">Throttle / Pedal Assist</label></li>
					</ul>
					
					<ul class="compare_label">
						
						<li><label>Suspension</label></li>
						<li><label>Brakes</label></li>
						<li><label>Gears</label></li>
						<li><label>Stem</label></li>
						<li><label>Saddle</label></li>
						<li><label>Wheel size (in)</label></li>
						<li><label>Tyres</label></li>
						<li><label>Controls</label></li>
						<li><label>Fork</label></li>
						<li><label>Handlebars</label></li>
						<li><label>Weight with battery (kg)</label></li>
						<li style="height: 40px;"><label>Warranty (frame and battery)</label></li>						
					</ul>

					
				</div>
				
<?php foreach($_POST as $k=>$v) { 
			
			$bike_id = explode('_', $k);
			$bike_args = array('p' => $bike_id[1],
								'post_type' => 'bike'
			
			);
			$bike = new WP_Query($bike_args);
			while( $bike->have_posts() ) : $bike->the_post();

		?>
				<div class="comparecol fl">
				
					<ul class="compare_list">
						<li><?php echo get_post_meta(get_the_id(), 'brand', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'model', true); ?></li>
						<li><?php if(get_post_meta(get_the_id(), 'rrp', true)) echo '&pound;'; echo get_post_meta(get_the_id(), 'rrp', true); ?></li>
					</ul>

					<ul class="compare_list">
						<li>
								<?php $uses = array();
									if(get_post_meta(get_the_id(), 'commuting_town', true)) { $uses[] = 'Commuting & Town'; }
									if(get_post_meta(get_the_id(), 'general_leisure', true)) { $uses[] = 'General leisure'; }
									if(get_post_meta(get_the_id(), 'trail_mountain', true)) { $uses[] = 'Trail & Mountain'; }
									if(get_post_meta(get_the_id(), 'touring', true)) { $uses[] = 'Touring'; }
									echo implode(', ', $uses);
								?>
						</li>
						<li><?php echo get_post_meta(get_the_id(), 'frame_type', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'frame_style', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'frame_material', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'palce_manufacture', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'motor_power', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'motor_position', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'battery_details', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'max_range', true); ?></li>
						<li class="norule"><?php echo get_post_meta(get_the_id(), 'throttle', true); ?>
						</li>
					</ul>
				
					<ul class="compare_list">
						
						<li><?php echo get_post_meta(get_the_id(), 'suspension', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'brakes', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'gears', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'stem', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'saddle', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'wheel_size', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'tyres', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'controls', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'fork', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'handlebars', true); ?></li>
						<li><?php echo get_post_meta(get_the_id(), 'weight', true); ?></li>
						<li style="height: 40px;"><?php echo get_post_meta(get_the_id(), 'warranty', true); ?></li>
						<?php if(get_post_meta(get_the_id(), 'discontinued', true)) { echo '<p style="margin-top: 10px;"><strong>This bike has been discontinued</strong></p>'; } ?>
						
					</ul>

					
				</div>
				
					<?php endwhile; } ?>
	
					
		</div>
		

	<div class="clear"></div>
	
	</div>
	
</div>



</div>