<?php
    $chose_supp = [
        'name' => 'c_supply[materal]['.$key_supp.']]['.$index.'][supp_price]',
        'type' => 'linking',
        'note' => 'Chọn khổ '.$note,
        'attr' => ['inject_class' => '__select_in_warehouse'],
        'other_data' => [
            'config' => ['search' => 1, 'except_linking' => 1], 
            'data' => [
                'table' => 'square_warehouses', 
                'where' => ['type' => $key_supp,
                            'supp_price' => $supp_price,
                            'status' => 'imported']
            ]
        ]
    ]
?>
<div class="__handle_supply_item position-relative <?php echo e($index > 0 ? 'mt-3 pt-3 border_top_eb' : ''); ?>" data-take = "0">
    <?php if($index > 0): ?>
        <span class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth">
            <i class="fa fa-times" aria-hidden="true"></i>
        </span> 
    <?php endif; ?>
    <?php echo $__env->make('view_update.view', $chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="__handle_supply_detail_ajax color_green" style="display:none">
        <input type="hidden" name="c_supply[materal][<?php echo e($key_supp); ?>]][<?php echo e($index); ?>][qty]" value="">
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại trong kho : </label>
            <p class="font_bold __square"></p>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Xuất ra cho lệnh này : </label>
            <p class="font_bold __takeout"> </p>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại : </label>
            <p class="font_bold __rest"></p>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Vật tư thiếu : </label>
            <p class="color_red font_bold __lack"></p>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/view_handles/squares/item.blade.php ENDPATH**/ ?>