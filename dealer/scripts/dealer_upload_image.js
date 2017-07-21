$(function(){
	$('#dealerImage').change(function(){
	
		var filename = $('#dealerImage').val();
		//var user_id = $('#user_id').val();
		$('#uploading span').html(filename);
		$('#uploading').show();
		
		var imagedata = $('#uploadimage').serialize();
		console.log(imagedata);
	    $('#uploadimage').submit();
	    
	    var this_user_id = $('#uploadimage input[name=user_id]').val();
	
		$('#imageUploadframe').load(function() {
			$('.gallery').delay(5000).load('/wp-content/themes/pedelecs/dealer/functions/dealer_read_images.php?' + Math.random()*99999, { user_id: this_user_id }).fadeIn();
			$('#uploadimage input[name=dealerImage]').val('');
			$('#images form').fadeOut(100);
			$('#uploading').hide();
		});
	
	});
});


//task.find('.comments').load('/scribe/application/views/task_comments.php?' + Math.random()*99999, { post_id: this_post_id }).fadeIn();