
<?php $__env->startSection('process'); ?>
    <?php echo $__env->make('quotes.products.papers.supply_print', ['no_exc' => 1, 'disable_all' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $nilon = json_decode($supply_obj->nilon, true);
        $metalai = json_decode($supply_obj->metalai, true);
        $base_supp_qty = calValuePercentPlus($supply_obj->supp_qty, $supply_obj->supp_qty, getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
        $data_length = @$supply_size['width'] < @$supply_size['length'] ? @$supply_size['width'] : @$supply_size['length'];
        $base_need = $base_supp_qty*($data_length/10);
    ?>
    <?php if(!empty($nilon['materal'])): ?>
        <?php echo $__env->make('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => ['key_supp' => \TDConst::NILON, 'note' => 'màng nilon', 'supp_price' => $nilon['materal'],
        'base_need' => $base_need],
        'type' => 'square_warehouses'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    
    <?php if(!empty($metalai['materal'])): ?>
        <?php echo $__env->make('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => ['key_supp' => \TDConst::METALAI, 'note' => 'màng metalai', 'supp_price' => $metalai['materal'],
        'base_need' => $base_need],
        'type' => 'square_warehouses'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> 
    
    
    <?php if(!empty($metalai['cover_materal'])): ?>
    <?php echo $__env->make('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => ['key_supp' => \TDConst::COVER, 
        'note' => 'màng phủ trên ('.$metalai['cover_face'].' mặt)', 
        'supp_price' => $metalai['cover_materal'],
        'base_need' => $base_need],
        'type' => 'square_warehouses'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> 
    <div class="process_paper_plan">
        <?php echo $__env->make('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => ['key_supp' => \TDConst::PAPER, 
        'note' => 'giấy in', 
        'supp_price' => $supply_size['materal'],
        'qtv' => $supply_size['qttv'],
        'base_need' => $base_supp_qty],
        'type' => 'print_warehouses'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div> 
    
    <div class="plan_over_supply">
        <?php echo $__env->make('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => [
        'title_handle' => 'Nhập kho băng lề giấy in', 
        'supp_price' => $supply_size['materal'],
        'qtv' => $supply_size['qttv']],
        'type' => 'over_supplies'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/paper.blade.php ENDPATH**/ ?>