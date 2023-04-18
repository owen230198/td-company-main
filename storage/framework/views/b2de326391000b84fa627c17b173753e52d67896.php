<div class="mb-2 paper_product_config">
    <?php
        $key_supp = \App\Constants\TDConstant::RUBBER;
        $rubber_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;
        $rubber_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
        $rubber_divide = \App\Constants\TDConstant::RUBBER_SIZE_DIVIDE;
        $rubber_plus = \App\Constants\TDConstant::RUBBER_SIZE_PLUS; 
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
        $key_device_cut = \App\Constants\TDConstant::CUT;
    ?>
    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $rubber_divide, 'name' => 'cao su non'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $rubber_compen_percent, 'compen_num' => $rubber_compen_num], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $rubber_plus, 'divide' => $rubber_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('quotes.products.supplies.select_supply_type', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' =>  getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 
    'value' =>  getDeviceId(['key_device' => $key_device_elevate, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 
    'value' =>  getDeviceId(['key_device' => $key_device_peel, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/rubbers/view.blade.php ENDPATH**/ ?>