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

var changeActiveStage = function()
{
	$(document).on('change', '.change_active_stage', function(event) {
		event.preventDefault();
		parent = $(this).closest('.incredent_items');
		if ($(this).prop("checked") == true) {
			parent.find('.incredent_content').fadeIn();
		}else{
			parent.find('.incredent_content').fadeOut();	
		}
	});
}
$(function(){
	loadDataPopup();
	// submitPopUpAction();
	changeActiveStage();
});