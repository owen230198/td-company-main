var loadDataPopup = function()
{
	$(document).on('click', '.load_view_popup', function(event) {
		event.preventDefault();
		var src = $(this).data('src');
		$('.modalAction').find('iframe').attr('src', src);
	});
}

var submitPopUpAction = function()
{
	$(document).on('submit', '.popupActionForm', function(event) {
		event.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      data: $(this).serialize(),
    })
    .done(function(data) {
      var json = JSON.parse(data);
      if((json.code) == 200){
        $('.close_action_popup', parent.document).trigger('click');
        window.parent.toastr['success'](json.message+'');
        setTimeout(function()
        {
          window.parent.location.reload();
        },1000); 
      }else{
        toastr['error'](json.message);
      }  
    })
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

var selectConfigs = function() {
  if($('select.select_config').length > 0){
    $('select.select_config').select2({
      minimumResultsForSearch: 1
    });
  };
};
var getExQuantityPaper = function(allqty, valqty, addqty)
{
	qty = allqty/valqty;
    add_qty = qty*addqty/100;
    ex_qty = qty+add_qty;
    return ex_qty;
}
var changQtyInput = function(){
  $(document).on('change','input[name=n_qty]',function(e){
    e.preventDefault();
    parent = $(this).closest('.formActionS');
    var allqty = parseInt(parent.find('input[name=qty_pro]').val());
    var valqty = parseInt($(this).val());
    var addqty = parseInt(parent.find('input[name=add_paper]').val());
    ex_qty = getExQuantityPaper(allqty, valqty, addqty);
    parent.find('input[name=qty_paper]').val(Math.ceil(ex_qty));
   });

  $(document).on('change','input[name=qty_pro]',function(e){
    e.preventDefault();
    parent = $(this).closest('.formActionS');
    var allqty = $(this).val();
    var valqty = parseInt(parent.find('input[name=n_qty]').val());
    var addqty = parent.find('input[name=add_paper]').val();
    ex_qty = getExQuantityPaper(allqty, valqty, addqty);
    parent.find('input[name=qty_paper]').val(Math.ceil(ex_qty));
   });
}

var moduleSelectOther = function()
{
  $(document).on('change', 'select.select_other', function(event) {
    event.preventDefault();
    parent = $(this).closest('.group_select_other').find('.input_add');
    if ($(this).val()==$(this).data('expland')) {
      console.log(parent);
      parent.fadeIn();
      parent.find('input').prop('disabled', false);
    }else{
      parent.fadeOut();
      parent.find('input').prop('disabled', true);
    }
  });
}

$(function(){
	loadDataPopup();
	submitPopUpAction();
	// selectConfigs();
	changeActiveStage();
	changQtyInput();
  moduleSelectOther();
});