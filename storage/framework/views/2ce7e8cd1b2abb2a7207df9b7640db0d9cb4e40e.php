<div class="table_base_view position-relative">
    <table class="table table-bordered mb-2 table_main">
        <theader>
            <tr>
                <th class="font-bold fs-13 text-center parentth" rowspan="<?php echo e(@$rowspan); ?>">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>#</span>
                        <?php if(@$tableItem['remove'] == 1): ?>
                            <input type="checkbox" class="c_all_remove ml-2">          
                        <?php endif; ?>
                    </div>
                </th>
                <?php $__currentLoopData = $field_shows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($field['parent'] == 0): ?>
                        <th class="font-bold fs-13" rowspan="<?php echo e(!empty($field['colspan']) ? 1 : @$rowspan); ?>" colspan="<?php echo e(!empty($field['colspan']) ? $field['colspan'] : 1); ?>">
                            <?php echo e($field['note']); ?>

                        </th>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <th class="font-bold fs-13 parentth" rowspan="<?php echo e(@$rowspan); ?>">Chức năng</th>
            </tr>
            <?php if(@$rowspan == 2): ?>
                <tr>
                    <?php $__currentLoopData = $field_shows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($field['type'] == 'group' && !empty($field['child'])): ?>
                            <?php $__currentLoopData = $field['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="font-bold fs-13">
                                    <?php echo e($field_child['note']); ?>

                                </th>   
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endif; ?>
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
                        <?php if($field['type'] != 'group'): ?>
                            <td>
                                <?php
                                    $arr = $field;
                                    $arr['obj_id'] = $data->id;
                                    $arr['value'] = @$data->{$field['name']};
                                    $arr['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
                                    $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                                ?>
                                <?php echo $__env->make('view_table.'.$field['type'], $arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td>
                        <div class="func_btn_module text-center position-relative">
                            <?php echo $__env->make('table.func_btn', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/table_base_view.blade.php ENDPATH**/ ?>