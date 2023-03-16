<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
    <span>Phần kích thước sản phẩm</span>
</h3>
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_180 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
        Nhập kích thước hộp
    </label>
    <div class="d-flex align-items-center">
        <div class="size_item_pro_structure">
            <p class="text-center">1</p>
            <div class="d-flex justify-content-between align-items-center">
                <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][length]' 
                placeholder="Nhập chiều dài" class="form-control medium_input text-center" step="any">
            </div>
            <p class="text-center"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
        </div>
        <span class="mx-3">X</span>
        <div class="size_item_pro_structure">
            <p class="text-center">2</p>
            <div class="d-flex justify-content-between align-items-center">
                <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][width]' 
                placeholder="Nhập chiều rộng" class="form-control medium_input text-center" step="any">
            </div>
            <p class="text-center"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
        </div>
        <span class="mx-3">X</span>
        <div class="size_item_pro_structure">
            <p class="text-center">3</p>
            <div class="d-flex justify-content-between align-items-center height_input">
                <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][height]' 
                placeholder="Nhập chiều cao" class="form-control medium_input text-center" step="any">
                <p class="text-center ml-1"><i class="fa fa-arrows-v fs-18" aria-hidden="true"></i></p>
            </div>
        </div>
    </div>
</div>
<?php
    $quote_size_pro_side = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][lid_bottom_type]',
        'note' => 'KT hông nắp + đáy',
        'type' => 'select',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRO_SIZE_SIDE]] 
    ]
?>
<?php echo $__env->make('view_update.view', $quote_size_pro_side, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="form-group d-flex mb-2">
    <label class="mb-0 min_180 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
       KT tai cài hộp
    </label>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][lid]' 
            placeholder="Nhập KT nắp" class="form-control medium_input text-center" step="any">
        </div>
        <span class="mx-3">--</span>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][bottom]' 
            placeholder="Nhập KT đáy" class="form-control medium_input text-center" step="any">
        </div>
    </div>
</div>

<?php
    $quote_size_edge = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][edge]',
        'note' => 'KT mép dán',
        'type' => 'text',
        'attr' => ['type_input' => 'number'] 
    ]
?>
<?php echo $__env->make('view_update.view', $quote_size_edge, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="form-group d-flex mb-2">
    <label class="mb-0 min_180 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
       Số bát chiều dài
    </label>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][nqty_length]' 
            placeholder="Nhập số bát" class="form-control medium_input text-center" step="any">
        </div>
        <span class="mx-3">=</span>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][size_length]' 
            placeholder="KT chiều giấy 1" class="form-control medium_input text-center" step="any"> <span class="ml-1">+10mm</span>
        </div>
    </div>
</div>

<div class="form-group d-flex mb-2">
    <label class="mb-0 min_180 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
       Số bát chiều cao
    </label>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][nqty_height]' 
            placeholder="Nhập số bát" class="form-control medium_input text-center" step="any">
        </div>
        <span class="mx-3">=</span>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][size_length]' 
            placeholder="KT chiều giấy 2" class="form-control medium_input text-center" step="any"> <span class="ml-1">+10mm</span>
        </div>
    </div>
</div>

<?php
    $quote_size_nqty_space = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][nqty_space]',
        'note' => 'Các bát chiều cao cách nhau',
        'type' => 'text',
        'attr' => ['type_input' => 'number'],
        'value' => 3 
    ]
?>
<?php echo $__env->make('view_update.view', $quote_size_nqty_space, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $quote_size_nqty = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][nqty]',
        'note' => 'Số bát/tờ in',
        'type' => 'text',
        'attr' => ['type_input' => 'number', 'placeholder' => 'Hiện tự động']
    ]
?>
<?php echo $__env->make('view_update.view', $quote_size_nqty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $quote_size_min = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][min_paper_size]',
        'note' => 'Chiều giấy nhỏ nhất',
        'type' => 'text',
        'attr' => ['type_input' => 'number'],
        'value' => 7
    ]
?>
<?php echo $__env->make('view_update.view', $quote_size_min, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="form-group d-flex mb-2">
    <label class="mb-0 min_180 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
       Khổ giấy tạm tính
    </label>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][temp_width]' 
            placeholder="KT chiều dài" class="form-control medium_input text-center" step="any">
        </div>
        <span class="mx-3">X</span>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[<?php echo e($j); ?>][paper][<?php echo e($pindex); ?>][pro_size][temp_height]' 
            placeholder="KT chiều cao" class="form-control medium_input text-center" step="any"> <span class="ml-1">cm</span>
        </div>
    </div>
</div>

<?php
    $quote_optimal_paper_lot = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][paper_lot]',
        'note' => 'Lô giấy tối ưu nhất',
        'type' => 'linking',
        'other_data' => ['data' => ['table'=>'paper_lots', 'select' => ['id', 'name']]]
    ]
?>
<?php echo $__env->make('view_update.view', $quote_optimal_paper_lot, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/structure.blade.php ENDPATH**/ ?>