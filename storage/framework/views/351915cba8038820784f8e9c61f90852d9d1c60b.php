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
    <?php if(\GroupUser::isAdmin() || \GroupUser::isDoBuying() || \GroupUser::isWarehouse()): ?>
        <?php
            $do_buy_fields = [
                [
                    'name' => 'total',
                    'type' => 'text',
                    'note' => 'Tổng tiền mua hàng',
                    'attr' => ['type_input' => 'number', 'readonly' => 1, 'inject_class' => '__buying_total_amount_input'],
                    'value' => @$dataItem['total'] ?? 0
                ],
                [
                    'name' => 'bill',
                    'note' => 'Hóa đơn mua hàng',
                    'type' => 'filev2',
                    'other_data' => ['role_update' => [\GroupUser::DO_BUYING], 'field_name' => 'bill'],
                    'value' => @$dataItem['bill']
                ]
            ]  
        ?>
        <?php $__currentLoopData = $do_buy_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $do_buy_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('view_update.view', $do_buy_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>  
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/json_supply.blade.php ENDPATH**/ ?>