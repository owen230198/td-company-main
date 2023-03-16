<?php
    $key_stage = \App\Constants\TDConstant::FLOAT;
    $paper_float = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][act]',
        'type' => 'checkbox',
        'note' => 'Sản phẩm có thúc nổi'
    ]
?>
<?php echo $__env->make('view_update.view', $paper_float, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/float.blade.php ENDPATH**/ ?>