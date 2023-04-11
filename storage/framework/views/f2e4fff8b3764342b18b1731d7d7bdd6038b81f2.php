<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e(@$title ? $title : 'Trang quản trị'); ?></title>
    <base href="<?php echo e(url('')); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('frontend/admin/images/logo.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/font-awesome.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/select2.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/toastr.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/daterangepickers/daterangepicker.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/style.css')); ?>" />
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body>
    <?php if(@$nosidebar): ?>
        <?php echo $__env->yieldContent('content'); ?>
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
                <div class="base_page h-100">
                    <div class="page_content">
                        <?php if(!isHome()): ?>
                            <div class="title_page_content">
                                <h2 class="fs-14 font_bold text-capitalize mb-0 d-flex align-items-center"><i class="fa fa-qrcode fs-18 mr-2" aria-hidden="true"></i><?php echo e(@$title); ?></h2>
                            </div>
                        <?php endif; ?>
                        <div class="p-3">
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script src="<?php echo e(asset('frontend/base/script/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/base/script/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/base/script/toastr.min.js')); ?>"></script>
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
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("<?php echo e(session('message')); ?>");
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>

        <?php if(Session::has('info')): ?>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("<?php echo e(session('info')); ?>");
        <?php endif; ?>

        <?php if(Session::has('warning')): ?>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("<?php echo e(session('warning')); ?>");
        <?php endif; ?>
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/index.blade.php ENDPATH**/ ?>