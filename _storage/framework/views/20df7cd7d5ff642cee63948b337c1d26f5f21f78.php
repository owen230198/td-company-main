<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/animate.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="home_index">
        <div class="row justify-content-center">
            <?php if(!empty($not_accepted_table) && is_array($not_accepted_table)): ?>
                <div class="col-12 my-4">
                    <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">Yêu xử lý công việc</h2>
                    <div class="row row-5 justify-content-center">
                        <?php $__currentLoopData = $not_accepted_table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-2 col-md-6 mb_10 text-center">
                            <?php
                                $command_count = getCountDataTable($command['table'], $command['condition']);
                            ?>
                            <a href=<?php echo e(asset($command['link'])); ?> 
                            class="main_item_command h-100 smooth box_shadow_3 radius_5 w-100 p-2 h-100">
                                <div class="position-relative d-inline-block">
                                    <img src="<?php echo e(asset('frontend/admin/images/'.$command['icon'].'_icon.png')); ?>" alt="order-icon" class="command_icon smooth">
                                    <?php if($command_count > 0): ?>
                                        <p class="font_bold notify_style">
                                            <?php echo e($command_count > 99 ? '99+' : $command_count); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="command_detail ml-2">
                                    <p class="command_detail_tiltle font_bold color_main">
                                        <?php echo e($command['text']); ?>

                                    </p>
                                </div>
                            </a>
                        </div>     
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>   
            <?php endif; ?>
            <div class="col-lg-6 text-center">
                <h2 class="fs-15 text-uppercase font_bold pb-1 mb-3 border_bot_eb">thống kê đơn hàng trong năm</h2>
                <canvas id="bar-chart" width="400" height="300" class="bg_white radius_5 p-2 mb-3 box_shadow_3"></canvas>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('frontend/admin/script/chart.js')); ?>" defer></script>
    <script src="<?php echo e(asset('frontend/admin/script/index.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/td-company-app-main/resources/views/main.blade.php ENDPATH**/ ?>