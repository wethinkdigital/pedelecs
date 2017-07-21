$(function(){
	$('#bike_dealer_search').click(function(){  
	
    	bike_dealer_postcode_search().done(function(dealers){
    		bikelistdealers(dealers);
    	});  

    	bike_online_dealer_search().done(function(onlinedealers){
    		bikelistonlinedealers(onlinedealers);
    	});  

	});
});

function bike_dealer_postcode_search(){

    var searchdata = $('#distance_search').serialize();
    	
    return $.ajax({
    	type: "POST",
    	url:  '/wp-content/themes/pedelecs/frontend/functions/dealer_postcode_search.php',
    	data: searchdata,
    	dataType: "json",
    });

}

function bike_online_dealer_search(){

    var onlinesearchdata = $('#distance_search').serialize();
    	
    return $.ajax({
    	type: "POST",
    	url:  '/wp-content/themes/pedelecs/frontend/functions/online_dealer_search.php',
    	data: onlinesearchdata,
    	dataType: "json",
    });

}

function bikelistdealers(dealers){			
	
	$('#in_range_dealers').html('');
	if(dealers.length > 0) {
    $('#in_range_dealers').append('<h5 style="margin-top: 30px; color: white;">Your closest stockists</h5>');    	
	}		

    // premium dealers
    
    var premium_ul = document.createElement('ul');

    $('#in_range_dealers').append(premium_ul);
    			    
    $.each(dealers, function() {
        if(this.roles[0] == 'dealer_premium' && this.data.meta.dealer_type != 'online'){
        
        var dealer_premium = document.createElement('li');
          
         $(premium_ul).append(dealer_premium); 
        if(this.data.logo_img != ''){
          $(dealer_premium).append('<img src="'+this.data.logo_img[0]+'" class="fl" />'); 
          }

          $(dealer_premium).append('<p style="font-size: 14px; display: block; max-width: 170px;"><strong><a href="/dealer/'+this.data.user_nicename+'">'+this.data.display_name+'</a></strong></p>');  
          $(dealer_premium).append('<label class="distance">'+this.data.check_distance+' miles</label>');
          $(dealer_premium).append('<div class="clear"></div>');

        } // end is dealer				
					
	}); // end each

    // standard dealers
    
    var standard_ul = document.createElement('ul');

    $('#in_range_dealers').append(standard_ul);
    			    
    $.each(dealers, function() {
        if(this.roles[0] == 'dealer' && this.data.meta.dealer_type != 'online'){
        
        var dealer_standard = document.createElement('li');
          
         $(standard_ul).append(dealer_standard); 

          $(dealer_standard).append('<p style="font-size: 12px; display: block; max-width: 170px;"><strong><a href="/dealer/'+this.data.user_nicename+'">'+this.data.display_name+'</a></strong></p>');  
          $(dealer_standard).append('<label class="distance" style="font-size: 12px;">'+this.data.check_distance+' miles</label>');
          $(dealer_standard).append('<div class="clear"></div>');

        } // end is dealer				
					
	}); // end each

			
} // end complete	


function bikelistonlinedealers(onlinedealers){			
	
	$('#online_dealers').html('');		



    $('#online_dealers').append('<h5 style="margin-top: 30px; color: white; display: none;" class="onlineh5">Buy online now</h5>');

	
    // online dealers
    
    var online_ul = document.createElement('ul');

    $('#online_dealers').append(online_ul);
    			    
    $.each(onlinedealers, function() {
        if(this.data.meta.dealer_type == 'online' || this.data.meta.dealer_type == 'both'){
        
        $('.onlineh5').show();
        
        var dealer_online = document.createElement('li');
          
         $(online_ul).append(dealer_online); 

         if(this.data.bike_query.retailer_url != '') {
             var link = this.data.bike_query.retailer_url;
             if (!link.match(/^[a-zA-Z]+:\/\//)) { link = 'http://' + link; }
             $(dealer_online).append('<p style="font-size: 12px; display: block; max-width: 170px;"><strong><a href="'+link+'" target="_blank">'+this.data.display_name+'</a></strong></p>');
         } else {
             var link = '/dealer/'+this.data.user_nicename;
             $(dealer_online).append('<p style="font-size: 12px; display: block; max-width: 170px;"><strong><a href="'+link+'">'+this.data.display_name+'</a></strong></p>');
         }
          
          
          /*
var this_bike_stock_data = this.data.meta.bike_stock.filter(function(val) {
                return val.id === "460";
            });
*/
          //$(dealer_online).append(link);
          $(dealer_online).append('<div class="clear"></div>');

        } // end is dealer				
					
	}); // end each

			
} // end complete	

