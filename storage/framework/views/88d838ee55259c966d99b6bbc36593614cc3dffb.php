
<?php $__env->startSection('content'); ?>
<div class="base_content_view">
    <div class="header_chose_supp_device">
        <ul class="nav nav-pills mb-3 base_nav_link" id="base-tab" role="tablist">
            <?php $__currentLoopData = $supply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($item['device'])): ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo e($key == 0 ? ' active' : ''); ?>" id="<?php echo e($item['pro_field']); ?>-tab" data-toggle="pill" 
                        href="#<?php echo e($item['pro_field']); ?>" role="tab" aria-controls="<?php echo e($item['pro_field']); ?>" aria-selected="true"><?php echo e($item['note']); ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <div class="tab-content" id="base-tabContent">
            <?php $__currentLoopData = $supply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($item['device'])): ?>
                    <div class="tab-pane fade<?php echo e($key == 0 ? ' show active' : ''); ?>" id="<?php echo e($item['pro_field']); ?>" role="tabpanel" 
                    aria-labelledby="base-<?php echo e($item['pro_field']); ?>-tab">
                        <div class="device_list_by_supply">
                            <?php $__currentLoopData = $item['device']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(url('config-device-price/devices?supply='.$item['pro_field'].'&key_device='.$key.'&name='.$device)); ?>" 
                                class="device_supp_item">
                                    <?php echo e($device); ?>

                                </a>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/config_devices/supplies/view.blade.php ENDPATH**/ ?>