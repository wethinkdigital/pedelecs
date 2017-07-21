$(function() {
    $( ".sortable" ).sortable();
	  	$(".gallery").on("DOMSubtreeModified", function() { 
		    $( ".sortable" ).sortable({
			    update: function(event, ui) {			    
					$.post("/wp-content/themes/pedelecs/dealer/functions/dealer_reorder_images.php", { images: $('.sortable').sortable('serialize'),user_id: $('#user_id') .val()}, 'json' );
				}
		    });
		    //$( ".thumbnails" ).disableSelection();
            console.log(images);
		});
					
	  });