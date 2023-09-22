<?php echo $__env->make('quotes.products.list_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="tab-content" id="quote-pro-tabContent">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro_index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tab-pane fade<?php echo e($pro_index == 0 ? ' show active' : ''); ?> tab_pane_quote_pro" id="quote-pro-<?php echo e($pro_index); ?>" role="tabpanel" aria-labelledby="quote-pro-<?php echo e($pro_index); ?>-tab">
            <div class="config_handle_paper_pro">
                <div class="mb-2 base_product_config">
                    <?php
                        $pro_base_name_input = 'product['.$pro_index.']';
                        $arr_pro_field = [
                            [
                                'name' => $pro_base_name_input.'[name]',
                                'note' => 'Tên sản phẩm',
                                'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name length_input', 'placeholder' => 'Nhập tên'],
                                'value' => !empty($product['id']) ? @$product['name'] : ''
                            ],
                            [
                                'name' => $pro_base_name_input.'[qty]',
                                'note' => 'Số lượng sản phẩm',
                                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty', 'placeholder' => 'Nhập số lượng'],
                                'value' => @$product['qty']
                            ],
                            [
                                'name' => $pro_base_name_input.'[design]',
                                'note' => 'thiết kế',
                                'type' => 'linking',
                                'other_data' => ['data' => ['table' => 'design_types', 'select' => ['id', 'name']]],
                                'value' => @$product['design']
                            ]
                        ];
                        $category_product_field = [
                            'name' => $pro_base_name_input.'[category]',
                            'type' => 'linking',
                            'note' => 'Nhóm sản phẩm',
                            'attr' => ['required' => 1 , 
                                'inject_class' => 'select_quote_procategory __select_product_category __category_product', 
                                'inject_attr' => 'proindex='.$pro_index,
                                'readonly' => !empty($product['category']) ? 1 : 0
                            ],
                            'other_data' => ['data' => ['table' => 'product_categories']],
                            'value' => @$product['category']
                        ];
                        $style_product_field = [
                            'name' => $pro_base_name_input.'[product_style]',
                            'type' => 'linking',
                            'note' => 'Kiểu hộp',
                            'attr' => ['required' => 1 , 
                                'inject_class' => '__select_product_style __style_product',
                                'disable_field' => 1
                            ],
                            'other_data' => ['data' => ['table' => 'product_styles']],
                            'value' => @$product['product_style']
                        ];
                    ?>

                    <?php $__currentLoopData = $arr_pro_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('view_update.view', $field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="__style_product_select_module">
                        <?php echo $__env->make('view_update.view', $category_product_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="__style_select mt-2" style="display: <?php echo e(!empty($product['product_style']) ? 'block' : 'none'); ?>">
                            <?php echo $__env->make('view_update.view', $style_product_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <?php if(\GroupUser::isSale() || \GroupUser::isTechApply() || \GroupUser::isAdmin()): ?>
                        <?php echo $__env->make('view_update.view', [
                            'name' => $pro_base_name_input.'[sale_shape_file]',
                            'note' => 'Khuôn kinh doanh tính giá',
                            'type' => 'file',
                            'other_data' => ['role_update' => [\GroupUser::SALE]],
                            'value' => @$product['sale_shape_file'] 
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <?php if(!empty($order_get)): ?>
                        <?php echo $__env->make('orders.products.extend_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
                    <?php endif; ?>
                </div>
                <div class="ajax_product_view_by_category">
                    
                </div>
                <?php if(!empty($product['id'])): ?>
                    <input type="hidden" name="<?php echo e($pro_base_name_input); ?>[id]" value="<?php echo e($product['id']); ?>">
                    <?php if(empty($not_detail)): ?>
                        <div class="text-center">
                            <button type="button" 
                            class="main_button color_white bg_green border_green radius_5 font_bold smooth show_config_handle_quote"
                            proindex = <?php echo e($pro_index); ?> data-proid = <?php echo e($product['id']); ?> data-category = <?php echo e(@$product['category']); ?>>
                                <i class="fa fa-angle-double-down fs-14 mr-2" aria-hidden="true"></i>
                                <span>Xem chi tiết sản xuất</span>
                            </button>
                        </div>    
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/ajax_view.blade.php ENDPATH**/ ?>