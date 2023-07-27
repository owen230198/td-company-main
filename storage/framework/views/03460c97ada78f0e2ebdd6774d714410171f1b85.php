
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="position-relative">
        <div class="quote_table_stage mb-4">
            <table class="table table-bordered mb-1">
                <thead>
                    <tr>
                        <th class="w_50">#</th>
                        <th>Sản phẩm</th>
                        <?php $__currentLoopData = $supply_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e(@$th['note']); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="w_50"><?php echo e($key + 1); ?></td>
                            <td><?php echo e($product['name']); ?></td>
                            <?php
                                $supply_product = \TDConst::HARD_ELEMENT;
                            ?>
                            <?php $__currentLoopData = $supply_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <?php
                                        $where = ['act' => 1, 'product' => $product['id']];
                                        if ($supply['table'] == 'supplies') {
                                            $where['type'] = $supply['pro_field'];
                                        }
                                        $data_supply = \DB::table($supply['table'])
                                            ->where($where)
                                            ->get()
                                            ->toArray();
                                        if (!empty($supply['device'])) {
                                            $insert_device = ['size' => 'Vật tư'];
                                            if ($supply['table'] == 'papers') {
                                                $insert_device['print'] = 'Máy in';
                                                $supply['device'] = $insert_device + $supply['device'];
                                                $supply['device']['ext_price'] = 'Phát sinh';
                                            }
                                            if ($supply['table'] == 'supplies') {
                                                $supply['device'] = $insert_device + $supply['device'];
                                            }
                                            if ($supply['table'] == 'fill_finishes') {
                                                $supply['device'] = \TDConst::FILL_FINISH_STAGE;
                                            }
                                        }
                                    ?>
                                    <ul class="list_supplies">
                                        <?php $__currentLoopData = $data_supply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_supp => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo $__env->make('quotes.profits.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <form action="<?php echo e(asset('profit-config-quote?quote_id=' . $data_quote['id'])); ?>" method="POST"
            class="baseAjaxForm config_content" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php
                $ship_price_input = [
                    'name' => 'ship_price',
                    'note' => 'Chi phí vận chuyển',
                    'attr' => ['type_input' => 'number', 'required' => 1],
                    'value' => @$data_quote['ship_price'],
                ];
                $profit_input = [
                    'name' => 'profit',
                    'note' => 'Lợi nhuận (%)',
                    'attr' => ['type_input' => 'number', 'required' => 1],
                    'value' => @$data_quote['profit'],
                ];
            ?>
            <?php echo $__env->make('view_update.view', $ship_price_input, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('view_update.view', $profit_input, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="group_btn_action_form text-center">
                <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <a href="<?php echo e(url('update/quotes/' . $data_quote['id'] . '?step=handle_config')); ?>"
                    class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                    <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
                <a href="<?php echo e(url('')); ?>" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Thoát
                </a>
            </div>
        </form>
        <div class="quote_total_cost">
            <h3 class="font_bold fs-18 color_red mb-0">BỘ SẢN PHẨM BAO GỒ COMBO <?php echo e(count($products)); ?> SẢN PHẨM - TỔNG GIÁ :
                <?php echo e(number_format((int) @$data_quote['total_amount'])); ?> đ</h3>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('frontend/admin/script/quote.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/profits/view.blade.php ENDPATH**/ ?>