<li class="supply_item">
    <?php if(!empty($supply['device'])): ?>
        <ul class="supply_info">
            <li class="supply_item_inf">
                <span class="font_bold mr-1">Tên vật tư: </span>
                <span><?php echo e(@$supply['pro_field'] == 'carton' ? getFieldDataById('name', 'supply_types', @$item->name) : (@$item->name ?? @$supply['note'])); ?></span>
            </li>
            <?php $__currentLoopData = $supply['device']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $stage = !empty($item->{$key}) ? json_decode($item->{$key}, true) : [];
                    $size = !empty($item->size) ? json_decode($item->size, true) : [];
                    $cost = @$stage['total'] ?? 0;
                ?>
                <?php if($cost > 0): ?>
                    <li class="supply_item_inf cursor_pointer position-relative">
                        <div class="supp_cost_name">
                            <span class="font_bold mr-1"><?php echo e($device); ?>: </span>
                            <span><?php echo e(number_format($cost)); ?>đ</span>
                        </div>
                        <?php if(\App\Models\NGroupUser::isAdmin()): ?>
                            <div class="detail_quote_supply_item">
                                <p class="mb-2 fs-15 font_bold color_green text-center text-capitalize">Chi Tiết Chi Phí <?php echo e($device); ?></p>
                                <?php echo $__env->make('quotes.profits.'.$supply['table'].'/'.$key, ['stage' => $stage, 'size' => $size], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endif; ?> 
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <li class="supply_item_inf">
                <span class="font_bold mr-1">Chi phí : </span>
                <span class="font_bold color_red"><?php echo e(number_format((int) @$item->total_cost)); ?>đ</span>
            </li>
        </ul>
    <?php endif; ?>
</li><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/profits/item.blade.php ENDPATH**/ ?>