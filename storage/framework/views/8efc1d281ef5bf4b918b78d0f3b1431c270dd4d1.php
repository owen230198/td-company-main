<?php
    $key_stage = \App\Constants\TDConstant::NILON;
    $paper_nilon_materal = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'value' => getDefaultMateralIDByKey($key_stage),
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => $key_stage], 'select' => ['id', 'name']]]
    ]
?>
<?php echo $__env->make('view_update.view', $paper_nilon_materal, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $paper_nilon_face = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'value' => 1,
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_nilon_face, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('quotes.products.papers.handles.select_device', 
['key_device' => $key_stage, 'value' => getDeviceIdByKey($key_stage, \App\Constants\TDConstant::SEMI_AUTO_DEVICE)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/nilon.blade.php ENDPATH**/ ?>