$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

var getBaseRoute = function(route)
{
	let base_url = $('head base').attr('href');
	return base_url+'/'+route;
}
var baseAjaxForm = function()
{ 
	$('.baseAjaxForm').submit(function(event) {
		event.preventDefault();
		ajaxBaseCall({url:$(this).attr('action'), 
		type:$(this).attr('method'), 
		data:$(this).serialize()});
	});
}

var ajaxBaseCall = function(param)
{
	$('#loader').fadeIn(200);
	$.ajax({
		url: param.url,
		type: param.type,
		data: param.data,
	})
	.done(function(data) {
		if((data.code) == 200){
			toastr['success'](data.message);
		}
		else{
			toastr['error'](data.message);
		}
		if (data.url != null) {
			setTimeout(() => {
				if (data.url == 'f5') {
					window.location.reload();	
				}else{
					window.location.href=data.url;
				}
			}, 1500);
		} 
		$('#loader').delay(200).fadeOut(500); 
	})
}

var ajaxViewTarget = function(url, target_ajax, section_class, type = 1)
{
	$('#loader').fadeIn(200);
	$.ajax({
		url: getBaseRoute(url),
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

var getEmptyDefault = function(value, deflt = '', type = 'string'){
	if (value === '' || value == 'undefined') {
		if (type == 'float') {
			return !Number.isNaN(parseFloat(value)) ? parseFloat(value) : deflt;	
		}else if(type == 'number'){
			return !Number.isNaN(parseInt(value)) ? parseInt(value) : deflt;		
		}else{
			return deflt;
		}	
	}else{
		if (type == 'float') {
			return parseFloat(value);
		}else if (type == 'number') {
			return parseInt($value);	
		}else{
			return value;
		}
		
	}
}

var getCssAndSetInlineCss = function(element)
{
	let str = '';
        let arr = getComputedStyle(element, null);
        for(let i = 0; i < arr.length; i++){
            str += arr[i] + ':' + arr.getPropertyValue(arr[i]) + ';';
        }
        $(element).attr('style', str);
}

var setCssInlineChildrenRecursively = function(element)
{
	element.children().each(function () {
		getCssAndSetInlineCss(this);
		setCssInlineChildrenRecursively($(this));   
	});
}

$(function(){
	baseAjaxForm();
});