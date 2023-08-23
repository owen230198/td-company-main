
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="chose_customer_form config_content">
        <form action="<?php echo e(!empty($link_action) ? $link_action : asset('insert/quotes?step=chose_customer')); ?>" method="POST" class="chose_customer_quote_form baseAjaxForm" 
        enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group d-flex mb-3 pb-3">
                <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">Tìm kiếm Khách hàng</label>
                <select name="customer_id" class="form-control select_ajax select_customer_quote" 
                data-url = <?php echo e(asset('get-data-json-customer?status=1')); ?> data-id=<?php echo e(@$data_customer['id']); ?> 
                data-label='<?php echo e(@$data_customer['code'].'-'.@$data_customer['name']); ?>'></select>
            </div>
            <div class="customer_info_quote mr-5">
                <?php if(!empty($data_customer)): ?>
                    <?php echo $__env->make('quotes.customer_info', $data_customer, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </form>
    </div>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('frontend/admin/script/quote.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/quotes/chose_customer.blade.php ENDPATH**/ ?>