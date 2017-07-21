var oldMarkers = [];

function drawmap(){


google.maps.visualRefresh = true;

var pairs = $('#postcode_search').serialize().split('&');

post_array = new Object();

for(i = 0; i < pairs.length; i++){
    m = pairs[i].split("=");
    post_array[m[0]] = m[1];
}

if(post_array.user_distance == ''){ post_array.user_distance = '9999'; }
//if(post_array.user_postcode == ''){ post_array.user_postcode = 'LE157RG'; }

post_array.user_postcode = post_array.user_postcode.replace('+','');
		
$.ajax({
	type: "POST",
	url:  '/wp-content/themes/pedelecs/frontend/functions/latlng.php',
	data: post_array,
	dataType: "json",
	async: false,
	
	success: function(result){
			
		var zoom_lvl;
		var map_shift;
		
		
		if(result.distance > 50) { zoom_lvl = 6; map_shift_lat = 54.65; map_shift_lng = -6.5; }
		if(result.distance == 50) { zoom_lvl = 8; map_shift_lat = 0; map_shift_lng = -0.7; }
		if(result.distance == 20) { zoom_lvl = 9; map_shift_lat = 0.03; map_shift_lng = -0.3; }
		if(result.distance == 10) { zoom_lvl = 10; map_shift_lat = 0; map_shift_lng = -0.2; }
		if(result.distance == 5) { zoom_lvl = 11; map_shift_lat = 0; map_shift_lng = -0.1; }

		//alert('distance: ' + result.distance + ' zoom level: ' + zoom_lvl + ' map shift: ' + map_shift);

		var centermap = new google.maps.LatLng(result.lat + map_shift_lat,result.lng + map_shift_lng);

		var mapOptions = {
		    scrollwheel: false,
			mapTypeControl: false,
			zoom: zoom_lvl,
		    center: centermap,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		};
				
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

		
		var script = document.createElement('script');
        var url = ['https://www.googleapis.com/fusiontables/v1/query?'];
        url.push('sql=');
        
        var query = 'SELECT name, geometry FROM ' + '1rIQjZVivYksXY1vrRpJ31u9Lq2sS2XkwUDHJG1U';
        
        var encodedQuery = encodeURIComponent(query);
        url.push(encodedQuery);
        url.push('&callback=drawcounties');
        url.push('&key=AIzaSyDW2xwuvJW2pbA9NUo-qIk44m4NE-PKtHA');
        script.src = url.join('');
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(script);
        
        		
		
	}
});



}




function drawcounties(data) {

	//alert('drawcounties');
	console.log(data);

	var rows = data['rows'];
	
	for (var i in rows) {
		var newCoordinates = [];
		var geometries = rows[i][1]['geometries'];
		var countyname = rows[i][0];
		
		if (geometries) {
			for (var j in geometries) {
			newCoordinates.push(constructNewCoordinates(geometries[j]));
			}
		} else {
			newCoordinates = constructNewCoordinates(rows[i][1]['geometry']);
		}
		
		var county = new google.maps.Polygon({
			name: countyname,
			paths: newCoordinates,
			strokeColor: '#000000',
			strokeOpacity: 0.1,
			strokeWeight: 1,
			fillColor: '#552C62',
			fillOpacity: 0
		});

		
		county.setMap(map);
		
		google.maps.event.addListener(county, 'click', function() {
			run_search('county',this.name);
		});
		
		google.maps.event.addListener(county, 'mouseover', function() {
			this.setOptions({fillOpacity: 0.3});
		});
		
		google.maps.event.addListener(county, 'mouseout', function() {
			this.setOptions({fillOpacity: 0});
		});
	}
	
}


function constructNewCoordinates(polygon) {
	//alert('constructNewCoordinates');

	var newCoordinates = [];
	var coordinates = polygon['coordinates'][0];
	
	for (var i in coordinates) {
		newCoordinates.push(
		new google.maps.LatLng(coordinates[i][1], coordinates[i][0]));
	}
	
	return newCoordinates;
}




function run_search(searchtype,county){

	
	if(oldMarkers && oldMarkers.length !== 0){
        for(var i = 0; i < oldMarkers.length; ++i){
            oldMarkers[i].setMap(null);
        }
    }

        
	$('#loading').fadeIn();

	if(searchtype == 'postcode') {
		dealer_postcode_search().done(function(dealers){
			placemarkers(dealers);
			listdealers(dealers,searchtype);
		});		
	} else if(searchtype == 'county') {
		dealer_county_search(UCFirst(county)).done(function(dealers){
			placemarkers(dealers);
			listdealers(dealers,searchtype,UCFirst(county));
		});	
	} else  {
		dealer_showall().done(function(dealers){
			placemarkers(dealers);
		});		
	}			
	
}



function dealer_postcode_search(){

var searchdata = $('#postcode_search').serialize();
//alert(searchdata);
	
return $.ajax({
	type: "POST",
	url:  '/wp-content/themes/pedelecs/frontend/functions/dealer_postcode_search.php',
	data: searchdata,
	dataType: "json",
});

}

function dealer_showall(){

//var searchdata = $('#postcode_search').serialize();
//alert(searchdata);
	
return $.ajax({
	type: "POST",
	url:  '/wp-content/themes/pedelecs/frontend/functions/dealer_showall.php',
	dataType: "json",
});

}


function dealer_county_search(county){

var searchdata = 'user_county=' + county;
//alert(searchdata);
	
return $.ajax({
	type: "POST",
	url:  '/wp-content/themes/pedelecs/frontend/functions/dealer_county_search.php',
	data: searchdata,
	dataType: "json",
});

}



function placemarkers(dealers){

		// alert(dealers.length);
	
		$.each(dealers, function(){
					
			if(this.data.meta.loc_lat != '' && this.data.meta.loc_lng != ''){
			
				if(this.roles[0] == 'dealer_premium'){ 
					
				  	var pin = {
				    url: 'http://www.pedelecs.co.uk/wp-content/themes/pedelecs/img/pin_large.png',
				    size: new google.maps.Size(28, 36),
				    origin: new google.maps.Point(0,0),
				    anchor: new google.maps.Point(0, 36)
				    };
	
				  	var shadow = {
				    url: 'http://www.pedelecs.co.uk/wp-content/themes/pedelecs/img/pin_large_shadow.png',
				    size: new google.maps.Size(37, 27),
				    origin: new google.maps.Point(0,0),
				    anchor: new google.maps.Point(-12, 27)
					};
					
				} else {
					
				  	var pin = {
				    url: 'http://www.pedelecs.co.uk/wp-content/themes/pedelecs/img/pin_small.png',
				    size: new google.maps.Size(19, 24),
				    origin: new google.maps.Point(0,0),
				    anchor: new google.maps.Point(0, 24)
				    };
	
				  	var shadow = {
				    url: 'http://www.pedelecs.co.uk/wp-content/themes/pedelecs/img/pin_small_shadow.png',
				    size: new google.maps.Size(25, 18),
				    origin: new google.maps.Point(0,0),
				    anchor: new google.maps.Point(-8, 18)
				    };
					
				}
				
			
				var marker = new google.maps.LatLng(this.data.meta.loc_lat,this.data.meta.loc_lng);
				marker = new google.maps.Marker({
				    map:map,
				    animation: google.maps.Animation.DROP,
				    draggable:false,
				    position: marker,
					icon: pin,
					shadow: shadow,
					url: '/dealer/' + this.data.user_nicename
				});
				
				oldMarkers.push(marker);
				
				var boxText = document.createElement("div");
				boxText.style.cssText = 'margin-top: 8px; background: #F5F5F5; padding: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.4);';
				boxText.innerHTML = '<h5 class="purple">' + this.data.display_name + '</h5>';
				if(typeof this.data.meta.address_1 != 'undefined') { boxText.innerHTML += '<p>' + this.data.meta.address_1[0] + '<br />' + this.data.meta.address_2[0] + '</p>'; }
				
				if(this.roles[0] == 'dealer_premium' && typeof this.data.meta.dealer_type != 'undefined') {
				    var dealerDesc = '';
				    if(this.data.meta.dealer_type == 'retail') var dealerDesc = 'Store';
				    if(this.data.meta.dealer_type == 'online') var dealerDesc = 'Online';
				    if(this.data.meta.dealer_type == 'both') var dealerDesc = 'Store and online';
                    boxText.innerHTML += '<p>Dealer type: ' + dealerDesc + '</p>';
				}
				
                if(typeof this.data.stocks_prod_type != 'undefined'){
                    if(this.data.stocks_prod_type['bike'] == true){
                        boxText.innerHTML += '<img src="/wp-content/themes/pedelecs/img/prod-type-bullet-bike.png" class="fl" style="margin-right: 3px;" />';
                    }
                    
                    if(this.data.stocks_prod_type['ckit'] == true){
                        boxText.innerHTML += '<img src="/wp-content/themes/pedelecs/img/prod-type-bullet-ckit.png" class="fl" style="margin-right: 3px;" />';
                    }
    
                    boxText.innerHTML += '<div class="clear"></div>';
                }

				                
				var myOptions = {
	                 content: boxText
	                ,disableAutoPan: false
	                ,maxWidth: 0
	                ,pixelOffset: new google.maps.Size(20, -10)
	                ,zIndex: null
	                ,boxStyle: { 
	                  background: "url('tipbox.gif') no-repeat"
	                  ,opacity: 1
	                  ,width: "200px"
	                 }
	                ,closeBoxMargin: "10px 2px 2px 2px"
	                ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
	                ,infoBoxClearance: new google.maps.Size(1, 1)
	                ,isHidden: false
	                ,pane: "floatPane"
	                ,enableEventPropagation: false
				};

				var ib = new InfoBox(myOptions);
				Cufon.refresh();
				
				google.maps.event.addListener(marker, 'mouseover', function() {
				
    				var overlay = new google.maps.OverlayView();
                    overlay.draw = function() {};
                    overlay.setMap(map);
                    
                    var proj = overlay.getProjection();
                    var pos = marker.getPosition();
                    var p = proj.fromLatLngToContainerPixel(pos);
				
                    if(p.y < 300) { 

                    }
				
					ib.open(map, marker);
					Cufon.refresh();
				});

				google.maps.event.addListener(marker, 'mouseout', function() {
					ib.close(map, marker);
				});
				
				google.maps.event.addListener(marker, 'click', function() {
				    window.location.href = marker.url;
				});


			} // end lat and lng not NULL
		
		}); // end each
		
	$('#loading').fadeOut();
	
}


function listdealers(dealers,searchtype,county){
	$('#dealer_listings_panel').fadeIn();
	$('#dealer_listings').html('').animate({ height: "550px" }, 300);
	
	if(dealers.length > 0) {
			
		if(searchtype == 'postcode') {
			var user_postcode = $('#user_postcode').val();
			if(user_postcode) $('#dealer_listings').append('<h4 class="purple">Dealers near '+ user_postcode + '</h4>');
		} else if (searchtype == 'county'){
			if(county) $('#dealer_listings').append('<h4 class="purple">Dealers in '+ county + '</h4>');
		} else {
			// do nothing
		}
	} else {
	    //var county_message = ''
	    //if(typeof(county) != undefined) { county_message = ' in ' + county; }
		$('#dealer_listings').append('<h4 class="purple">No dealers found, please broaden your search.</h4>');
	}



	var premium = false;
	
	$.each(dealers, function(){ // list 'premium' dealers
		if(this.roles[0] == 'dealer_premium'){
			premium = true;
			
			if(typeof dealer_premium != 'undefined') { dealer_premium = null; }
			var dealer_premium = document.createElement('div');
			dealer_premium.className = 'dealer_premium fl';

			if(typeof this.data.meta.logo_url != 'undefined' && this.data.meta.logo_url[0] != ''){
				$(dealer_premium).append('<a href="/dealer/' + this.data.user_nicename + '"><img class="fl" style="margin: 0 6px 6px 0;" src="' + this.data.meta.logo_url[0] + '" /></a>');
			}

			$(dealer_premium).append('<p><strong><a href="/dealer/' + this.data.user_nicename + '">' + this.data.meta.nickname + '</a></strong></p>');
			$(dealer_premium).append('<div class="clear"></div>');
			if(typeof this.data.meta.telephone != 'undefined') $(dealer_premium).append('Tel: ' + this.data.meta.telephone + '<br />');
			if(typeof this.data.meta.email != 'undefined') $(dealer_premium).append('Email: ' + this.data.meta.email + '<br />');
			if(typeof this.data.meta.url != 'undefined') {
				var dealer_url = this.data.meta.url.toString();
				dealer_url = dealer_url.replace(/.*?:\/\//g, "");
				dealer_url = dealer_url.replace(/\/$/, '');
				$(dealer_premium).append('Web: ' + dealer_url + '<br />');
			}
			$(dealer_premium).append('<div class="clear"></div>');
			$('#dealer_listings').append(dealer_premium);
		}
	});

	if(premium){ $('#dealer_listings').append('<div class="clear"></div><hr><div class="clear"></div>'); }
			
	$.each(dealers, function(){ // list 'standard' dealers
		if(this.roles[0] == 'dealer'){
		
			if(typeof dealer_standard != 'undefined') { dealer_standard = null; }

			var dealer_standard = document.createElement('p');
			dealer_standard.className = 'dealer_standard';
			$('#dealer_listings').append(dealer_standard);

			
			$(dealer_standard).append('<strong style="margin-bottom: 2px;">' + this.data.meta.nickname + '</strong><br />');
			if(typeof this.data.meta.address_1 != 'undefined' && this.data.meta.address_1 != '') $(dealer_standard).append(this.data.meta.address_1[0] + '<br />');
			if(typeof this.data.meta.address_2 != 'undefined' && this.data.meta.address_2 != '') $(dealer_standard).append(this.data.meta.address_2[0] + '<br />');
			if(typeof this.data.meta.town != 'undefined' && this.data.meta.town != '') $(dealer_standard).append(this.data.meta.town[0] + '<br />');
			if(typeof this.data.meta.telephone != 'undefined' && this.data.meta.telephone != '') $(dealer_standard).append('Tel: ' + this.data.meta.telephone + '<br />');
			//if(typeof this.data.meta.town != 'undefined') $('#dealer_listings').append(this.data.meta.town);
			$('#dealer_listings').append('</p>');
		}
	});
	
	Cufon.refresh();


	google.maps.event.trigger(map, 'resize');
	
	scroll_to_results();

}

function scroll_to_results(){
	$('html, body').animate({
        scrollTop: $("#postcode_search").offset().top
    }, 500);
}

function UCFirst(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}