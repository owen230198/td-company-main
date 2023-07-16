
<?php $__env->startSection('process'); ?>
    <?php
        $key_supp = \TDConst::RUBBER;
        $rubber_divide = \TDConst::RUBBER_SIZE_DIVIDE;
        $rubber_compen_percent = (float) getDataConfig('QuoteConfig', 'RUBBER_COMPEN_PERCENT');
        $rubber_plus = \TDConst::RUBBER_SIZE_PLUS;
    ?>
    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $rubber_divide, 'name' => 'Cao su'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.quantity_config', ['compen_percent' => $rubber_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $rubber_plus, 'divide' => $rubber_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.select_supply_type', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $where = [
                    'type' => $key_supp, 
                    'supp_type' => @$supply_size['supply_type'],
                    'supp_price' => @$supply_size['supply_price'],
                    'status' => 'imported'
                ]
    ?>
    <?php echo $__env->make('orders.users.6.supply_handles.handle', ['compen_percent' => $rubber_compen_percent, 'where_size_type' => $where], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/rubber.blade.php ENDPATH**/ ?>