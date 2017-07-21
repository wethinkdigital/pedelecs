<?php

// Pedelecs block view
// Section : Dealer Admin
// View : Store details form
// Location : /views/block-dealer-admin-store.php

?>

	
	
<div class="leftcol fl">

		<div id="dealer_logo" style="margin-top: -10px;">
			<?php include(TEMPLATEPATH.'/dealer/includes/dealer_read_dealerlogo.php'); ?>
		</div>
			
			<form id="uploadlogo" name="" action="<?php bloginfo('template_url'); ?>/dealer/functions/dealer_upload_logo.php" method="post" enctype="multipart/form-data" target="dealerLogoframe" style="position: relative;">
				<label style="color: white;">Upload a logo:</label>
				<input type="file" class="file" id="dealerLogo" name="dealerLogo" style="color: white;"/>
				<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>" />
				<iframe class="formtarget" name="dealerLogoframe" id="dealerLogoframe"></iframe>
				<div id="loading" style="position: absolute; width: 200px; bottom: 16px; left: 0px; padding: 8px 0; background-color: #5F3267; display: none;" >
					<h5 style="margin: 0px; color: white">Loading...<img class="fr" style="margin: 0 70px 0 0;" src="<?php bloginfo('template_url'); ?>/img/ajax-loader.gif" /></h5>
				</div>
			</form>
			
		<div class="clear"></div>
	
				
		<form id="contact_details" action="" method="post" style="margin-bottom: 20px;">
			<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>" />
			<textarea id="dealer_name" name="dealer_name" placeholder="Dealer name"><?php echo $formdata['nickname'][0]; ?></textarea>
			<input type="text" id="address_1" name="address_1" placeholder="Address 1" value="<?php echo $formdata['address_1'][0]; ?>"/>
			<input type="text" id="address_2" name="address_2" placeholder="Address 2" value="<?php echo $formdata['address_2'][0]; ?>"/>
			<input type="text" id="town" name="town" placeholder="Town / City" value="<?php echo $formdata['town'][0]; ?>"/>
			
			<select id="county" name="county">
				<optgroup label="England">
					<option value="Bedfordshire" <?php if($formdata['county'][0] == 'Bedfordshire') { echo 'SELECTED'; } ?>>Bedfordshire</option>
					<option value="Berkshire" <?php if($formdata['county'][0] == 'Berkshire') { echo 'SELECTED'; } ?>>Berkshire</option>
					<option value="Bristol" <?php if($formdata['county'][0] == 'Bristol') { echo 'SELECTED'; } ?>>Bristol</option>
					<option value="Buckinghamshire" <?php if($formdata['county'][0] == 'Buckinghamshire') { echo 'SELECTED'; } ?>>Buckinghamshire</option>
					<option value="Cambridgeshire" <?php if($formdata['county'][0] == 'Cambridgeshire') { echo 'SELECTED'; } ?>>Cambridgeshire</option>
					<option value="Cheshire" <?php if($formdata['county'][0] == 'Cheshire') { echo 'SELECTED'; } ?>>Cheshire</option>
					<option value="City of London" <?php if($formdata['county'][0] == 'City of London') { echo 'SELECTED'; } ?>>City of London</option>
					<option value="Cornwall" <?php if($formdata['county'][0] == 'Cornwall') { echo 'SELECTED'; } ?>>Cornwall</option>
					<option value="County Durham" <?php if($formdata['county'][0] == 'County Durham') { echo 'SELECTED'; } ?>>County Durham</option>
					<option value="Cumbria" <?php if($formdata['county'][0] == 'Cumbria') { echo 'SELECTED'; } ?>>Cumbria</option>
					<option value="Derbyshire" <?php if($formdata['county'][0] == 'Derbyshire') { echo 'SELECTED'; } ?>>Derbyshire</option>
					<option value="Devon" <?php if($formdata['county'][0] == 'Devon') { echo 'SELECTED'; } ?>>Devon</option>
					<option value="Dorset" <?php if($formdata['county'][0] == 'Dorset') { echo 'SELECTED'; } ?>>Dorset</option>
					<option value="East Riding of Yorkshire" <?php if($formdata['county'][0] == 'East Riding of Yorkshire') { echo 'SELECTED'; } ?>>East Riding of Yorkshire</option>
					<option value="East Sussex" <?php if($formdata['county'][0] == 'East Sussex') { echo 'SELECTED'; } ?>>East Sussex</option>
					<option value="Essex" <?php if($formdata['county'][0] == 'Essex') { echo 'SELECTED'; } ?>>Essex</option>
					<option value="Gloucestershire" <?php if($formdata['county'][0] == 'Gloucestershire') { echo 'SELECTED'; } ?>>Gloucestershire</option>
					<option value="Greater London" <?php if($formdata['county'][0] == 'Greater London') { echo 'SELECTED'; } ?>>Greater London</option>
					<option value="Greater Manchester" <?php if($formdata['county'][0] == 'Greater Manchester') { echo 'SELECTED'; } ?>>Greater Manchester</option>
					<option value="Hampshire" <?php if($formdata['county'][0] == 'Hampshire') { echo 'SELECTED'; } ?>>Hampshire</option>
					<option value="Herefordshire" <?php if($formdata['county'][0] == 'Herefordshire') { echo 'SELECTED'; } ?>>Herefordshire</option>
					<option value="Hertfordshire" <?php if($formdata['county'][0] == 'Hertfordshire') { echo 'SELECTED'; } ?>>Hertfordshire</option>
					<option value="Isle of Wight" <?php if($formdata['county'][0] == 'Isle of Wight') { echo 'SELECTED'; } ?>>Isle of Wight</option>
					<option value="Kent" <?php if($formdata['county'][0] == 'Kent') { echo 'SELECTED'; } ?>>Kent</option>
					<option value="Lancashire" <?php if($formdata['county'][0] == 'Lancashire') { echo 'SELECTED'; } ?>>Lancashire</option>
					<option value="Leicestershire" <?php if($formdata['county'][0] == 'Leicestershire') { echo 'SELECTED'; } ?>>Leicestershire</option>
					<option value="Lincolnshire" <?php if($formdata['county'][0] == 'Lincolnshire') { echo 'SELECTED'; } ?>>Lincolnshire</option>
					<option value="Merseyside" <?php if($formdata['county'][0] == 'Merseyside') { echo 'SELECTED'; } ?>>Merseyside</option>
					<option value="Norfolk" <?php if($formdata['county'][0] == 'Norfolk') { echo 'SELECTED'; } ?>>Norfolk</option>
					<option value="Northamptonshire" <?php if($formdata['county'][0] == 'Northamptonshire') { echo 'SELECTED'; } ?>>Northamptonshire</option>
					<option value="Northumberland" <?php if($formdata['county'][0] == 'Northumberland') { echo 'SELECTED'; } ?>>Northumberland</option>
					<option value="North Yorkshire" <?php if($formdata['county'][0] == 'North Yorkshire') { echo 'SELECTED'; } ?>>North Yorkshire</option>
					<option value="Nottinghamshire" <?php if($formdata['county'][0] == 'Nottinghamshire') { echo 'SELECTED'; } ?>>Nottinghamshire</option>
					<option value="Oxfordshire" <?php if($formdata['county'][0] == 'Oxfordshire') { echo 'SELECTED'; } ?>>Oxfordshire</option>
					<option value="Rutland" <?php if($formdata['county'][0] == 'Rutland') { echo 'SELECTED'; } ?>>Rutland</option>
					<option value="Shropshire" <?php if($formdata['county'][0] == 'Shropshire') { echo 'SELECTED'; } ?>>Shropshire</option>
					<option value="Somerset" <?php if($formdata['county'][0] == 'Somerset') { echo 'SELECTED'; } ?>>Somerset</option>
					<option value="South Yorkshire" <?php if($formdata['county'][0] == 'South Yorkshire') { echo 'SELECTED'; } ?>>South Yorkshire</option>
					<option value="Staffordshire" <?php if($formdata['county'][0] == 'Staffordshire') { echo 'SELECTED'; } ?>>Staffordshire</option>
					<option value="Suffolk" <?php if($formdata['county'][0] == 'Suffolk') { echo 'SELECTED'; } ?>>Suffolk</option>
					<option value="Surrey" <?php if($formdata['county'][0] == 'Surrey') { echo 'SELECTED'; } ?>>Surrey</option>
					<option value="Tyne and Wear" <?php if($formdata['county'][0] == 'Tyne and Wear') { echo 'SELECTED'; } ?>>Tyne and Wear</option>
					<option value="Warwickshire" <?php if($formdata['county'][0] == 'Warwickshire') { echo 'SELECTED'; } ?>>Warwickshire</option>
					<option value="West Midlands" <?php if($formdata['county'][0] == 'West Midlands') { echo 'SELECTED'; } ?>>West Midlands</option>
					<option value="West Sussex" <?php if($formdata['county'][0] == 'West Sussex') { echo 'SELECTED'; } ?>>West Sussex</option>
					<option value="West Yorkshire" <?php if($formdata['county'][0] == 'West Yorkshire') { echo 'SELECTED'; } ?>>West Yorkshire</option>
					<option value="Wiltshire" <?php if($formdata['county'][0] == 'Wiltshire') { echo 'SELECTED'; } ?>>Wiltshire</option>
					<option value="Worcestershire" <?php if($formdata['county'][0] == 'Worcestershire') { echo 'SELECTED'; } ?>>Worcestershire</option>
					<option value="Northern Ireland" <?php if($formdata['county'][0] == 'Northern Ireland') { echo 'SELECTED'; } ?>>Northern Ireland</option>
					<option value="Guernsey" <?php if($formdata['county'][0] == 'Guernsey') { echo 'SELECTED'; } ?>>Guernsey</option>
				</optgroup>
				<optgroup label="Ireland">
					<option value="Carlow" <?php if($formdata['county'][0] == 'Carlow') { echo 'SELECTED'; } ?>>Carlow</option>
					<option value="Cavan" <?php if($formdata['county'][0] == 'Cavan') { echo 'SELECTED'; } ?>>Cavan</option>
					<option value="Clare" <?php if($formdata['county'][0] == 'Clare') { echo 'SELECTED'; } ?>>Clare</option>
					<option value="Cork" <?php if($formdata['county'][0] == 'Cork') { echo 'SELECTED'; } ?>>Cork</option>
					<option value="Donegal" <?php if($formdata['county'][0] == 'Donegal') { echo 'SELECTED'; } ?>>Donegal</option>
					<option value="Dublin" <?php if($formdata['county'][0] == 'Dublin') { echo 'SELECTED'; } ?>>Dublin</option>
					<option value="Galway" <?php if($formdata['county'][0] == 'Galway') { echo 'SELECTED'; } ?>>Galway</option>
					<option value="Kerry" <?php if($formdata['county'][0] == 'Kerry') { echo 'SELECTED'; } ?>>Kerry</option>
					<option value="Kildare" <?php if($formdata['county'][0] == 'Kildare') { echo 'SELECTED'; } ?>>Kildare</option>
					<option value="Kilkenny" <?php if($formdata['county'][0] == 'Kilkenny') { echo 'SELECTED'; } ?>>Kilkenny</option>
					<option value="Laoighis" <?php if($formdata['county'][0] == 'Laoighis') { echo 'SELECTED'; } ?>>Laoighis</option>
					<option value="Leitrim" <?php if($formdata['county'][0] == 'Leitrim') { echo 'SELECTED'; } ?>>Leitrim</option>
					<option value="Limerick" <?php if($formdata['county'][0] == 'Limerick') { echo 'SELECTED'; } ?>>Limerick</option>
					<option value="Longford" <?php if($formdata['county'][0] == 'Longford') { echo 'SELECTED'; } ?>>Longford</option>
					<option value="Louth" <?php if($formdata['county'][0] == 'Louth') { echo 'SELECTED'; } ?>>Louth</option>
					<option value="Mayo" <?php if($formdata['county'][0] == 'Mayo') { echo 'SELECTED'; } ?>>Mayo</option>
					<option value="Meath" <?php if($formdata['county'][0] == 'Meath') { echo 'SELECTED'; } ?>>Meath</option>
					<option value="Monaghan" <?php if($formdata['county'][0] == 'Monaghan') { echo 'SELECTED'; } ?>>Monaghan</option>
					<option value="Offaly" <?php if($formdata['county'][0] == 'Offaly') { echo 'SELECTED'; } ?>>Offaly</option>
					<option value="Roscommon" <?php if($formdata['county'][0] == 'Roscommon') { echo 'SELECTED'; } ?>>Roscommon</option>
					<option value="Sligo" <?php if($formdata['county'][0] == 'Sligo') { echo 'SELECTED'; } ?>>Sligo</option>
					<option value="Tipperary" <?php if($formdata['county'][0] == 'Tipperary') { echo 'SELECTED'; } ?>>Tipperary</option>
					<option value="Waterford" <?php if($formdata['county'][0] == 'Waterford') { echo 'SELECTED'; } ?>>Waterford</option>
					<option value="Westmeath" <?php if($formdata['county'][0] == 'Westmeath') { echo 'SELECTED'; } ?>>Westmeath</option>
					<option value="Wexford" <?php if($formdata['county'][0] == 'Wexford') { echo 'SELECTED'; } ?>>Wexford</option>
					<option value="Wicklow" <?php if($formdata['county'][0] == 'Wicklow') { echo 'SELECTED'; } ?>>Wicklow</option>
				</optgroup>
				<optgroup label="Scotland">
					<option value="Glasgow" <?php if($formdata['county'][0] == 'Glasgow') { echo 'SELECTED'; } ?>>Glasgow</option>
					<option value="Highlands and Islands" <?php if($formdata['county'][0] == 'Highlands and Islands') { echo 'SELECTED'; } ?>>Highlands and Islands</option>
					<option value="North East Scotland" <?php if($formdata['county'][0] == 'North East Scotland') { echo 'SELECTED'; } ?>>North East Scotland</option>
					<option value="Mid Scotland and Fife" <?php if($formdata['county'][0] == 'Mid Scotland and Fife') { echo 'SELECTED'; } ?>>Mid Scotland and Fife</option>
<option value="South Scotland" <?php if($formdata['county'][0] == 'South Scotland') { echo 'SELECTED'; } ?>>South Scotland</option>
<option value="Lothian" <?php if($formdata['county'][0] == 'Lothian') { echo 'SELECTED'; } ?>>Lothian</option>
<option value="West Scotland" <?php if($formdata['county'][0] == 'West Scotland') { echo 'SELECTED'; } ?>>West Scotland</option>
					
				</optgroup>
				<optgroup label="Wales">
					<option value="North Wales" <?php if($formdata['county'][0] == 'North Wales') { echo 'SELECTED'; } ?>>North Wales</option>
					<option value="Mid and West Wales" <?php if($formdata['county'][0] == 'Mid and West Wales') { echo 'SELECTED'; } ?>>Mid and West Wales</option>
					<option value="West South Wales" <?php if($formdata['county'][0] == 'West South Wales') { echo 'SELECTED'; } ?>>West South Wales</option>
					<option value="Central South Wales" <?php if($formdata['county'][0] == 'Central South Wales') { echo 'SELECTED'; } ?>>Central South Wales</option>
					<option value="East South Wales" <?php if($formdata['county'][0] == 'East South Wales') { echo 'SELECTED'; } ?>>East South Wales</option>
				
				</optgroup>
			</select>				
			
			<input type="text" name="postcode" placeholder="Postcode" value="<?php echo $formdata['postcode'][0]; ?>"/ style="margin-bottom: 20px;">
			<textarea name="opening_hours" style="margin-bottom: 20px;" placeholder="Opening hours"><?php echo $formdata['opening_hours'][0]; ?></textarea>
			<input type="text" name="tel" placeholder="Telephone" value="<?php echo $formdata['telephone'][0]; ?>"/>
			<input type="text" name="web" placeholder="Website address" value="<?php echo $formdata['url'][0]; ?>"/>
			<input type="text" name="email" placeholder="Email address" value="<?php echo $formdata['email'][0]; ?>"/>
			<select name="dealer_type" id="dealer_type">
				<option value="">Kind of dealer</option>
				<option value="retail" <?php if($formdata['dealer_type'][0] == 'retail') { echo 'SELECTED'; } ?>>Retailer</option>
				<option value="online" <?php if($formdata['dealer_type'][0] == 'online') { echo 'SELECTED'; } ?>>Online only</option>
				<option value="both" <?php if($formdata['dealer_type'][0] == 'both') { echo 'SELECTED'; } ?>>Retail and online</option>
			</select>
		</form>
		
		
			

</div>


<div class="rightcol palegrey fr">
		
	<h3>Description</h3>

	<form id="dealer_content" method="post" action="">
		<textarea name="summary" placeholder="Your introduction summary"><?php echo $formdata['summary'][0]; ?></textarea>
		<textarea name="description" placeholder="Your description"><?php echo $formdata['description'][0]; ?></textarea>
	</form>
	
</div>

<div class="clear"></div>
