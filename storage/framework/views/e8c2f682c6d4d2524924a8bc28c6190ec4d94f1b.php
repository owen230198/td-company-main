
<?php $__env->startSection('content'); ?>
    <div class="row my-4 pb-3">
        <div class="col-lg-6 border_right_green mb-lg-0 mb-3">
            <div class="bg_eb radius_5 box_shadow_3 h-100 p-3 text-center">
                <h3 class="fs-14 text-uppercase border_bot pb-1 mb-3 text-center handle_title color_green mx-auto">Thông tin đơn</h3>   
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Mã đơn : <strong class="color_main ml-1"><?php echo e(@$data_product->code); ?>.</strong>
                </p>  
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Tên sản phẩm : <strong class="color_main ml-1"><?php echo e(@$data_product->name); ?>.</strong>
                </p>  
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Nhóm sản phẩm : <strong class="color_main ml-1"><?php echo e(getFieldDataById('name', 'product_categories', $data_product->category)); ?>.</strong>
                </p>
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Ngày đặt : <strong class="color_main ml-1"><?php echo e(date('d/m/Y H:i', strtotime($data_product->created_at))); ?>.</strong>
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg_eb radius_5 box_shadow_3 h-100 p-3 text-center">
                <h3 class="fs-14 text-uppercase border_bot pb-1 mb-3 text-center handle_title color_green mx-auto">Thông tin sản xuất</h3>
                <?php echo $__env->make('Worker::commands.view_types.'.$view_type.'.view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                <?php if(!empty($data_handle['product_qty'])): ?>
                    <p class="d-flex align-items-center color_green mb-2">
                        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                        Số lượng SP : <strong class="color_main ml-1"><?php echo e($data_handle['product_qty']); ?>.</strong>
                    </p>    
                <?php endif; ?>
                <?php if(!empty($data_handle['supp_qty'])): ?>
                    <p class="d-flex align-items-center color_green mb-2">
                        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                        Số lượng vật tư : <strong class="color_main ml-1"><?php echo e($data_handle['supp_qty']); ?>.</strong>
                    </p>    
                <?php endif; ?>
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Loại thiết bị : <strong class="color_main ml-1"><?php echo e(getTextMachineType($view_type, @$data_command->machine_type)); ?>.</strong>
                </p>
                
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Trạng thái : <strong class="color_main ml-1"><?php echo e(getStatusWorkerCommand($data_command)); ?>.</strong>
                </p>
                
            </div>        
        </div>
    </div> 
    <?php echo $__env->make('Worker::commands.submit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="group_btn_worker_form text-center">
        <?php if(workerCommandIsProcessing($data_command)): ?>
            <button 
            type="button" data-toggle="modal" data-target="#worker-submit-modal"
            class="radius_5 box_shadow_3 btn btn-primary main_button smooth  font_bold text-center bg_green color_white __worker_submit_btn"
            data-table=<?php echo e($data_command->table); ?> data-id=<?php echo e($data_command->id); ?>>
                <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Xác nhận lệnh
            </button>
            <?php echo $__env->make('Worker::commands.submit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <button 
            type="button" 
            class="radius_5 box_shadow_3 main_button smooth  font_bold text-center bg_green color_white __worker_receive_btn"
            data-table=<?php echo e($data_command->table); ?> data-id=<?php echo e($data_command->id); ?>>
                <i class="fa fa-level-down fs-14 mr-1" aria-hidden="true"></i> Nhận lệnh
            </button>   
        <?php endif; ?>
    </div>      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Worker::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/commands/view.blade.php ENDPATH**/ ?>