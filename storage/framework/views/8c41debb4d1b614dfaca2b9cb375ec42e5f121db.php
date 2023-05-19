<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
    <span>Phần thiết kế</span>
</h3>
<?php
    $quote_pro_design = [
        'name' => 'product['.$j.'][design]',
        'note' => 'thiết kế',
        'type' => 'linking',
        'other_data' => ['data' => ['table' => 'design_types', 'select' => ['id', 'name']]]
    ]
?>
<?php echo $__env->make('view_update.view', $quote_pro_design, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/design.blade.php ENDPATH**/ ?>