<table class="table">
    <tr>
        <th class="font-bold fs-13 text-center">
            <div class="d-flex align-items-center justify-content-center">
                <span>#</span>
                <?php if(!@$hideCheck): ?>
                    <input type="checkbox" class="c_all_remove ml-2">          
                <?php endif; ?>
            </div>
        </th>
        <?php $__currentLoopData = $field_shows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th class="font-bold fs-13"><?php echo e($field['note']); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <th class="font-bold fs-13">Chức năng</th>
    </tr>
    <?php $__currentLoopData = $data_tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $data = (array) $data;
        ?>
        <tr>
            <td class="text-center">
                <div class="d-flex align-items-center justify-content-center">
                    <span><?php echo e($key + 1); ?></span>
                    <?php if(!@$hideCheck): ?>
                        <input type="checkbox" class="c_one_remove ml-2" data-id="<?php echo e($data['id']); ?>">
                    <?php endif; ?>
                </div>
            </td>
            <?php $__currentLoopData = $field_shows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td>
                    <?php echo $__env->make('view_table.' . $field['type'] . '', [
                        'data' => $data,
                        'field' => $field,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td>
                <div class="func_btn_module text-center position-relative">
                    <button class="station-richmenu-main-btn-area change_menu_func_btn">
                        <i class="fa fa-ellipsis-v fs-15" aria-hidden="true"></i>
                    </button>
                    <div class="list_func_table">
                        <?php echo $__env->make('table.' . $tableItem['function_view'] . 'func_btn', ['data' => $data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/table_base_view.blade.php ENDPATH**/ ?>