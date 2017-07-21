<script src="<?php bloginfo('template_url') ?>/dealer/scripts/dealer_sortable.js"></script>

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
			$('ul.brands li').removeClass('active');
			$(this).addClass('active');
			$('.brand_panel').hide();
			$(this).closest('.admin_section').find('ul.brand_panel_' + show).show();
			Cufon.refresh();
		})
	});
</script>

<input type="hidden" id="uniform" value="TRUE" />

<?php if(is_user_logged_in()) {

get_currentuserinfo();
if ( current_user_can('level_10') && $_POST['user_override']) { $current_user->ID = $_POST['user_override']; }
$formdata = get_user_meta($current_user->ID);
//parse_str($formdata['accessory_stock'][0], $stocked_accessories);

?>
 
<div class="wrapper" id="dealer_admin" style="margin-bottom: 30px;">

	<?php // show dealer menu for administrators
	
	if ( current_user_can('level_10')) { ?>

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
		</div>
	
	<?php } ?>
	
	<div class="stage">
		<h1 style="margin: 0px;"><?php echo $formdata['nickname'][0]; ?></h1>
		<div id="submitdata"></div>
	</div>
	
	<!-- images header -->
	<div id="images">
	
		<div class="gallery">
				<?php include(TEMPLATEPATH.'/dealer/functions/dealer_read_images.php'); ?>

		</div>

		<form id="uploadimage" class="palegrey" name="" action="<?php bloginfo('template_url'); ?>/dealer/functions/dealer_upload_image.php" method="post" enctype="multipart/form-data" target="imageUploadframe">
			<h5 style="margin-right: 40px;">Upload an image:</h5>

			<label>Upload an image:</label>
			<input type="file" class="file" id="dealerImage" name="dealerImage" />
			<div class="palegrey" id="uploading">Uploading <span id="filename"></span><img src="<?php bloginfo('template_url'); ?>/img/ajax-loader-grey.gif" /></div>
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $current_user->ID; ?>" />
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
			<label  style="color: white;" class="fl">Add image: </label>
			<div class="formswitch purplegrad fl" for="uploadimage"><img src="<?php bloginfo('template_url'); ?>/img/media-icon-photo.png"/></div>
			<!-- <div class="formswitch purplegrad fl" for="linkvideo"><img src="<?php bloginfo('template_url'); ?>/img/media-icon-video.png"/></div> -->
		</div>

	</div>
	
	
	<div class="stage purplegrad">

	<div class="stage" style="height: 60px; padding-bottom: 16px; ">
		<div class="darkpurplegrad fl" id="section_tabs" style="padding: 10px; width: 700px;">
			<ul class="tabs">
				<li id="load_store_details" for="store_details" style="color: white;">Store Details</li>
				<li id="load_bike_stock" for="bike_stock" style="color: #995695;">Bikes stocked</li>
				<li id="load_ckits" for="conversion_kits" style="color: #995695;">Conversion Kits</li>
				<li id="load_accessories" for="accessories" style="color: #995695; display: none;">Accessories</li>
			</ul>
		</div>
		<div class="fr" style="width: 220px; position: relative;">
			<input type="button" class="greenbutton" style="position: absolute; left: 0px; top: 14px; width: 120px; height: 30px; padding: 6px;" id="update_dealer" value="Save" />
			<a href="<?php echo wp_logout_url( get_permalink() ); ?>"><input type="button" class="purplebutton" style="position: absolute; left: 130px; top: 14px; width: 70px; height: 30px;  padding: 6px; text" value="Log out" /></a>
		</div>
	</div>
	
	<div class="clear"></div>

	
        <div id="store_details" class="admin_section">
		
    		<?php include (TEMPLATEPATH . '/views/block-dealer-admin-store.php'); ?>
    		    		
        </div>


        <div id="bike_stock" class="admin_section" style="display: none;">
		
    		<?php include (TEMPLATEPATH . '/views/block-dealer-admin-bikes.php'); ?>
    		    		
        </div>
        

        <div id="conversion_kits" class="admin_section" style="display: none;">
		
    		<?php include (TEMPLATEPATH . '/views/block-dealer-admin-ckits.php'); ?>
    		    		
        </div>


        <div id="accessories" class="admin_section" style="display: none;">
		
    		<?php //include (TEMPLATEPATH . '/views/block-dealer-admin-accessories.php'); ?>
    		    		
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
		
		$('#accessories').on('click', '.delete', function () {
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
