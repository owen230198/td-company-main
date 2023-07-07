
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/order.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="config_content">
        <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
            <span>Danh sách sản phẩm</span>
        </h3>
        <?php echo $__env->make('quotes.products.list_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="tab-content" id="quote-pro-tabContent">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro_index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane fade<?php echo e($pro_index == 0 ? ' show active' : ''); ?> tab_pane_quote_pro" id="quote-pro-<?php echo e($pro_index); ?>" role="tabpanel" aria-labelledby="quote-pro-<?php echo e($pro_index); ?>-tab">
                    <div class="config_handle_paper_pro">
                        <div class="mb-2 base_product_config">
                            <?php
                                $pro_base_name_input = 'product['.$pro_index.']';
                                $pro_name_field = [
                                    'name' => $pro_base_name_input.'[name]',
                                    'note' => 'Tên sản phẩm',
                                    'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name', 'placeholder' => 'Nhập tên'],
                                    'value' => !empty($product['id']) ? @$product['name'] : ''
                                ];
                                $pro_qty_field = [
                                    'name' => $pro_base_name_input.'[qty]',
                                    'note' => 'Số lượng sản phẩm',
                                    'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty', 'placeholder' => 'Nhập số lượng'],
                                    'value' => @$product['qty']
                                ];
                                $pro_category_field = [
                                    'name' => $pro_base_name_input.'[category]',
                                    'type' => 'linking',
                                    'note' => 'Nhóm sản phẩm',
                                    'attr' => ['required' => 1 , 'inject_class' => 'select_quote_procategory', 'inject_attr' => 'proindex='.$pro_index],
                                    'other_data' => ['data' => ['table' => 'product_categories']],
                                    'value' => @$product['category']
                                ]
                            ?>
        
                            <?php echo $__env->make('view_update.view', $pro_name_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
                            <?php echo $__env->make('view_update.view', $pro_qty_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            
                            <?php echo $__env->make('view_update.view', $pro_category_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
                        <span>Danh sách yêu cầu xử lí vật tư</span>
                    </h3>
                    <?php
                        $elements = getProductElementData($product['category'], $product['id']);
                        dd($elements);
                    ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/view.blade.php ENDPATH**/ ?>