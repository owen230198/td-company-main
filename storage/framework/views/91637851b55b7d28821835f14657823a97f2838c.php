<?php echo $__env->make('Worker::commands.base_command_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $print_info = getPrintInfo(@$data_handle['type'], @$data_handle['color'], @$data_handle['machine'])
?>
<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Kiểu in : <strong class="color_main ml-1"><?php echo e($print_info['type']); ?>.</strong>
</p>
<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Màu in : <strong class="color_main ml-1"><?php echo e($print_info['color']); ?>.</strong>
</p>
<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Công nghệ in : <strong class="color_main ml-1"><?php echo e($print_info['tech']); ?>.</strong>
</p><?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/commands/view_types/print/view.blade.php ENDPATH**/ ?>