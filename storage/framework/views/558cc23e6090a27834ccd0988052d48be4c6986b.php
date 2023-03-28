<div class="mb-2 paper_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span><?php echo e($pindex == 0 ? 'Phần vật tư carton' : 'Vật tư carton thêm '.$pindex); ?></span>
    </h3>
    <?php
        $carton_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;
        $carton_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
    ?>
    
    <div class="quantity_paper_module" data-percent = <?php echo e($carton_compen_percent); ?> data-num = <?php echo e($carton_compen_num); ?>>
        <?php
            $pro_carton_qty = [
                'name' => 'product['.$j.'][carton]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_carton_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php
            $pro_carton_nqty = [
                'name' => 'product['.$j.'][carton]['.$pindex.'][nqty]',
                'note' => 'Số bát/tờ in',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_carton_nqty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php
            $pro_carton_qty = [
                'name' => 'product['.$j.'][carton]['.$pindex.'][carton_qty]',
                'note' => 'Số lượng tờ in',
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        ?>
        <div class="d-flex align-items-center">
            <?php echo $__env->make('view_update.view', $pro_carton_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <span class="ml-1 color_gray">Thêm <?php echo e($carton_compen_percent); ?> % + <?php echo e($carton_compen_num); ?> BH</span>
        </div> 
    </div>
    <div class="d-flex align-items-center mb-2 fs-13">
        <label class="mb-0 min_180 text-capitalize text-right mr-3">
            <span class="fs-15 mr-1">*</span>Kích thước
        </label>
        <div class="d-flex justify-content-between align-items-center<?php echo e($pindex == 0 ? ' carton_module_size' : ''); ?>">
            <input type="number" name = 'product[<?php echo e($j); ?>][carton][<?php echo e($pindex); ?>][size][length][total]' placeholder="Chiều dài (cm)" 
            class="form-control medium_input input_size_length" step="any"> 
            <span class="mx-3">X</span>
            <input type="number" name = 'product[<?php echo e($j); ?>][carton][<?php echo e($pindex); ?>][size][width][total]' placeholder="Chiều rộng (cm)" 
            class="form-control medium_input input_size_width" step="any"> 
        </div>
    </div>

    <?php
        $pro_carton_supply = [
            'name' => 'product['.$j.'][carton]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::CARTON_SUPP]]]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_carton_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $pro_carton_supply = [
            'name' => 'product['.$j.'][carton]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn định lượng',
            'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
            'other_data' => ['config' => ['search_box' => 1], 'data' => ['table' => 'supply_prices']]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_carton_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_mill = \App\Constants\TDConstant::MILL;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
    ?>
    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => 'carton'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_mill, 'note' => 'Máy phay', 'value' => getDeviceIdByKey($key_device_mill), 'element' => 'carton'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy phay', 'value' => getDeviceIdByKey($key_device_peel), 'element' => 'carton'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/cartons/view.blade.php ENDPATH**/ ?>