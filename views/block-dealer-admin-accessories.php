<?php

// Pedelecs block view
// Section : Dealer Admin
// View : Accessories form
// Location : /views/block-dealer-admin-accessories.php

?>

	
	
<div class="leftcol fl">

</div>

<div class="rightcol fr palegrey">
	
	<h3>Accessories</h3>
		
	<div id="accessory-items">
	
		<form id="accessories_form">
	
		<?php foreach($stocked_accessories as $k=>$v) { ?>
		
			<div class="stock_item">
				<input type="text" name="<?php echo $k; ?>" placeholder="Accessory name" value="<?php echo $v; ?>"/>
				<div class="
				 purplegrad">
					<img src="<?php bloginfo('template_url'); ?>/img/image-delete.png" unselectable="on" />
				</div>
			</div>
			
		<?php } ?>
		
		</form>
		
	</div>
	
    <input type="button" name="add_accessory" id="add_accessory" value="Add" />

</div>

<div class="clear"></div>
