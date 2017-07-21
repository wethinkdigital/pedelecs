<input type="hidden" id="uniform" value="TRUE" />

<?php if(is_user_logged_in()) {

get_currentuserinfo();
if ( current_user_can('level_10') && $_POST['user_override']) { $current_user->ID = $_POST['user_override']; }
$formdata = get_user_meta($current_user->ID);
parse_str($formdata['bike_stock'][0], $stocked_bikes);
parse_str($formdata['accessory_stock'][0], $stocked_accessories);

?>
 
 <pre><?php //print_r($stocked_accessories); ?></pre>
<div class="wrapper" id="dealer_admin" style="margin-bottom: 30px;">

	<?php if ( current_user_can('level_10')) { ?>
		
	
		<div class="stage">
			<form action="/dealer-admin" method="POST">
			<select name="user_override" onchange="this.form.submit();">
				<option value="">Load a dealer</option>
				<?php foreach(get_users('role=dealer') as $dealer) { ?>
					<option value="<?php echo $dealer->ID; ?>"><?php echo $dealer->user_login; ?></option>
				<?php } ?>
				<?php foreach(get_users('role=dealer_premium') as $dealer) { ?>
					<option value="<?php echo $dealer->ID; ?>"><?php echo $dealer->user_login; ?></option>
				<?php } ?>
			</select>
			</form>
			<pre><?php //print_r($_POST); ?></pre>
		</div>
	
	<?php } ?>
	
	<div class="stage">
		<h1 style="margin: 0px;"><?php echo $formdata['nickname'][0]; ?></h1>
		<div id="submitdata"></div>
	</div>
	
	<div id="images">
	
		<div class="gallery">
				<?php include(TEMPLATEPATH.'/dealer/functions/dealer_read_images.php'); ?>
		</div>

		<form id="uploadimage" class="palegrey" name="" action="<?php bloginfo('template_url'); ?>/dealer/functions/dealer_upload_image.php" method="post" enctype="multipart/form-data" target="imageUploadframe">
			<h5 style="margin-right: 40px;">Upload an image:</h5>

			<label>Upload an image:</label>
			<input type="file" class="file" id="dealerImage" name="dealerImage" />
			<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>" />
			<iframe class="formtarget" name="imageUploadframe" id="imageUploadframe"></iframe>
		<div class="moreinfo popleft purplegrad" for="image_upload">?</div>
		</form>
		
		<form id="linkvideo" class="palegrey" name="" action="" method="post">
			<h5 style="margin-right: 40px;">Vimeo / Youtube code</h5>
			<p>Please <a href="https://support.google.com/youtube/answer/94522" class="purple"target="_blank">disabled advertising</a> on Youtube videos</p>
			<input type="hidden" name="post_id" value="" />
			<input type="text" name="videolink" value="" class="fl"style="width: 250px; height: 20px; border: 1px solid #DDDDDD;"/>
			<input type="submit" value="Save" class="greenbutton fr" style="width: 45px; height: 24px; "/>
			<div class="moreinfo popleft purplegrad" for="video_embed">?</div>
		</form>

		
		<div id="formswitches">
			<label  style="color: white;" class="fl">Add media: </label>
			<div class="formswitch purplegrad fl" for="uploadimage"><img src="<?php bloginfo('template_url'); ?>/img/media-icon-photo.png"/></div>
			<div class="formswitch purplegrad fl" for="linkvideo"><img src="<?php bloginfo('template_url'); ?>/img/media-icon-video.png"/></div>
		</div>

	</div>
	
	<div class="stage purplegrad">
	
	<div id="leftcol" class="fl">
	
			<div id="dealer_logo">
				<?php include(TEMPLATEPATH.'/dealer/includes/dealer_read_dealerlogo.php'); ?>
			</div>
				
				<form id="uploadlogo" name="" action="<?php bloginfo('template_url'); ?>/dealer/functions/dealer_upload_logo.php" method="post" enctype="multipart/form-data" target="dealerLogoframe">
					<label style="color: white;">Upload a logo:</label>
					<input type="file" class="file" id="dealerLogo" name="dealerLogo" style="color: white;"/>
					<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>" />
					<iframe class="formtarget" name="dealerLogoframe" id="dealerLogoframe"></iframe>
				</form>
				
			<div class="clear"></div>
		
					
			<form id="contact_details" action="" method="post" style="margin-bottom: 20px;">
				<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>" />
				<input type="text" id="dealer_name" name="dealer_name" placeholder="Dealer name" value="<?php echo $formdata['nickname'][0]; ?>"/>
				<input type="text" id="address_1" name="address_1" placeholder="Address 1" value="<?php echo $formdata['address_1'][0]; ?>"/>
				<input type="text" id="address_2" name="address_2" placeholder="Address 2" value="<?php echo $formdata['address_2'][0]; ?>"/>
				<input type="text" id="town" name="town" placeholder="Town / City" value="<?php echo $formdata['town'][0]; ?>"/>
				
				<select id="county" name="county">
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
				</select>				
				
				<input type="text" name="postcode" placeholder="Postcode" value="<?php echo $formdata['postcode'][0]; ?>"/ style="margin-bottom: 20px;">
				<input type="text" name="opening_hours" placeholder="Opening hours" value="<?php echo $formdata['opening_hours'][0]; ?>"/ style="margin-bottom: 20px;">
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
			
			
				<input type="button" class="greenbutton" style="width: 198px; height: 24px;" id="update_dealer" value="Save" />
	<a  href="<?php echo wp_logout_url( get_permalink() ); ?>"><div class="purplebutton" style="margin-top: 20px; padding: 6px;">Log out</div></a>

	</div>
	

	<div id="rightcol" class="palegrey fr">
			
			<pre><?php print_r(stock_data()); ?></pre>
	
				<h3>Description</h3>

	
		<form id="dealer_content" method="post" action="">
			<textarea name="summary" placeholder="Your introduction summary"><?php echo $formdata['summary'][0]; ?></textarea>
			<textarea name="description" placeholder="Your description"><?php echo $formdata['description'][0]; ?></textarea>
		</form>
		
		<form id="stock_items" action="" method="post" style="">
		
			<input type="hidden" name="post_id" value="" />
			<div class="alert"></div>
		
			
			<div id="bikes_check" class="fl">
			
			<h3>Bikes</h3>
			
				<div id="url_column_header" style="position: absolute; left: 156px; top: 26px; display: none;">Your product URL</div>

			
				<?php $args = array('post_type' => 'bike',
									'posts_per_page' => -1,
									'meta_key' => 'brand',
									'orderby' => 'meta_value',
									'order' => 'ASC'
									);
									
					$bikes = new WP_Query($args); 
				
					while( $bikes->have_posts() ) : $bikes->the_post();
											
						$bike = get_post_meta(get_the_id(), 'brand', true).' '.get_post_meta(get_the_id(), 'model', true); ?>
					
						<div class="stock_item fl" <?php $dt = array('online','both'); if(in_array($formdata['dealer_type'][0],$dt)) { echo 'style="width: 320px;"'; } ?>>
							<input type="checkbox" name="bike_<?php echo get_the_id(); ?>" value="stocked" <?php if($stocked_bikes['bike_'.get_the_id()]) { echo 'CHECKED'; }?>/>
							<label class="fl"><?php echo $bike; ?></label>
							<input class="bike_url fr" type="text" value="<?php echo ($stocked_bikes['bike_'.get_the_id()] != 'stocked') ? $stocked_bikes['bike_'.get_the_id()] : ''; ?>" <?php if(in_array($formdata['dealer_type'][0],$dt)) { echo 'style="display: block;"'; } ?>/>
						</div>
					
					<?php endwhile; wp_reset_postdata(); ?>
				
			</div>
			
			<div id="accessories" class="fl">
			
				<h3>Accessories</h3>
				
				<div id="accessory-items">
				
				<?php foreach($stocked_accessories as $k=>$v) { ?>
				
					<div class="stock_item">
						<input type="text" name="<?php echo $k; ?>" placeholder="Accessory name" value="<?php echo $v; ?>"/>
						<div class="delete purplegrad">
							<img src="<?php bloginfo('template_url'); ?>/img/image-delete.png" unselectable="on" />
						</div>
					</div>
					
				<?php } ?>
					
				</div>
			
				<input type="button" name="add_accessory" id="add_accessory" value="Add" />
			
			</div>
	
		</form>
		
	</div>
		
		
	
	<div class="clear"></div>
	
	</div><!-- close stage -->
</div><!-- close wrapper -->

<?php } else { // user is not logged in ?>

<form name="loginform" id="loginform" action="<?php echo get_option('siteurl'); ?>/wp-login.php" method="post" class="palegrey manu-login" >

		<div class="purplegrad header"><h2 style="color: white; font-size: 32px; margin: 0px;">Dealer login</h2></div>
		
		<?php if(isset($_GET['login']) && $_GET['login'] == 'failed') { echo '<p class="error">Username or password not recognised</p>'; } ?>
 
		<ul>
			<li><label>Username</label><input value="" class="input" type="text" tabindex="10" name="log" id="user_login" /></li>
			<li><label>Password</label><input value="" class="input" type="password" size="10" tabindex="20" name="pwd" id="user_pass" /></li>
		</ul>
			<input name="wp-submit" id="wp-submit" value="Log In" tabindex="100" type="submit" class="greenbutton">
			<p></p>
			<label></label><input name="rememberme" id="rememberme" value="forever" tabindex="90" type="checkbox"> <span>Remember Me? </span>
			
			<input name="redirect_to" value="<?php echo get_option('siteurl'); ?>/dealer-admin" type="hidden">
			<input name="testcookie" value="1" type="hidden">
 
	</form>			
<?php } ?>

<?php if(!is_user_logged_in()){ ?>
<script>
	$(function(){
		$('#newbike input:submit').attr('disabled','disabled');
		$('#specform input').attr('disabled','disabled');
		$('#specform select').attr('disabled','disabled');
	});
</script>
<?php } ?>



<script>
	$(function(){
	
		$('#add_accessory').click(function(){
			var acc_index = $('.stock_item').last().children('input:text').attr('name');
			acc_index = acc_index.split('_');
			var next_index = parseInt(acc_index[1]) + 1;
			//alert(next_index);
			$('#accessory-items').append('<div class="stock_item"><input type="text" name="accessory_' + next_index + '" placeholder="Accessory name"/><div class="delete purplegrad"><img src="/wp-content/themes/pedelecs/img/image-delete.png" unselectable="on" /></div></div></div>');

		});
		
		$('body').on('click', '.delete', function () {
			if($('#accessories').find('.stock_item').length > 1) {
				$(this).parent().remove();
			}
		});
	
		$.get('<?php bloginfo('template_url') ?>/manufacturer/includes/popups.xml', function(dopopups){
			$(dopopups).find('popup').each(function(){
				var $popup = $(this);
				$('#bikespec .moreinfo[for=\'' + $popup.attr('for') + '\']').append('<div class="popup palegrey">' + $popup.find('text').text() + '</div>');
				$('#bikespec .moreinfo[for=\'' + $popup.attr('for') + '\'] .popup').hide();
			});
		});
		
		$('#bikespec .moreinfo').hover(
			function(){ $(this).children('.popup').show(); },
			function(){ $(this).children('.popup').hide(); }
		);
		$('.viewlink').hide();
		
		$('#dealer_type').change(function(){
			if($(this).val() != 'retail'){
				$('#bikes_check .stock_item').css('width','320px');
				$('#bikes_check .stock_item').each(function(){
					$(this).children('.bike_url').fadeIn(300);
				})
				$('#url_column_header').fadeIn(300);
			} else {
				$('#bikes_check .stock_item').css('width','160px');				
				$('#bikes_check .stock_item').children('.bike_url').hide();
				$('#url_column_header').hide();
			}
		})


	});
	
	$(function(){
		function updatecheck(){
			if($(this).val() != '') {
					var url = $(this).val();
					$(this).siblings('input:checkbox').val(url);		
			} else {
					$(this).siblings('input:checkbox').val('stocked');		
			}
		}
		
		$('.bike_url').keypress(updatecheck);
		$('.bike_url').change(updatecheck);
		$('.bike_url').bind('paste', updatecheck);
	
	});
	
			// hide media upload forms
		$('#images form').hide();
		
		
		// hide images saved alert
		$('#images_saved').hide();
		
		
		// show form
		$('.formswitch').click(function(e){
			var form = jQuery(this).attr('for');
			$('#images form').not('#' + form).fadeOut(100);			
			$('#' + form).fadeIn(100);
		    e.stopPropagation();
		})

		$('#images form').click(function(e){
		    e.stopPropagation();
		})

		
		// click off form to hide
		$('html').click(function() {
			$('#images form').fadeOut(100);
		});

	
	
</script>
