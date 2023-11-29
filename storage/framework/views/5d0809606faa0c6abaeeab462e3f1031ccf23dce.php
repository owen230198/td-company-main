<?php
    $key_stage = \TDConst::UV;
    $paper_uv_face = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'value' => @$data_handle['face'],
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ];
    $paper_uv_materal = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][materal]',
        'type' => 'linking',
        'note' => 'mực in',
        'value' => @$data_handle['materal'],
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['type' => $key_stage], 'select' => ['id', 'name']]]
    ];
?>
<?php echo $__env->make('view_update.view', $paper_uv_face, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('view_update.view', $paper_uv_materal, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('quotes.products.papers.handles.select_device', ['key_device' => $key_stage, 'value' => @$data_handle['machine']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/td-company-app/resources/views/quotes/products/papers/handles/uv.blade.php ENDPATH**/ ?>