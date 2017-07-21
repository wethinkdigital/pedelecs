$(function(){
	$('body').on('click', '.pdf_panel .delete', function () {    
    
    
    var div = $(this).parent();
   
    var this_image_id = div.attr('attachment_id');
    var this_post_id = div.attr('post_id');
    var this_prod_type = div.attr('prod_type');

    var attachment = 'post_id=' + this_image_id;

    //div.html('post_id is ' + post_id);

	   $.ajax({
			type: "POST",
			url:  "/wp-content/themes/pedelecs/manufacturer/functions/manu_delete_manual.php",
			data: attachment,
			dataType: "json",
			async: false,
			
			success: function(manual){

				$('#'+this_prod_type+'_manuals_panel').delay(2000).load('/wp-content/themes/pedelecs/manufacturer/includes/manu_list_manuals.php?' + Math.random()*99999, { post_id: this_post_id, prod_type: this_prod_type }).fadeIn();

			}
			
		}); //end ajax		
	
		

	});
});