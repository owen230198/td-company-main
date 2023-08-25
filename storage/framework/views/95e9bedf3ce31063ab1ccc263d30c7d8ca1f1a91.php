<?php
    $index = @$index ?? 0;
    $data_length = @$supply_size['width'] < @$supply_size['length'] ? @$supply_size['width'] : @$supply_size['length'];
    $base_supp_qty = calValuePercentPlus($supply_obj->supp_qty, $supply_obj->supp_qty, getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
    $base_need = $base_supp_qty*($data_length/10);
?>
<div class="__module_multiple_handle_supply">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        Xuất vật tư <?php echo e(@$note); ?> theo yêu cầu
    </h3>
    <div class="__supply_handle_list" data-table = "square_warehouses" data-need ="<?php echo e($base_need); ?>">
        <?php echo $__env->make('orders.users.6.supply_handles.view_handles.squares.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
    </div>
    <button type="button" 
    class="main_button color_white bg_green border_green radius_5 font_bold smooth __supply_handle_button_add" 
    data-type = "squares"
    data-key = <?php echo e($key_supp); ?>

    data-note = <?php echo e($note); ?>

    data-supp = <?php echo e($supp_price); ?>>
       <i class="fa fa-plus mr-2 fs-14"></i>Thêm
    </button>
</div><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/orders/users/6/supply_handles/view_handles/squares/view.blade.php ENDPATH**/ ?>