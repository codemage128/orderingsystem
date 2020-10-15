$(function(){
	reinitIndex();
	
	$('#btn-save').on('click', function(){
		var suc = 0;
		$('#category-list td.edit').each(function(){
			var elem = $(this);
			var id = elem.find('input[type="hidden"]').val();
			var name = elem.find('input[type="text"]').val();
			$.ajax({
				url:$('#category-list').data('ajaxurl')+'/'+id+'/'+name,
				dataType:'json',
				success:function(data){
					elem.find('input[type="hidden"]').val(data.id);
					suc++;
					if(cnt == suc)
					{
						alert('success');
					}
				}
			});
		});
	});
	
	$('#btn-add').on('click', function(){
		$('#category-list tbody').append($('<tr/>')
										.append($('<td/>').addClass('index'))
										.append($('<td/>').addClass('edit')
												.append('<input type="hidden" value="0" /><input type="text" />'))
										.append($('<td/>')));
		reinitIndex();
	});
});

var reinitIndex = function()
{
	var index=0;
	$('#category-list td.index').each(function(){
		var elem = $(this);
		index++;
		elem.html(index)
	});
	cnt = index;
}