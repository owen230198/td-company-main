
<?php $__env->startSection('process'); ?>
    <?php
        $key_supp = \TDConst::SILK;
        $silk_divide = \TDConst::SILK_SIZE_DIVIDE;
        $silk_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $silk_plus = \TDConst::SILK_SIZE_PLUS;
    ?>
    
    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $silk_divide, 'name' => 'vải lụa'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.quantity_config', ['compen_percent' => $silk_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $silk_plus, 'divide' => $silk_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.select_supply_type', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('orders.users.6.supply_handles.handle', ['compen_percent' => $silk_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/silk.blade.php ENDPATH**/ ?>