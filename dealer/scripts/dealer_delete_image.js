jQuery(function(){
	jQuery('#dealer_admin').on('click', '.imagethumb .delete', function () {  
		        
    var div = jQuery(this).parent();
   
    var this_image_id = div.attr('attachment_id');
    var user_id = div.attr('user_id');

    var attachment = 'post_id=' + this_image_id + '&user_id=' + user_id;

    //div.html('post_id is ' + post_id);

	   jQuery.ajax({
			type: "POST",
			url:  "/wp-content/themes/pedelecs/dealer/functions/dealer_delete_image.php",
			data: attachment,
			dataType: "json",
			async: false,
			
			success: function(result){

				//jQuery('#images .gallery').html('we are now going to load images from post ' + this_post_id).fadeIn();

				jQuery('#images .gallery').delay(5000).load('/wp-content/themes/pedelecs/dealer/functions/dealer_read_images.php?' + Math.random()*99999, { user_id: result.user_id }).fadeIn();

			}
			
		}); //end ajax		
	
		

	});
});