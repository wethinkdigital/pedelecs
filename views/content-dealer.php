<script>
	$(function(){
		$('ul.tabs li').click(function(){
			var show = $(this).attr('for');
			$('ul.tabs li').css('color','#995695');
			$(this).css('color','white');
			$('.admin_section').hide();
			$('#' + show).show();
			Cufon.refresh();
		});
		
		$('ul.brands li').click(function(){
			var show = $(this).attr('for');
			show = show.replace(' ','_');
			//$('ul.brands li').css('color','#995695');
			//$(this).css('color','white');
			$('ul.brands li').removeClass('active');
			$(this).addClass('active');
			$('.brand_panel').hide();
			$('#' + show).show();
			Cufon.refresh();
		})
	});
</script>


<input type="hidden" id="uniform" value="TRUE" />

<?php 


$bits = explode("/",$_SERVER['REQUEST_URI']);
$user = get_user_by( 'slug', $bits[2] );
$metadata = get_user_meta($user->ID);
global $roles; $roles = unserialize($metadata['wp_capabilities'][0]);
//print_r($roles);

parse_str($metadata['bike_stock'][0], $stocked_bikes);
parse_str($metadata['accessory_stock'][0], $stocked_accessories);

function show($el){
	global $roles;
	$standard_els = array('name','address','telephone','map');
	if(array_key_exists('dealer_premium', $roles) || in_array($el, $standard_els)) { return true; } 
}


?>
 
<script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW2xwuvJW2pbA9NUo-qIk44m4NE-PKtHA&sensor=false">
</script>

<script type="text/javascript">
	$(function() {
		
		var map;
		var dealer = new google.maps.LatLng(<?php echo $metadata['loc_lat'][0]; ?>,<?php echo $metadata['loc_lng'][0]; ?>);
		
		var pin = {
			url: 'http://www.pedelecs.co.uk/wp-content/themes/pedelecs/img/pin_small.png',
			size: new google.maps.Size(19, 24),
			origin: new google.maps.Point(0,0),
			anchor: new google.maps.Point(0, 24)
		};
		
		var shadow = {
			url: 'http://www.pedelecs.co.uk/wp-content/themes/pedelecs/img/pin_small_shadow.png',
			size: new google.maps.Size(25, 18),
			origin: new google.maps.Point(0,0),
			anchor: new google.maps.Point(-8, 18)
		};
		
		var mapOptions = {
		    scrollwheel: false,
		    zoom: 11,
		    center: dealer,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		
		marker = new google.maps.Marker({
		    map:map,
		    animation: google.maps.Animation.DROP,
		    position: dealer,
			icon: pin,
			shadow: shadow
		});
	
	});
</script>




 
<div class="wrapper" id="dealer_admin" style="margin: 30px 0;">
	
	<?php if(show('images') && get_user_meta($user->ID, 'image_id', true) != '') { ?>
	<div id="images">
	
		<div class="gallery">
			<div id="image">
				<?php include(TEMPLATEPATH.'/dealer/includes/dealer_read_dealerimage.php'); ?>
			</div>
		</div>
		
	</div>
	
	<?php } ?>
	
	<div class="stage purplegrad">
	
	<div class="stage" style="height: 60px; padding-bottom: 16px; ">
		<div class="darkpurplegrad fl" id="section_tabs" style="padding: 10px; ">
			<ul class="tabs">
				<li id="load_store_details" for="store_details" style="color: white;">Store Details</li>
				<?php if(show('bikes_stocked')) { ?>
				    <li id="load_bike_stock" for="bike_stock" style="color: #995695;">Bikes stocked</li>
				<?php } ?>
				<li id="load_accessories" for="accessories" style="color: #995695; display: none;">Accessories</li>
			</ul>
		</div>
		
	</div>
	
	<div class="clear"></div>

	<div id="store_details" class="admin_section">

	<div id="leftcol" class="fl" style="color: white; padding: 20px; width: 220px;">
	
		<!-- logo -->
		<?php if(show('logo') && get_user_meta($user->ID, 'logo_id', true) != '') { ?>
		<div id="dealer_logo">
			<?php echo wp_get_attachment_image( get_user_meta($user->ID, 'logo_id', true), 'dealerlogo'); ?>
		</div>
		<?php } ?>
			
		<div class="clear"></div>
	
		<!-- name and address -->				
		<h4 style="color: white;"><?php echo $metadata['nickname'][0]; ?></h4>
		<?php if(show('address')) { ?>
		<p>
		<?php if($metadata['address_1'][0] != '') echo $metadata['address_1'][0].'<br />'; ?>
		<?php if($metadata['address_2'][0] != '') echo $metadata['address_2'][0].'<br />'; ?>
		<?php if($metadata['town'][0] != '') echo $metadata['town'][0].'<br />'; ?>
		<?php if($metadata['county'][0] != '') echo $metadata['county'][0].'<br />'; ?>
		<?php if($metadata['postcode'][0] != '') echo $metadata['postcode'][0].'<br />'; ?>
		</p>
		<?php } ?>
			
			
		<!-- opening hours -->			
		<?php if(show('opening_hours') && $metadata['opening_hours'][0] != '') { ?>
			<p>Opening hours:<br /><?php echo $metadata['opening_hours'][0]; ?></p>
		<?php } ?>


		<!-- telephone -->			
		<?php if(show('telephone') && $metadata['telephone'][0] != '') { ?>
			<p><?php echo $metadata['telephone'][0]; ?></p>
		<?php } ?>
			
		
		<!-- website -->			
		<?php if(show('url') && $metadata['url'][0] != '') { ?>
			<p>
			<a href="http://<?php echo $metadata['url'][0]; ?>" style="color: white; font-size: 12px;" target="_blank" >
			<?php echo preg_replace("(https?://)", "", $metadata['url'][0]); ?>
			</a>
			</p>		
		<?php } ?>
		
		<?php if(show('email') && $metadata['email'][0] != '') { ?>
			<p><a href="mailto:<?php echo $metadata['email'][0]; ?>"><?php echo $metadata['email'][0]; ?></a></p>
		<?php } ?>
			
		<?php if(show('dealer_type') && $metadata['dealer_type'][0] != '') {
			echo '<p>Buy from us:<br />';
			switch ($metadata['dealer_type'][0]) {
				case 'retail': echo "In store"; break;
				case 'online': echo "Online"; break;
				case 'both': echo "In store and online"; break;
			}
		} ?>
			
	</div>
	
	<div id="rightcol" class="palegrey fr" style="padding: 20px; width: 660px; min-height: 500px !important;">
	
		<div class="fl" >
			<h1 class="purple"><?php echo $metadata['nickname'][0]; ?></h1>
	
			<?php if(show('summary') && $metadata['summary'][0] != '') { ?>
				<p><strong><?php echo $metadata['summary'][0]; ?></strong></p>
			<?php } ?>
	
			<?php if(show('description') && $metadata['description'][0] != '') { ?>
				<p><?php echo preg_replace("/[\r\n]+/", "<br />", $metadata['description'][0]); ?></p>
				
			<?php } ?>
			
			<div id="map_canvas" style="width: 650px; height: 300px; background-color: white; border: 1px solid #CCCCCC;"></div>
		</div>
		

	</div>
		
	</div>
		
	<div id="bike_stock" class="admin_section" style="display:none;">

	<div class="leftcol fl">
	
	            <pre><?php //print_r(dealer_stock_data($user->ID)); ?></pre>
				
				<input type="hidden" name="post_id" value="" />
				<ul class="brands">
				<?php foreach(dealer_stock_data($user->ID) as $brand=>$models) { echo '<li for="'.$brand.'">'.$brand.'</li>'; } ?>
				</ul>

			</div>
			
			<div class="rightcol fr palegrey">
				<div class="brand_panel" id="default">
				    <h2 class="purple">Bikes stocked</h2>
                    <?php foreach(dealer_stock_data($user->ID) as $brand=>$bikes) { ?>
					<ul class="brand_panel brand_panel_thumbs">
						<h4><?php echo $brand; ?></h4>
						
						<?php foreach($bikes as $id=>$details) { ?>
							<li class="fl"><?php //echo $id; ?>
								<a href="<?php echo get_permalink($id); ?>">
								<div class="imageholder" <?php if($details['image'] == '') echo 'style="background-image: url(../img/bike-ill-small.png);"'; ?>>
								<?php echo $details['image']; ?>
								</div>
								<label><?php echo $details['model']; ?></label>
								
								</a>
							</li>
						<?php } ?>
					
					</ul>
                    <div class="clear" style="margin-bottom: 30px;"></div>
				
				<?php } ?>
				</div>
                    <?php foreach(dealer_stock_data($user->ID) as $brand=>$bikes) { ?>
					<ul class="brand_panel brand_panel_thumbs" id="<?php echo preg_replace('/ /','_',$brand); ?>" style="display: none;">
						<h3><?php echo $brand; ?></h3>
						
						<?php foreach($bikes as $id=>$details) { ?>
							<li class="fl">
								<a href="/bikes/<?php echo preg_replace('/ /','-',$details['model']); ?>">
								<div class="imageholder">
								<?php echo $details['image']; ?>
								</div>
								<label><?php echo $details['model']; ?></label>
								
								</a>
							</li>
						<?php } ?>
					
					</ul>
				
				
				<?php } ?>

				<pre><?php //print_r(stock_data()); ?></pre>
			</div>		
	</div>
		
		
	
	<div class="clear"></div>
	
	</div><!-- close stage -->
</div><!-- close wrapper -->