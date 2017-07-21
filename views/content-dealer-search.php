<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW2xwuvJW2pbA9NUo-qIk44m4NE-PKtHA&sensor=false"></script>
<script src="<?php bloginfo('template_url') ?>/js/infobox.js"></script>

<script type="text/javascript">
$(function() {
	$('#loading').hide();
	drawmap();
	run_search('showall');
	$('#run_search').click(function(){
		drawmap();
		run_search('postcode');
	});
	
	var pathArray = window.location.pathname.split( '/' );
	console.log(pathArray);
	if(pathArray[3] != '') {
	
		run_search('county',pathArray[3]);
		//alert(pathArray[3]);
	}
});

</script>

<?php if($_GET['clearpostcode']) { unset($_SESSION['user_postcode']); } ?>


<div class="wrapper dropshad" style="height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>


<div class="wrapper" style="min-height: 700px; margin-bottom: -30px;">

	<div class="wrapper" id="map_canvas" style="position: absolute; height: 100%;"></div>
	
	<div class="wrapper dropshad" style="display: block"></div>
	
	<div class="wrapper">
	
	
		<div class="stage purplegrad" id="dealersearch_postcode">
		
			<form id="postcode_search" action="" method="post">
			<input type="hidden" id="uniform" value="true" />
			<div class="fl section" style="width: 240px;">
				<h5 class="white">Location</h5>
					<div style="position: absolute; top: 30px; left: 4px;">
						<span class="white" style="padding: 0 4px;">Within</span>
						<select name="user_distance">
							<option value="9999" <?php echo ($_SESSION['user_distance'] == '9999' ? 'SELECTED' : ''); ?>>any miles</option>
							<option value="50" <?php echo ($_SESSION['user_distance'] == '50' ? 'SELECTED' : ''); ?>>50 miles</option>
							<option value="20" <?php echo ($_SESSION['user_distance'] == '20' ? 'SELECTED' : ''); ?>>20 miles</option>
							<option value="10" <?php echo ($_SESSION['user_distance'] == '10' ? 'SELECTED' : ''); ?>>10 miles</option>
							<option value="5" <?php echo ($_SESSION['user_distance'] == '5' ? 'SELECTED' : ''); ?>>5 miles</option>
						</select>
						<span class="white" style="padding: 0 4px;">of</span>
						<input type="text" name="user_postcode" id="user_postcode" style="width: 86px;" placeholder="Postcode" value="<?php session_start(); if($e = $_SESSION['user_postcode']) echo $e; ?>" />
					</div>
			</div>
			
			<div class="section fl" style="width: 130px;" id="dealer_type">
				<h5 class="white">Dealer type</h5>
				<div style="position: absolute !important; top: 30px; left: 14px;">
				<select name="dealer_type">
					<option value="any" <?php echo ($_SESSION['dealer_type'] == 'any' ? 'SELECTED' : ''); ?>>Any</option>
					<option value="retail" <?php echo ($_SESSION['dealer_type'] == 'retail' ? 'SELECTED' : ''); ?>>Store</option>
					<option value="online" <?php echo ($_SESSION['dealer_type'] == 'online' ? 'SELECTED' : ''); ?>>Online</option>
					<option value="both" <?php echo ($_SESSION['both'] == '20' ? 'SELECTED' : ''); ?>>Store and Online</option>
				</select>
				</div>
			</div>
			
			<div class="section fl" style="width: 120px;">
				<h5 class="white">Products</h5>
				<div class="palegrey stopprop dropdown" id="product_dropdown" style="padding: 6px; width: 238px; height: 200px; position: absolute; left: 12px; top: 52px; box-shadow: 0 2px 4px rgba(0,0,0,0.4); display: none;">
					<div class="fl" style="overflow-y: auto; overflow-x: hidden; width: 238px;">
							<input type="checkbox" class="product" name="bikes" value="Bikes" CHECKED> Bikes<br />
							<input type="checkbox" class="product" name="ckits" value="Conversion kits"> Conversion kits<br />
						</div>
				</div>
				<input type="text" class="droptext" id="products_stocked" name="products_stocked" for="product_dropdown" value="Bikes" style="width: 114px; position: absolute; right: 12px; bottom: 12px;" readonly />
			
			</div>
			
			<div class="section fl" style="width: 130px;">
				<h5 class="white">Brands</h5>
				<div class="palegrey stopprop dropdown" id="brand_dropdown" style="padding: 6px; width: 238px; height: 200px; position: absolute; left: 12px; top: 52px; box-shadow: 0 2px 4px rgba(0,0,0,0.4); display: none;">
					<div class="fl" style="overflow-y: auto; overflow-x: hidden; height: 200px; width: 238px;">
						<?php foreach(brands_array() as $brand) { ?>
							<input type="checkbox" class="brand" name="<?php echo $brand; ?>" value="<?php echo $brand; ?>"> <?php echo $brand; ?><br />
						<?php } ?>
						</div>
				</div>
				<input type="text" class="droptext" id="brands_stocked" name="brands_stocked" for="brand_dropdown" style="width: 124px; position: absolute; right: 12px; bottom: 12px;" readonly />
			
			</div>
			
			<div class="section fl" style="width: 130px;">
				<h5 class="white">Dealer name</h5>
				<input type="text" name="dealer_name" style="width: 124px; position: absolute; left: 12px; bottom: 12px;" placeholder="Enter part of dealer name" />
			
			</div>
				<input type="button" value="Search" id="run_search" class="greenbutton" style="height: 22px; width: 62px; position: absolute; right: 12px; bottom: 12px;"/>
			<div class="clear"></div>
			</form>
			
		</div>
			
				<div class="stage">
				<div id="loading" style="padding: 10px; width: 120px; position: absolute; bottom: -220px; left: 420px;" class="purplegrad">
					<h5 style="margin: 0px;">Loading...<img class="fr" src="<?php bloginfo('template_url'); ?>/img/ajax-loader.gif" /></h5>
				</div>
				</div>
		
	</div>

	<div class="wrapper" style="padding: 0 0 20px 0; margin: 40px 0 -32px;	pointer-events: none;">
		<div class="stage">
			<div id="dealer_listings_panel" class="palegrey fl">
				<div id="dealer_listings">
				
				</div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="clear"></div>

</div>

<script>
	$(function(){

		// show dropdown
		$('.droptext').focus(function(e){
			$('.dropdown').fadeOut(100);
		    e.stopPropagation();
		    var dropdown = $(this).attr('for');
		    $('#'+dropdown).show();
		})

		$('.droptext, .dropdown').click(function(e){
		    e.stopPropagation();
		})
		
		// add brands to search field
		$('input:checkbox').change(function(){
		    var type = $(this).attr('class');
			var check_string = '';
			$('#'+type+'_dropdown input').each(function(){
				if($(this).is(':checked')) {
					check_string += $(this).val() + ', ';
				}
			});
			check_string = check_string.substring(0, check_string.length - 2);
			$(this).closest('.section').find('.droptext').val(check_string);
		});

		// click off dropdown to hide
		$('html').click(function() {
			$('.dropdown').fadeOut(100);
		});

	});

</script>
