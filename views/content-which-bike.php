<?php faeo('#demo'); ?>

<!-- <div id="demo"><pre><?php// session_start(); print_r($_SESSION); ?></pre></div> -->

<script>
	$(window).load(function() {
		$('#advanced_options_toggle').click(function(){
			if($('#advanced_options').height() < 10 ){
		        $('#advanced_options').stop().animate({ height: "375" }, 1);
		        $(this).css('background-image','url(/wp-content/themes/pedelecs/img/toggle-arrow-up.png)');
		        $(this).css('overflow','show');
		        $(this).html('Basic Search');
				$('.basic').hide();
				$('input[name="searchtype"]').val('advanced');
				$.uniform.update();
		    } else {
		        $('#advanced_options').stop().animate({ height: "0"  }, 1);     
		        $(this).css('background-image','url(/wp-content/themes/pedelecs/img/toggle-arrow-down.png)');
		        $(this).css('overflow','hidden');
		        $(this).html('Advanced Search');
				$('.basic').show();
				$('input[name="searchtype"]').val('basic');
				$.uniform.update();
		    }

		});
	});
</script>

<script>
	$(function(){
		$('body').on('change', '#sorting_select', function () {
			var sort = $(this).val();
			//alert(sort);
			$('#sorting').val(sort);
			$('#bikesearch').submit();
		});
	});
</script>

<script>
    function reset_form(){
        $('#bikesearch')[0].reset();
		$.uniform.update();
    }
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

		

		<script>
			$('select').each(function(){
				if($(this).val != '') {
					$(this).parent('.selector').addClass('selected');
				}
			});
		</script>
		
		</div>
		
		<div id="shortlist" class="palegrey fr">
			<form id="compare_bikes" name="compare_bikes" action="/compare-bikes" method="post">
				<h3 class="purple" style="margin-bottom: 0px;">Shortlist</h3>
				<p>Maximum 4 bikes</p>
				<div class="prods">
				</div>
				<input type="submit" id="compare_submit" class="greenbutton compare_shortlist" value="Compare shortlist" style="display: none;"/>
			</form>
			<p class="clear_shortlist purple" style="display: none; margin-top: 8px;">Clear shortlist</p>
		</div>
	</div>
</div>

<div class="wrapper" id="whichbike" style="margin-bottom: 20px;">
	<div class="stage purplegrad">
	
		<div id="leftcol" class="fl">
		
		
		<!-- <pre>Session: <?php print_r($session_array); ?></pre> -->
		
			<h3 class="white">Search options</h3>
			<form action="" method="post" id="bikesearch" <?php if(isset($session_array)) echo 'style="display: none;"'; ?>>
			
			<h5 class="white">Price (RRP)</h5>
			<p><div id="rrp" style="border: 0; font-size: 12px; font-family: Arial,Helvetica,sans-serif !important; color: #FFFFFF; background: none !important; "></div></p>
			<div id="slider-range"></div>
			
			<input type="hidden" name="rrp-min" value=""  class="basic"/>
			<input type="hidden" name="rrp-max" value=""  class="basic"/>
			
			<h5 class="white" style="margin: 30px 0 4px 0;">Specification</h5>
			<div id="advanced_options_toggle" class="white">Advanced search</div>


			<select name="use" class="basic">
				<option value="">Use</option>
				<option value="commuting_town">Commuting & Town</option>
				<option value="general_leisure">General leisure</option>
				<option value="trail_mountain">Trail & Mountain</option>
				<option value="touring">Touring</option>
			</select>
			<select name="frame_type" class="basic">
				<option value="">Frame type</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
				<option value="Unisex">Unisex</option>
			</select>
			
			<div id="advanced_options">
			
				<input type="hidden" class="basic advanced" name="searchtype" value="<?php echo (isset($session_array) ? $session_array['searchtype'] : 'basic'); ?>" />

			
				<select name="frame_style" class="advanced">
					<option value="">Frame style</option>
					<option value="Low step through">Low step through</option>
					<option value="High step through">High step through</option>
					<option value="With cross bar">With cross bar</option>
					<option value="Mountain bike">Mountain bike</option>
					<option value="Folding">Folding</option>
					<option value="Tricycle">Tricycle</option>
					<option value="Tandem">Tandem</option>
					<option value="Cargo">Cargo</option>
				</select>
				<select name="motor_position" class="advanced">
					<option value="">Motor position</option>
					<option value="Front hub">Front hub</option>
					<option value="Rear hub">Rear hub</option>
					<option value="Centre Crank drive">Centre / Crank drive</option>
				</select>
				<select name="throttle" class="advanced">
					<option value="">Throttle</option>
					<option value="Independent throttle plus pedal assist">Independent throttle plus pedal assist</option>
					<option value="Throttle to 4mph and when pedals are being turned plus pedal assist">Throttle to 4mph and when pedals are being turned plus pedal assist</option>
					<option value="Pedal assist only, no throttle">Pedal assist only, no throttle</option>
				</select>
				
				<div class="fl" style="height: 40px;">
				
					<div class="palegrey" id="brands_dropdown" style="padding: 6px; width: 268px; height: 200px; position: absolute; left: 0px; top: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.4); display: none; z-index: 999;">
							<div class="fl" style="overflow-y: auto; overflow-x: hidden; height: 200px; width: 210px;">
							<?php foreach(brands_array() as $brand) { ?>
								<input type="checkbox" name="<?php echo $brand; ?>" value="<?php echo $brand; ?>"> <?php echo $brand; ?><br />
							<?php } ?>
							</div>
					</div>
					<input type="text" id="brands" name="brands" style="width: 274px" placeholder="Brands" readonly />
					<input type="button" class="greenbutton" id="close_brands" value="Close" style="height: 24px; width: 40px; position: absolute; left: 176px; top: 2px; display: none;"/>
				</div>
			
				<select name="place_manufacture" class="advanced">
					<option value="">Place of manufacture</option>
					<option value="Asia">Asia</option>
					<option value="Europe">Europe</option>
					<option value="US">United States</option>
				</select>
				<select name="wheel_size" class="advanced">
					<option value="">Wheel size</option>
					<option value="0/20">20" and below</option>
					<option value="21/26">21" to 26"</option>
					<option value="27/999">27" and above</option>
				</select>
				<select name="weight" class="advanced">
					<option value="">Weight with battery</option>
					<option value="0/20.999">Below 21kg</option>
					<option value="21/25.999">21kg to 25kg</option>
					<option value="26/999">26kg and above</option>
				</select>
				<select name="motor_power" class="advanced">
					<option value="">Motor power</option>
					<option value="0/250">250w or below (classified as electric bike for UK road use)</option>
					<option value="250.1/999">above 250w (UK road vehicle legislation applies to this bike)</option>
				</select>
				<input type="text" name="keywords" placeholder="Keywords" value="" class="advanced"/>
				<div id="discontinued" class="advanced">
				
				<input type="checkbox" name="discontinued" value="TRUE"> <span class="white">Discontinued</span>
				<div class="hint purplegrad">?
				    <div class="hint-hover palegrey">
				        Find support manuals for discontinued e-bikes
				    </div>
				</div>
				</div>
				
			</div>
			
			<input type="hidden" class="basic" id="sorting" name="sorting" value="" placeholder="sorting"/>
			
			<input type="reset" id="form_clear" class="purplebutton" style="width: 220px; margin-left: 1px;" value="Reset" onclick="reset_form();"/>
			
			<input type="submit" id="bikesearch_submit" class="greenbutton" value="Search" />

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
			
			<div id="results_count" class="fr" style="padding: 6px 40px;"></div>
		</div>
		
		<div id="rightcol" class="palegrey fr">
			
			<?php include(TEMPLATEPATH.'/frontend/functions/front_search_bikes_landing.php'); ?>
			
		</div>
		
		<div class="clear"></div>
		
	</div>
</div>




<script>
	$(function() {
		//$('#bikesearch_submit').trigger( 'click' );
		
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

		// show dropdown
		$('#brands').focus(function(e){
		    e.stopPropagation();
		    $('#brands_dropdown').show();
		    $('#close_brands').show();
		})

		$('#brands, #brands_dropdown').click(function(e){
		    e.stopPropagation();
		})
		
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

		// click off dropdown to hide
		$('html, #close_brands').click(function() {
			$('#brands_dropdown').fadeOut(100);
		    $('#close_brands').hide();
		});

	});

</script>

<?php 
		session_start();
		if(isset($_SESSION['search_query'])) { ?>
		
		
			<?php parse_str($_SESSION['search_query'],$session_array);
			
			    if($session_array['searchtype'] == 'advanced'){ ?>
				    <script>
				        $(function(){
    				        $('#advanced_options').stop().animate({ height: "375" }, 1); // php
            		        $(this).css('background-image','url(/wp-content/themes/pedelecs/img/toggle-arrow-up.png)');
            		        $(this).css('overflow','show');
            		        $(this).html('Basic Search'); // php
            				$('.basic').hide(); // php
            				$.uniform.update();
				        });
				    </script>
				 <?php } 
			 
				foreach($session_array as $k=>$v) { 
					if($v != ''){ ?>
					<script>
						$(function(){
							var select = $('select[name="<?php echo $k; ?>"]'); // php
							select.val('<?php echo $v; ?>'); // php
							
							var textfield = $('input[name="<?php echo $k; ?>"]'); // php
							textfield.val('<?php echo $v; ?>'); // php
														
							$.uniform.update();
							select.closest('.selector').addClass('selected');
						});
					</script>
				 <?php }
				 } ?>
				 
				 <script>
				    $(function(){
    				    $('#slider-range').slider("values",0,<?php echo $session_array['rrp-min']; ?>);
    				    $('#slider-range').slider("values",1,<?php echo $session_array['rrp-max']; ?>);
    				    $('#rrp').html("<?php echo '&pound;'.number_format($session_array['rrp-min'],0,'.',',').' - '.'&pound;'.number_format($session_array['rrp-max'],0,'.',','); ?>"); // php
        		        $('#bikesearch').show().submit();
    		        });
    		    </script>

				 
				 				 
		<?php } ?>
