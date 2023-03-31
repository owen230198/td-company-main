<div class="mb-2 paper_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span><?php echo e($pindex == 0 ? 'Phần vật tư cao su non' : 'Vật tư cao su non thêm '.$pindex); ?></span>
    </h3>
    <?php
        $rubber_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;
        $rubber_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
    ?>
    
    <div class="quantity_paper_module quantity_supply_module" data-percent = <?php echo e($rubber_compen_percent); ?> data-num = <?php echo e($rubber_compen_num); ?>>
        <?php
            $pro_rubber_qty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_rubber_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php
            $pro_rubber_nqty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][nqty]',
                'note' => 'Số bát',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_rubber_nqty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php
            $pro_rubber_qty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][rubber_qty]',
                'note' => 'Tổng SL vật tư',
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        ?>
        <div class="d-flex align-items-center">
            <?php echo $__env->make('view_update.view', $pro_rubber_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <span class="ml-1 color_gray"> x <?php echo e($rubber_compen_percent); ?> % + <?php echo e($rubber_compen_num); ?> BH</span>
        </div> 
    </div>
    <?php
        $pro_rubber_length = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][size][length]',
            'note' => 'Kích thước chiều dài',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Mặc định 125cm'],
        ] 
    ?>
    <div class="d-flex align-items-center">
        <?php echo $__env->make('view_update.view', $pro_rubber_length, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="ml-1 color_gray">Kích thước tấm cao su non là 125cm x 250cm</span>
    </div> 

    <?php
        $pro_rubber_width = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ];
        $rubber_width_plus = \App\Constants\TDConstant::RUBBER_SIZE_WIDTH_PLUS 
    ?>
    <div class="d-flex align-items-center">
        <?php echo $__env->make('view_update.view', $pro_rubber_width, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="ml-1 color_gray"> + <?php echo e($rubber_width_plus); ?>cm BH</span>
    </div> 
    
    <?php
        $pro_rubber_supply = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::RUBB_SUPP]]]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_rubber_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $pro_rubber_supply = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn định lượng',
            'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
            'other_data' => ['config' => ['search_box' => 1], 'data' => ['table' => 'supply_prices']]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_rubber_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
    ?>
    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => 'rubber'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Bóc lề', 'value' => getDeviceIdByKey($key_device_peel), 'element' => 'rubber'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/rubbers/view.blade.php ENDPATH**/ ?>