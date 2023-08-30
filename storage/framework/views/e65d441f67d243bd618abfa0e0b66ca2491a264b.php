
<?php $__env->startSection('content'); ?>
    <div class="row my-4">
        <div class="col-lg-6 border_right_green">
            <div class="main_worker_home">
                <h3 class="fs-14 text-uppercase border_bot_eb pb-1 mb-1 text-center handle_title color_green">
                    Danh sách lệnh 
                    <a href="<?php echo e(url()->current()); ?>"><i class="fa fa-refresh ml-2 fs-14 color_green" aria-hidden="true"></i></a>
                </h3>   
            </div> 
            <form action="<?php echo e(url()->current()); ?>" method="GET" class="mt-3 mb-4 form_search position-relative">
                <input type="text" name="q" value=<?php echo e(@$key_search); ?>>
                <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                    <i class="fa fa-search fs-14" aria-hidden="true"></i>
                </button>
            </form>
            <div class="list_worker_command">
                <div class="row row-10">
                    <?php if(!empty($list_data)): ?>
                        <?php $__currentLoopData = $list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($item->{$worker['type']})): ?>
                                <?php
                                    $data = json_decode($item->{$worker['type']}, true);
                                ?>
                                <div class="col-lg-6 mb_20">
                                    <?php echo $__env->make('Worker::commands.items/'.$item_command, ['supply' => $item, 'command' => $data, 'key_type' => $worker['type']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>       
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Worker::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/main.blade.php ENDPATH**/ ?>