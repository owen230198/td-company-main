<?php
    $key_stage = \App\Constants\TDConstant::ELEVATE;
    $value = getDeviceIdByKey($key_stage, \App\Constants\TDConstant::SEMI_AUTO_DEVICE);
    $paper_elevate_ext_price = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
            'note' => 'Thêm giá cho khuôn phức tạp',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
?>
<?php echo $__env->make('view_update.view', $paper_elevate_ext_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('quotes.products.papers.handles.select_device', ['key_device' => $key_stage], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/elevate.blade.php ENDPATH**/ ?>