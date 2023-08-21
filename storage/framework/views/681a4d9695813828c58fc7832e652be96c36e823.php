
<?php $__env->startSection('process'); ?>
    <?php echo $__env->make('quotes.products.papers.supply_print', ['no_exc' => 1, 'disable_all' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $nilon = json_decode($supply_obj->nilon, true);
        $metalai = json_decode($supply_obj->metalai, true);
    ?>
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư màng theo yêu cầu</span>
    </h3>
    <?php if(!empty($nilon['materal'])): ?>
        <?php
            $nilon_chose_supp = [
                'name' => 'c_supply[materal]['.\TDConst::NILON.']]',
                'type' => 'linking',
                'note' => 'Chọn màng nilon',
                'value' => '',
                'other_data' => [
                    'config' => ['search' => 1], 
                    'data' => [
                        'table' => 'square_warehouses', 
                        'where' => ['type' => 'nilon',
                                    'supp_price' => $nilon['materal'],
                                    'status' => 'imported']
                    ]
                ]
            ]
        ?>
        <?php echo $__env->make('view_update.view', $nilon_chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    
    <?php if(!empty($metalai['materal'])): ?>
        <?php
            $metalai_chose_supp = [
                'name' => 'c_supply[materal]['.\TDConst::METALAI.']',
                'type' => 'linking',
                'note' => 'Chọn màng cán metalai ('.$metalai['face'].' mặt)' ,
                'value' => '',
                'other_data' => [
                    'config' => ['search' => 1], 
                    'data' => [
                        'table' => 'square_warehouses', 
                        'where' => ['type' => 'metalai',
                                    'supp_price' => $metalai['materal'],
                                    'status' => 'imported']
                    ]
                ]
            ]
        ?>
        <?php echo $__env->make('view_update.view', $metalai_chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> 
    
    
    <?php if(!empty($metalai['cover_materal'])): ?>
        <?php
            $metalai_chose_supp = [
                'name' => 'c_supply[materal]['.\TDConst::COVER.']',
                'type' => 'linking',
                'note' => 'Chọn màng cán phủ trên ('.$metalai['cover_face'].' mặt)' ,
                'value' => '',
                'other_data' => [
                    'config' => ['search' => 1], 
                    'data' => [
                        'table' => 'square_warehouses', 
                        'where' => ['type' => 'cover',
                                    'supp_price' => $metalai['cover_materal'],
                                    'status' => 'imported']
                    ]
                ]
            ]
        ?>
        <?php echo $__env->make('view_update.view', $metalai_chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> 
    <div class="process_paper_plan">
        <?php echo $__env->make('orders.users.6.supply_handles.handle', [
            'where_size_supp' => [
                    'type' => 'paper',
                    'supp_price' => @$supply_size['materal'],
                    'status' => 'imported'
            ],
            'table_type' => 'print_warehouses',
            'compen_percent' => getDataConfig('QuoteConfig', 'COMPEN_PERCENT')
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/paper.blade.php ENDPATH**/ ?>