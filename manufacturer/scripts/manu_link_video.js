jQuery(function(){
	jQuery('body').on('submit', '#linkvideo', function (e) {    

	    e.preventDefault();
	    		
	    	var data = jQuery(this).serialize();
	    	var this_post_id = jQuery('#linkvideo input[name=post_id]').val();

	    		        		    
		    jQuery.ajax({
				type: "POST",
				url:  "/wp-content/themes/pedelecs/manufacturer/functions/manu_link_video.php",
				data: data,
				dataType: "json",
				//async: false,
				
				success: function(result){
	
					jQuery('#images .gallery').delay(5000).load('/wp-content/themes/pedelecs/manufacturer/functions/manu_read_images.php?' + Math.random()*99999, { post_id: this_post_id }).fadeIn();
					jQuery('#linkvideo input[name=videolink]').val('');
					jQuery('#images form').fadeOut(100);
				}
				
			}); //end ajax	
			

	});
});