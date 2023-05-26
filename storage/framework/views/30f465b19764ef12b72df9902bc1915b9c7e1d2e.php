
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/order.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(@$link_action); ?>" method="POST" class="baseAjaxForm config_content" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        <?php echo csrf_field(); ?>
        <?php if(!empty($customer_info)): ?>
            <?php echo $__env->make('quotes.head_information', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <div class="order_field_update __order_field_module mt- pt-3 border_top_eb">
            <?php if(!empty($data_order['id'])): ?>
                <input type="hidden" name="order[id]" value="<?php echo e($data_order['id']); ?>">     
            <?php endif; ?>
            <input type="hidden" name="order[quote]" value="<?php echo e($data_quote['id']); ?>">
            <?php
                $order_field_update = [
                    [
                        'name' => '',
                        'note' => 'Tổng tiền (chưa bao gồm VAT)',
                        'attr' => ['disable_field' => 1, 'inject_class' => '__order_total_input'],
                        'value' => round(@$data_quote['total_amount'])
                    ],
                    [
                        'name' => 'order[advance]',
                        'note' => 'Tạm ứng đơn hàng',
                        'attr' => ['type_input' => 'number', 'inject_class' => '__order_advance_input'],
                        'value' => @$data_order['advance'] ?? 0
                    ],
                    [
                        'name' => 'order[rest]',
                        'note' => 'Chi phí còn lại',
                        'attr' => ['readonly' => 1, 'inject_class' => '__order_rest_input'],
                        'value' => @$data_order['rest'] ?? round(@$data_quote['total_amount'])
                    ],
                    [
                        'name' => 'order[rest_bill]',
                        'note' => 'File bill tạm ứng',
                        'type' => 'file',
                        'value' => @$data_order['rest_bill']
                    ],
                    [
                        'name' => 'order[rest_note]',
                        'note' => 'Ghi chú công nợ',
                        'type' => 'textarea',
                        'value' => @$data_order['rest_note']
                    ],
                    [
                        'name' => 'order[ship_note]',
                        'note' => 'Ghi chú giao hàng',
                        'type' => 'textarea',
                        'value' => @$data_order['ship_note']
                    ]
                ]
            ?>
            <?php $__currentLoopData = $order_field_update; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('view_update.view', $order_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
            <span>Danh sách sản phẩm</span>
        </h3>
        <div class="order_list_product">
            <?php echo $__env->make('quotes.products.ajax_view', ['order_get' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            <?php if(!empty($data_order['status']) && $data_order['status'] == StatusConst::NOT_ACCEPTED): ?>
                <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
                    <i class="fa fa-thumbs-o-up mr-2 fs-14" aria-hidden="true"></i>Xác nhận sản xuất
                </button>    
            <?php endif; ?>
            <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
                <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i>In đơn
            </button>
            <a href="<?php echo e(url('')); ?>" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>  
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('frontend/admin/script/quote.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/admin/script/order.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/view.blade.php ENDPATH**/ ?>