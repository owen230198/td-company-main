var ajaxListTable = function()
{
  url = $('meta[name=ajax-url]', parent.document).attr('content');
  if (url!='') {
    $.ajax({
      url: url,
      type: 'GET',
    })
    .done(function(data) {
      $('.table_data', parent.document).html(data);  
    })
  } 
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
        window.parent.toastr['success'](json.message);
        ajaxListTable();
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
		eParent = $(this).closest('.incredent_items');
		if ($(this).prop("checked") == true) {
			eParent.find('.incredent_content').fadeIn();
		}else{
			eParent.find('.incredent_content').fadeOut();	
		}
	});
}

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
    eParent = $(this).closest('.formActionS');
    var allqty = parseInt(eParent.find('input[name=qty_pro]').val());
    var valqty = parseInt($(this).val());
    var addqty = parseInt(eParent.find('input[name=add_paper]').val());
    ex_qty = getExQuantityPaper(allqty, valqty, addqty);
    eParent.find('input[name=qty_paper]').val(Math.ceil(ex_qty));
   });

  $(document).on('change','input[name=qty_pro]',function(e){
    e.preventDefault();
    eParent = $(this).closest('.formActionS');
    var allqty = $(this).val();
    var valqty = parseInt(eParent.find('input[name=n_qty]').val());
    var addqty = eParent.find('input[name=add_paper]').val();
    ex_qty = getExQuantityPaper(allqty, valqty, addqty);
    eParent.find('input[name=qty_paper]').val(Math.ceil(ex_qty));
   });
}

var moduleSelectOther = function()
{
  $(document).on('change', 'select.select_other', function(event) {
    event.preventDefault();
    eParent = $(this).closest('.group_select_other').find('.input_add');
    if ($(this).val()==$(this).data('expland')) {
      eParent.fadeIn();
      eParent.find('input').prop('disabled', false);
    }else{
      eParent.fadeOut();
      eParent.find('input').prop('disabled', true);
    }
  });
}

var GetTodayDate = function() {
   var tdate = new Date();
   var dd = tdate.getDate(); //yields day
   var MM = tdate.getMonth(); //yields month
   var yyyy = tdate.getFullYear(); //yields year
   var str= (MM+1) + "-" + dd + "-" + yyyy;
   return str;
}

var PrintQuote = function() {
  $(document).on('click','.print_quotes',function(event){
    event.preventDefault();
    var baseUrl = $('base').attr('href');
    var arrs = document.querySelectorAll('.quote_model');
    var html = '';
    var name = $('.pro_name').text();
    var company = $('.company').text();
    for (var i = 0; i < arrs.length; i++) {
      html += arrs[i].innerHTML;
    }
    str_today = GetTodayDate();
    title = str_today + ' ' + name + ' ' + company ;
    var mywindow = window.open('', '', '');
    mywindow.document.write('<html><head><title>'+title+'</title>');
    mywindow.document.write('<base href="' + baseUrl + '">');
    mywindow.document.write('<link rel="icon" href="frontend/admin/images/logo.jpg" type="image/gif">');
    mywindow.document.write('<link href="frontend/base/css/bootstrap.min.css" rel="stylesheet">');
    mywindow.document.write('<link href="frontend/base/css/font-awesome.min.css" rel="stylesheet" type="text/css">');
    mywindow.document.write('<link rel="stylesheet" href="frontend/admin/css/style.css" type="text/css">');
    mywindow.document.write('</head><body style="overflow:hidden">');
    mywindow.document.write('<div class="ex_quote_file">');
    mywindow.document.write(html);
    mywindow.document.write('</div>');
    mywindow.document.write('</div">');
    mywindow.document.write('</body></html>');
    mywindow.document.close();
    mywindow.focus();
    setTimeout(function() {
        mywindow.print();
        mywindow.close();
    }, 300);    
  });
}

$(function(){
	submitPopUpAction();
	changeActiveStage();
	changQtyInput();
  moduleSelectOther();
  PrintQuote();
});