<script>
	$(function(){
		$('body').on('change', '#sorting_select', function () {
			var sort = $(this).val();
			//alert(sort);
			$('#sorting').val(sort);
			$('#ckitsearch').submit();
		});
	});
</script>

<input type="hidden" id="uniform" value="TRUE" />

<div class="wrapper dropshad" id="adpanel" style="margin-bottom: 10px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>


<div class="wrapper" style="margin-top: 20px;">
	<div class="stage">
		
		<div class="intro fl">
		<h1 class="purple"><?php the_title(); ?></h1>
		<?php the_content(); ?>

		<?php if(isset($_POST['search_query'])) { 
			parse_str($_POST['search_query'],$post_array); 
				foreach($post_array as $k=>$v) { 
					if($v != ''){ ?>
					<script>
						$(function(){
							var select = $('select[name="<?php echo $k; ?>"]');
							select.val('<?php echo $v; ?>')
							$.uniform.update();
						});
					</script>
				 <?php }
				 }
		} ?>

		<script>
			$('select').each(function(){
				if($(this).val != '') {
					$(this).parent('.selector').addClass('selected');
				}
			});
		</script>
		
		</div>
		
		<div id="shortlist" class="palegrey fr">
			<form id="compare_ckits" name="compare_ckits" action="/compare-conversion-kits" method="post">
				<h3 class="purple" style="margin-bottom: 0px;">Shortlist</h3>
				<p>Maximum 4 kits</p>
				<div class="prods">
				</div>
				<input type="submit" id="compare_submit" class="greenbutton compare_shortlist" value="Compare shortlist" style="display: none;"/>
			</form>
			<p class="clear_shortlist purple" style="display: none; margin-top: 8px;">Clear shortlist</p>
		</div>
	</div>
</div>

<div class="wrapper" id="whichckit" style="margin-bottom: 20px;">
	<div class="stage purplegrad">
	
		<div id="leftcol" class="fl">
		
			<h3 class="white">Brand</h3>
			
			<form action="" method="post" id="ckitsearch">
			
			<div id="brands_dropdown">
			<?php foreach(brands_array('ckit') as $brand) { ?>
				<input type="checkbox" name="<?php echo $brand; ?>" value="<?php echo $brand; ?>"> <span class="white"><?php echo $brand; ?></span><br />
			<?php } ?>
			</div>
			
			<input type="hidden" id="brands" name="brands" readonly />
				
			<input type="hidden" class="basic" id="sorting" name="sorting" value="" placeholder="sorting"/>
			
			<input type="reset" id="form_clear" class="purplebutton" style="width: 220px; margin-left: 1px;" value="Reset" onclick="this.form.reset();"/>
			
			<input type="submit" id="ckitsearch_submit" class="greenbutton" value="Search" />

			</form>
			
		</div>
		
		<div class="palegrey fr" id="sortbar">
			Sort results by:
			
			<select name="sorting_select" id="sorting_select">
				<option value="price_asc">Price lowest first</option>
				<option value="price_desc">Price highest first</option>
				<option value="brand_asc">Brand A-Z</option>
				<option value="brand_desc">Brand Z-A</option>
				<option value="model_asc">Model A-Z</option>
				<option value="model_desc">Model Z-A</option>
			</select>
		</div>
		
		<div id="rightcol" class="palegrey fr">
			
			<?php include(TEMPLATEPATH.'/frontend/functions/front_search_ckits_landing.php'); ?>
			
		</div>
		
		<div class="clear"></div>
		
	</div>
</div>




<script>
	$(function() {
		//$('#ckitsearch_submit').trigger( 'click' );
		
		$('select').change(function(){
			if($(this).val() != ''){
				$(this).parent('.selector').addClass('selected');
			} else {
				$(this).parent('.selector').removeClass('selected');
			}
		})
	});
</script>

<script>
	$(function(){
		
		// add brands to search field
		$('#brands_dropdown input').change(function(){
			var brands_string = '';
			$('#brands_dropdown input').each(function(){
				if($(this).is(':checked')) {
					brands_string += $(this).val() + ', ';
				}
			});
			brands_string = brands_string.substring(0, brands_string.length - 2);
			$('#brands').val(brands_string);
		});

	});

</script>
