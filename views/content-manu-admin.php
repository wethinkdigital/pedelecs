<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_sortable.js"></script>


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
	});
</script>



<input type="hidden" id="uniform" value="TRUE" />

<?php if(is_user_logged_in()) { ?>

<div id="manu_admin">

<div class="wrapper" id="prodspec">


	<div id="prodheader">
		<h1 style="margin: 0px;">Product configurator</h1>
	</div>

	<div id="images">
	
		<div class="gallery"></div>

		<form id="uploadimage" class="palegrey" name="" action="<?php bloginfo('template_url'); ?>/manufacturer/functions/manu_upload_image.php" method="post" enctype="multipart/form-data" target="imageUploadframe">
		
			<h5 style="margin-right: 40px;">Upload an image (max 6):</h5>
			<input type="file" class="file fl" id="bikeImage" name="bikeImage" />
			<div class="palegrey" id="uploading">Uploading <span id="filename"></span><img src="<?php bloginfo('template_url'); ?>/img/ajax-loader-grey.gif" /></div><input type="hidden" name="post_id" value="" />
			<div class="clear"></div>
			<p class="legal">It is your responsibility to ensure you have the copyright<br />holder's permission before uploading any images to this website</p>
			
			<iframe class="formtarget" name="imageUploadframe" id="imageUploadframe"></iframe>
			
			<div class="moreinfo popleft purplegrad" for="image_upload">?</div>
		
		</form>
		
		<form id="linkvideo" class="palegrey" name="" action="" method="post">
			<h5 style="margin-right: 40px;">Vimeo / Youtube code</h5>
			<p>Please <a href="https://support.google.com/youtube/answer/94522" class="purple">disabled advertising</a> on Youtube videos</p>
			<input type="hidden" name="post_id" value="" />
			<input type="text" name="videolink" value="" class="fl"style="width: 250px; height: 20px; border: 1px solid #DDDDDD;"/>
			<input type="submit" value="Save" class="greenbutton fr" style="width: 45px; height: 24px; "/>
			<div class="clear"></div>
			<p class="legal">It is your responsibility to ensure you have the copyright<br />holder's permission before linking any videos to this website</p>
			<div class="moreinfo popleft purplegrad" for="video_embed">?</div>
		</form>
		
		<div id="formswitches">
			<label  style="color: white;" class="fl">Add media: </label>
			<div class="formswitch purplegrad fl" for="uploadimage"><img src="<?php bloginfo('template_url'); ?>/img/media-icon-photo.png"/></div>
			<div class="formswitch purplegrad fl" for="linkvideo"><img src="<?php bloginfo('template_url'); ?>/img/media-icon-video.png"/></div>
		</div>
		
		<div id="images_saved" class="palegrey"><h4 class="purple">Images saved</h4></div>

	</div>
	
	<div class="stage purplegrad" style="margin-bottom: 30px;">
	
    	<div class="stage" style="height: 60px; padding-bottom: 16px; ">
    		<div class="darkpurplegrad fl" id="section_tabs" style="padding: 10px; width: 700px;">
    			<ul class="tabs">
    				<li id="load_bikes" for="manu_bikes" style="color: white;">Bikes</li>
    				<li id="load_ckits" for="manu_ckits" style="color: #995695;">Conversion Kits</li>
    			</ul>
    		</div>
    		<div class="fr" style="width: 220px; position: relative;">
    			
    			<a href="<?php echo wp_logout_url( get_permalink() ); ?>"><input type="button" class="purplebutton" style="position: absolute; left: 130px; top: 14px; width: 70px; height: 30px;  padding: 6px; text" value="Log out" /></a>
    		</div>
    	</div>
    	
    	<div class="clear"></div>
				
		<div id="manu_bikes" class="admin_section">
		
    		<?php include (TEMPLATEPATH . '/views/block-manu-admin-bike.php'); ?>
    		    		
        </div>

		<div id="manu_ckits" class="admin_section" style="display: none;">
		
    		<?php include (TEMPLATEPATH . '/views/block-manu-admin-ckit.php'); ?>
    		    		
        </div>

        <div class="clear"></div>
	
	</div>
</div>

</div>

<?php } else { // user is not logged in ?>

<form name="loginform" id="loginform" action="<?php echo get_option('siteurl'); ?>/wp-login.php" method="post" class="palegrey manu-login" >

		<div class="purplegrad header"><h2 style="color: white; font-size: 32px; margin: 0px;">Manufacturer login</h2></div>
		
		<?php if(isset($_GET['login']) && $_GET['login'] == 'failed') { echo '<p class="error">Username or password not recognised</p>'; } ?>
 
		<ul>
			<li><label>Username</label><input value="" class="input" type="text" tabindex="10" name="log" id="user_login" /></li>
			<li><label>Password</label><input value="" class="input" type="password" size="10" tabindex="20" name="pwd" id="user_pass" /></li>
		</ul>
			<input name="wp-submit" id="wp-submit" value="Log In" tabindex="100" type="submit" class="greenbutton">
			<p></p>
			<label></label><input name="rememberme" id="rememberme" value="forever" tabindex="90" type="checkbox"> <span>Remember Me? </span>
			
			<input name="redirect_to" value="<?php echo get_option('siteurl'); ?>/manufacturer-admin" type="hidden">
			<input name="testcookie" value="1" type="hidden">
 
	</form>			
<?php } ?>

<?php if(!is_user_logged_in()){ ?>
<script>
	jQuery(function(){
		jQuery('#newbike input:submit').attr('disabled','disabled');
		jQuery('#specform input').attr('disabled','disabled');
		jQuery('#specform select').attr('disabled','disabled');
	});
</script>
<?php } ?>

<script>
	$(function(){
	
		// more info pop-ups
		$.get('<?php bloginfo('template_url') ?>/manufacturer/includes/popups.xml', function(dopopups){
			$(dopopups).find('popup').each(function(){
				var jQuerypopup = $(this);
				$('#bikespec .moreinfo[for=\'' + $popup.attr('for') + '\']').append('<div class="popup palegrey">' + $popup.find('text').text() + '</div>');
				$('#bikespec .moreinfo[for=\'' + $popup.attr('for') + '\'] .popup').hide();
			});
		});
		
		$('#bikespec .moreinfo').hover(
			function(){ jQuery(this).children('.popup').show(); },
			function(){ jQuery(this).children('.popup').hide(); }
		);
		
		
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
				
		// hide 'view bike' button
		$('.viewlink').hide();
		
		$('body').on('mouseover', '.videoholder', function () {
			$('body').find('#images .thumbnails').filter(':not(:animated)').fadeOut(200);
			$('#formswitches').filter(':not(:animated)').fadeOut(200);
		});

		$('body').on('mouseleave', '.videoholder', function () {
			$('body').find('#images .thumbnails').fadeIn(200);
			$('#formswitches').fadeIn(200);
		});
				


	});
	
</script>
