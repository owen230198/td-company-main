
<?php $__env->startSection('content'); ?>
<div class="base_content_view">
    <div class="header_chose_supp_device">
        <ul class="nav nav-pills mb-3 base_nav_link" id="base-tab" role="tablist">
            <?php if(@$type == 'devices'): ?>
                <?php $__currentLoopData = $supply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($item['device'])): ?>
                        <li class="nav-item">
                            <a class="nav-link<?php echo e($key == 0 ? ' active' : ''); ?>" id="<?php echo e($item['pro_field']); ?>-tab" data-toggle="pill" 
                            href="#<?php echo e($item['pro_field']); ?>" role="tab" aria-controls="<?php echo e($item['pro_field']); ?>" aria-selected="true">
                            <?php echo e($item['note']); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $supply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo e($key == 0 ? ' active' : ''); ?>" id="<?php echo e($item['pro_field']); ?>-tab" data-toggle="pill" 
                        href="#<?php echo e($item['pro_field']); ?>" role="tab" aria-controls="<?php echo e($item['pro_field']); ?>" aria-selected="true">
                        <?php echo e($item['note']); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
        <div class="tab-content" id="base-tabContent">
            <?php $__currentLoopData = $supply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane fade<?php echo e($key == 0 ? ' show active' : ''); ?>" id="<?php echo e($item['pro_field']); ?>" role="tabpanel" 
                aria-labelledby="base-<?php echo e($item['pro_field']); ?>-tab">
                    <?php if(@$type == 'devices'): ?>
                        <?php if(!empty($item['device'])): ?>
                            <div class="device_list_by_supply">
                                
                                <?php $__currentLoopData = $item['device']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_device => $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $link = $key_device == \TDConst::PRINT ? 'config-device-price/print_techs' 
                                        : 'view/devices?supply='.$item['pro_field'].'&key_device='.$key_device;
                                    ?>
                                    <a href="<?php echo e(url($link)); ?>" class="device_supp_item"><?php echo e($device); ?></a>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                    <?php
                        $materal_supplies = !empty(\TDConst::MATERAL_SUPPLY_TYPE[$item['pro_field']]) ? \TDConst::MATERAL_SUPPLY_TYPE[$item['pro_field']] : [];
                    ?>
                    <?php if(!empty($materal_supplies)): ?>
                        <div class="device_list_by_supply">
                            
                            <?php $__currentLoopData = $materal_supplies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materal_supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(url('view/'.$materal_supply['table'].'?type='.$materal_supply['key'])); ?>" class="device_supp_item">
                                    <?php echo e($materal_supply['name']); ?>

                                </a>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/config_devices/supply_types/view.blade.php ENDPATH**/ ?>