<?php
    $key_stage = \App\Constants\TDConstant::PRINT;
    $paper_print_type = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][type]',
        'type' => 'select',
        'note' => 'kiểu in',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_TYPE]]
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_print_type, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $paper_print_color = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][color]',
        'type' => 'select',
        'note' => 'số màu in',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_COLOR]]
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_print_color, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $paper_print_tech = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][machine]',
        'type' => 'select',
        'note' => 'công nghệ in',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_TECH]]
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_print_tech, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $paper_print_req = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][color]',
        'type' => 'select',
        'note' => 'Yêu cầu thợ in',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_REQUIRED]]
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_print_req, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $paper_print_note = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][note]',
        'type' => 'textarea',
        'note' => 'Ghi chú'
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_print_note, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/print.blade.php ENDPATH**/ ?>