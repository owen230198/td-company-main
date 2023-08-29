<?php
    $chose_supp = [
        'name' => 'c_supply[square]['.$key_supp.']['.$index.'][size_type]',
        'type' => 'linking',
        'note' => 'Chọn khổ '.$note,
        'attr' => ['inject_class' => '__select_in_warehouse'],
        'other_data' => [
            'config' => ['search' => 1, 'except_linking' => 1], 
            'data' => [
                'table' => 'square_warehouses', 
                'where' => ['type' => $key_supp,
                            'supp_price' => $supp_price,
                            'except_value' => '{"field" :"id","value":"'.@$except_value.'"}',
                            'status' => 'imported']
            ]
        ]
    ]
?>
<div class="__handle_supply_item position-relative <?php echo e($index > 0 ? 'mt-3 pt-3 border_top_eb' : ''); ?>" data-take = "0">
    <?php if($index > 0): ?>
        <button type="button" class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth __supply_handle_btn_remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button> 
    <?php endif; ?>
    <?php echo $__env->make('view_update.view', $chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="__handle_supply_detail_ajax color_green" style="display:none">
        <input type="hidden" name="c_supply[square][<?php echo e($key_supp); ?>][<?php echo e($index); ?>][qty]" value="">
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại trong kho : </label>
            <p class="font_bold __inhouse"></p>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Xuất ra cho lệnh này : </label>
            <p class="font_bold __takeout"> </p>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại : </label>
            <p class="font_bold __rest"></p>
        </div>
        <input type="hidden" name="c_supply[square][<?php echo e($key_supp); ?>][<?php echo e($index); ?>][lack]" value="">
        <div class="align-items-center mb-2 fs-13" style="display: flex">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Vật tư thiếu : </label>
            <p class="color_red font_bold __lack"></p>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/view_handles/square_warehouses/item.blade.php ENDPATH**/ ?>