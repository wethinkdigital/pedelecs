$(function(){
	$('body').on('click', '.add_to_shortlist', function (){
		var name = $(this).siblings('[name=prodname]').val();
		var id = $(this).siblings('[name=prod_id]').val();

		if($('.shortlist_prod').length > 0) {
			$('#compare_submit').show();
		}

		if($('.shortlist_prod').length < 4) {
			$('#shortlist .prods').append(
				'<div class="shortlist_prod" id="sl_' + id + '">' + name + ' <span class="purple remove_from_shortlist">Remove</span><input type="hidden" name="prod_' + id + '" value="' + name + '" /></div>'
			);
			$('.clear_shortlist').show();
			$(this).hide();
		}
	});

	$('body').on('click', '.remove_from_shortlist', function (){
		var id = $(this).parent().attr('id');
		id = id.split('_');
		$('#' + id[1]).find('.add_to_shortlist').show();
		$(this).parent().remove();
		if($('.shortlist_prod').length == 0) { $('.clear_shortlist').hide(); }
		if($('.shortlist_prod').length < 2) {
			$('#compare_submit').hide();
		}

	});

	
	$('body').on('click', '.clear_shortlist', function (){
		$('#shortlist .prods').html('');
		$('.add_to_shortlist').show();
		$('#compare_submit').hide();
		$(this).hide();
	});
});