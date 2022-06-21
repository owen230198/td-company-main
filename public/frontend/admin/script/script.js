var submitActionAjaxForm = function()
{
	$('.adminAjaxForm').submit(function(e) {
      e.preventDefault();
	  table = $(this).data('table-name');
      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
      })
      .done(function(data) {
	    var json = JSON.parse(data);
	    if((json.code) == 200){
	    	$('input[name=csrf_test_name]').val(json.token);
	        toastr['success'](json.message);
		    if (table!='no_reload') {
		    	setTimeout(function()
		        {
		        	window.location.href='admin/view/'+table;
		        },300);
		    }
	    }
	    else{
		    $('input[name=csrf_test_name]').val(json.token);
	      	toastr['error'](json.message);
	    }  
      })
    });
}

var confirmRemoveData = function()
{
	$(document).on('click', '.delete_btn', function(event) {
		event.preventDefault();
		var id = $(this).data('id');
		$( "input[name=remove_id]" ).val(id);
	});
}

var checkBoxModule = function()
{
	$(document).on('change', '.checkbox_module input[type=checkbox]', function(event) {
		parent = $(this).closest('.checkbox_module');
		val = $(this).is(':checked')?1:0;
		parent.find('input[type=hidden]').val(val);		
	});	
}

var changeSubmit = function()
{
	$(document).on('change', '.change_submit', function(event) {
	event.preventDefault(event);
		$(this).closest('form').submit();
	});
}

var numberInputPrevent = function()
{
	$('input[type=number]').bind('paste', function(){
    	this.value = this.value.replace(/[^0-9]/g, '');
  	});
  	$('input[type=number]').bind('keyup', function(){
    	this.value = this.value.replace(/[^0-9]/g, '');
  	});
}

var usernameInputPrevent = function()
{
	$('input[name=username]').keypress(function (e) {
	  	var txt = String.fromCharCode(e.which);
	  	if (!txt.match(/[A-Za-z0-9&. ]/)) {
	      	return false;
	  	}
		if(e.which === 32) 
		    return false;
	});

	$('input[name=username]').bind('paste', function(e) {
	 	 setTimeout(function() { 
	    	var value = $('input[name=username]').val();
	    	var updated = value.replace(/[^A-Za-z0-9&. ]/g, '');
	    	$('input[name=username]').val(updated);
	   	});
	  	if(e.which === 32) 
		    return false;
	});
}

var passwordInputPrevent = function()
{
	$('input[name=password]').keypress(function (e) {
		if(e.which === 32) 
		    return false;
	});

	$('input[name=password]').bind('paste', function(e) {
	  	if(e.which === 32) 
		    return false;
	});	
}

var checkMultiRecordModule = function()
{
	$(document).on('change','input.c_one_remove',function(event){
		event.preventDefault();
		getValueMuliCheckbox();
	});

	$(document).on('change','input.c_all_remove',function(event){
		event.preventDefault();
		if ($('.c_one_remove').is(':checked') && $(this).prop("checked")==false) {
			$('.c_one_remove').prop( "checked", false);
		}else{
			$('.c_one_remove').prop( "checked", true);
		}
		getValueMuliCheckbox();
	});
}

var getValueMuliCheckbox = function()
{
	var arr = $('input.c_one_remove:checked');
	var str = "";
	console.log(arr.length);
	for (var i = 0; i < arr.length; i++) {
		var item = arr[i];
		str += $(item).data('id');
		if(i<arr.length-1){
			str+=",";
		}
	};
	$('input[name=multi_remove_id]').val(str);
}

var ajaxGuideContent = function(parent = 0){
	$(document).on('click','.guide_btn_ajax',function(event){
		event.preventDefault();
		link = $(this).data('route');
		$.ajax({
			url: link,
			type: 'GET',
		})
		.done(function(data) {
			$('.ajax-guide-content').html(data);
	    })
	});
}

$(function(){
	// submitActionAjaxForm();
	confirmRemoveData();
	checkBoxModule();
	changeSubmit();
	numberInputPrevent();
	usernameInputPrevent();
	passwordInputPrevent();
	checkMultiRecordModule();
	ajaxGuideContent();
});