
<?php $__env->startSection('process'); ?>
<div class="plan_handle_supp_inf">
    <h3 class="fs-14 text-uppercase border_bot_eb pb-3 mb-3 text-center handle_title">
        <p class="mb-1">Thông tin vật tư nam châm cần xuất</p>
    </h3>
    <?php
        $data_magnet = !empty($supply_obj->magnet) ? json_decode($supply_obj->magnet, true) : [];
        $data_select_magnet = [
            'other_data' => [
                'data' => ['table' => 'materals', 'where' => ['type' => \TDConst::MAGNET]]
            ],
            'name' => '',
            'type' => 'linking',
            'value' => @$data_magnet['type'],
            'note' => 'Vật tư nam châm'
        ];

        $data_magnet_qty = [
            'name' => '',
            'note' => 'Số viên nam châm/hộp',
            'value' => @$data_magnet['qty'],
            'attr' => ['type_input' => 'number']
        ];
        $magnet_chose_supp = [
            'name' => 'c_supply[supp_price]',
            'type' => 'linking',
            'note' => 'Chọn nam châm trong kho',
            'other_data' => [
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'other_warehouses', 
                    'where' => ['type' => \TDConst::MAGNET,
                                'supp_price' => @$data_magnet['type'],
                                'status' => 'imported']
                ]
            ]
        ]
    ?>
    <?php echo $__env->make('view_update.view', $data_select_magnet, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('view_update.view', $data_magnet_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nam châm theo yêu cầu</span>
    </h3>

    <?php echo $__env->make('view_update.view', $magnet_chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('orders.users.6.supply_handles.supplies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/fill_finish.blade.php ENDPATH**/ ?>