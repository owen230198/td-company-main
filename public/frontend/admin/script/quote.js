var loadDataPopup = function()
{
	$(document).on('click', '.load_view_popup', function(event) {
		event.preventDefault();
		var src = $(this).data('src');
		console.log($('.modalAction '));
		$('.modalAction').find('iframe').attr('src', src);
	});
}

var submitPopUpAction = function()
{
	$(document).on('submit', '.popupActionForm', function(event) {
		event.preventDefault();
		$('.close_action_popup', parent.document).trigger('click');
		window.parent.toastr['success']('Nguyen duy khanh');
	});
}

$(function(){
	loadDataPopup();
	submitPopUpAction();
});