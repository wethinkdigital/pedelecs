$(function(){
	$('body').on('click', '.update_prod', function (e) {    

	    //$('.updatebike').submit(function(e){
	    //e.preventDefault();
	    
		var form = $(this).closest('.specform');
	    if(form.find('[name=model]').val() != '') {
		
	    	var update_prod = form.serialize();
	    		        		    
		    $.ajax({
				type: "POST",
				url:  "/wp-content/themes/pedelecs/manufacturer/functions/manu_update_prodspec.php",
				data: update_prod,
				dataType: "json",
				//async: false,
				
				success: function(updatedspec){
					$('.update_prod').addClass('greybutton').removeClass('greenbutton').val('Save').attr('disabled','disabled');
					$('#'+updatedspec.prod_type+'list').load('/wp-content/themes/pedelecs/manufacturer/includes/manu_list_prods.php?' + Math.random()*99999, { prod_type: updatedspec.prod_type });
				}
				
			}); //end ajax	
			
			} // end check product has name/model	

	});
});

$(function(){

	
    function enablesave(form){
		if($(form).find('input[name=model]').val() != '') {
			$(form).find('.update_prod').addClass('greenbutton').removeClass('greybutton').val('Save changes').removeAttr('disabled');
        } else {
			$(find).find('.update_prod').addClass('greybutton').removeClass('greenbutton').val('Save').attr('disabled','disabled');
		}
	}

	
	$('.specform input, .specform textarea').keypress(function(){
	    var form = $(this).closest('.specform');
	    enablesave(form);
	});
        
	$('.specform input, .specform textarea, .specform select').change(function(){
	    var form = $(this).closest('.specform');
	    enablesave(form);
	});
	
	$('.specform input, .specform textarea').bind('paste', function(){
	    var form = $(this).closest('.specform');
	    enablesave(form);
	});
	
});