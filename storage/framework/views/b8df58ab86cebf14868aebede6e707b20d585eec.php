<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(@$title ?? 'Chấm công - công nhân'); ?></title>
        <base href="<?php echo e(url('Worker')); ?>">
        <link rel="icon" type="image/x-icon" href="<?php echo e(asset('frontend/admin/images/logo.png')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/bootstrap.min.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/font-awesome.min.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/select2.min.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('frontend/base/daterangepickers/daterangepicker.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/style.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/style.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('frontend/workers/css/style.css')); ?>" />
        <?php echo $__env->yieldContent('css'); ?>
    </head>
    <body>
        <?php echo $__env->make('Worker::header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container h-100">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <?php echo $__env->make('Worker::footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script src="<?php echo e(asset('frontend/base/script/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('frontend/base/script/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('frontend/base/script/swal.min.js')); ?>"></script>
        <script src="<?php echo e(asset('frontend/base/script/select2.min.js')); ?>"></script>
        <script src="<?php echo e(asset('frontend/base/daterangepickers/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('frontend/base/daterangepickers/daterangepicker.js')); ?>"></script>
        <script src="<?php echo e(asset('frontend/workers/script/loading.js')); ?>"></script>
        <script src="<?php echo e(asset('frontend/base/script/script.js')); ?>"></script>
        <script src="<?php echo e(asset('frontend/workers/script/script.js')); ?>"></script>
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
<?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views/index.blade.php ENDPATH**/ ?>