<div class="quote_supp_item decal_module <?php echo e($supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : ''); ?>" data-index=<?php echo e(@$supp_index ?? 0); ?>>
    <?php
        $key_supp = \TDConst::DECAL;
        $decal_compen_percent = (float) getDataConfig('QuoteConfig', 'SILK_COMPEN_PERCENT');
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $decal_plus = \TDConst::DECAL_SIZE_PLUS;
        $pro_decal_supply = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][supply_price]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'value' => @$supply_size['supply_price'],
            'other_data' => ['config' => ['search' => 1],
            'data' => ['table' => 'supply_prices', 'where' => ['type' => $key_supp]]]
        ];
        $key_device_cut = \TDConst::CUT;
        $data_cut = !empty($supply_obj->cut) ? json_decode($supply_obj->cut, true) : []; 
    ?>

    <?php echo $__env->make('quotes.products.supplies.check_index_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $decal_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $decal_plus, 'divide' => $decal_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('view_update.view', $pro_decal_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' => !empty($supply_obj->id) ? @$data_cut['machine'] : getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('quotes.products.note_field', ['key_supp' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/decals/ajax_view.blade.php ENDPATH**/ ?>