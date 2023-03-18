<?php
    $pro_fill_price = [
        'name' => 'product['.$j.'][fill_finish]['.$pindex.'][fill_price]',
        'note' => 'Đơn giá bồi',
        'value' => 0
    ] 
?>
<?php echo $__env->make('view_update.view', $pro_fill_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $pro_finishes_price = [
        'name' => 'product['.$j.'][fill_finish]['.$pindex.'][finish_price]',
        'note' => 'Đơn giá hoàn thiện',
        'value' => 0
    ] 
?>
<?php echo $__env->make('view_update.view', $pro_finishes_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/fill_finishes/view.blade.php ENDPATH**/ ?>