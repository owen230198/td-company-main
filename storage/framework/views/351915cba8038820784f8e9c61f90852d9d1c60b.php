<?php
    $arr_value = !empty($value) ? json_decode($value, true) : [];
?>
<div class="json_supply_buy p-2 radius_5 box_shadow_3">
    <div class="list_supply_buy">
        <?php if(count($arr_value) > 0): ?>
            <?php $__currentLoopData = $arr_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $supp_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('supply_buyings.supply_item', ['index' => $key, 'value' => $supp_val], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php echo $__env->make('supply_buyings.supply_item', ['index' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
        <?php endif; ?>
    </div>
    <?php if(\GroupUser::isPlanHandle()): ?>
    <div class="text-center">
        <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold sooth add_supp_buy_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm vật tư
        </button>
    </div>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/json_supply.blade.php ENDPATH**/ ?>