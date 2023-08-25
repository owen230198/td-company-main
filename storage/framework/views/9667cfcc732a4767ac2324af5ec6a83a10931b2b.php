<?php
    $index = @$index ?? 0;
    $data_length = @$supply_size['width'] < @$supply_size['length'] ? @$supply_size['width'] : @$supply_size['length'];
    $base_supp_qty = calValuePercentPlus($supply_obj->supp_qty, $supply_obj->supp_qty, getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
    $base_need = $base_supp_qty*($data_length/10);
    $chose_supp = [
        'name' => 'c_supply[materal]['.$key_supp.']]['.$index.'][supp_price]',
        'type' => 'linking',
        'note' => 'Chọn khổ '.$note,
        'attr' => ['inject_class' => '__select_in_warehouse'],
        'other_data' => [
            'config' => ['search' => 1], 
            'data' => [
                'table' => 'square_warehouses', 
                'where' => ['type' => $key_supp,
                            'supp_price' => $supp_price,
                            'status' => 'imported']
            ]
        ]
    ]
?>
<div class="__module_multiple_handle_supply">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        Xuất vật tư <?php echo e(@$note); ?> theo yêu cầu
    </h3>
    <div class="__supply_handle_list" data-table = "square_warehouses">
        <div class="__handle_supply_item position-relative" data-need = <?php echo e(@$data_nedd ?? $base_need); ?>>
            <?php echo $__env->make('view_update.view', $chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="__handle_supply_detail_ajax color_green" style="display:none">
                <input type="hidden" name="c_supply[materal][<?php echo e($key_supp); ?>]][<?php echo e($index); ?>][qty]" value="">
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại trong kho : </label>
                    <p class="font_bold __square"></p><span>m</span>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Xuất ra cho lệnh này : </label>
                    <p class="font_bold __takeout"> </p><span>m</span>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại : </label>
                    <p class="font_bold __rest"></p><span>m</span>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Vật tư thiếu : </label>
                    <p class="color_red font_bold __lack"></p><span>m</span>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth __supply_handle_button_add">
       <i class="fa fa-plus mr-2 fs-14"></i>Thêm
    </button>
</div><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/orders/users/6/supply_handles/view_handles/square.blade.php ENDPATH**/ ?>