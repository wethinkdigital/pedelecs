$(function(){
	$('body').on('submit', '.prodload', function (e) {    

    e.preventDefault();

    var loadprod = $(this).serialize();
        		    
	    $.ajax({
			type: "POST",
			url:  "/wp-content/themes/pedelecs/manufacturer/functions/manu_read_prodspec.php",
			data: loadprod,
			dataType: "json",
			async: false,
			
			success: function(readspec){
						
				$('#prodheader h1').html(readspec.model);
				Cufon.replace('h1');
				
				// hide welcome
				$('.overlay').fadeOut(200);

				// clear previous form data
				$('#'+readspec.prod_type+'form input:text').val('');
				$('#'+readspec.prod_type+'form input:hidden').not('.brand').val('');
				$('#'+readspec.prod_type+'form input:checkbox').removeAttr('checked');
				$('#'+readspec.prod_type+'form select').val('');
				$('#'+readspec.prod_type+'form textarea').val('');
				
				// load returned form data
				$.each(readspec, function(key, value){
					$('#'+readspec.prod_type+'form input:hidden[name="' + key + '"]').not('.brand').val(value);
					$('#'+readspec.prod_type+'form input:text[name="' + key + '"]').val(value);
					$('#'+readspec.prod_type+'form textarea[name="' + key + '"]').val(value);
					$('#'+readspec.prod_type+'form input:checkbox[name="' + key + '"][value="' + value + '"]').prop('checked',true);
					$('#'+readspec.prod_type+'form select[name="' + key + '"]').find('option[value="' + value + '"]').prop('selected',true);
				});
				
/*
				if(readspec.brand == '') {
					//$('#'+readspec.prod_type+'form').find('input[name="brand"]').val(brand);
				}
*/
				
				
				$('#uploadimage input[name="post_id"]').val(readspec.post_id);
				$('#linkvideo input[name="post_id"]').val(readspec.post_id);
				
				$.uniform.update();

				// set form form action to 'update'
				$('#'+readspec.prod_type+'form').addClass('updatebike').removeClass('createbike');
				
				// load  images
				$('#images .gallery').delay(5000).load('/wp-content/themes/pedelecs/manufacturer/functions/manu_read_images.php?' + Math.random()*99999, { post_id: readspec.post_id }).fadeIn();
				
				
				// open image panel if closed, and scroll window to match
				if($('#images').height() < 30) {
					$('html, body').delay(500).animate({scrollTop: '+=450px'}, 500);
				}
				$('#images').delay(500).animate({ height: '450px' }, 500 );
				
				// load manuals
				$('#'+readspec.prod_type+'_manuals_panel').load('/wp-content/themes/pedelecs/manufacturer/includes/manu_list_manuals.php?' + Math.random()*99999, { post_id: readspec.post_id, prod_type: readspec.prod_type }).fadeIn();
				
				// load href for view button
				$('.viewlink').attr('href','/?p=' + readspec.post_id).show();
				
				// set save button to disabled
				$('#'+readspec.prod_type+'form input:submit').addClass('greybutton').removeClass('greenbutton').val('Save').attr('disabled','disabled');

								
			}
			
		}); //end ajax		

	});
});