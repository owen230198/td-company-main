<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Loại vật tư gia công : <strong class="color_main ml-1">
        <?php echo e(!empty($data_command->type) ? getSupplyNameByKey($data->command->type) : @$data_command->name); ?>.
    </strong>
</p>
<ul class="d-flex flex-wrap">
    <?php $__currentLoopData = $all_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $data_stage = !empty($data_command->{$key}) ? json_decode($data_command->{$key}, true) : [];
        ?>
        <?php if(!empty($data_stage)): ?>
            <?php
                $icon = getIconByStageHandle(@$data_stage['act']);
            ?>
            <li class="px-3 py-2 mr-2 mb-2 bg_white color_main color_<?php echo e($icon['color']); ?> box_shadow_3 radius_5">
                <i class="fa fa-<?php echo e($icon['icon']); ?> mr-1" aria-hidden="true"></i>
                <?php echo e($device); ?>    
            </li>   
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
</ul> <?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/commands/base_command_info.blade.php ENDPATH**/ ?>