
<?php $__env->startSection('content'); ?>
    <div class="dashborad_content">
        <?php if(count($list_data) > 0): ?>
            <div class="table_base_view position-relative">
                <h3 class="fs-14 text-uppercase pt-4 mt-4 text-center font_bold text-center color_green"><?php echo e($title); ?></h3>
                <h3 class="fs-14 text-uppercase py-2 my-2 text-center font_bold text-center color_green">
                    THông tin nhà cung cấp: <?php echo e(getFieldDataById('name', 'warehouse_providers', $data_buying->provider)); ?>

                </h3>
                <table class="table table-bordered mb-2 table_main">
                    <tr>
                        <th class="font-bold fs-13 text-center "><span>#</span></th>
                        <th class="font-bold fs-13">Loại vật tư</th>
                        <th class="font-bold fs-13">Vật tư cần mua</th>
                        <th class="font-bold fs-13 ">Số lượng cần mua</th>
                        <th class="font-bold fs-13 ">Đơn giá</th>
                        <th class="font-bold fs-13 ">Thành tiền</th>
                    </tr>
                    <tbody>
                        <?php $__currentLoopData = $list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><span><?php echo e($key + 1); ?></span></td>
                                <td>
                                    <?php echo $__env->make('view_table.text', ['value' => getSupplyNameByKey(@$data->supp_type)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                                <td>
                                    <?php
                                        $table_supply = getTableWarehouseByType($data);
                                        $model = getModelByTable($table_supply);
                                        $linking_value = \DB::table($table_supply)->find(@$data->size_type);
                                        $data_label = method_exists($model, 'getLabelLinking') ? $model::getLabelLinking($linking_value) : @$linking_value->{$field_title};
                                    ?>
                                    <?php echo $__env->make('view_table.text', ['value' => $data_label], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                                <td>
                                    <?php echo $__env->make('view_table.text', ['value' => @$data->qty], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                                <td>
                                    <?php echo $__env->make('view_table.money', ['value' => @$data->price], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                                <td>
                                    <?php echo $__env->make('view_table.money', ['value' => @$data->total], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <p class="text-center p2 border_eb font_bold color_red fs-16 text-uppercase">
                    Tổng tiền cần thanh toán: <?php echo e(number_format((int) $data_buying->total)); ?> vnđ
                </p>
            </div>
        <?php else: ?>
            <p class="fs-15 font-italic color_red">Chưa có dữ liệu <?php echo e(@$title); ?> !</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/supply_buyings/list_supply.blade.php ENDPATH**/ ?>