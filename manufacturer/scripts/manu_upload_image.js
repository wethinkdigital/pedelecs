$(function(){
	$('#bikeImage').change(function(){
	
		var filename = $('#dealerImage').val();
		$('#uploading span').html(filename);
		$('#uploading').show();

	    $('#uploadimage').submit();
	    
	    var this_post_id = $('#uploadimage input[name=post_id]').val();
	
		$('#imageUploadframe').load(function() {
			$('#images .gallery').delay(5000).load('/wp-content/themes/pedelecs/manufacturer/functions/manu_read_images.php?' + Math.random()*99999, { post_id: this_post_id }).fadeIn();
			$('#uploadimage input[name=bikeImage]').val('');
			$('#images form').fadeOut(100);
			$('#uploading').hide();
			
			$('#images_saved').delay(2000).fadeIn().delay(2000).fadeOut();

		});
	
	});
});