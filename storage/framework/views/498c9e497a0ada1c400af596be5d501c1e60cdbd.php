<?php
    $pro_supply_note = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][note]',
        'type' => 'textarea',
        'note' => 'Ghi chú',
        'value' => @$supply_obj->note
    ];
?>
<?php echo $__env->make('view_update.view', $pro_supply_note, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/td-company-app/resources/views/quotes/products/note_field.blade.php ENDPATH**/ ?>