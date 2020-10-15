$(function(){
	$('.menu-order').on('mouseover',function(){
		$('.menu-order .action').show();
	}).on('mouseout', function(){
		$('.menu-order .action').hide();
	});
	
	$('.menu-order > .action > .btn').on('click', function(){
		$.ajax({
			'url':$(this).data('ajaxurl')+'/'+$('#menu_id').val(),
			'success':function() {
				toastr.success('An item has been successfuly added to your cart!');
			}
		});
	});
	
	
});