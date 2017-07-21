(function($){
  $.fn.PedelecsSlider = function() {
          
	  
	
    var slider = this;
    var tray = this.find('ul');
    var item_width = this.find('.feature').width();
    
    var nextbutton = slider.children('.next');	
    var prevbutton = slider.children('.prev');	

    
	
	var auto_slide = true;
	var hover_pause = true;
	var auto_slide_delay = 6500;
	var speed = 900;
	
	//auto sliding
	if(auto_slide == true){
	autoslideint = setInterval( function() { $( '.next' ).trigger( 'click' ) }, auto_slide_delay );
	}
	
	//hover pause
	if((hover_pause == true) && (auto_slide == true)) {
	
		this.hover(function(){
			clearInterval(autoslideint);
			},
			function(){
				autoslideint = setInterval( function() { $( '.next' ).trigger( 'click' ) }, auto_slide_delay ); 
			});

	}
	
	
	// next slide
	var nextslide = function(){
	
		prevbutton.unbind('click',prevslide);	
		nextbutton.unbind('click',nextslide);	

	
		if(auto_slide == true){
				clearInterval(autoslideint);
			}
			
			tray.find('.feature:first').clone().appendTo(tray);
			Cufon.refresh();
			tray.animate({
				left: '-=' + item_width,
				
				}, speed, 'swing', function() {
				tray.find('.feature:first').remove();
				tray.css('left','0');
				prevbutton.bind('click',prevslide);	
				nextbutton.bind('click',nextslide);	
				
			});
			
			if(auto_slide == true){
				autoslideint = setInterval( function() { $( '.next' ).trigger( 'click' ) }, auto_slide_delay );
			}
	}
	
	
	//previous slide
	var prevslide = function(){
		
		prevbutton.unbind('click',prevslide);	
		nextbutton.unbind('click',nextslide);	

		if(auto_slide == true){
				clearInterval(autoslideint);
			}
			
			tray.find('.feature:last').clone().prependTo(tray);
			Cufon.refresh();
			tray.css('left',(item_width * -1));
			tray.animate({
				left: '+=' + item_width,
				}, speed, 'swing', function() {
				tray.find('.feature:last').remove();
				tray.css('left','0');
				prevbutton.bind('click',prevslide);	
				nextbutton.bind('click',nextslide);	
			});

/*
		if(auto_slide == true){
			autoslideint = setInterval( function() { $( '.prev' ).trigger( 'click' ) }, auto_slide_delay );
		}
*/
		
	}

	nextbutton.bind('click',nextslide);	
	prevbutton.bind('click',prevslide);
	
	


  };
})(jQuery);