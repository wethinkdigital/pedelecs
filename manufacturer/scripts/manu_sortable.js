$(function() {
	  	$(".gallery").on("DOMSubtreeModified", function() { 
		    $( ".sortable" ).sortable({
			    update: function(event, ui) {			    
					$.post("/wp-content/themes/pedelecs/manufacturer/functions/manu_reorder_images.php", { images: $('.sortable').sortable('serialize') }, 'json' );
				}
		    });
		    //$( ".thumbnails" ).disableSelection();
		});			
	  });