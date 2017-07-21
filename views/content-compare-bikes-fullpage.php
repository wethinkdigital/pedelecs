<div class="wrapper dropshad" style="margin-bottom: 10px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>

<div class="wrapper purplegrad dropshad">
	<div class="stage purplegrad">
		<?php foreach($_POST as $k=>$v) { ?>
			<label class="compare_tab" id="<?php echo $k; ?>"><?php echo $v; ?></label>
		<?php } ?>
	</div>
</div>

<div class="wrapper" id="bikespec">


	
		<?php foreach($_POST as $k=>$v) { 
			
			$bike_id = explode('_', $k);
			$bike_args = array('p' => $bike_id[1],
								'post_type' => 'bike'
			
			);
			$bike = new WP_Query($bike_args);
			while( $bike->have_posts() ) : $bike->the_post();

		?>
		
		
		
<div class="compare_sheet" id="compare_sheet_<?php echo get_the_id(); ?>">

		<div id="bikeheader">
			<h1 style="margin: 0px;"><?php echo get_post_meta(get_the_id(), 'brand', true); echo ' '; the_title(); ?></h1>
		</div>

	
		<div id="images" style="height: 450px;">
		
			<div class="gallery">
				<?php
				$attach_args = array(
				'post_type' => 'attachment',
				'post_mime_type' => array('image','video'),
				'posts_per_page' => -1,
				'post_status' => null,
				'post_parent' => get_the_id(),
				'orderby' => 'menu_order',
				'order' => 'ASC'
				);
				
				$attachments = get_posts($attach_args);
									
					if(count($attachments) > 0){
				
						echo '<div class="mainimage">';
			foreach ($attachments as $attachment) {
				
				echo '<div class="imageholder" id="'.$attachment->ID.'">'; echo wp_get_attachment_image( $attachment->ID, 'bikemain', $mainatts ); echo '</div>';
			}
		echo '</div>';
					}
					
					echo '<div class="thumbnails" style="background: none;">';
				
					foreach ($attachments as $attachment) {
					
						echo '<div class="thumb"  style="margin: -70px 10px 0 0;" id="image_'.$attachment->ID.'" attachment_id="'.$attachment->ID.'" post_id="'.$_POST['post_id'].'">'; 
						echo wp_get_attachment_image( $attachment->ID, 'bikethumb' );
						echo '</div>';
					 }
					 
					 echo '</div>'; // end .thumbnails
				
				 ?>
				
			</div>

		</div>
		
	<div class="stage purplegrad" style="margin-bottom: 30px;">

		<div id="speclist">

			<div id="leftcol" class="palegrey">
		
				
			<h3>Description</h3>
		
			<p><?php echo get_post_meta(get_the_id(), 'description', true); ?></p>
		
			<h3>Specification</h3>
			
				<div class="formcol">
				
					<ul class="speclist">
						<li><label>Brand</label><?php echo get_post_meta(get_the_id(), 'brand', true); ?></li>
						<li><label>Model</label><?php echo get_post_meta(get_the_id(), 'model', true); ?></li>
						<li><label>RRP</label><?php if(get_post_meta(get_the_id(), 'rrp', true)) echo '&pound;'; echo get_post_meta(get_the_id(), 'rrp', true); ?></li>
					</ul>

					<ul class="speclist">
						<li><label style="width: 100px;">Use</label>
							<div class="fr" style="width: 170px;">
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
						<li><label>Frame Type</label><?php echo get_post_meta(get_the_id(), 'frame_type', true); ?></li>
						<li><label>Frame Style</label><?php echo get_post_meta(get_the_id(), 'frame_style', true); ?></li>
						<li><label>Frame material</label><?php echo get_post_meta(get_the_id(), 'frame_material', true); ?></li>
						<li><label>Place of manufacture</label><?php echo get_post_meta(get_the_id(), 'palce_manufacture', true); ?></li>
						<li><label>Motor power (W)</label><?php echo get_post_meta(get_the_id(), 'motor_power', true); ?></li>
						<li><label>Motor position</label><?php echo get_post_meta(get_the_id(), 'motor_position', true); ?></li>
						<li><label>Battery details</label><?php echo get_post_meta(get_the_id(), 'battery_details', true); ?></li>
						<li><label>Max. range (miles)</label><?php echo get_post_meta(get_the_id(), 'max_range', true); ?></li>
						<li class="norule"><label style="width: 125px;">Throttle / Pedal Assist</label>
							<div class="fr" style="width: 170px;">
								<?php echo get_post_meta(get_the_id(), 'throttle', true); ?>
							</div>
						</li>
					</ul>
					
				</div>

				<div class="formcol" style="margin: 0px;">
				
					<ul class="speclist">
						
						<li><label>Suspension</label><?php echo get_post_meta(get_the_id(), 'suspension', true); ?></li>
						<li><label>Brakes</label><?php echo get_post_meta(get_the_id(), 'brakes', true); ?></li>
						<li><label>Gears</label><?php echo get_post_meta(get_the_id(), 'gears', true); ?></li>
						<li><label>Stem</label><?php echo get_post_meta(get_the_id(), 'stem', true); ?></li>
						<li><label>Saddle</label><?php echo get_post_meta(get_the_id(), 'saddle', true); ?></li>
						<li><label>Wheel size (in)</label><?php echo get_post_meta(get_the_id(), 'wheel_size', true); ?></li>
						<li><label>Tyres</label><?php echo get_post_meta(get_the_id(), 'tyres', true); ?></li>
						<li><label>Controls</label><?php echo get_post_meta(get_the_id(), 'controls', true); ?></li>
						<li><label>Fork</label><?php echo get_post_meta(get_the_id(), 'fork', true); ?></li>
						<li><label>Handlebars</label><?php echo get_post_meta(get_the_id(), 'handlebars', true); ?></li>
						<li><label>Weight with battery (kg)</label><?php echo get_post_meta(get_the_id(), 'weight', true); ?></li>
						<li style="height: 40px;"><label>Warranty (frame and battery)</label><?php echo get_post_meta(get_the_id(), 'warranty', true); ?></li>
						<?php if(get_post_meta(get_the_id(), 'discontinued', true)) { echo '<p style="margin-top: 10px;"><strong>This bike has been discontinued</strong></p>'; } ?>
						
					</ul>

					
				</div>
				
								<div class="clear"></div>

				
				<?php if(get_post_meta(get_the_id(), 'cert', true)) { ?>
				<p style="margin-top: 20px;">The manufacturer states this bike adheres to the following European standard: EN 15194 standard for 'Electronically Power Assisted Cycles' (EPAC)</p>
				<?php } ?>
				
				
				<hr>
				
				<label style="width: 200px">Service & Repair options</label>
				<p><?php echo get_post_meta(get_the_id(), 'service_repair', true); ?></p>

				<hr>
				
				<label>Optional extras</label>
				<p><?php echo get_post_meta(get_the_id(), 'optional_extras', true); ?></p>
				
				<hr>
				<h3>Manuals</h3>
				
				<?php $args = array(
					'post_type' => 'attachment',
					'numberposts' => null,
					'post_status' => null,
					'post_parent' => $_POST['post_id'],
					'post_mime_type' => array('application/pdf'),
				);
				
				$attachments = get_posts($args);
				
				foreach($attachments as $attachment) { ?>
					<div class="pdf_panel fl" style="width: 180px;" attachment_id="<?php echo $attachment->ID; ?>" post_id="<?php echo $_POST['post_id']; ?>">
						<a href="<?php echo $attachment->guid; ?>" target="_blank">
							<img src="<?php bloginfo('template_url'); ?>/img/pdf-icon.png" /><br />
							<?php echo $attachment->post_title; ?>
						</a>
					</div>
				<?php } ?>
				
			</div>
		
			<div id="rightcol" >
							
				<h3 style="color: white;">Your closest stockists</h3>
				<?php //stockists(get_the_id()); ?>
	
				<h3 style="color: white;">Buy online now</h3>
				<?php //buy_online(get_the_id()); ?>
				
			</div>
	
		</div>
		

	<div class="clear"></div>
	
	</div>
	
</div>


		<?php endwhile; } ?>

</div>