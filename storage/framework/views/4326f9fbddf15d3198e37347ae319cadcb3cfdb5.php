<?php
    $index = @$index ?? 0;
    $base_supp_qty = calValuePercentPlus($supply_obj->supp_qty, $supply_obj->supp_qty, getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
    $data_length = @$supply_size['width'] < @$supply_size['length'] ? @$supply_size['width'] : @$supply_size['length'];
    $base_need = $base_supp_qty*($data_length/10);
?>

<?php $__env->startSection('items'); ?>
    <?php echo $__env->make('orders.users.6.supply_handles.view_handles.squares.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.view_handles.multiple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/view_handles/squares/view.blade.php ENDPATH**/ ?>