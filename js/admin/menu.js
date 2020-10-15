$(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	
	setDelButtonListener();
	
	$('#add-picture-btn').on('click', function(){
		if($('#file').val())
		{
			var formData = new FormData($('#picture-form')[0]);
			//var formData = new FormData($('#file')[0].files[0]);
			console.log(formData);
			$.ajax({
				url:$('#add-picture-btn').data('uploadurl'),
				type:'post',
				// data: "AAAA",
				data:formData,
				dataType:'json',
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success:appendPicture
			});
			
			$('#file').val('');
		}
	});
});

var appendPicture = function(data) {
	$('#picture-table tbody').append($('<tr/>')
									.append($('<td/>'))
									.append($('<td/>')
											.append('<img style="width:100%;" src="'+data.url+'"/>'))
//									.append($('<td/>'))
									.append($('<td/>')
											.append('<button data-id="'+data.id+'" class="btn btn-danger delbtn"><span class="glyphicon glyphicon-trash"></span> Delete</button>')));

	$('#pictures').append('<input type="hidden" name="picture['+data.id+']" id="picture-'+data.id+'" value="'+data.id+'" />')
				.append('<input type="hidden" name="url['+data.id+']" id="url-'+data.id+'" value="'+data.url+'" />');
	setDelButtonListener();
}

var setDelButtonListener = function() {
	$('.delbtn').on('click', function(){
		if(confirm('Are you sure?'))
		{
			var elem = $(this);
			$.ajax({
				url:$('#add-picture-btn').data('deleteurl')+'/'+elem.data('id'),
				success:function(){
					$('#picture-'+elem.data('id')).remove();
					$('#url-'+elem.data('id')).remove();
					elem.parent().parent().remove();
				}
			});
		}
	});
}

