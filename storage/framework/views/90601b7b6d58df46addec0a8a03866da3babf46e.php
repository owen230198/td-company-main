<?php
    $index = @$index ?? 0;
    $base_need = calValuePercentPlus($supply_obj->supp_qty, $supply_obj->supp_qty, getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
?>

<?php $__env->startSection('items'); ?>
    <?php echo $__env->make('orders.users.6.supply_handles.view_handles.papers.item', $arr_item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.view_handles.multiple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/view_handles/papers/view.blade.php ENDPATH**/ ?>