
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('warehouses.actions.form_action', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(!empty($data_item_log)): ?>
        <?php echo $__env->make('warehouses.actions.histories.view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/warehouses/actions/view.blade.php ENDPATH**/ ?>