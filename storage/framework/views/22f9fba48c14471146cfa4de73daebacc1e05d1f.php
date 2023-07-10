
<?php $__env->startSection('process'); ?>
<?php
    $key_supp = \TDConst::CARTON;
    $carton_divide = \TDConst::CARTON_SIZE_DIVIDE;
    $carton_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
    $carton_plus = \TDConst::CARTON_SIZE_PLUS;
    $pro_index = 0;
    $supp_index = 0;
?>
<?php echo $__env->make('quotes.products.supplies.quantity_config', ['compen_percent' => $carton_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $carton_plus, 'divide' => $carton_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('quotes.products.supplies.select_supply_type', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/carton.blade.php ENDPATH**/ ?>