<div class="module_quote_supp_config">
    <div class="list_supp_item">
        <?php echo $__env->make('quotes.products.cartons.ajax_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="text-center my-3">
        <button type="button" data-product="<?php echo e($j); ?>"  data-key=<?php echo e(\TDConst::CARTON); ?>

        class="main_button color_white bg_green border_green radius_5 font_bold sooth">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm vật tư
        </button>
    </div> 
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/cartons/view.blade.php ENDPATH**/ ?>