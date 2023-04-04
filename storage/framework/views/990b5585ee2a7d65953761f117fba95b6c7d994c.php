<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo e(asset('remove')); ?>" method="POST" class="confirmRemoveForm">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="remove_id" = value="">
        <input type="hidden" name="table" value="<?php echo e($tableItem['name']); ?>">
        <div class="modal-header">
          <h4 class="modal-title fs-17">Xác thực xóa <span class="text-lowercase"><?php echo e($tableItem['note']); ?></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body fs-13 color_red font-italic">
          Bạn sẽ xóa vĩnh viễn <span class="text-lowercase"><?php echo e($tableItem['note']); ?></span> này ?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger confirm_btn">Xóa</button>
          <button type="button" class="btn ml-2" data-dismiss="modal">Hủy</button>
        </div>
      </form>
    </div>
  </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/remove_confirm.blade.php ENDPATH**/ ?>