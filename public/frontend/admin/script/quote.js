var loadDataPopup = function()
{
	$(document).on('click', '.load_view_popup', function(event) {
		event.preventDefault();
		var src = $(this).data('src');
		$('.modalAction').find('iframe').attr('src', src);
	});
}

$(function(){
	loadDataPopup();
});