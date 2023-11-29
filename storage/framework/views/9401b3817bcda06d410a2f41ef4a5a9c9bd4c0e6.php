<div class="quote_handle_section mb-3">
    <h3 class="fs-14 text-uppercase pb-1 mb-3 text-center handle_title">
        <span>Mã báo giá <strong><?php echo e($data_quote['seri']); ?></strong></span>
    </h3>
    <?php
        $field_infomation = \App\Models\Customer::FIELD_UPDATE;
    ?>
    <?php $__currentLoopData = $field_infomation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!empty($data_quote[$customer['name']])): ?>
            <div class="d-flex align-items-center mb-2 fs-13">
                <label class="mb-0 min_210 text-capitalize text-right mr-3"><?php echo e($customer['note']); ?>: </label>
                <p class="font_italic">
                    <?php echo e(@$customer['type'] != 'linking' ? $data_quote[$customer['name']] 
                        : getFieldDataById('name', $customer['other_data']['data']['table'], $data_quote[$customer['name']])); ?>

                </p>
            </div>
        <?php endif; ?>    
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if((int) $data_quote['total_amount'] > 0): ?>
        <div class="d-flex align-items-center mb-2 fs-15">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Tổng chi phí: </label>
            <p class="font_bold color_red">
                <?php echo e(number_format((int) $data_quote['total_amount'])); ?>đ
            </p>
        </div>
    <?php endif; ?>
</div><?php /**PATH /var/www/html/td-company-app/resources/views/quotes/head_information.blade.php ENDPATH**/ ?>