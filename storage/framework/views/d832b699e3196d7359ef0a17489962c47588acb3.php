<div class="section_quote_print_paper">
    <div class="list_paper_config">
        <div class="quote_paper_item item_main" data-index=0>
            <?php echo $__env->make('quotes.products.papers.ajax_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>    
    </div>
    <div class="text-center my-3">
        <button type="button" data-product="<?php echo e($j); ?>" class="main_button color_white bg_green border_green radius_5 font_bold sooth add_print_paper_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm tờ in
        </button>
    </div> 
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/view.blade.php ENDPATH**/ ?>