<?php
    $chose_supp = [
        'name' => 'c_supply[materal]['.$key_supp.']]['.$index.'][supp_price]',
        'type' => 'linking',
        'note' => 'Tìm và chọn khổ giấy in',
        'attr' => ['inject_class' => '__select_in_warehouse'],
        'other_data' => [
            'config' => ['search' => 1, 'except_linking' => 1], 
            'data' => [
                'table' => 'print_warehouses', 
                'where' => ['type' => $key_supp,
                            'supp_price' => $supp_price,
                            'qtv' => $qtv,
                            'status' => 'imported']
            ]
        ]
    ];
    $need_qty = [
        'name' => 'need_qty',
        'type' => 'text',
        'note' => 'Cần xuất : ',
        'attr' => ['type_input' => 'number', 'inject_class' => '__qty_supp_plan __supp_plan_qty_change']
    ];
    $nqty_supp = [
        'name' => '',
        'type' => 'text',
        'note' => 'Số bát/khổ in : ',
        'attr' => ['type_input' => 'number', 'inject_class' => '__nqty_supp_pla __supp_plan_qty_changen'],
        'value' => 1
    ];
    $total_qty_supp = [
        'name' => 'c_supply[materal]['.$key_supp.']]['.$index .'][qty]',
        'type' => 'text',
        'note' => 'Tổng số lượng : ',
        'attr' => ['type_input' => 'number', 'inject_class' => '__total_qty_supp_plan', 'readonly' => 1],
        'value' => 1
    ]
?>
<div class="__handle_supply_item position-relative <?php echo e($index > 0 ? 'mt-3 pt-3 border_top_eb' : ''); ?>" data-take = "0">
    <?php if($index > 0): ?>
        <span class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth">
            <i class="fa fa-times" aria-hidden="true"></i>
        </span> 
    <?php endif; ?>
    <?php echo $__env->make('view_update.view', $chose_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="__handle_supply_detail_ajax color_green" style="display:none">
        <input type="hidden" name="c_supply[materal][<?php echo e($key_supp); ?>]][<?php echo e($index); ?>][qty]" value="">
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại trong kho : </label>
            <p class="font_bold __inhouse"></p>
        </div>
        <?php echo $__env->make('view_update.view', $need_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('view_update.view', $nqty_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('view_update.view', $total_qty_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/view_handles/papers/item.blade.php ENDPATH**/ ?>