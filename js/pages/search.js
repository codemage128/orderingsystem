$(function(){
	$("#price-range").ionRangeSlider({
		min: 0,
        max: 100,
        type: 'double',
        step: 1,
        postfix: "&nbsp;$",
        hasGrid: false,
		onLoad: onPriceSliderLoad,
        onChange: onPriceSliderChange,
        onFinish: onPriceSliderFinish
	});
	$('#search-toggle').on('click', function(){
		if($('#search-toggle span').hasClass('glyphicon-arrow-up'))
		{
			$('#search-toggle span').removeClass('glyphicon-arrow-up');
			$('#search-toggle span').addClass('glyphicon-arrow-down');
		}
		else
		{
			$('#search-toggle span').addClass('glyphicon-arrow-up');
			$('#search-toggle span').removeClass('glyphicon-arrow-down');
		}
	});
	
	$('#category').on('change',function(){
		renderItems();
	});
	
	$.ajax({
		'url':$('#result').data('ajaxurl'),
		'success':function(data) {
			rawData = data;
			renderItems();		
		},
		'dataType':'json'
	});
	
});

var filterByCategory = function(category_id) {
	filteredData = [];
	
	if(category_id == -1)
	{
		filteredData = rawData;
	}
	else
	{
		var index = 0;
		for(var i=0; i<rawData.length; i++)
		{
			if(rawData[i].category_id == category_id)
			{
				filteredData[index] = rawData[i];
				index++;
			}
		}
	}
}

var onPriceSliderLoad = function(data) {
	minPrice = data.fromNumber;
	maxPrice = data.toNumber;
}

var onPriceSliderChange = function(data) {
	minPrice = data.fromNumber;
	maxPrice = data.toNumber;
	renderItems();
}

var onPriceSliderFinish = function(data) {
	minPrice = data.fromNumber;
	maxPrice = data.toNumber;
	renderItems();
}

var isInPriceRange = function(item)
{
	if(maxPrice>=100)
		return item.price>=minPrice;

	return item.price>=minPrice && item.price<=maxPrice;
}

var renderItems = function() {
	filterByCategory(parseInt($('#category').val()));

	$('#result').html('');
	var strResult = '';
	for(var i=0; i<filteredData.length; i++)
	{
		if (isInPriceRange(filteredData[i]))
		{
			strResult+=	'<div class="col-sm-6 col-md-4">'+
							'<div class="menu-item">'+
								'<div class="picture">'+
									'<img class="photo" src="'+filteredData[i].picture+'" />'+
									'<img class="rating" src="'+filteredData[i].rating+'" />'+
								'</div>'+
								'<div class="detail">'+
									'<a href="'+filteredData[i].url+'" class="orderbtn right">Detail</a>'+
									'<span class="name">'+filteredData[i].name+'</span><br/>'+
									'<span class="price">'+filteredData[i].price+'$</span>'+
								'</div>'+
							'</div>'+
						'</div>';
		}
	}
	$('#result').html(strResult);
	autoSizeMenuItem();
}
