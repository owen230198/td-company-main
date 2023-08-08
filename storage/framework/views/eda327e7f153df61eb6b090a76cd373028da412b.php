
<?php $__env->startSection('process'); ?>
    <?php
        $key_supp = \TDConst::STYRO;
        $styro_divide = \TDConst::STYRO_SIZE_DIVIDE;
        $styro_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $styro_plus = \TDConst::STYRO_SIZE_PLUS;
    ?>
    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $styro_divide, 'name' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.quantity_config', ['compen_percent' => $styro_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $styro_plus, 'divide' => $styro_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.select_supply_type', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('orders.users.6.supply_handles.handle', ['compen_percent' => $styro_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/styrofoam.blade.php ENDPATH**/ ?>