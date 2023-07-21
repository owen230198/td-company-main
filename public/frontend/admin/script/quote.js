var changQtyInput = function(){
  $(document).on('keyup change','input.paper_qty_modul_input',function(e){
    e.preventDefault();
    let parent = $(this).closest('.quantity_paper_module');
    let qty_pro = parseInt(parent.find('input.pro_qty_input').val());
    let nqty = parseInt(parent.find('input.pro_nqty_input').val());
    let qty_paper = Math.ceil(qty_pro/nqty)
    let compen_percent = parent.data('percent');
    let compen_num = parent.data('num');
    let addqty = Math.ceil(qty_paper*compen_percent/100) + compen_num;
    parent.find('input.paper_qty_input').val(qty_paper);
    let plan_qty = parent.find('input.plan_input_supp_qty');
    if (plan_qty.length>0) {
      plan_qty.trigger('change');
    }
  });

  $(document).on('keyup change', 'input.input_pro_qty', function(event){
    event.preventDefault();
    let parent = $(this).closest('.tab_pane_quote_pro');
    let product_qty = parseInt($(this).val());
    supp_product_qty = parent.find('.pro_qty_input');
    if (supp_product_qty.length > 0) {
      supp_product_qty.val(product_qty);
      supp_product_qty.trigger('change');
    }
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
  $(document).on('click', 'button.print_quotes', function(event){
    event.preventDefault();
    let arrs = document.querySelectorAll('.quote_model');
    let html = '';
    let seri = $(this).data('seri');
    let company = $('.company').text();
    for (let i = 0; i < arrs.length; i++) {
      html += arrs[i].innerHTML;
    }
    str_today = GetTodayDate();
    title =  company + ' - ' + seri + ' - ' + str_today;
    let mywindow = window.open('', '', '');
    mywindow.document.write('<html><head><title>'+title+'</title>');
    mywindow.document.write('<base href="' + getBaseRoute('/') + '">');
    mywindow.document.write('<link rel="icon" href="'+getBaseRoute('frontend/admin/images/logo.png')+'" type="image/gif">');
    mywindow.document.write('<link href="'+getBaseRoute('frontend/base/css/bootstrap.min.css')+'" rel="stylesheet">');
    mywindow.document.write('<link href="'+getBaseRoute('frontend/base/css/font-awesome.min.css')+'" rel="stylesheet" type="text/css">');
    mywindow.document.write('<link rel="stylesheet" href="'+getBaseRoute('frontend/admin/css/base.css')+'" type="text/css">');
    mywindow.document.write('<link rel="stylesheet" href="'+getBaseRoute('frontend/admin/css/style.css')+'" type="text/css">');
    mywindow.document.write('<link rel="stylesheet" href="'+getBaseRoute('frontend/admin/css/quote.css')+'" type="text/css">');
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
      url: getBaseRoute('get-view-customer-data?id='+$(this).val()),
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
    if ($(this).val() === 'other') {
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
  let input_time;
  $(document).on('keyup', 'input.quote_set_qty_pro_input', function(event){
    event.preventDefault();
    let quantity = parseInt($(this).val());
    if (quantity > 0) {
      let url = 'get-view-product-quantity?quantity='+$(this).val();
      let ajax_target = $(this).closest('.quote_handle_section.handle_pro_section').find('.ajax_product_quote_number');
      clearTimeout(input_time)
      input_time = setTimeout(function(){
        ajaxViewTarget(url, ajax_target, ajax_target);
      }, 500)
    }
  });
}

var addSuppModule = function()
{
  $(document).on('click', 'button.add_supp_quote_button', function(event){
    event.preventDefault();
    let list_section = $(this).closest('.module_quote_supp_config').find('.list_supp_item');
    let item = list_section.find('.quote_supp_item');
    let pro_index = $(this).data('product');
    let supp_view = $(this).data('key');
    let supp_index = parseInt(item.last().data('index')) + 1;
    let supp_name = item.first().find('input.quote_receive_paper_name_main').val();
    let pro_qty = item.first().find('input.pro_qty_input ').first().val();
    let url = 'add-supply-quote?pro_index='+pro_index+'&supp_index='+supp_index+'&supp_view='+supp_view+'&supp_name='+supp_name+'&pro_qty='+pro_qty;
    ajaxViewTarget(url, list_section, list_section, 2);
  });
}

var addFillFinishModule = function()
{
  $(document).on('click', 'button.add_fill_finish_quote_button', function(event){
    event.preventDefault();
    let list_section = $(this).closest('.section_quote_fill_finish').find('.list_item_fill_finish');
    let item = list_section.find('.quote_fill_finish_item');
    let pro_index = $(this).data('product');
    let findex = parseInt(item.last().data('index')) + 1;
    let view = $(this).data('view');
    let ajax_target = list_section.find('.ajax_ff_quote');
    let url = 'add-fill-finish-quote?pro_index='+pro_index+'&ff_index='+findex+'&view='+view;
    ajaxViewTarget(url, ajax_target, list_section, 2);
  });
}

var removeItemAddedModule = function()
{
  $(document).on('click', 'span.remove_ext_element_quote', function(event){
    event.preventDefault();
    $(this).parent().remove();
    let id = $(this).data('id'); 
    if (id != undefined) {
      ajaxBaseCall({url:getBaseRoute('remove?ajax=1'), 
      type:'DELETE', 
      data:{remove_id:id, table:$(this).data('table')}});
    }
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
  $(document).on('keyup change', 'select.select_ext_name_paper', function(event){
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
      url: getBaseRoute('compute-paper-size?paper_name='+paper_name+'&proindex='+proindex+'paperindex='+paperindex),
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
    let pro_qty = $(this).closest('.config_handle_paper_pro').find('input.input_pro_qty').val();
    let url = 'get-view-product-structure?category='+$(this).val()+'&proindex='+proindex+'&paper_name='+paper_name+'&pro_qty='+pro_qty;
    let section = $(this).closest('.config_handle_paper_pro').find('.ajax_product_view_by_category');
    ajaxViewTarget(url, section, section);
  });
}

var showHandleDetail = function()
{
  $(document).on('click', 'button.show_config_handle_quote', function(event){
    let section = $(this).closest('.config_handle_paper_pro').find('.ajax_product_view_by_category');
    let icon = $(this).find('i');
    let text = $(this).find('span');
    if (section.find('.product_structure_quote').length > 0) {
      text.text('Xem chi tiết sản xuất');
      icon.removeClass('fa-angle-double-up');
      icon.toggleClass('fa-angle-double-down');
      section.html('');
    }else{
      text.text('Thu gọn');
      icon.removeClass('fa-angle-double-down');
      icon.toggleClass('fa-angle-double-up');
      let proindex = $(this).attr('proindex'); 
      let id = $(this).data('proid');
      let cate = $(this).data('category');
      let url = 'get-view-product-structure-data?id='+id+'&category='+cate+'&proindex='+proindex;
      ajaxViewTarget(url, section, section);
    }
    
  });
}

var calcSizeSupply = function()
{
  $(document).on('keyup change', 'input.temp_size_length', function(event){
    event.preventDefault();
    let parent = $(this).closest('.calc_size_module');
    let plus = getEmptyDefault(parent.data('plus'), 0, 'float');
    let divide = getEmptyDefault(parent.data('divide'), 0, 'float');
    let value = getEmptyDefault($(this).val(), 0, 'float');
    let otm_input = parent.find('input.otm_size_length');
    let nqty = Math.floor(divide/(value+plus));
    console.log(divide/(value+plus), nqty);
    if (value > 0 && nqty > 0) {
      otm_input.attr('readonly', true);
      otm_input.val(divide/nqty);
    }else{
      otm_input.attr('readonly', false);
      otm_input.val('')
    } 
  })
}

var selectDecalNQty = function()
{
  $(document).on('change', 'select.select_decal_nqty', function(event){
    event.preventDefault();
    let decal_module = $(this).closest('.decal_module');
    let size_module = decal_module.find('.module_decal_size');
    let val = $(this).val();
    if (val == 1) {
      size_module.fadeIn();    
    }else{
      size_module.fadeOut();
    }
  })
}

var moduleSelectSupply = function()
{
  $(document).on('change', 'select.select_supply_type', function(event){
    event.preventDefault();
    let id = $(this).val();
    let cvalue = $(this).attr('cvalue');
    let url = 'get-list-option-ajax/supply_prices?supply_id='+id+'&cvalue='+cvalue;
    let ajax_target = $(this).closest('.module_select_supply_type').find('select.ajax_supply_price');
    ajaxViewTarget(url, ajax_target, ajax_target);
  });
}

var hoverDetailSupplyCost = function()
{
  $("li.supply_item_inf").hover(
    function() {
      let tab_detail = $(this).find('.detail_quote_supply_item');
      let timeout = setTimeout(function() {
        tab_detail.addClass("hover");
      }, 1500);
      tab_detail.data("timeout", timeout);
    },
    function() {
      let tab_detail = $(this).find('.detail_quote_supply_item');
      clearTimeout(tab_detail.removeClass('hover').data('timeout'));
    }
  )
}

$(function(){
	changQtyInput();
  moduleSelectOtherPaper();
  PrintQuote();
  selectCustomerQuote();
  selectPaperMateralModule();
  moduleInputQuantityProduct();
  addSuppModule();
  addFillFinishModule();
  removeItemAddedModule();
  setNameProductQuote();
  selectExtNamePaperModule();
  selectProductCategory();
  calcSizeSupply();
  selectDecalNQty();
  moduleSelectSupply();
  showHandleDetail();
  hoverDetailSupplyCost();
  // autoComputePaperAjax();
});