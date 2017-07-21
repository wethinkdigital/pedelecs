<script>	
	jQuery(function(){
		jQuery('form').submit(function(){
			var email = jQuery(this).find('input[name="email"]');
			if(email.val() == ''){
				email.css({backgroundColor: "#FFDDDD", border: "1px solid #FF0000" });
				email.val('EMAIL ADDRESS IS REQUIRED');
				return false;
			} else {
				jQuery(this).find('iframe').delay(1500).animate({ height: '70px'}, 160);
			}
			return true;

		});
	});
</script>

<div id="footer" class="shadowgrad-down" style="">

	<div class="stage">
	
		<div id="newsletter_signup" class="fl palegrey">

<form action="http://<?php echo $_SERVER['SERVER_NAME']; ?>/wp-content/themes/pedelecs/frontend/functions/footer_subscription-submit.php" method="post" id="enquiry" class="subscription" target="subscribe-result" enctype="multipart/form-data">

    <input type="hidden" name="form_name" value="Footer Subscribe" />
	<input type="hidden" name="page" value="<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />

    <h3>Sign up for our newsletter</h3>
    
    <p>To receive regular round ups of Pedelecs news straight to your inbox please supply us with your contact details below. We adhere to a strict privacy policy and will not sell or rent your information to third parties. You will be able to opt out of receiving our newsletter at any time:</p>
    
    <div class="fl" style="margin-bottom: 6px;">    
        <div class="fl"><label>First name</label><input type="text" name="name" value="" size="40" class="inputgrad" /></div>
        <div class="fr"><label>Surname</label><input type="text" name="surname" value="" size="40" class="inputgrad" /></div>
        <label>Email</label><input type="email" name="email" value="" size="40" class="inputgrad" />
        <input type="submit" value="Submit" class="purplegrad" />
        <div class="clear"></div>
        
        <iframe id="subscribe-result" name="subscribe-result" frameBorder="0" scrolling="no" style="width: 100%; position: absolute; left: 0px; top: 0px;"></iframe>

    </div>
    
    
    <p>Please note newsletters are an upcoming feature of the new Pedelecs website that will commence in the near future.</p>
    
	
	
</form>

		<div class="clear"></div>
		
		</div>
		
		<div id="advertise_cta" class="fr palegrey">
			<h3 class="purple">Want to advertise on Pedelecs?</h3>
			<p>In an expanding industry, Pedelecs offers advertisers a mix of returning & first time visitors looking to purchase their first electric bike. Grow your business here with our highly targeted readership.</p>
			<a href="/advertising"><input type="button" class="purplegrad fr" value="Find out more" /></a>
		</div>
		
		<div class="clear"></div>

		<div class="legal">
			<p>&copy; Copyright Pedelecs. An IBE <a href="http://www.ibecreative.co.uk">website design.</a> <a href="/legal">Legal.</a></p>
		</div>

	</div>

</div>