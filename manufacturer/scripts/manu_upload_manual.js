$(function(){
	$('body').on('submit', '.manuals ', function () {    
		    
	    var this_post_id = $(this).find('input[name=post_id]').val();
	
		$(this).find('iframe').load(function() {
			$(this).parent().delay(2000).load('/wp-content/themes/pedelecs/manufacturer/includes/manu_list_manuals.php?' + Math.random()*99999, { post_id: this_post_id }).fadeIn();
		});
	
	});
});

$(function(){
	$('body').on('change', '.manuals input:file', function () {    
			$(this).closest('.manuals').find('input:submit').addClass('greenbutton').removeClass('greybutton').removeAttr('disabled');		
	});
});