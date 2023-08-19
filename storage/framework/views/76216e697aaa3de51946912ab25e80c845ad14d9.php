
<?php $__env->startSection('process'); ?>
    <?php
        $key_supp = \TDConst::DECAL;
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $decal_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $decal_plus = \TDConst::DECAL_SIZE_PLUS;
        $pro_decal_supply = [
            'name' => '',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'value' => @$supply_size['supply_price'],
            'other_data' => ['config' => ['search' => 1],
            'data' => ['table' => 'materals', 'where' => ['type' => $key_supp]]]
        ];
        $decal_chose_supp = [
            'name' => 'c_supply[supp_price]',
            'type' => 'linking',
            'note' => 'Chọn nhung trong kho',
            'value' => '',
            'other_data' => [
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'square_warehouses', 
                    'where' => ['type' => $key_supp,
                                'supp_price' => @$supply_size['supply_price'],
                                'status' => 'imported']
                ]
            ]
        ]
    ?>
    <?php echo $__env->make('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('quotes.products.supplies.quantity_config', ['compen_percent' => $decal_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('quotes.products.supplies.size_config', ['plus' => $decal_plus, 'divide' => $decal_divide], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('view_update.view', $pro_decal_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nhung theo yêu cầu</span>
    </h3>

    <?php echo $__env->make('view_update.view', $decal_chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/decal.blade.php ENDPATH**/ ?>