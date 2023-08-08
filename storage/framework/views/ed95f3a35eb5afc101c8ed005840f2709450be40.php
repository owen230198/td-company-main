<div class="quote_product_structure quote_supp_item<?php echo e($supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : ''); ?>" data-index=<?php echo e(@$supp_index ?? 0); ?>>
    <?php echo $__env->make('quotes.products.papers.supply_print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="paper_ajax_after_print" style="display: <?php echo e(@$supply_obj->except_handle == 1 ? 'none' : ''); ?>">
        <?php if(@$supp_index == 0 || !empty($supply_obj)): ?>
            <?php echo $__env->make('quotes.products.papers.after_print', ['data_paper' => $supply_obj], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
        <?php endif; ?>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/ajax_view.blade.php ENDPATH**/ ?>