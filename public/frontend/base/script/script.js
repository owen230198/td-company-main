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

var ajaxViewTarget = function(url, target_ajax, section_class, type = 1)
{
	$('#loader').fadeIn(200);
	$.ajax({
		url: url,
		type: 'GET'
	})
	.done(function(data){
		if (typeof data === 'object' && data.code == 100) {
		  toastr['error'](data.message);
		}else{
		  if (type === 1) {
			target_ajax.html(data);
		  }else{
			target_ajax.append(data);
		  }
		  initInputModuleAfterAjax(section_class);
		}
		$('#loader').delay(200).fadeOut(500); 
	})
}

$(function(){
	baseAjaxForm();
});