<table class="table table-bordered fs-18 mb-0">
    <thead>
        <tr>
            <th scope="col" class="text-center color_red table_style" style="min-width: auto;">STT</th>
            <th scope="col" class="text-center color_red table_style max_content">THÔNG SỐ SẢN PHẨM</th>
            <th scope="col" class="text-center color_red table_style">ĐVT</th>
            <th scope="col" class="text-center color_red table_style">SL</th>
            <th scope="col" class="text-center color_red table_style">ĐG</th>
            <th scope="col" class="text-center color_red table_style">TT</th>
        </tr>
    </thead>
    <tbody class="fs-17 font-italic">
        <?php $__currentLoopData = $data_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $main_paper = getDataProExportFile($product);
            ?>
            <tr>
                <td data-label="Sản phẩm thứ" class="table_style text-center" style="min-width: auto;"><?php echo e($key + 1); ?></td>
                <td data-label="Nội dung" class="table_style font-italic quote_content_section max_content">
                    <p class="d-flex align-items-center mb-1 font_bold">
                        <span class="pro_name fs-18 text-uppercase"><?php echo e(@$product['name']); ?></span>
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="dot"></i> Chất liệu giấy: </span>
                        <?php echo e(getFieldDataById('name', 'materals', @$main_paper['size']['materal'])); ?>

                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="dot"></i> Kích thước: </span>
                        <span class="">
                            <?php echo e(getSizeTitleProduct($product)); ?>

                        </span>
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="dot"></i>
                             Mẫu thiết kế : </span>
                        <?php echo e(getFieldDataById('name', 'design_types', @$product['design'])); ?>

                    </p>
                    <?php if(!empty($main_paper['print'])): ?>
                        <p class="d-flex align-items-center mb-1 font_bold">
                            <span class="mr-1">
                                <i class="dot"></i>
                                Công nghệ in: <?php echo e(\TDConst::PRINT_TECH[@$main_paper['print']['machine']]); ?>

                            </span>
                        </p>    
                    <?php endif; ?>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="dot"></i> Hoàn thiện: </span>
                        <span class="font-italic">
                            <?php if(@$main_paper['nilon']['act'] == 1): ?>
                                + Cán nilon: <?php echo e(getFieldDataById('name', 'materals', @$main_paper['nilon']['materal']).' '. $main_paper['nilon']['face'] . ' mặt '); ?> 
                            <?php endif; ?>

                            <?php if(@$main_paper['compress']['act'] == 1): ?>
                                + ép nhũ theo maket
                            <?php endif; ?>
                            
                            <?php if(@$main_paper['uv']['act'] == 1): ?>
                                + in lưới UV <?php echo e(mb_strtolower(getFieldDataById('name', 'materals', $main_paper['uv']['materal']))); ?> theo maket   
                            <?php endif; ?>

                            <?php if(!empty($main_paper['float'])): ?>
                                + thúc nổi sản phẩm
                            <?php endif; ?>
                        </span>
                    </p>
                    <?php if(!empty($main_paper['main_paper']['note'])): ?>
                        <p class="mb-1">
                            <span class="font_bold mr-1"><i class="dot"></i> Ghi chú: </span>
                            <span class="font-italic">
                                <?php echo e($main_paper['main_paper']['note']); ?>

                            </span>
                        </p>
                    <?php endif; ?>
                </td>
                <td data-label="DVT" class="text-center table_style">Sản phẩm</td>
                <td data-label="SL" class="text-center table_style"><?php echo e(@$product['qty']); ?></td>
                <?php
                    $price = (int) $product['total_cost']+(float)$data_quote['ship_price'];
                    $total_cost = calValuePercentPlus($product['total_cost'], $price, (float)$data_quote['profit']);
                    $each_price = $total_cost / (int) @$product['qty'];
                ?>
                <td data-label="ĐG" class="text-center table_style"><?php echo e(number_format($each_price)); ?> đ</td>
                <td data-label="T.Tiền(VNĐ)" class="text-center table_style"><?php echo e(number_format(round((int)$total_cost, -3))); ?> đ</td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/quotes/files/table.blade.php ENDPATH**/ ?>