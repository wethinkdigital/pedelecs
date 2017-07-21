$(function(){
	$('body').on('click', '.prodload input[name=delete]', function () {    

    var deleteprod = $(this).parent().serialize();
            		    
	    $.ajax({
			type: "POST",
			url:  "/wp-content/themes/pedelecs/manufacturer/functions/manu_delete_prodspec.php",
			data: deleteprod,
			dataType: "json",
			async: false,
			
			success: function(deletedspec){
								
				// reload product list
				$('#'+deletedspec.prod_type+'list').load('/wp-content/themes/pedelecs/manufacturer/includes/manu_list_prods.php?' + Math.random()*99999, { prod_type: deletedspec.prod_type });

			}
			
		}); //end ajax		

	}); 
});