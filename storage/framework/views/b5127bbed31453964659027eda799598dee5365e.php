<div class="mb-2 paper_product_config">
    <?php
        $silk_compen_percent = 0;
        $silk_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
        $silk_divide = \App\Constants\TDConstant::SILK_SIZE_DIVIDE;
    ?>
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <p class="mb-1"><?php echo e($pindex == 0 ? 'Phần vật tư lụa' : 'Vật tư silk thêm '.$pindex); ?></p>
        <p class="mb-1">Kích thước tấm lụa là <?php echo e($silk_divide[0]); ?> x <?php echo e($silk_divide[1]); ?>cm</p>
    </h3>
    
    <div class="quantity_paper_module quantity_supply_module" data-percent = <?php echo e($silk_compen_percent); ?> data-num = <?php echo e($silk_compen_num); ?>>
        <?php
            $pro_silk_qty = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_silk_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php
            $pro_silk_nqty = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][nqty]',
                'note' => 'Số bát',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_silk_nqty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php
            $pro_silk_qty = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][silk_qty]',
                'note' => 'Tổng SL vật tư',
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        ?>
        <div class="d-flex align-items-center">
            <?php echo $__env->make('view_update.view', $pro_silk_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <span class="ml-1 color_gray"> x <?php echo e($silk_compen_percent); ?> % + <?php echo e($silk_compen_num); ?> BH</span>
        </div> 
    </div>

    <?php
        $silk_plus = \App\Constants\TDConstant::SILK_SIZE_PLUS; 
    ?>
    <div class="calc_size_module" data-plus = <?php echo e($silk_plus); ?> data-divide = <?php echo e($silk_divide[0]); ?>>
        <?php
            $pro_silk_temp_length = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][size][temp_length]',
                'note' => 'KT chiều dài sơ bộ',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT(cm)', 'inject_class' => 'temp_size_length'],
            ] 
        ?>
        <div class="d-flex alig-items-center">
            <?php echo $__env->make('view_update.view', $pro_silk_temp_length, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <span class="ml-1 color_gray mt-1"> + <?php echo e($silk_plus); ?>cm</span>
        </div>

        <?php
            $pro_silk_length = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][size][length]',
                'note' => 'KT chiều dài tối ưu',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Đơn vị cm', 'inject_class' => 'otm_size_length'],
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_silk_length, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <?php
        $pro_silk_width = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ];
    ?>
    <div class="d-flex">
        <?php echo $__env->make('view_update.view', $pro_silk_width, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="ml-1 color_gray mt-1"> + <?php echo e($silk_plus); ?>cm BH</span>
    </div>

    <?php
        $pro_silk_supply = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::SILK_SUPP]]]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_silk_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $pro_silk_ext_price = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][prescript_price]',
            'note' => 'Phát sinh giá lụa cao cấp',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
    ?>
    <div class="d-flex align-items-center">
        <?php echo $__env->make('view_update.view', $pro_silk_ext_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="ml-1 color_gray">Giá cho 1 sản phẩm</span>
    </div> 

    <?php
        $key_device_cut = \App\Constants\TDConstant::CUT;
    ?>
    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 'value' => getDeviceIdByKey($key_device_cut), 'element' => 'silk'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/silks/view.blade.php ENDPATH**/ ?>