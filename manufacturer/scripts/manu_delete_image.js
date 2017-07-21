jQuery(function(){
	jQuery('#manu_admin').on('click', '.imagethumb .delete', function () {  
	        
    var div = jQuery(this).parent();
   
    var this_image_id = div.attr('attachment_id');
    var this_post_id = div.attr('post_id');

    var attachment = 'post_id=' + this_image_id;

    //div.html('post_id is ' + post_id);

	   jQuery.ajax({
			type: "POST",
			url:  "/wp-content/themes/pedelecs/manufacturer/functions/manu_delete_image.php",
			data: attachment,
			dataType: "json",
			async: false,
			
			success: function(image){

				//jQuery('#images .gallery').html('we are now going to load images from post ' + this_post_id).fadeIn();

				jQuery('#images .gallery').delay(5000).load('/wp-content/themes/pedelecs/manufacturer/functions/manu_read_images.php?' + Math.random()*99999, { post_id: this_post_id }).fadeIn();

			}
			
		}); //end ajax		

	});
});