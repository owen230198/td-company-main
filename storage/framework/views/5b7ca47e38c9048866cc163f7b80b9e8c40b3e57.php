<div class="quote_supp_item decal_module <?php echo e($supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : ''); ?>" data-index=<?php echo e(@$supp_index ?? 0); ?>>
    <?php
        $key_supp = \TDConst::DECAL;
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $pro_decal_qty = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][qty]',
            'note' => 'Số lượng',
            'value' => !empty($supply_obj->id) ? @$supply_obj->product_qty : @$pro_qty,
            'attr' => ['type_input' => 'number', 'required' => 1]
        ];

        $arr_option = \TDConst::SELECT_SUPP_LINK;
        array_push($arr_option, 'Khác');
        $pro_decal_nqty = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][nqty]',
            'note' => 'Số bát',
            'type' => 'select',
            'attr' => ['inject_class' => 'select_decal_nqty'],
            'value' => @$supply_obj->product_qty,
            'other_data' => ['data' => ['options' => $arr_option]]
        ];
        $pro_decal_qty_supp = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][supp_qty_linking]',
            'note' => 'Tổng SL vật tư',
            'type' => 'select',
            'value' => @$supply_obj->supp_qty_linking,
            'other_data' => ['data' => ['options' => \TDConst::SELECT_SUPP_LINK]]
        ];
        $pro_decal_length_supp = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][length]',
            'note' => 'Kích thước chiều dài',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
            'value' => @$supply_size['length']
        ];

        $pro_decal_width_supp = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
            'value' => @$supply_size['width']
        ];
        $pro_decal_supply = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][supply_price]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'other_data' => ['config' => ['search' => 1], 
            'value' => @$supply_size['supply_price'],
            'data' => ['table' => 'supply_prices', 'where' => ['type' => $key_supp]]]
        ];
        $key_device_cut = \TDConst::CUT;
        $data_cut = !empty($supply_obj->cut) ? json_decode($supply_obj->cut, true) : []; 
    ?>

    <?php if(!empty($supply_obj->id)): ?>
        <input type="hidden" name="product[<?php echo e($pro_index); ?>][<?php echo e($key_supp); ?>][<?php echo e($supp_index); ?>][id]" value="<?php echo e($supply_obj->id); ?>">
    <?php endif; ?>

    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('view_update.view', $pro_decal_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('view_update.view', $pro_decal_nqty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('view_update.view', $pro_decal_qty_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

    <div class="module_decal_size" style="display: <?php echo e(@$supply_obj->nqty == 1 ? 'block' : 'none'); ?>">
        <?php echo $__env->make('view_update.view', $pro_decal_length_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

        <?php echo $__env->make('view_update.view', $pro_decal_width_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </div>

    <?php echo $__env->make('view_update.view', $pro_decal_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' => !empty($supply_obj->id) ? @$data_cut['machine'] : getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/decals/ajax_view.blade.php ENDPATH**/ ?>