$(function(){
	$('.btn-delete').on('click', function(){
		var elem = $(this);
		if(confirm('Are you sure?'))
		{
			$.ajax({
				'url': elem.data('ajaxurl'),
				'success': function() {
					elem.parent().parent().remove();
				}
			});
		}
	});
});