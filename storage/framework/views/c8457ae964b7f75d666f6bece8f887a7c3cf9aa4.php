
<?php $__env->startSection('process'); ?>
    <?php
        $key_supp = \TDConst::MICA;
        $mica_divide = \TDConst::MICA_SIZE_DIVIDE;
        $mica_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $mica_plus = \TDConst::MICA_SIZE_PLUS;
    ?>
    <?php echo $__env->make('quotes.products.supplies.check_index_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $mica_divide, 'name' => 'vải lụa'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.quantity_config', ['compen_percent' => $mica_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $mica_plus, 'divide' => $mica_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.select_supply_type', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('orders.users.6.supply_handles.handle', ['compen_percent' => $mica_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/mica.blade.php ENDPATH**/ ?>