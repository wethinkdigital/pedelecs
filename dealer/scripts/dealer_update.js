jQuery(function(){
	jQuery('body').on('click', '#update_dealer', function () {    
	    
		
	    	var contact_details = jQuery('#contact_details').serialize();
	    	var dealer_content = jQuery('#dealer_content').serialize();
	    	var bike_stock = jQuery('#bike_stock_form').serialize();
	    	var ckit_stock = jQuery('#ckit_stock_form').serialize();
	    	var accessories = jQuery('#accessories_form').serialize();
	    		    	
	    	var data = contact_details + '&split=&' + dealer_content + '&split=&' + bike_stock + '&split=&' + ckit_stock + '&split=&' + accessories;
	    	
	    	console.log(data);
	    	
	    	//alert(data);
	    		        		    
		    jQuery.ajax({
				type: "POST",
				url:  '/wp-admin/admin-ajax.php',
				data: 'action=dealer_update&' + data,
				dataType: "json",
				//async: false,
				
				success: function(result){
	
					alert(result.message);
					
				}
				
			}); //end ajax	
			
	});
});