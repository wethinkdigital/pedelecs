<?php

// Pedelecs block view
// Section : Dealer Admin
// View : Bikes stocked form
// Location : /views/block-dealer-admin-bikes.php

?>

<?php $stocked_bikes = unserialize($formdata['bike_stock'][0]); ?>
	
<form id="bike_stock_form" action="" method="post" style="">

	<div class="leftcol fl">
		<?php $all_bikes = all_prods('bike'); ?>
		<pre><?php //print_r($all_bikes); ?></pre>
		<input type="hidden" name="post_id" value="" />
		<ul class="brands">
		<?php foreach($all_bikes as $brand=>$models) { if(!empty($models)) { echo '<li for="'.$brand.'">'.$brand.'</li>'; }} ?>
		</ul>	
	</div>
	
	<div class="rightcol fr palegrey">
		<div class="brand_panel" id="default">
			<h5>Select a brand on the left to choose which bikes you stock</h5>
		</div>
		<?php foreach($all_bikes as $brand=>$models) { if(!empty($models)) {?>
			<ul class="brand_panel brand_panel_<?php echo preg_replace('/ /','_',$brand); ?>" style="display: none;">
				<h3><?php echo $brand; ?></h3>
				<label class="column_header" style="width: 180px;">Model</label><label class="column_header" style="width: 370px;">Your retail URL</label><label class="column_header">Your price</label>
				<?php foreach($models as $id=>$model) { ?>
					<li>
						<input type="checkbox" name="<?php echo 'bike_stock[bike_'.$id.'][stocked]'; ?>" value="true" <?php if($stocked_bikes['bike_'.$id]['stocked']) echo 'CHECKED'; ?>/>
						<label><?php echo $model; ?></label>
						<input type="text" class="retailer_url" placeholder="Your retail URL" name="<?php echo 'bike_stock[bike_'.$id.'][retailer_url]'; ?>" value="<?php if($stocked_bikes['bike_'.$id]['retailer_url']) echo $stocked_bikes['bike_'.$id]['retailer_url']; ?>" />
						<input type="text" class="retailer_price" placeholder="Your price" name="<?php echo 'bike_stock[bike_'.$id.'][retailer_price]'; ?>" value="<?php if($stocked_bikes['bike_'.$id]['retailer_price']) echo '&pound;'.round(floatval(ereg_replace("[^-0-9\.]","",$stocked_bikes['bike_'.$id]['retailer_price'])), 2); ?>" />
					</li>
				<?php } ?>
			
			</ul>
		
		
		<?php }} ?>

		<pre><?php //print_r(stock_data()); ?></pre>
	</div>
	
</form>

<div class="clear"></div>
		
