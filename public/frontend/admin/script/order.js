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

$(function(){
    showUploadDesignFileButton();
    moduleChangePrintQuantity();
});