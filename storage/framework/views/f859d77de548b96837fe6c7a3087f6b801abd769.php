<?php if($list_data->isEmpty()): ?>
    <p class="fs-15 font-italic color_red text-center mb-3">Chưa có sản phẩm cùng kích thước khuôn đã sản xuất !</p>
<?php else: ?>
    <div class="table_base_view position-relative mb-3">
        <table class="table table-bordered table_main">
            <theader>
                <tr>
                    <th class="font-bold fs-13 text-center"><span>#</span></th>
                    <th class="font-bold fs-13">Mã Đơn</th>
                    <th class="font-bold fs-13">Sản phẩm</th>
                    <th class="font-bold fs-13">Kích thước</th>  
                    <th class="font-bold fs-13">Phụ trách</th> 
                    <th class="font-bold fs-13">File khuôn (kinh doanh)</th> 
                    <th class="font-bold fs-13">File khuôn (kỹ thuật)</th>     
                </tr>
            </theader>
            <tbody>
                <?php $__currentLoopData = $list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><span><?php echo e($key + 1); ?></span></td>
                        <td><?php echo e($data->code); ?></td>
                        <td><?php echo e($data->name); ?></td>
                        <td><?php echo e(getSizeTitleProduct($data)); ?></td>
                        <td><?php echo e(getFieldDataById('name', 'n_users', $data->created_by)); ?></td>
                        <td>
                            <?php echo $__env->make('view_table.file', ['value' => $data->sale_shape_file], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                        <td>
                            <?php echo $__env->make('view_table.file', ['value' => $data->tech_shape_file], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/suggest_product_submited.blade.php ENDPATH**/ ?>