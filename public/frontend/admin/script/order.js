var vatCheckBoxModule = function (val) {
    vatCostInput = $('.vat_cost_group_input');
    if (val==1) {
        vatCostInput.fadeIn();
    }else{
        vatCostInput.fadeOut();
    }
};

var showUploadDesignFileButton = function(){
    $(document).on('change', '.design_style_order', function(event){
        event.preventDefault();
        orderConfig = $(this).closest('.command_config_detail');
        fileModuleButton = orderConfig.find('.customer_file_upload');
        if ($(this).val()==4){
            fileModuleButton.fadeIn();
        }else{
            fileModuleButton.fadeOut();
        }
    });
}

var moduleChangePrintQuantity = function(){
    $(document).on('change', '.print_req_qty_field', function(event){
        event.preventDefault();
        cPrintModule = $(this).closest('.cogfig_print_command');
        printCompenInput = cPrintModule.find('.print_commpen_qty_field').val();
        printReqInput = $(this).val();
        cPrintModule.find('.print_amount_qty_field').val(parseInt(printCompenInput)+parseInt(printReqInput));
    });
    $(document).on('change', '.print_commpen_qty_field', function(event){
        event.preventDefault();
        cPrintModule = $(this).closest('.cogfig_print_command');
        printReqInput = cPrintModule.find('.print_req_qty_field').val();
        printCompenInput = $(this).val();
        cPrintModule.find('.print_amount_qty_field').val(parseInt(printCompenInput)+parseInt(printReqInput));
    });
}

var setListProductViewModule = function()
{
    $(document).on('change', '.order_base_input input[name="order[qty]"]', function(event){
        event.preventDefault();
        ordQty = $(this).val();
        ordName = $(this).closest('.order_base_input').find('input[name="order[name]"]').val();
        $.ajax({
            url: 'set-quantity-order-products',
            type: 'GET',
            data: {qty: ordQty, name: ordName}
        })
        .done(function(html){
            $('.ajax_product_orders').html(html);
        })  
    });

    $(document).on('change', 'input.nameProductInput', function(event){
        event.preventDefault();
        proNameSet = $(this).val();
        labelClass = $(this).data('label');
        $('.'+labelClass).text(proNameSet);
    });
}

var configProductItemSetOrderCost = function()
{
    $(document).on('change', '.proItemQtyInput', function(event){
        event.preventDefault();
        proItemQty = parseInt($(this).val());
        proItemModule = $(this).closest('.baseInfoProductItem');
        proItemPriceInput = proItemModule.find('input.proItemPriceInput');
        proItemPrice = parseInt(proItemPriceInput.val());
        proItemTotalInput = proItemModule.find('input.proItemTotalInput');
        setCostItemAndOrder(proItemQty, proItemPrice, proItemTotalInput);
    });
    $(document).on('change', '.proItemPriceInput', function(event){
        event.preventDefault();
        proItemPrice = parseInt($(this).val());
        proItemModule = $(this).closest('.baseInfoProductItem');
        proItemQtyInput = proItemModule.find('input.proItemQtyInput');
        proItemQty = parseInt(proItemQtyInput.val());
        proItemTotalInput = proItemModule.find('input.proItemTotalInput');
        setCostItemAndOrder(proItemQty, proItemPrice, proItemTotalInput);
    });
}

var setCostItemAndOrder = function(qty, price, itemInput){
    itemCost = qty*price;
    itemInput.val(itemCost);
    proOrderCostInput = $('input[name="order[product_cost]"]');
    proOrderCost = 0;
    $('.baseInfoProductItem').each(function(){
        proItemTotalCost = parseInt($(this).find('.proItemTotalInput').val());
        proOrderCost +=  proItemTotalCost;
    });
    proOrderCostInput.val(proOrderCost);
}

$(function(){
    showUploadDesignFileButton();
    moduleChangePrintQuantity();
    setListProductViewModule();
    configProductItemSetOrderCost();
});