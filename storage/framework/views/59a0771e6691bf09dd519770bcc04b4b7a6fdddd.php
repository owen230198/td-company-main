<div class="mb-2 paper_product_config">
    <?php
        $key_supp = \App\Constants\TDConstant::MICA;
        $mica_divide = \App\Constants\TDConstant::MICA_SIZE_DIVIDE;
        $mica_compen_percent = 0;
        $mica_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
        $mica_plus = \App\Constants\TDConstant::MICA_SIZE_PLUS; 
        $pro_mica_supply = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][supply_price]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supply_prices', 'where' => ['type' => $key_supp]]]
        ];
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
        $key_device_cut = \App\Constants\TDConstant::CUT;
    ?>
    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $mica_divide, 'name' => 'mica'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $mica_compen_percent, 'compen_num' => $mica_compen_num], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $mica_plus, 'divide' => $mica_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('view_update.view', $pro_mica_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' =>  getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 
    'value' =>  getDeviceId(['key_device' => $key_device_elevate, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 
    'value' =>  getDeviceId(['key_device' => $key_device_peel, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/micaes/view.blade.php ENDPATH**/ ?>