
<?php $__env->startSection('content'); ?>
    <div class="worker_salary_table">
        <table>
            <h3 class="fs-14 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                <?php echo e($title); ?> - Công nhân: <?php echo e(\Worker::getCurrent('name')); ?>

            </h3>
            <h3 class="fs-14 my-lg-4 mb-3 color_main">
                <i class="fa fa-money mr-2 fs-14 color_green" aria-hidden="true"></i>
                Thu nhập hiện tại: <?php echo e(number_format($summary)); ?>đ
            </h3>     
            <caption class="text-center fs-16 font_bold color_red">TỔNG TIỀN: <?php echo e(number_format($summary)); ?>Đ</caption>
            <thead>
                <tr>
                    <th scope="col">Mã lệnh</th>
                    <th scope="col">Tên lệnh</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">ĐG lượt</th>
                    <th scope="col">ĐG lên khuôn</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Thời gian</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td data-label="Mã lệnh">
                            <?php echo e($item->command); ?>

                        </td>
                        <td data-label="Tên lệnh">
                            <?php echo e($item->name); ?>

                        </td>
                        <td data-label="Số lượng">
                            <?php echo e($item->qty); ?>

                        </td>
                        <td data-label="ĐG lượt">
                            <?php echo e(number_format($item->work_price)); ?>đ
                        </td>
                        <td data-label="ĐG lên khuôn">
                            <?php echo e(number_format($item->shape_price)); ?>đ
                        </td>
                        <td data-label="Thành tiền">
                            <?php echo e(number_format($item->total)); ?>đ
                        </td>
                        <td data-label="Thời gian">
                            <div>
                                <?php echo $__env->make('view_table.datetime', ['value' => $item->submited_at], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Worker::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/salaries/view.blade.php ENDPATH**/ ?>