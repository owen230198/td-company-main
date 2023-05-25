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

$(function(){
    setAdvanceCostOrder();  
});