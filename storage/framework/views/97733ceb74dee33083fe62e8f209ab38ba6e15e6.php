<?php
    $paper_metalai_materal = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][metalai][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => 'metalai'], 'select' => ['id', 'name']]]
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_metalai_materal, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $paper_metalai_face = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][metalai][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_metalai_face, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('quotes.products.papers.handles.device_note', ['key_device' => 'metalai'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/metalai.blade.php ENDPATH**/ ?>