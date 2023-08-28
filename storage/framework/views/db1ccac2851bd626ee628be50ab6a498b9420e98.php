<table class="table table-bordered my-4">
    <tr>
        <th class="font-bold fs-13 text-center"><span>#</span></th>
        <th class="font-bold fs-13">Tên tờ in</th>
        <th class="font-bold fs-13">Kiểu in</th>
        <th class="font-bold fs-13">Cán nilon</th>
        <th class="font-bold fs-13">Ép nhũ</th>
        <th class="font-bold fs-13">In lưới UV</th>
        <th class="font-bold fs-13">Thúc nổi</th>
    </tr>
    <tbody>
        <?php $__currentLoopData = $data_paper; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center"><?php echo e($key + 1); ?></td>
                <td class="text-center"><?php echo e($paper->name); ?></td>
                <td class="text-center">
                    <?php
                        $print = !empty($paper->print) ? json_decode($paper->print, true) : [];
                    ?> 
                    <?php echo e(!empty($print['machine']) ? getTextdataPaperStage(\TDConst::PRINT, $print['machine']) : "Không"); ?>   
                </td>
                <td class="text-center">
                    <?php
                        $nilon = !empty($paper->nilon) ? json_decode($paper->nilon, true) : [];
                    ?> 
                    <?php echo e(!empty($nilon) ? getTextdataPaperStage(\TDConst::NILON, $nilon) : "Không"); ?>   
                </td>
                <td class="text-center">
                    <?php
                        $compress = !empty($paper->compress) ? json_decode($paper->compress, true) : [];
                    ?> 
                    <?php echo e(!empty($compress['act']) ? 'Có' : "Không"); ?>   
                </td>
                <td class="text-center">
                    <?php
                        $uv = !empty($paper->uv) ? json_decode($paper->uv, true) : [];
                    ?> 
                    <?php echo e(!empty($uv['materal']) ? getTextdataPaperStage(\TDConst::UV, $uv) : "Không"); ?>   
                </td>
                <td class="text-center">
                    <?php
                        $float = !empty($paper->float) ? json_decode($paper->float, true) : [];
                    ?> 
                    <?php echo e(!empty($float['act']) ? 'Có' : "Không"); ?>   
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/c_designs/paper_table.blade.php ENDPATH**/ ?>