<div class="modal fade" id="multiDeleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo e(asset('multiple-remove')); ?>" method="POST" class="confirmMultiRemoveForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('delete'); ?>
        <input type="hidden" name="multi_remove_id" value="">
        <input type="hidden" name="table" value="<?php echo e($tableItem['name']); ?>">
        <div class="modal-header">
          <h4 class="modal-title fs-17">Xác thực xóa <span class="text-lowercase"><?php echo e($tableItem['note']); ?></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body fs-13 color_red font-italic">
          Bạn sẽ xóa vĩnh viễn các <span class="text-lowercase"><?php echo e($tableItem['note']); ?></span> đã chọn ?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger confirm_btn">Xóa</button>
          <button type="button" class="btn ml-2" data-dismiss="modal">Hủy</button>
        </div>
      </form>
    </div>
  </div>
</div><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/table/remove_confirm_check.blade.php ENDPATH**/ ?>