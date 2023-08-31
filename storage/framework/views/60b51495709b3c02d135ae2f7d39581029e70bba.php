<div class="item_command overflow_hidden">
    <p class="machine_label color_white bg_red text-uppercase">
        Thiết bị : <?php echo e(getTextMachineType($key_type, @$supply->machine_type)); ?>

        <?php if(!empty($supply->type)): ?>
             - Loại : <?php echo e($supply->type); ?>    
        <?php endif; ?>
    </p>
    <div class="item_command_content p-2">
        <p class="d-flex align-items-center color_green mb-2">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            Mã lệnh : <?php echo e(@$supply->code); ?>.
        </p>  
        <p class="d-flex align-items-center color_green mb-2">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            Tên sản phẩm : <?php echo e(getFieldDataById('name', 'products', $supply->product)); ?>.
        </p>
        <p class="d-flex align-items-center color_green mb-2">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            Trạng thái : <?php echo e(getStatusWorkerCommand($supply)); ?>.
        </p>
        <p class="d-flex align-items-center color_red mb-2">
            <i class="fa fa-asterisk mr-1 fs-14" aria-hidden="true"></i>
            Chú thích : hoàn thành nhanh nhất.
        </p>
        <div class="command_group_btn d-flex mt-1 pt-1 border_top">
            <a href="<?php echo e(url('Worker/action-command/detail?table='.@$supply->table.'&id='.@$supply->id)); ?>" class="d-block button_command p-1 color_green smooth  font_bold smooth text-center">
                <i class="fa fa-info-circle fs-14 mr-1" aria-hidden="true"></i> Chi tiết
            </a>
            <?php if(workerCommandIsProcessing($supply)): ?>
                <button 
                type="button" data-toggle="modal" data-target=".worker-submit-modal"
                class="d-block btn btn-primary button_command p-1 smooth  font_bold smooth text-center bg_green color_white __worker_submit_btn"
                data-table=<?php echo e($supply->table); ?> data-id=<?php echo e($supply->id); ?>>
                    <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Xác nhận lệnh
                </button>
            <?php else: ?>
                <button 
                type="button" 
                class="d-block button_command p-1 smooth  font_bold smooth text-center bg_green color_white __worker_receive_btn"
                data-table=<?php echo e($supply->table); ?> data-id=<?php echo e($supply->id); ?>>
                    <i class="fa fa-level-down fs-14 mr-1" aria-hidden="true"></i> Nhận lệnh
                </button>   
            <?php endif; ?>
        </div>     
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/commands/items/base.blade.php ENDPATH**/ ?>