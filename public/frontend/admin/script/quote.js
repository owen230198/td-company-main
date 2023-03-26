var changQtyInput = function(){
  $(document).on('change','input.paper_qty_modul_input',function(e){
    e.preventDefault();
    let parent = $(this).closest('.quantity_paper_module');
    let qty_pro = parseInt(parent.find('input.pro_qty_input').val());
    let nqty = parseInt(parent.find('input.pro_nqty_input').val());
    let qty_paper = Math.ceil(qty_pro/nqty)
    let compen_percent = parent.data('percent');
    let compen_num = parent.data('num');
    let addqty = Math.ceil(qty_paper*compen_percent/100) + compen_num;
    parent.find('input.paper_qty_input').val(qty_paper + addqty);
   });
}

var moduleSelectOtherPaper = function()
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
      selectAjaxModule($('.customer_info_quote'));
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

var moduleInputQuantityProduct = function()
{
  $(document).on('keyup', 'input.quote_set_qty_pro_input', function(event){
    event.preventDefault();
    let quantity = parseInt($(this).val());
    if (quantity > 0) {
      let url = 'get-view-product-quantity?quantity='+$(this).val();
      let ajax_target = $(this).closest('.quote_handle_section.handle_pro_section').find('.ajax_product_quote_number');
      let section_class = '.ajax_product_quote_number';
      ajaxViewTarget(url, ajax_target, ajax_target);
    }
  });
}

var addPrintPaperModule = function()
{
  $(document).on('click', 'button.add_print_paper_quote_button', function(event){
    event.preventDefault();
    let list_section = $(this).closest('.section_quote_print_paper').find('.list_paper_config');
    let item = list_section.find('.quote_paper_item');
    let pro_index = $(this).data('product');
    let paper_index = item.length;
    let paper_name = $(this).closest('.section_quote_print_paper').find('input.quote_receive_paper_name_main').val();
    let url = 'add-print-paper-quote?pro_index='+pro_index+'&paper_index='+paper_index+'&paper_name='+paper_name;
    ajaxViewTarget(url, list_section, list_section, 2);
  });
}

var removePrintPaperModule = function()
{
  $(document).on('click', 'span.remove_ext_paper_quote', function(event){
    event.preventDefault();
    $(this).parent().remove();
  });
}

var setNameProductQuote = function()
{
  $(document).on('change', 'input.quote_set_product_name', function(event){
    event.preventDefault();
    let text = $(this).val() != '' ? $(this).val() : 'Chưa có tên';
    let tabpane = $(this).closest('.tab-pane.tab_pane_quote_pro');
    let li_id = tabpane.attr('id');
    $('a#'+li_id+'-tab').text(text);
    $(this).closest('.config_handle_paper_pro').find('input.quote_receive_paper_name_main').val(text);
    tabpane.data('pname', text);
  })
}

var selectExtNamePaperModule = function()
{
  $(document).on('change', 'select.select_ext_name_paper', function(event){
    event.preventDefault();
    text = $(this).val();
    $(this).closest('.paper_product_config').find('input.quote_receive_paper_name_ext').val(text);
  });
}

var autoComputePaperAjax = function()
{
  $(document).on('click', 'button.auto_computed_btn', function(event){
    event.preventDefault();
    let data = $(this).closest('.quote_product_structure').find('.struture_pro_input').serialize();
    let paper_name = $(this).closest('.section_quote_print_paper').find('input.quote_receive_paper_name_main').val();
    let proindex = $(this).data('proindex');
    let paperindex = $(this).data('paperindex');
    let section = $(this).closest('.quote_paper_item');
    $('#loader').fadeIn(200);
    $.ajax({
      url: 'compute-paper-size?paper_name='+paper_name+'&proindex='+proindex+'paperindex='+paperindex,
      type: 'GET',
      data: data
    })
    .done(function(html){
      section.html(html);
      initInputModuleAfterAjax(section);
      $('#loader').delay(200).fadeOut(500); 
    })
  });
}

var selectProductCategory = function()
{
  $(document).on('change', 'select.select_quote_procategory', function(event){
    event.preventDefault();
    let proindex = $(this).attr('proindex');
    let paper_name = $(this).closest('.config_handle_paper_pro').find('input.quote_set_product_name').val();
    let url = 'get-view-product-structure?category='+$(this).val()+'&proindex='+proindex+'&paper_name='+paper_name;
    section = $(this).closest('.config_handle_paper_pro').find('.ajax_product_view_by_category');
    ajaxViewTarget(url, section, section);
  });
}

$(function(){
	changQtyInput();
  moduleSelectOtherPaper();
  PrintQuote();
  selectCustomerQuote();
  selectPaperMateralModule();
  moduleInputQuantityProduct();
  addPrintPaperModule();
  removePrintPaperModule();
  setNameProductQuote();
  selectExtNamePaperModule();
  selectProductCategory();
  // autoComputePaperAjax();
});