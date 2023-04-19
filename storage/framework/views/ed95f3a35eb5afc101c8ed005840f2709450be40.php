<?php if($pindex > 0): ?>
<div class="quote_paper_item mt-3 border_green p-3 radius_5 position-relative" data-index=<?php echo e($pindex); ?>> 
    <span class="remove_ext_paper_quote d-flex bg_red color_white red_btn smooth"><i class="fa fa-times" aria-hidden="true"></i></span> 
<?php else: ?> 
    <input type="hidden" value="1" name="product[<?php echo e($j); ?>]['.$key_supp.'][<?php echo e($pindex); ?>][main]">
<?php endif; ?>
    <div class="quote_product_structure">
        <div class="mb-2 paper_product_config">
            <?php
                $key_supp = \TDConst::PAPER;
                $paper_compen_percent = \TDConst::COMPEN_PERCENT;
                $paper_compen_num = \TDConst::COMPEN_NUM;
            ?>
            <?php if($pindex > 0): ?>
                <?php
                    $pro_paper_extend_name = [
                        'name' => '',
                        'type' => 'select',
                        'note' => 'Chọn tên phụ',
                        'attr' => ['required' => 1, 'inject_class' => 'select_ext_name_paper'],
                        'other_data' => ['data' => ['options' => [
                            @$paper_name => 'Chọn tên phụ cho lệnh in này',
                            @$paper_name.' (Tờ bồi khay định hình)' => '1. Tờ bồi khay định hình',
                            @$paper_name.' (Tờ bồi thành)' => '2. Tờ bồi thành',
                            @$paper_name.' (Tờ bồi mặt trong hộp)' => '3. Tờ bồi mặt trong hộp',
                            @$paper_name.' (Khay giấy định hình)' => '4. Khay giấy định hình',
                            @$paper_name.' (Tờ phụ trang trí)' => '5. Tờ phụ trang trí'
                        ]]]
                    ] 
                ?>
                <?php echo $__env->make('view_update.view', $pro_paper_extend_name, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
                <span><?php echo e($pindex == 0 ? 'Phần giấy in' : 'Lệnh in thêm thứ '.$pindex); ?></span>
            </h3>
            <?php
                $pro_paper_name = [
                    'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][name]',
                    'note' => 'Tên SP giấy in',
                    'value' => @$paper_name,
                    'attr' => ['required' => 1, 'inject_class' => $pindex == 0 ? 'quote_receive_paper_name_main' : 'quote_receive_paper_name_ext']
                ] 
            ?>
            <?php echo $__env->make('view_update.view', $pro_paper_name, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <?php echo $__env->make('quotes.products.supplies.quantity_config', 
            ['compen_percent' => $paper_compen_percent, 'compen_num' => $paper_compen_num], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <div class="materal_paper_module">
                <?php
                    $pro_paper_materals = [
                        'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][size][materal]',
                        'type' => 'linking',
                        'note' => 'Chọn chất liệu giấy',
                        'attr' => ['required' => 1, 'inject_class' => 'select_paper_materal'],
                        'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'paper_materals']]
                    ] 
                ?>
                <?php echo $__env->make('view_update.view', $pro_paper_materals, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <?php
                    $pro_paper_qttv = [
                        'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][size][qttv]',
                        'note' => 'Định lượng',
                        'attr' => ['type_input' => 'number', 'required' => 1]
                    ] 
                ?>
                <?php echo $__env->make('view_update.view', $pro_paper_qttv, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_185 text-capitalize text-right mr-3">
                        <span class="fs-15 mr-1">*</span>Kích thước khổ giấy tối ưu
                    </label>
                    <div class="d-flex justify-content-between align-items-center">
                        <input type="number" name = 'product[<?php echo e($j); ?>][<?php echo e($key_supp); ?>][<?php echo e($pindex); ?>][size][length]' placeholder="Chiều dài (cm)" 
                        class="form-control medium_input" step="any" value="<?php echo e(@$pro_size['optimal_length']); ?>"> 
                        <span class="mx-3">X</span>
                        <input type="number" name = 'product[<?php echo e($j); ?>][<?php echo e($key_supp); ?>][<?php echo e($pindex); ?>][size][width]' placeholder="Chiều rộng (cm)" 
                        class="form-control medium_input" step="any"value="<?php echo e(@$pro_size['optimal_width']); ?>"> 
                        <div class="paper_price_config_input" style="display: none">
                            <div class="d-flex align-items-center">
                                <span class="mx-3">X</span>
                                <input type="number" name = 'product[<?php echo e($j); ?>][<?php echo e($key_supp); ?>][<?php echo e($pindex); ?>][size][unit_price]' placeholder="Đơn giá" 
                                class="form-control medium_input price_input_paper" disabled="disabled" step="any">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('quotes.products.papers.after_print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php if($pindex > 0): ?>
</div>   
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/ajax_view.blade.php ENDPATH**/ ?>