
<?php $__env->startSection('content'); ?>
    <div class="worker_salary_table">
        <table>
            <caption><?php echo e($title); ?> - Công nhân: <?php echo e(\Worker::getCurrent('name')); ?></caption>
            <thead>
                <tr>
                    <th scope="col">Mã lệnh</th>
                    <th scope="col">Tên lệnh</th>
                    <th scope="col">Chi tiết sản xuất</th>
                    <th scope="col">Thời gian chấm công</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Account">Visa - 3412</td>
                </tr>
            </tbody>
        </table>
    </div>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Worker::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/salaries/view.blade.php ENDPATH**/ ?>