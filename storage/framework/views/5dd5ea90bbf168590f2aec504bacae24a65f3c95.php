<?php
    $worker_login = session('worker_login')['user'];
    $group_worker_name = getDeviceGroupName($worker_login['type'], $worker_login['device']);
?>
<div class="header_worker text-center">
    <a href="<?php echo e(url('Worker')); ?>" class="login_logo mb-3">
        <img src="<?php echo e(url('frontend/admin/images/logo.png')); ?>" alt="'logo">
    </a>
    <h3 class="fs-14 text-uppercase mb-3 text-center handle_title">
        <p class="mb-1"><?php echo e($title.' - '.$group_worker_name); ?></p>
    </h3>
</div>
<div class="header_worker_nav p-2 bg_grey">
    <ul class="d-flex justify-content-end">
        <li class="d-inline-block color_green mr-2 pr-2 border_right">
            <i class="fa fa-user fs-15" aria-hidden="true"></i>
            <a href="<?php echo e(url('change-password/w_users')); ?>" class="color_green"><?php echo e($worker_login['name']); ?></a>
        </li>
        <li class="d-inline-block color_green">
            <i class="fa fa-sign-out fs-15" aria-hidden="true"></i>
            <a href="<?php echo e(url('Worker/logout')); ?>" class="color_green">Thoát</a>
        </li>
    </ul>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\app\Modules/Worker/Views/header.blade.php ENDPATH**/ ?>