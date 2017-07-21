$(function(){
	$('body').on('click', '.thumb img', function () {
			    
	    var imageid = $(this).parent().attr('attachment_id');
	    $(this).closest('.gallery').find('.imageholder').hide();
	    $('.imageholder#' + imageid).show();
	    
	});
});

