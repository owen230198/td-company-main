<?php
    $pro_fill_finish_qty = [
        'name' => 'product['.$pro_index.'][fill_finish][qty]',
        'note' => 'Số lượng',
        'value' => @$supply_obj->product_qty,
        'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input']
    ];

    $data_fill = !empty($supply_obj->fill) ? json_decode($supply->fill, true) : [];

    $pro_fill_ext = [
        'name' => 'product['.$pro_index.'][fill_finish][fill][ext_price]',
        'note' => 'Phát sinh chi tiết bồi khó',
        'value' => @$data_fill['ext_price'] ?? 0,
        'attr' => ['type_input' => 'number']
    ];

    $fill_device_select = [
        'name' => 'product['.$pro_index.'][fill_finish][fill][machine]',
        'type' => 'linking',
        'note' => 'Chọn thiết bị máy bồi',
        'value' => !empty($supply_obj->id) ? @$data_fill['machine'] : getDeviceId(['key_device' => 'fill', 'supply' => 'fill_finish', 'default_device' => 1]),
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => 'fill', 'supply' => 'fill_finish'], 'select' => ['id', 'name']]]
    ];

    $data_finish = !empty($supply_obj->finish) ? json_decode($supply_obj->finish, true) : [];

    $pro_finish_ext = [
        'name' => 'product['.$pro_index.'][fill_finish][finish][ext_price]',
        'note' => 'Phát sinh chi tiết hoàn thiện',
        'value' => @$data_finish['ext_price'] ?? 0,
        'attr' => ['type_input' => 'number']
    ];

    $data_magnet = !empty($supply_obj->magnet) ? json_decode($supply_obj->magnet, true) : [];

    $data_select_magnet = [
        'other_data' => [
            'data' => ['table' => 'materals', 'where' => ['type' => \TDConst::MAGNET]]
        ],
        'name' => 'product['.$pro_index.'][fill_finish][magnet][type]',
        'type' => 'linking',
        'value' => @$data_magnet['type'],
        'note' => 'Vật tư nam châm'
    ];

    $data_magnet_qty = [
        'name' => 'product['.$pro_index.'][fill_finish][magnet][qty]',
        'note' => 'Số viên nam châm/hộp',
        'value' => @$data_magnet['qty'],
        'attr' => ['type_input' => 'number']
    ]
?>

<?php if(!empty($supply_obj->id)): ?>
    <input type="hidden" name="product[<?php echo e($pro_index); ?>][fill_finish][id]" value="<?php echo e($supply_obj->id); ?>">
<?php endif; ?>
<?php echo $__env->make('view_update.view', $pro_fill_finish_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="module_fill_quote pb-2 mb-2 border_bot_eb section_quote_fill_finish">
    <div class="d-flex align-items-end list_item_fill_finish">
        <div class="ajax_fill_quote ajax_ff_quote">
            <?php if(!empty($data_fill['stage'])): ?>
                <?php $__currentLoopData = $data_fill['stage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $findex => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('quotes.products.fill_finishes.ajax_fill', ['fill_data' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php echo $__env->make('quotes.products.fill_finishes.ajax_fill', ['findex' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <button type="button" data-product="<?php echo e($pro_index); ?>" data-view="ajax_fill"
        class="main_button color_white bg_green border_green radius_5 font_bold sooth quote_add_fill_item ml-5 mb-2 add_fill_finish_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm chi tiết
        </button>
    </div>
    <div class="d-flex align-items-center">
        <?php echo $__env->make('view_update.view', $pro_fill_ext, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="fs-12 color_red font-italic ml-2">Đơn giá/1 sản phẩm</span>
    </div>
    <?php echo $__env->make('view_update.view', $fill_device_select, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div class="module_finish_quote pb-2 mb-2 border_bot_eb section_quote_fill_finish">
    <div class="d-flex align-items-end list_item_fill_finish">
        <div class="ajax_fill_quote ajax_ff_quote">
            <?php if(!empty($data_finish['stage'])): ?>
                <?php $__currentLoopData = $data_finish['stage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $findex => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('quotes.products.fill_finishes.ajax_finish', ['finish_data' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php echo $__env->make('quotes.products.fill_finishes.ajax_finish', ['findex' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <button type="button" data-product="<?php echo e($pro_index); ?>" data-view="ajax_finish" 
        class="main_button color_white bg_green border_green radius_5 font_bold sooth quote_add_finish_item ml-5 mb-2 add_fill_finish_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm chi tiết
        </button>
    </div>
    <div class="d-flex align-items-center">
        <?php echo $__env->make('view_update.view', $pro_finish_ext, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="fs-12 color_red font-italic ml-2">ĐG/1 sản phẩm</span>
    </div>
</div>

<?php echo $__env->make('view_update.view', $data_select_magnet, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('view_update.view', $data_magnet_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/quotes/products/fill_finishes/ajax_view.blade.php ENDPATH**/ ?>