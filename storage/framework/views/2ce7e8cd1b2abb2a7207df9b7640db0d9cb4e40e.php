<div class="table_base_view position-relative">
    <table class="table table-bordered mb-2">
        <theader>
            <tr>
                <th class="font-bold fs-13 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>#</span>
                        <?php if(@$tableItem['remove'] == 1): ?>
                            <input type="checkbox" class="c_all_remove ml-2">          
                        <?php endif; ?>
                    </div>
                </th>
                <?php $__currentLoopData = $field_shows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th class="font-bold fs-13">
                        <?php echo e($field['note']); ?>

                    </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <th class="font-bold fs-13">Chức năng</th>
            </tr>
        </theader>
        <tbody>
            <?php $__currentLoopData = $data_tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <span><?php echo e($key + 1); ?></span>
                            <?php if(@$tableItem['remove'] == 1): ?>
                                <input type="checkbox" class="c_one_remove ml-2" data-id="<?php echo e($data->id); ?>">
                            <?php endif; ?>
                        </div>
                    </td>
                    <?php $__currentLoopData = $field_shows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td>
                            <?php
                                $arr = $field;
                                $arr['value'] = $data->{$field['name']};
                                $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                            ?>
                            <?php echo $__env->make('view_table.'.$field['type'], $arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td>
                        <div class="func_btn_module text-center position-relative">
                            <?php
                                $func_view = !empty($tableItem['function_view']) ? $tableItem['function_view'] : 'func_btn';
                            ?>
                            <?php echo $__env->make('table.'.$func_view, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/table_base_view.blade.php ENDPATH**/ ?>