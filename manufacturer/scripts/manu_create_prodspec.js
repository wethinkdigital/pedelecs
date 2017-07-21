$(function(){
	$('body').on('submit', '.create', function (e) {    

	// prevent default form action
    e.preventDefault();
    
    // check bike has a name/model
	var model = $(this).children('[name=model]');
    if(model.val() != '') {
    
    var newprod = $(this).serialize();
    
        		    
	    $.ajax({
	    
			type: "POST",
			url:  "/wp-content/themes/pedelecs/manufacturer/functions/manu_create_prodspec.php",
			data: newprod,
			dataType: "json",
			async: false,
			
			success: function(newspec){
			
			    var form = $('#'+newspec.prod_type+'form');
						
				// hide welcome
				$('.overlay').fadeOut(200);
			
				// clear previous form data
				$('#'+newspec.prod_type+'form input:text').val('');
				$('#'+newspec.prod_type+'form input:hidden').val('');
				$('#'+newspec.prod_type+'form input:checkbox').removeAttr('checked');
				$('#'+newspec.prod_type+'form select').val('');
				$('#'+newspec.prod_type+'form textarea').val('');
				$.uniform.update();
				
				// clear gallery
				$('#images .gallery').html('');

				// clear create form
				$('.create input[name="model"]').val('');

				// load model and post ID into main form
				$.each(newspec, function(key, value){
					$('#'+newspec.prod_type+'form [name="' + key + '"]').val(value);
				});
				$('#uploadimage input[name="post_id"]').val(newspec.post_id);


				// set page title
				$('#'+newspec.prod_type+'header h1').html(newspec.model);
				Cufon.replace('h1');
								
				// reload product list
				$('#'+newspec.prod_type+'list').load('/wp-content/themes/pedelecs/manufacturer/includes/manu_list_prods.php?' + Math.random()*99999, { prod_type: newspec.prod_type });
				
				// reload manuals
				$('#'+newspec.prod_type+'_manuals_panel').delay(2000).load('/wp-content/themes/pedelecs/manufacturer/includes/manu_list_manuals.php?' + Math.random()*99999, { post_id: newspec.post_id, prod_type: newspec.prod_type }).fadeIn();


				// open image panel
				$('#images').delay(500).animate({ height: '450px' }, 500 );
			}
			
		}); //end ajax		
		
		} // end check bike has name/model
		
	});
	
});


$(function(){
	$('.create input').keyup(function(){
		if($(this).val() != '') {
			$('.create input:submit').addClass('greenbutton').removeClass('greybutton').removeAttr('disabled');		
		} else {
			$('.create input:submit').addClass('greybutton').removeClass('greenbutton').attr('disabled','disabled');
		}
	});
});