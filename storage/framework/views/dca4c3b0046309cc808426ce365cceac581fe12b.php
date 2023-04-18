<?php
    $key_stage = \App\Constants\TDConstant::ELEVATE;
    $paper_elevate_ext_price = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][ext_price]',
            'note' => 'Thêm giá cho khuôn phức tạp',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
?>
<?php echo $__env->make('view_update.view', $paper_elevate_ext_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('quotes.products.papers.handles.select_device', ['key_device' => $key_stage], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(@$category == 2): ?>
    <div class="mt-2 pt-2 border_top_white">
        <?php echo $__env->make('quotes.products.papers.handles.float', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/elevate.blade.php ENDPATH**/ ?>