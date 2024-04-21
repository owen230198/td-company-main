<div class="sidebar admin_sidebar">
  <ul class="sidebar_menu">
    <li>
      <a href="<?php echo e(url('')); ?>">
        Trang chủ
      </a>
    </li>
    <?php $__currentLoopData = $group_modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_group => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
          <a href="javascript:void(0)">
            <?php echo e($group); ?>

          </a>
          <i class="fa fa-angle-right fs-14" aria-hidden="true"></i>
          <ul>
            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(@$module['group'] && $module['group'] == $key_group): ?>
                <li class="<?php echo e(url()->full() == url($module['link']) ? 'active' : ''); ?>">
                  <a href="<?php echo e(asset($module['link'])); ?>"><?php echo e($module['name']); ?></a>
                </li>
              <?php endif; ?> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </li> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</div><?php /**PATH /var/www/html/td-company-app-main/resources/views/sidebar.blade.php ENDPATH**/ ?>