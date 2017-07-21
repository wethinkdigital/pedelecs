<?php 

function footer_subscription_form( $atts, $content = null ) {

ob_start(); ?>

<script>	
	jQuery(function(){
		jQuery('form').submit(function(){
			var email = jQuery(this).find('input[name="email"]');
			if(email.val() == ''){
				email.css({backgroundColor: "#FFDDDD", border: "1px solid #FF0000" });
				email.val('EMAIL ADDRESS IS REQUIRED');
				return false;
			} else {
				jQuery(this).find('iframe').delay(1500).animate({ height: '60px'}, 160);
			}
			return true;

		});
	});
</script>



<form action="<?php echo $_SERVER['SERVER_NAME']; ?>/wp-content/themes/pedelecs/frontend/functions/footer_subscription-submit.php" method="post" id="enquiry" class="subscription" target="subscribe-result" enctype="multipart/form-data">

    <input type="hidden" name="form_name" value="Footer Subscribe" />
	<input type="hidden" name="page" value="<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />

    <h3>Sign up for our newsletter</h3>
    
    <p>To receive regular round ups of Pedelecs news straight to your inbox please supply us with your contact details below. We adhere to a strict privacy policy and will not sell or rent your information to third parties. You will be able to opt out of receiving our newsletter at any time:</p>
    
    <div class="fl"><label>First name</label><input type="text" name="name" value="" size="40" class="inputgrad" /></div>
    <div class="fr"><label>Surname</label><input type="text" name="surname" value="" size="40" class="inputgrad" /></div>
    <p><label>Email</label><input type="email" name="email" value="" size="40" class="inputgrad" /></span>
    
    <input type="submit" value="Submit" class="purplegrad" /><br />
    
    <p>Please note newsletters are an upcoming feature of the new Pedelecs website that will commence in the near future.</p>
    
	<iframe id="subscribe-result" name="subscribe-result"></iframe>
	
</form>

		<div class="clear"></div>
		
<?php

$output = ob_get_contents(); ob_end_clean();

return $output;

}

add_shortcode( 'subscription', 'footer_subscription_form' );

?>
