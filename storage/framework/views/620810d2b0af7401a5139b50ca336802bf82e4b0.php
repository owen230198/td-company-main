<?php
    $device = [
        'name' => 'product['.$pro_index.']['.$element.']['.$supp_index.']['.$key_device.'][machine]',
        'type' => 'linking',
        'note' => $note,
        'value' => @$value ?? 0,
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => $key_device, 'supply' => $element], 'select' => ['id', 'name']]]
    ] 
?>
<?php echo $__env->make('view_update.view', $device, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/td-company-app/resources/views/quotes/products/select_device.blade.php ENDPATH**/ ?>