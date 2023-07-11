var setAdvanceCostOrder = function()
{
    $(document).on('keyup change', '.__order_advance_input', function(event) {
        event.preventDefault();
        let parent = $(this).closest('.__order_field_module');
        let advance = $(this).val();
        let total = parent.find('.__order_total_input').val();
        let rest = total - advance;
        let rest_val = rest > 0 ? rest : 0;
        parent.find('.__order_rest_input').val(rest_val);  
    });
}

var applyOrderStep = function()
{
    $(document).on('click', '.__apply_order', function(event){
        event.preventDefault();
        let form = $(this).closest('.__form_order');
        let stage = $(this).data('stage');
        let form_data = form.serialize();
        let id = $(this).data('id');
        ajaxBaseCall({
            url:getBaseRoute('apply-order/'+stage+'/'+id), 
            type:'POST', 
            data:form_data
        });
    })
}

var planHandleElevateModule = function()
{
    $(document).on('keyup change', 'input.input_elevate_change', function(event){
        event.preventDefault();
        let parent = $(this).closest('.plan_handle_elevate_module');
        let supp_qty = parseInt(parent.find('input.plan_input_supp_qty').val());
        let elevate = parseInt(parent.find('input.plan_input_elevate').val());
        let total_elevate = supp_qty*elevate;
        let input_total_elevate = parent.find('input.plan_input_total_elevate')
        input_total_elevate.val(total_elevate);
        input_total_elevate.trigger('change');
        
    });

    $(document).on('change', 'input.plan_input_total_elevate', function(event){
        event.preventDefault();
        updateHandleWareHouse($(this));
    });

    $(document).on('keyup change', 'input.plan_input_warehouse_size', function(event)
    {
        event.preventDefault();
        updateHandleWareHouse($(this));
    });
}

var updateHandleWareHouse = function(obj)
{
    let parent = obj.closest('.plan_handle_supply_module');
    let size = parent.find('input.plan_input_warehouse_size');
    let bool = true;
    size.each(function(){
        if ($(this).val() <= 0) {
            bool = false;    
        }
    });
    if (bool == true) {
        let supp_qty = parseInt(parent.find('input.plan_input_supp_qty').val());
        parent.find('input.plan_input_warehouse_qty').val(supp_qty);    
    }
}

$(function(){
    setAdvanceCostOrder(); 
    applyOrderStep();
    planHandleElevateModule();
});