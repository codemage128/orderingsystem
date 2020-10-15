$(function(){
	autoSizeMenuItem();
});

$(window).resize(function(){
	autoSizeMenuItem();
});

var autoSizeMenuItem = function() {
	$('.menu-item > .picture').height($('.menu-item > .picture').width()*0.75);
}