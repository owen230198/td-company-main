<?php if(isNotBox($cate)): ?>
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
        Nhập kích thước <?php echo e(!isNotBox(@$cate) ? ' hộp' : ''); ?>

    </label>
    <?php echo $__env->make('products.duo_size', ['pro_index' => @$pro_index], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php else: ?>
    <div class="form-group d-flex mb-2">
        <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
            Nhập kích thước hộp
        </label>
        <?php echo $__env->make('products.full_size',['pro_index' => @$pro_index], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?>
<div class="__suggest_product_submited_ajax">

</div><?php /**PATH /var/www/html/td-company-app/resources/views/quotes/products/size.blade.php ENDPATH**/ ?>