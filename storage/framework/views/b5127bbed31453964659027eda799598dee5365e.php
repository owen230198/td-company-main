<div class="mb-2 paper_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span><?php echo e($pindex == 0 ? 'Phần vật tư vải lụa' : 'Vật tư vải lụa thêm '.$pindex); ?></span>
    </h3>
    <?php
        $silk_compen_percent = 0;
        $silk_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
    ?>
    
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
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_silk_nqty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php
        $pro_silk_qty_supp = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][silk_qty]',
            'note' => 'Tổng SL vật tư',
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $pro_silk_qty_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $pro_silk_length = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][size][length]',
            'note' => 'Kích thước chiều dài',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Mặc định 150cm'],
        ] 
    ?>
    <div class="d-flex align-items-center">
        <?php echo $__env->make('view_update.view', $pro_silk_length, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="ml-1 color_gray">Kích thước tấm cao su non là 150cm x 1000cm</span>
    </div> 

    <?php
        $pro_silk_width = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ]
    ?>
    <?php echo $__env->make('view_update.view', $pro_silk_width, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/silks/view.blade.php ENDPATH**/ ?>