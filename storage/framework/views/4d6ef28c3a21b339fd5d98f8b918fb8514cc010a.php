<?php $__env->startSection('content'); ?>
    <div class="tab-content" id="base-tabContent">
        <div class="tab-pane show active" role="tabpanel" >
            <div class="device_list_by_supply">
                <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 mb-2 text-center"><?php echo e(@$title); ?></h3>
                <?php $__currentLoopData = $list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        if (@$step == 'machine') {
                            $link = 'list-worker-by-device/device?type='.$key;
                        }else{
                            $link = 'view/w_users?default_data={"type":"'.@$type.'","device":"'.$key.'"}';
                        }
                    ?>
                    <a href="<?php echo e(url($link)); ?>" class="device_supp_item">
                        <?php echo e($item); ?>

                    </a>    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/group_workers/view.blade.php ENDPATH**/ ?>