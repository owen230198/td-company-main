
<?php $__env->startSection('content'); ?>
    <div class="home_index">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">thống kê đơn hàng trong năm</h2>
                <canvas id="bar-chart" width="400" height="300" class="bg_white radius_5 p-2 mb-3 box_shadow_3"></canvas>
            </div>
            <?php if(!empty($not_accepted_table) && is_array($not_accepted_table)): ?>
                <div class="col-lg-6">
                    <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">Đơn hàng & Lệnh chờ duyệt</h2>
                    <div class="row row-7">
                        <?php $__currentLoopData = $not_accepted_table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6 mb-3">
                            <a href=<?php echo e(asset('view/'.$table.'?default_data={"status":"not_accepted"}')); ?> class="main_item_command h-100 smooth d-flex align-items-center position-relative h-100">
                                <img src="<?php echo e(asset('frontend/admin/images/'.$table.'_icon.png')); ?>" alt="order-icon" 
                                class="command_icon smooth">
                                <div class="command_detail ml-2">
                                    <p class="command_detail_tiltle text-uppercase font_bold color_main">
                                        <?php echo e($text); ?>

                                    </p>
                                    <p class="fs-18 font_bold color_red"><?php echo e(getCountDataTable($table, ['status' => 'not_accepted'])); ?></p>
                                    <p class="border_top_eb pt-2 mt-2 fs-12 color_gray d-flex align-items-center">
                                        Xem chi tiết 
                                    </p>
                                </div>
                            </a>
                        </div>     
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>   
            <?php endif; ?>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('frontend/admin/script/chart.js')); ?>" defer></script>
    <script src="<?php echo e(asset('frontend/admin/script/index.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/main.blade.php ENDPATH**/ ?>