<div class="warehouse_history">
    <h3 class="fs-14 text-uppercase border_bot_eb pb-1 mb-4 text-center handle_title">
        Lịch sử xuất nhập vật tư <?php echo e($dataItem['name']); ?>

    </h3>
    <ul>
        <?php $__currentLoopData = $data_item_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class=" mb-2 pb-2 border_bot_eb">
                <?php echo $__env->make('warehouses.actions.histories.item', $item_log, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <div class="paginate_view d-flex align-center justify-content-between mt-4">
        <?php echo $data_item_log->appends(request()->input())->links('pagination::bootstrap-4'); ?>

    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/warehouses/actions/histories/view.blade.php ENDPATH**/ ?>