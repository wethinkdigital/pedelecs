jQuery(function(){
	jQuery('body').on('click', '.videothumb .delete', function () {   
	
        

    var div = jQuery(this).parent();
    
	var video_id = div.attr('attachment_id').replace('video_','');
	var this_post_id = div.attr('post_id')

	var data = "video_id=" + video_id + "&post_id=" + this_post_id;



	   jQuery.ajax({
			type: "POST",
			url:  "/wp-content/themes/pedelecs/manufacturer/functions/manu_delete_video.php",
			data: data,
			dataType: "json",
			async: false,
			
			success: function(){

				jQuery('#images .gallery').delay(5000).load('/wp-content/themes/pedelecs/manufacturer/functions/manu_read_images.php?' + Math.random()*99999, { post_id: this_post_id }).fadeIn();

			}
			
		}); //end ajax		
	
	
	});
});