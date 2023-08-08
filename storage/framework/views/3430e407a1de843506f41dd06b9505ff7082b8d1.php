<?php
    $key_supp = \TDConst::PAPER;
    $paper_compen_percent = getDataConfig('QuoteConfig', 'COMPEN_PERCENT');

    $pro_paper_name = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][name]',
        'note' => 'Tên sản phẩm',
        'attr' => ['required' => 1, 
                    'inject_class' => $supp_index == 0 ? 'length_input quote_receive_paper_name_main' 
                    : 'length_input quote_receive_paper_name_ext'],
        'value' => @$supply_obj->name ?? @$supp_name
    ];
    $pro_paper_materals = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][materal]',
        'type' => 'linking',
        'note' => 'Chọn chất liệu giấy',
        'attr' => ['required' => 1, 'inject_class' => 'select_paper_materal'],
        'other_data' => ['data' => ['table' => 'materals','where' => ['type' => $key_supp], 'ext_option' => [['id' => 'other', 'name' => 'Giấy khác']]]],
        'value' => @$supply_size['materal']
    ];
    $pro_paper_qttv = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][qttv]',
        'note' => 'Định lượng',
        'attr' => ['type_input' => 'number', 'required' => 1],
        'value' => @$supply_size['qttv']
    ];
    $pro_paper_except = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.'][except_handle]',
        'note' => 'Lệnh in ghép',
        'type' => 'checkbox',
        'attr' => ['inject_class' => "__paper_except_handle"],
        'value' => @$supply_obj->except_handle
    ]
?>
<?php echo $__env->make('quotes.products.supplies.check_index_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($supp_index == 0 || @$supply_obj->main == 1): ?>
    <input type="hidden" value="1" name="product[<?php echo e($pro_index); ?>][<?php echo e($key_supp); ?>][<?php echo e($supp_index); ?>][main]">   
<?php endif; ?>
<div class="mb-2 paper_product_config">
    <?php if($supp_index > 0): ?>
        <?php
            $pro_paper_extend_name = [
                'name' => '',
                'type' => 'linking',
                'note' => 'Chọn tên phụ',
                'attr' => [
                    'required' => 1, 
                    'inject_class' => 'select_ext_name_paper', 
                    'inject_attr' => 'pro_index = '."$pro_index".' supp_index = '."$supp_index".''
                ],
                'other_data' => [
                    'data' => [
                        'table' => 'paper_extends',
                        'field_value' => 'name'
                    ]
                ]
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_paper_extend_name, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span><?php echo e($supp_index == 0 ? 'Phần giấy in' : 'Lệnh in thêm thứ '.$supp_index); ?></span>
    </h3>
    <?php echo $__env->make('view_update.view', $pro_paper_name, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $paper_compen_percent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="materal_paper_module">
        <?php echo $__env->make('view_update.view', $pro_paper_materals, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('view_update.view', $pro_paper_qttv, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('quotes.products.papers.size', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php if(empty($no_exc)): ?>
        <?php echo $__env->make('view_update.view', $pro_paper_except, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/supply_print.blade.php ENDPATH**/ ?>