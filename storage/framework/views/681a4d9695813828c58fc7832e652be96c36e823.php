
<?php dd($supply_size); ?>;
<?php $__env->startSection('process'); ?>
    <?php echo $__env->make('quotes.products.papers.supply_print', ['no_exc' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="process_paper_plan">
        <?php echo $__env->make('orders.users.6.supply_handles.handle', [
            'where_size_supp' => [
                    'type' => 'paper',
                    'supp_price' => @$supply_size['supply_price'],
                    'status' => 'imported'
            ],
            'no_elevate_handle' => true,
            'compen_percent' => getDataConfig('QuoteConfig', 'COMPEN_PERCENT')
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/paper.blade.php ENDPATH**/ ?>