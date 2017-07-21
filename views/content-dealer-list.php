<?php $bits = explode("/",$_SERVER['REQUEST_URI']); ?>


<div class="wrapper dropshad" style="margin-bottom: 20px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>

<div class="wrapper" id="dealer_list">
	<div class="stage">
		<?php front_dealer_list($bits[2]); ?>	
	</div>
</div>