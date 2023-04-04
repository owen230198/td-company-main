
<?php $__env->startSection('content'); ?>
  <?php echo getBreadcrumb($tableItem['name'], 0, $tableItem['note']); ?>

  <div class="dashborad_content">
    <div class="form-decstop d-none d-lg-block">
      <div class="row align-items-center mb_20 align-items-center justify-content-between ">
        <div class="col-12">
           <?php echo $__env->make('table.form_search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-12">
          <div class="d-flex align-center justify-content-end">
            <button type="submit" class="station-richmenu-main-btn-area mr-2" form="form-search" value="submit">
              <i class="fa fa-filter mr-2 fs-15" aria-hidden="true"></i>Tìm kiếm
            </button>
            <?php if($tableItem['insert'] == 1): ?>
              <a href="<?php echo e('insert/'.$tableItem['name']); ?>" class="station-richmenu-main-btn-area">
                <i class="fa fa-plus mr-2 fs-15" aria-hidden="true"></i>Thêm mới
              </a>
            <?php endif; ?>
            <?php if($tableItem['remove']): ?>
              <button class="station-richmenu-main-btn-area mx-2 red_button" data-toggle="modal" data-target="#multiDeleteModal">
                <i class="fa fa-trash mr-2 fs-15" aria-hidden="true"></i>Xóa 
              </button>
            <?php endif; ?>
            <a href="" class="station-richmenu-main-btn-area">
              <i class="fa fa-book mr-2 fs-15" aria-hidden="true"></i>Trợ giúp
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php echo $__env->make('table.table_base_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="paginate_view d-flex align-center justify-content-between">
     <?php echo $data_tables->links('pagination::bootstrap-4'); ?>

    </div>
  </div>
  <?php echo $__env->make('table.remove_confirm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('table.remove_confirm_check', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/view.blade.php ENDPATH**/ ?>