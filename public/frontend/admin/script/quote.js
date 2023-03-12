var changQtyInput = function(){
  $(document).on('change','input.paper_qty_modul_input',function(e){
    e.preventDefault();
    let parent = $(this).closest('.quantity_paper_module');
    let qty_pro = parseInt(parent.find('input.pro_qty_input').val());
    let nqty = parseInt(parent.find('input.pro_nqty_input').val());
    let qty_paper = Math.ceil(qty_pro/nqty)
    let addqty = Math.ceil(qty_paper*10/100);
    parent.find('input.paper_qty_input').val(qty_paper);
    parent.find('input.total_paper_qty_input').val(qty_paper+addqty);
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
    mywindow.document.write('<link rel="icon" href="public/frontend/admin/images/logo.png" type="image/gif">');
    mywindow.document.write('<link href="public/frontend/base/css/bootstrap.min.css" rel="stylesheet">');
    mywindow.document.write('<link href="public/frontend/base/css/font-awesome.min.css" rel="stylesheet" type="text/css">');
    mywindow.document.write('<link rel="stylesheet" href="public/frontend/admin/css/style.css" type="text/css">');
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

var selectCustomerQuote = function()
{
  $(document).on('change', '.select_customer_quote', function(event){
    event.preventDefault();
    $.ajax({
      url: 'get-view-customer-data?id='+$(this).val(),
      type: 'GET'
    })
    .done(function(html){
      console.log($(this).parent());
      $('.customer_info_quote').html(html);
      selectAjaxModule('.customer_info_quote');
    });
  })
}

var selectPaperMateralModule = function()
{
  $(document).on('change', 'select.select_paper_materal', function(event){
    event.preventDefault();
    let module_size_paper = $(this).closest('.materal_paper_module').find('.paper_price_config_input');
    let price_input = module_size_paper.find('input.price_input_paper');
    if ($(this).val() === '0') {
      if (module_size_paper.css('display') === 'none' && price_input.attr('disabled') === 'disabled') {
        module_size_paper.fadeIn(100);
        price_input.attr('disabled', false);  
      }
    }else{
      module_size_paper.fadeOut(100);
      price_input.attr('disabled', true);   
    }
  });
}

$(function(){
	changQtyInput();
  moduleSelectOther();
  PrintQuote();
  selectCustomerQuote();
  selectPaperMateralModule();
});