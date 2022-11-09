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
		    	toastr['success'](json.message);
		    }
		    else{
		      	toastr['error'](json.message);
		    }
			if (json.url != null) {
				setTimeout(() => {
					window.location.href=json.url;
				}, 1500);
			} 
	    })
	});
}

$(function(){
	baseAjaxForm();
});