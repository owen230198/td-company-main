var baseAjaxForm = function()
{ 
	$('.baseAjaxForm').submit(function(event) {
		event.preventDefault();
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
		    }
		    else{
		    	$('input[name=csrf_test_name]').val(json.token);
		      	toastr['error'](json.message);
		    } 
	    })
	});
}

$(function(){
	baseAjaxForm();
});