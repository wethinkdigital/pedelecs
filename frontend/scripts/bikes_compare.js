$(function(){
	$('.compare_sheet').hide();
	$('.compare_sheet:eq(0)').show();
	$('.compare_tab:eq(0)').addClass('active');
	
	$('.compare_tab').click(function(){
		$('.active').removeClass('active');
		$('.compare_sheet').hide();

		$(this).addClass('active');

		var id = $(this).attr('id').split('_');
		$('#compare_sheet_' + id[1]).show();
	});
});