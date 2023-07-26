
<?php $__env->startSection('content'); ?>
    <div class="dashborad_content position-relative">
        <form action="<?php echo e($action_url); ?>" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($key == 0 ? 'active' : ''); ?>" id="<?php echo e($region['id']); ?>-tab" data-toggle="tab"
                            href="#<?php echo e($region['id']); ?>" role="tab" aria-controls="<?php echo e($region['id']); ?>"
                            aria-selected="true"><?php echo e($region['name']); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="tab-content px-2 py-3 bg_white content_form" id="myTabContent">
                <?php if(!empty($default_field)): ?>
                    <?php $__currentLoopData = $default_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $df_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name = "<?php echo e($key); ?>" value = "<?php echo e($df_value); ?>">   
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $c_region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade <?php echo e($key == 0 ? 'show active' : ''); ?>" id="<?php echo e($c_region['id']); ?>"
                        role="tabpanel" aria-labelledby="<?php echo e($c_region['id']); ?>-tab">
                        <?php $__currentLoopData = $field_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $field =  (array) $field;
                            ?>
                            <?php if($field['region'] == $c_region['id']): ?>
                                <?php
                                    $arr = processArrField($field);
                                    $arr['value'] = @$config_view == 1 ? @$field['value'] : @$dataItem[$field['name']];
                                ?>
                                <?php echo $__env->make('view_update.view', $arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="group_btn_action_form text-center">
                <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <a href="<?php echo e(getBackUrl()); ?>"
                    class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                    <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
                <a href="<?php echo e(url('')); ?>" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                </a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/action/view.blade.php ENDPATH**/ ?>