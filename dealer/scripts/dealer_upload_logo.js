$(function(){
	$('#dealerLogo').change(function(){
	
		$('#loading').show();
	
		//var imagedata = $('#uploadlogo').serialize();
	    $('#uploadlogo').submit();
	    
	   // var this_post_id = $('#uploadlogo input[name=post_id]').val();
	
		$('#dealerLogoframe').load(function() {
			$('#dealer_logo').delay(5000).load('/wp-content/themes/pedelecs/dealer/includes/dealer_read_dealerlogo.php?' + Math.random()*99999).fadeIn();
			$('#uploadlogo input[name=dealerLogo]').val('');
			$('#loading').hide();
		});
	
	});
});