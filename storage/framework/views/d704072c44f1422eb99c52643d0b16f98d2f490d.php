<div class="mb-2 paper_product_config decal_module">
    <?php
        $decal_divide = \App\Constants\TDConstant::DECAL_SIZE_DIVIDE;
    ?>
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <p class="mb-1"><?php echo e($pindex == 0 ? 'Phần vật tư decal nhung' : 'Vật tư decal nhung thêm '.$pindex); ?></p>
        <p class="mb-1">Kích thước tấm decal nhung là <?php echo e($decal_divide[0]); ?> x <?php echo e($decal_divide[1]); ?>cm</p>
    </h3>
    <?php
        $pro_decal_qty = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][qty]',
            'note' => 'Số lượng',
            'value' => @$pro_qty,
            'attr' => ['type_input' => 'number', 'required' => 1]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_decal_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $arr_option = \App\Constants\TDConstant::SELECT_SUPP_LINK;
        array_push($arr_option, 'Khác');
        $pro_decal_nqty = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][nqty]',
            'note' => 'Số bát',
            'type' => 'select',
            'attr' => ['inject_class' => 'select_decal_nqty'],
            'other_data' => ['data' => ['options' => $arr_option]]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_decal_nqty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php
        $pro_decal_qty_supp = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][decal_qty]',
            'note' => 'Tổng SL vật tư',
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_decal_qty_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    
   <div class="module_decal_size" style="display: none">
        <?php
            $pro_decal_length_supp = [
                'name' => 'product['.$j.'][decal]['.$pindex.'][size][length]',
                'note' => 'Kích thước chiều dài',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_decal_length_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

        <?php
            $pro_decal_width_supp = [
                'name' => 'product['.$j.'][decal]['.$pindex.'][size][width]',
                'note' => 'Kích thước chiều rộng',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_decal_width_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
   </div>

    <?php
        $pro_decal_supply = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::DECAL_SUPP]]]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_decal_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $key_device_cut = \App\Constants\TDConstant::CUT;
    ?>
    <?php echo $__env->make('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 'value' => getDeviceIdByKey($key_device_cut), 'element' => 'decal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/decals/view.blade.php ENDPATH**/ ?>