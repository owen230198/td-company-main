
<?php $__env->startSection('main'); ?>
    <?php if(@$order_type == \OrderConst::INCLUDE): ?>
        <?php echo $__env->make('orders.base_field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
            <span>Danh sách sản phẩm</span>
        </h3>
    <?php endif; ?>
    <div class="order_list_product">
        <?php echo $__env->make('quotes.products.ajax_view', ['order_get' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/orders/view.blade.php ENDPATH**/ ?>