$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

var getCsrfToken = function () {
	return $('meta[name="csrf-token"]').attr('content');
}

var getBaseRoute = function (route) {
	let base_url = $('head base').attr('href');
	return base_url + '/' + route;
}
var baseAjaxForm = function () {
	$('.baseAjaxForm').submit(function (event) {
		event.preventDefault();
		ajaxBaseCall({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: $(this).serialize()
		});
	});
}

var ajaxBaseCall = function (param) {
	$('#loader').fadeIn(200);
	$.ajax(param)
		.done(function (data) {
			let title = data.code == 200 ? 'Thành công' : 'Không thành công';
			let key = data.code == 200 ? 'success' : 'error';
			if (!empty(data.message)) {
				swal(title, data.message, key).then(function () {
					if (data.url != null) {
						if (data.url == RELOAD) {
							window.location.reload();
						} else if (data.url == CLOSE_POPUP) {
							closeDataPopup(true);
						}else if (data.url == 'close_popup_no_reload') {
							closeDataPopup();
						} else {
							window.location = data.url;
						}
					}
				});
			} else {
				if (data.url == RELOAD) {
					window.location.reload();
				} else if (data.url == CLOSE_POPUP) {
					closeDataPopup(true);
				} else {
					window.location = data.url;
				}
			}
			$('#loader').delay(200).fadeOut(500);
		})
}

var ajaxViewTarget = function (url, target_ajax, section_class, type = 1, data = '', full_url = true, loading = true) {
	if (loading) {
		$('#loader').fadeIn(200);
	}
	let link = full_url == true ? getBaseRoute(url) : url
	let ajax_conf = { url: link, type: 'GET' };
	if (!empty(data)) {
		ajax_conf.data = data;
	}
	$.ajax(ajax_conf)
		.done(function (data) {
			if (typeof data === 'object' && data.code == 100) {
				target_ajax.html('');
				swal('Không thành công', data.message, 'error');
			} else {
				if (type === 1) {
					target_ajax.html(data);
				} else {
					target_ajax.append(data);
				}
				initInputModuleAfterAjax(section_class);
			}
			if (loading) {
				$('#loader').delay(200).fadeOut(500);
			}
		})
}

var empty = function (value) {
	return value === '' || value == 'undefined' || value == null || value == undefined || value == 0 || !value;
}

var getEmptyDefault = function (value, deflt = '', type = 'string') {
	if (empty(value)) {
		if (type == 'float') {
			return !Number.isNaN(parseFloat(value)) ? parseFloat(value) : deflt;
		} else if (type == 'number') {
			return !Number.isNaN(parseInt(value)) ? parseInt(value) : deflt;
		} else {
			return deflt;
		}
	} else {
		if (type == 'float') {
			let ex_value = getExactNumber(value);
			return parseFloat(ex_value);
		} else if (type == 'number') {
			let ex_value = getExactNumber(value);
			return parseInt(ex_value);
		} else {
			return value;
		}

	}
}

var price_format = function(number){
	// if (isNaN(number) || number === '') return '';
    let parts = number.toString().split('.');
    let integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    let formattedNumber = integerPart;
    if (parts[1] !== undefined) {
        formattedNumber += '.' + parts[1];
    }
    return formattedNumber;

}

var getExactNumber = function(number)
{
	let ret = number.toString().replace(/[^0-9.-]/g, '');
	if (ret.indexOf('-') > 0) {
        ret = ret.replace(/-/g, '');
    }
	return ret;
}

var getCssAndSetInlineCss = function (element) {
	let str = '';
	let arr = getComputedStyle(element, null);
	for (let i = 0; i < arr.length; i++) {
		str += arr[i] + ':' + arr.getPropertyValue(arr[i]) + ';';
	}
	$(element).attr('style', str);
}

var setCssInlineChildrenRecursively = function (element) {
	element.children().each(function () {
		getCssAndSetInlineCss(this);
		setCssInlineChildrenRecursively($(this));
	});
}
var enableButtonSubmit = function () {
	let buttons = $('button[type=submit]');
	buttons.each(function () {
		$(this).prop('disabled', false);
	});
}

var getValueByPercent = function(value, percent) {
	return (value * percent) / 100;
}

$(function () {
	$(document).ready(function () {
		enableButtonSubmit();
	});
	baseAjaxForm();
});