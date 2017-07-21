$(function(){

	$('body').on('submit', '#bikesearch', function (e) {    
    e.preventDefault();

	if($('#advanced_options').height() < 10 ) {
		var searchvars = $(this).find('.basic').serialize();
		//alert(JSON.stringify(searchvars));
	} else {
		var searchvars = $(this).serialize();
		//alert(JSON.stringify(searchvars));
	}
	
	console.log(searchvars);
        		    
	    $.ajax({
			type: "POST",
			url:  "/wp-content/themes/pedelecs/frontend/functions/front_search_bikes.php",
			data: searchvars,
			dataType: "json",
			async: false,
			
			success: function(returned_bikes){
			
				//console.log(returned_bikes.length);
				
				$('#rightcol').html('');
				
				if(returned_bikes.length > 0) {
				
				    $('#results_count').html(returned_bikes.length + ' bikes found');
				    
				
					$.each( returned_bikes, function() {
						
						var s = this.description;
					    excerpt = s.split(' ').slice(0,24).join(' ');
					    
						if(typeof(this.rrp) != 'undefined' && this.rrp != '') {
					    var rrp = parseFloat(this.rrp).toFixed(2);
					    }
	
						var result = '<form action="' + this.permalink + '" method="post"><input type="hidden" name="search_query" value="searchvars" /><div class="prodresult" id="' + this.id + '">';
						
						if(typeof(this.image) != 'undefined' && this.image != '') {
						result += '<span onclick="$(this).closest(\'form\').submit();" style="cursor: pointer;">' + this.image + '</span>';
						}
						
						result += '<div class="text fr"><h4 onclick="$(this).closest(\'form\').submit();" style="cursor: pointer;">' + this.brand + ' ' + this.model + '</h4><div class="excerpt fl"><p>' + excerpt + '... <span onclick="$(this).closest(\'form\').submit();" style="cursor: pointer;">read more</span></p></div><div class="spec fr">';
						
						if(typeof(this.frame_style) != 'undefined' && this.frame_style != '') {
						result += '<p>Style: <strong>' + this.frame_style + '</strong></p>';
						}
	
						if(typeof(this.motor_position) != 'undefined' && this.motor_position != '') {
						result += '<p>Motor: <strong>' + this.motor_position + '</strong></p>';
						}
						
						if(typeof(this.weight) != 'undefined' && this.weight != '') {
						result += '<p>Weight: <strong>' + this.weight + 'kg</strong></p>';
						}
	
						if(typeof(rrp) != 'undefined' && rrp != '0.00') {
						result += '<p>RRP: <strong>&pound;' + rrp + '</strong></p>';
						}
						
						result += '<p class="purple add_to_shortlist">Add to shortlist</p><input type="hidden" name="prodname" value="' + this.brand + ' ' + this.model + '" /><input type="hidden" name="prod_id" value="' + this.id + '" /></div></div><div class="clear"></div></div></form>';
											
						$('#rightcol').append(result);
					
					}); // end each
				
				} else {
					$('#rightcol').append('<h3>Sorry, there are no bikes matching your search</h3><p>Please broaden your search for more results</p>');
				}

				Cufon.refresh();

								
			}
			
		}); //end ajax		

	});
});