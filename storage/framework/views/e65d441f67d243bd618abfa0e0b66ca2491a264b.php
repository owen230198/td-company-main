
<?php $__env->startSection('content'); ?>
    <div class="row my-4">
        <div class="col-lg-6 border_right_green mb-lg-0 mb-4">
            <div class="main_worker_home">
                <h3 class="fs-14 text-uppercase border_bot_eb pb-1 mb-1 text-center handle_title color_green mx-auto">
                    Danh sách lệnh 
                    <a href="<?php echo e(url()->current()); ?>"><i class="fa fa-refresh ml-2 fs-14 color_green" aria-hidden="true"></i></a>
                </h3>   
            </div> 
            <form action="<?php echo e(url()->current()); ?>" method="GET" class="mt-3 mb-4 form_search position-relative">
                <input type="text" name="q" value=<?php echo e(@$q); ?>>
                <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                    <i class="fa fa-search fs-14" aria-hidden="true"></i>
                </button>
            </form>
            <div class="list_worker_command">
                <?php if(!empty($my_command)): ?>
                <a href="<?php echo e(url('Worker/action-command/detail?table='.@$my_command->table.'&id='.@$my_command->id)); ?>" 
                    class="d-block px-3 py-2 bg_red color_white smooth  font_bold smooth text-center radius_5 box_shadow_3 mb-4">
                    <i class="fa fa-id-card-o fs-14 mr-1" aria-hidden="true"></i> Lệnh đang nhận
                </a>
                <?php endif; ?>
                <div class="row row-10">
                    <?php if(!empty($list_data)): ?>
                        <?php $__currentLoopData = $list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $supply = \DB::table($item->table_supply)->find($item->supply);
                                $data_handle = !empty($supply->{$worker['type']}) ? json_decode($supply->{$worker['type']}, true) : [];
                            ?>
                            <?php if(!empty($data_handle)): ?>
                                <div class="col-lg-6 mb_20">
                                    <?php echo $__env->make('Worker::commands.items.base', 
                                    ['supply' => $supply, 'handle' => $data_handle, 'key_type' => $worker['type'], 'command' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    <?php endif; ?>
                </div>
                <div class="paginate_view d-flex align-center justify-content-between mt-3">
                    <?php echo $list_data->appends(request()->input())->links('pagination::bootstrap-4'); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <h3 class="fs-14 text-uppercase border_bot_eb pb-1 mb-1 text-center handle_title color_green mx-auto">
                Thông tin của bạn
            </h3> 
            <a href="<?php echo e(url('Worker/my-table-salary')); ?>" class="d-block color_green my-3 fs-15">
                Bảng lương tháng
            </a>
        </div>
    </div>       
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Worker::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/main.blade.php ENDPATH**/ ?>