
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/bootstrap-multiselect.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(asset('create-quote?step=handle_config')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="quote_handle_section mb-3">
            <h3 class="fs-14 text-uppercase pb-1 mb-3 text-center quote_handle_title">
                <span>Thông tin khách hàng</span>
            </h3>
            <?php $__currentLoopData = $customer_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_150 text-capitalize text-right mr-3"><?php echo e($customer['note']); ?>: </label>
                    <p class="font_italic">
                        <?php if(!empty($data_quote[$customer['name']])): ?>
                            <?php echo e(@$customer['type'] != 'linking' ? $data_quote[$customer['name']] 
                                : getFieldDataById('name', $customer['other_data']['data']['table'], $data_quote[$customer['name']])); ?>

                        <?php endif; ?>
                    </p>
                </div>    
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="quote_handle_section handle_pro_section mb-3">
            <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
                <span>Khởi tạo sản phẩm</span>
            </h3>
            <?php
                $quote_pro_qty_field = [
                    'name' => 'quote[product_qty]',
                    'note' => 'Số lượng sản phẩm',
                    'attr' => ['type_input' => 'number', 'inject_class' => 'quote_set_qty_pro_input']
                ] 
            ?>
            <?php echo $__env->make('view_update.view', $quote_pro_qty_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="ajax_product_quote_number">
                <?php echo $__env->make('quotes.products.ajax_view', ['qty' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>       
            </div>
        </div> 
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('frontend/base/script/bootstrap-multiselect.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/admin/script/quote.js')); ?>"></script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/handle_config.blade.php ENDPATH**/ ?>