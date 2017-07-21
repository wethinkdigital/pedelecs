<?php

// Pedelecs block view
// Section : Manufacturer Admin
// View : Conversion Kit specification form
// Location : /views/block-manu-admin-ckit.php

?>

<div id="leftcol" >
		
	<a class="viewlink" href="" target="_blank>"><div class="greenbutton" style="margin-bottom: 20px; padding: 6px;">View kit</div></a>
				
	<h4 style="color: white;">Create new conversion kit</h4>
	
	<form id="newckit" class="create" action="" method="post" style="margin-bottom: 20px;">
		<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>"/>
		<input type="hidden" name="brand" value="<?php echo $userdata->user_login; ?>" />
		<input type="hidden" name="prod_type" value="ckit" />
		<input type="text" name="model" placeholder="Kit name" style="width: 136px; height: 18px;" value=""/>
		<input type="submit" class="greybutton fr" value="Create" style="height: 24px;"/>
	</form>
	
	
	<h4 style="color: white;">Saved conversion kits</h4>
	
	<div id="ckitlist" style="margin-bottom: 20px;">
				<?php $_POST['prod_type'] = 'ckit'; include (TEMPLATEPATH . '/manufacturer/includes/manu_list_prods.php'); unset($_POST['prod_type']); ?>
				<div class="clear"></div>
	</div >
	
	   <h4 style="color: white;">Admin</h4>
		<a style="color: white;" href="/manufacturer-admin-support">Support</a><br />			
		<div class="clear"></div>

	
</div>
    		
<div id="rightcol" class="palegrey">
				
		<form id="ckitform" class="specform update" action="" method="post" style="">
		
			<input type="hidden" name="post_id" value="" />
			<input type="hidden" name="prod_type" value="ckit" />
			<div class="alert"></div>
		
			<h3 class="purple">Kit Description</h3>
		
			<textarea name="description"></textarea>


			<h3 class="purple">Components included</h3>
		
			<textarea name="components"></textarea>
		
			<h3 class="purple">Specification</h3>
			
				<div class="formcol">
				
					<ul class="speclist">
						<input type="hidden" name="brand" value="<?php echo $userdata->user_login; ?>" />
						<li><label>Model</label><input type="text" name="model" value="" /></li>
						<li><label>RRP (&pound;)</label><input type="text" name="rrp" value="" /></li>
						<li><label>Wheel size (in)</label><input type="text" name="wheel_size" value="" /></li>
						<li><label>Motor power (W)</label><input type="text" name="motor_power" value="" /></li>
						<li><label>Motor position</label>
							<select name="motor_position">
								<option value="">Select</option>
								<option value="Front hub">Front hub</option>
								<option value="Rear hub">Rear hub</option>
								<option value="Front or Rear hub">Front or Rear hub</option>
								<option value="Centre / Crank drive">Centre / Crank drive</option>
							</select>
						</li>
						<li><label>Motor manufacturer</label><input type="text" name="motor_manufacturer" value="" /></li>
						<li><label>Battery and charger</label><input type="text" name="battery_charger" value="" /></li>
						<li><label>Max. range (miles)</label><input type="text" name="max_range" value="" /></li>
					</ul>
					
				</div>
				
				<div class="formcol">
				
					<ul class="speclist">
					
						<li class="norule"><label>Throttle / Pedal Assist</label>
							<select name="throttle">
								<option value="">Select</option>
								<option value="Throttle only">Throttle only</option>
								<option value="Independent throttle plus pedal assist">Independent throttle plus pedal assist</option>
								<option value="Throttle to 4mph and when pedals are being turned plus pedal assist">Throttle to 4mph and when pedals are being turned plus pedal assist</option>
								<option value="Pedal assist only, no throttle">Pedal assist only, no throttle</option>
							</select>
						</li>

						
						<li><label>Controls and display</label><input type="text" name="controls" value="" /></li>
						<li><label>Brakes</label><input type="text" name="brakes" value="" /></li>
						<li><label>Weight with battery (kg)</label><input type="text" name="weight" value="" /></li>
						<li><label>Wiring harness</label><input type="text" name="wiring_harness" value="" /></li>
						<li><label>Warranty</label><input type="text" name="warranty" value="" /></li>
						<li><label>Installation</label>
							<select name="installation">
								<option value="">Select</option>
								<option value="DIY">DIY & Manuals</option>
								<option value="Fitter">Qualified Fitter</option>
							</select>
						</li>

					</ul>

					
				</div>
								
				<div class="clear"></div>
				
				<hr>
				<h3 class="purple">Certification</h3>
					<ul class="speclist" style="padding: 0 20px 0 0;">
					
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
								
				<div id="ckit_manuals_panel"></div>
				
				<div class="overlay">
					<div class="welcome palegrey">
						<div class="header purplegrad">
							<h2 style="font-size: 32px; color: white; margin: 0px;">Welcome <?php echo $current_user->user_login; ?></h2>
						</div>
						<img src="<?php bloginfo('template_url'); ?>/img/green-arrow-left.png" class="fl" style="margin: 0 10px 0 -10px;"/>
						<h4 class="grey">To get started, create a new product or edit one you've already created</h4>
					</div>
				
				</div>

			</div>

