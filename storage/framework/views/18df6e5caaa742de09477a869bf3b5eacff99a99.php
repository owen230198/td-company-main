
<?php $__env->startSection('type'); ?>
    <div class="table_base_view position-relative">
        <table class="table table-bordered mb-2 table_main">
            <tr>
                <th class="font-bold fs-13 text-center ">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>#</span>
                        <input type="checkbox" class="c_all_remove ml-2">     
                    </div>
                </th>
                <th class="font-bold fs-13">Thời gian</th>
                <th class="font-bold fs-13">Nội dung thực hiện</th>
                <th class="font-bold fs-13 ">Chức năng</th>
            </tr>
            <tbody>
                <?php $__currentLoopData = $data_tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <span><?php echo e($key + 1); ?></span>
                                <input type="checkbox" class="c_one_remove ml-2" data-id="<?php echo e($data->id); ?>">
                            </div>
                        </td>
                        <td>
                            <?php echo $__env->make('view_table.datetime', ['value' => @$data->created_at], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                        <?php
                            $htable = \DB::table('n_tables')->where('name', $data->table_map)->first();
                        ?>
                        <td>
                            <div>
                                Nhân viên <strong class="color_green"><?php echo e(getFieldDataById('name', 'n_users', $data->user)); ?></strong> đã 
                                <strong class="color_red"><?php echo e(mb_strtolower(getActionByKey($data->action))); ?></strong> 1 <?php echo e(@$htable->note); ?>

                            </div>
                        </td>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('table.base_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/history.blade.php ENDPATH**/ ?>