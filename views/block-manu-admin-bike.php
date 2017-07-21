<?php

// Pedelecs block view
// Section : Manufacturer Admin
// View : Bike specification form
// Location : /views/block-manu-admin-bike.php

?>

<div id="leftcol" >
		
	<a class="viewlink" href="" target="_blank>"><div class="greenbutton" style="margin-bottom: 20px; padding: 6px;">View bike</div></a>
				
	<h4 style="color: white;">Create new bike</h4>
	
	<form id="newbike" class="create" action="" method="post" style="margin-bottom: 20px;">
		<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>"/>
		<input type="hidden" class="brand" name="brand" value="<?php echo $userdata->user_login; ?>" />
		<input type="hidden" name="prod_type" value="bike" />
		<input type="text" name="model" placeholder="Model" style="width: 136px; height: 18px;" value=""/>
		<input type="submit" class="greybutton fr" value="Create" style="height: 24px;"/>
	</form>
	
	
	<h4 style="color: white;">Saved bikes</h4>
	
	<div id="bikelist" style="margin-bottom: 20px;">
				<?php $_POST['prod_type'] = 'bike'; include (TEMPLATEPATH . '/manufacturer/includes/manu_list_prods.php'); unset($_POST['prod_type']); ?>
				<div class="clear"></div>
	</div >
	
    <h4 style="color: white;">Admin</h4>
		<a style="color: white;" href="/manufacturer-admin-support">Support</a><br />			
		<div class="clear"></div>
			
			


	
</div>
    		
<div id="rightcol" class="palegrey">
		
<!-- //////////////////// form starts //////////////////// -->
		
		<form id="bikeform" class="specform update" action="" method="post" style="">
		
			<input type="hidden" name="post_id" value="" />
			<input type="hidden" name="prod_type" value="bike" />
			<div class="alert"></div>
		
			<h3 class="purple">Description</h3>
		
			<textarea name="description"></textarea>
		
			<h3 class="purple">Specification</h3>
			
				<div class="formcol">
				
					<ul class="speclist">
						<input type="hidden" class="brand" name="brand" value="<?php echo $userdata->user_login; ?>" /></li>
						<li><label>Model</label><input type="text" name="model" value="" /></li>
						<li><label>RRP (&pound;)</label><input type="text" name="rrp" value="" /></li>
					</ul>

					<ul class="speclist">
						<li style="height: 90px;"><label>Use</label>
						<div class="fr" style="width: 194px;">
						<input type="checkbox" name="commuting_town" value="TRUE">Commuting & Town<br />
						<input type="checkbox" name="general_leisure" value="TRUE">General leisure<br />
						<input type="checkbox" name="trail_mountain" value="TRUE">Trail & Mountain<br />
						<input type="checkbox" name="touring" value="TRUE">Touring
						</div>
						<div class="clear"></div>
						</li>

						<li><label>Frame Type</label>
						<select name="frame_type">
							<option value="">Select</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="Unisex">Unisex</option>
						</select>
						</li>

						<li><label>Frame Style</label>
						<select name="frame_style">
							<option value="">Select</option>
							<option value="Low step through">Low step through</option>
							<option value="High step through">High step through</option>
							<option value="With cross bar">With cross bar</option>
							<option value="Mountain bike">Mountain bike</option>
							<option value="Folding">Folding</option>
							<option value="Tricycle">Tricycle</option>
							<option value="Tandem">Tandem</option>
							<option value="Cargo">Cargo</option>
						</select>
						</li>

						<li><label>Frame material</label>
						<select name="frame_material">
							<option value="">Select</option>
							<option value="Aluminium">Aluminium</option>
							<option value="Steel">Steel</option>
							<option value="Carbon fibre">Carbon Fibre</option>
						</select>
						</li>


						<li><label>Place of manufacture</label>
						<select name="place_manufacture">
							<option value="">Select</option>
							<option value="Asia">Asia</option>
							<option value="Europe">Europe</option>
							<option value="US">United States</option>
						</select>
						</li>
						
						<li><label>Motor power (W)</label><input type="text" name="motor_power" value="" /></li>
						<li><label>Motor position</label>
							<select name="motor_position">
								<option value="">Select</option>
								<option value="Front hub">Front hub</option>
								<option value="Rear hub">Rear hub</option>
								<option value="Centre Crank drive">Centre / Crank drive</option>
							</select>
						</li>
						<li style="height: 52px;"><label>Motor description (Manufacturer & model no if applicable)</label><textarea name="motor_description" class="fr" style="width: 190px; height: 46px; resize: none"></textarea></li>
						<li><label>Battery details</label><input type="text" name="battery_details" value="" /></li>
						<li><label>Max. range (miles)</label><input type="text" name="max_range" value="" /></li>
						<li class="norule"><label>Throttle / Pedal Assist</label>
							<select name="throttle">
								<option value="">Select</option>
								<option value="Throttle only">Throttle only</option>
								<option value="Independent throttle plus pedal assist">Independent throttle plus pedal assist</option>
								<option value="Throttle to 4mph and when pedals are being turned plus pedal assist">Throttle to 4mph and when pedals are being turned plus pedal assist</option>
								<option value="Pedal assist only, no throttle">Pedal assist only, no throttle</option>
							</select>
						</li>
					
					</ul>
					
				</div>

				<div class="formcol">
				
					<ul class="speclist">
						
						<li><label>Suspension</label>
							<select name="suspension">
								<option value="">Select</option>
								<option value="None">None</option>
								<option value="Front">Front</option>
								<option value="Rear">Rear</option>
								<option value="Front & Rear">Front & Rear</option>
							</select>
						</li>
						<li><label>Brakes</label>
							<select name="brakes">
								<option value="">Select</option>
								<option value="Caliper">Caliper</option>
								<option value="V-type">V-type</option>
								<option value="Disc">Disc</option>
								<option value="Hydraulic disc">Hydraulic disc</option>
							</select>
						</li>
						<li><label>Gears</label><input type="text" name="gears" value="" /></li>
						<li><label>Stem</label><input type="text" name="stem" value="" /></li>
						<li><label>Saddle</label><input type="text" name="saddle" value="" /></li>
						<li><label>Wheel size (in)</label><input type="text" name="wheel_size" value="" /></li>
						<li><label>Tyres</label><input type="text" name="tyres" value="" /></li>
						<li><label>Controls</label><input type="text" name="controls" value="" /></li>
						<li><label>Fork</label><input type="text" name="fork" value="" /></li>
						<li><label>Handlebars</label><input type="text" name="handlebars" value="" /></li>
						<li><label>Weight with battery (kg)</label><input type="text" name="weight" value="" /></li>
						<li style="height: 40px;"><label>Warranty (frame and battery)</label><input type="text" name="warranty" value="" /></li>
						
						<li class="norule"><label>Discontinued</label><input type="checkbox" name="discontinued" value="TRUE"></li>

					</ul>

					
				</div>
								
				<div class="clear"></div>
				
				<hr>
				<h3 class="purple">Certification</h3>
					<ul class="speclist" style="padding: 0 20px 0 0;">
					<li style="height: 44px;"><label>Bike</label><input type="checkbox" name="cert" value="TRUE">
						<div class="fr" style="width: 525px;">
							Does this electric bike meet the following European standard: EN 15194 standard for 'Electronically Power Assisted Cycles' (EPAC)?
						</div>
					</li>
					<li class="norule"><label class="fl">Battery</label>
						<select name="battery_certification" id="battery_certification">
							<option value="lithium">Lithium battery conforms to UN standard 38.3</option>
							<option value="non-lithium">Non-lithium - UN38.3 not applicable</option>
						</select>
					</li>
					</ul>

				<div class="clear"></div>
				
				<hr>
				<h3 class="purple">Options</h3>
				
				<label style="width: 200px;">Service & Repair Options</label>
				<textarea name="service_repair"></textarea>
				
				<hr>
				
				<label>Optional extras</label>
				<textarea name="optional_extras"></textarea>
				
				<input type="button" id="" class="update_prod greybutton" value="Save" />

				</form>
				
<!-- ///////////////////// form ends ////////////////////// -->
				
				<div class="clear"></div>

				<hr>
				
				
				<h3 class="purple">Attach manuals</h3>
								
				<div id="bike_manuals_panel"></div>
				
				<div class="overlay">
					<div class="welcome palegrey">
						<div class="header purplegrad">
							<h2 style="font-size: 32px; color: white; margin: 0px;">Welcome <?php echo $current_user->user_login; ?></h2>
						</div>
						<img src="<?php bloginfo('template_url'); ?>/img/green-arrow-left.png" class="fl" style="margin: 0 10px 0 -10px;"/>
						<h4 class="grey">To get started, create a new bike or edit one you've already created</h4>
					</div>
				
				</div>

			</div>
