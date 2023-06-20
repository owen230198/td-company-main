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

$(function(){
    setAdvanceCostOrder(); 
    applyOrderStep();
});