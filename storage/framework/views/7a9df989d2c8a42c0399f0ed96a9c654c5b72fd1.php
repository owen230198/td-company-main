<?php
    $key_stage = \App\Constants\TDConstant::FLOAT;
    $paper_float_price = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
        'note' => 'Đơn giá thúc nổi',
        'attr' => ['type_input' => 'number'],
        'value' => 0
    ]
?>
<?php echo $__env->make('view_update.view', $paper_float_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/float.blade.php ENDPATH**/ ?>