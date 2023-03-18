<?php
    $paper_device = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_device.'][machine]',
        'type' => 'linking',
        'note' => 'thiết bị',
        'value' => @$value ?? 0,
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => $key_device], 'select' => ['id', 'name']]]
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_device, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/select_device.blade.php ENDPATH**/ ?>