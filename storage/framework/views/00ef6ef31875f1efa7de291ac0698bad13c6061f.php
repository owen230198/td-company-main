
<?php $__env->startSection('process'); ?>
    <?php echo $__env->make('quotes.products.papers.supply_print', ['no_exc' => 1, 'disable_all' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $nilon = json_decode($supply_obj->nilon, true);
        $metalai = json_decode($supply_obj->metalai, true);
    ?>
    <?php if(!empty($nilon['materal'])): ?>
        <?php echo $__env->make('orders.users.6.supply_handles.view_handles.squares.view', 
        ['key_supp' => \TDConst::NILON, 'note' => 'màng nilon', 'supp_price' => $nilon['materal']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    
    <?php if(!empty($metalai['materal'])): ?>
        <?php echo $__env->make('orders.users.6.supply_handles.view_handles.squares.view', 
        ['key_supp' => \TDConst::METALAI, 'note' => 'màng metalai', 'supp_price' => $metalai['materal']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> 
    
    
    <?php if(!empty($metalai['cover_materal'])): ?>
    <?php echo $__env->make('orders.users.6.supply_handles.view_handles.squares.view', 
        ['key_supp' => \TDConst::COVER, 
        'note' => 'màng phủ trên ('.$metalai['cover_face'].' mặt)', 
        'supp_price' => $metalai['cover_materal']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/orders/users/6/supply_handles/paper.blade.php ENDPATH**/ ?>