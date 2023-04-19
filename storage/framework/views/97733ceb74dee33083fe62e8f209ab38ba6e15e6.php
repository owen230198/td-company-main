<?php
    $key_stage = \TDConst::METALAI;
    $paper_metalai_materal = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => $key_stage], 'select' => ['id', 'name']]]
    ]; 
    $paper_metalai_face = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ];
    
    $paper_cover_materal = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][cover_materal]',
        'type' => 'linking',
        'note' => 'chất liệu cán phủ trên',
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => 'cover'], 'select' => ['id', 'name']]]
    ]; 
    $paper_cover_face = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][cover_face]',
        'type' => 'select',
        'note' => 'Số mặt cán phủ trên',
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ]; 
?>

<?php echo $__env->make('view_update.view', $paper_metalai_materal, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('view_update.view', $paper_metalai_face, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('view_update.view', $paper_cover_materal, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('view_update.view', $paper_cover_face, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('quotes.products.papers.handles.select_device', ['key_device' => $key_stage], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/metalai.blade.php ENDPATH**/ ?>