<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(@$title ? $title : 'Trang quản trị'); ?></title>
    <base href="<?php echo e(url('')); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('frontend/admin/images/logo.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/font-awesome.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/select2.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/daterangepickers/daterangepicker.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/style.css')); ?>" />
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body>
    <?php if(@$nosidebar): ?>
        <div class="page_content container-fluid h-100">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    <?php else: ?>
        <?php
            $user_login = session('user_login');
            $modules = @$user_login['modules'] ?? [];
            $group_modules = @$user_login['group_modules'] ?? [];
        ?>
        <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="base_content">
            <div class="container-fluid h-100">
                <?php if(!isHome()): ?>
                    <nav aria-label="breadcrumb" class="breadcrumb_section">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(url('')); ?>" class="color_green">Trang chủ</a>
                        </li>
                        <?php if(!empty($parent_url['link'])): ?>
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(url(@$parent_url['link'])); ?>" class="color_green"><?php echo e(@$parent_url['note']); ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e(@$title); ?></li>
                        </ol>
                    </nav>
                <?php endif; ?>
                <div class="base_page h-100">
                    <div class="page_content">
                        <?php if(!isHome()): ?>
                            <div class="title_page_content d-flex justify-content-between align-items-center">
                                <h2 class="fs-14 font_bold text-capitalize mb-0 d-flex align-items-center">
                                <i class="fa fa-qrcode fs-18 mr-2" aria-hidden="true"></i><?php echo e(@$title); ?></h2>
                            </div>
                        <?php endif; ?>
                        <div class="px-3 pb-3">
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php echo $__env->make('index_script_const', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('frontend/base/script/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/base/script/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/base/script/swal.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/admin/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/admin/tinymce/js/tinymce/init_tinymce.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/base/script/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/base/daterangepickers/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/base/daterangepickers/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/admin/script/loading.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/base/script/script.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/admin/script/script.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
    <script>
        <?php if(Session::has('message')): ?>
            swal('Thành công', "<?php echo e(session('message')); ?>", 'success');
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
            swal('Không thành công', "<?php echo e(session('error')); ?>", 'error');
        <?php endif; ?>
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/index.blade.php ENDPATH**/ ?>