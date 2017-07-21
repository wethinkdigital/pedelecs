<?php

    // dev site root is http://pedelecs.ideasbyeden.co.uk
    // live site root is http://www.pedelecs.co.uk
    
    define('WPSITEROOT', 'http://www.pedelecs.co.uk');
    define('WPTEMPPATH', 'http://www.pedelecs.co.uk/wp-content/themes/pedelecs');
?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo WPTEMPPATH; ?>/css/layout.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo WPTEMPPATH; ?>/css/colours.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo WPTEMPPATH; ?>/css/textstyles.css" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400' rel='stylesheet' type='text/css'>

<div class="wrapper purplegrad" style="margin-top: 30px; color: white;">
	<div class="stage" style="padding: 30px 0;">
		<div class="columns">
			<a href="<?php echo WPSITEROOT; ?>/electric-bike-guides/first-timers-guides/">
			<div class="qtrcol">
				<h4 class="white">First Electric Bike</h4>
				<img src="<?php echo WPTEMPPATH; ?>/img/which-electric-bike.jpg" style="width: 225px; height: 150px; background-color: white; margin-bottom: 6px;"/>
				<p class="white">Looking to buy your first bike? Our First Timers' section gives the lowdown on all you need to know.</p>
			</div>
			</a>

			<a href="<?php echo WPSITEROOT; ?>/buy/find-an-electric-bike">
			<div class="qtrcol">
				<h4 class="white">Find an Electric Bike</h4>
				<img src="<?php echo WPTEMPPATH; ?>/img/which-bike.jpg"  style="width: 225px; height: 150px; background-color: white; margin-bottom: 6px;"/>
				<p class="white">Use our electric bike search to find your ideal bike by price, specification and location.</p>
			</div>
			</a>

			<a href="<?php echo WPSITEROOT; ?>/buy/electric-bike-dealer-directory/">
			<div class="qtrcol">
				<h4 class="white">Find a dealer</h4>
				<img src="<?php echo WPTEMPPATH; ?>/img/electric-bike-dealers.jpg"  style="width: 225px; height: 150px; background-color: white; margin-bottom: 6px;"/>
				<p class="white">Search for UK electric bike shops and dealers by location and brands stocked.</p>
			</div>
			</a>

			<a href="<?php echo WPSITEROOT; ?>/forum">
			<div class="qtrcol">
				<h4 class="white">Join the community</h4>
				<img src="<?php echo WPTEMPPATH; ?>/img/electric-bike-community.jpg"  style="width: 225px; height: 150px; background-color: white; margin-bottom: 6px;"/>
				<p class="white">Join our vibrant community and get tips and help from experienced electric bike owners.</p>
			</div>
			</a>
			
		</div>
	</div>
	<div class="clear"></div>
</div>