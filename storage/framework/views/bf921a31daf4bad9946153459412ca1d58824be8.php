<header class="header d-flex justify-content-between align-items-center bg_white">
    <div class="header_logo">
        <a href="<?php echo e(url('')); ?>" class="header_logo d-inline-block py-1">
            <img src="<?php echo e(asset('frontend/admin/images/logo.png')); ?>" />
        </a>
    </div>
    <div class="header_menu_user d-flex align-items-center position-relative cursor_pointer">
        <p class="user_name mr-1 font_bold">
            <span class="mr-1"><?php echo e($user_login['user']['name']); ?></span>
            <i class="fa fa-angle-down fs-14" aria-hidden="true"></i>
        </p>
        <ul class="header_menu_user_list" style="display:none">
            <li>
                <a href="<?php echo e(asset('profile')); ?>">Profile</a>
            </li>
            <li>
                <a href="<?php echo e(asset('logout')); ?>">Đăng xuất</a>
            </li>
        </ul>
        <span class="header_menu_user_avatar">
            <img src="<?php echo e(asset('frontend/admin/images/avatar.png')); ?>" />
        </span>
    </div>
</header>
<?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/header.blade.php ENDPATH**/ ?>