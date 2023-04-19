<div class="mb-2 handle_after_print_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>Phần Sản xuất sau in</span>
    </h3>

    <div class="quote_after_print_tab">
        <div class="d-flex">
            <div class="nav flex-column nav-pills  min_185 max_150 mr-3 bg_white" id="after-print-tab-pro<?php echo e($j.'_'.$pindex); ?>" role="tablist" aria-orientation="vertical">
                <a class="nav-link text-right active" id="v-print_type_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-print_type_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-print_type_<?php echo e($j.'_'.$pindex); ?>" aria-selected="true">
                    Quy Cách - kiểu in
                </a>
                <a class="nav-link text-right" id="v-nilon_cover_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-nilon_cover_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-nilon_cover_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    Cán nilon
                </a>
                <a class="nav-link text-right" id="v-metalai_cover_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-metalai_cover_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-metalai_cover_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    Cán Metalai
                </a>
                <a class="nav-link text-right" id="v-glossy_compress_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-glossy_compress_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-glossy_compress_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    Ép Nhũ
                </a>
                <a class="nav-link text-right" id="v-floating_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-floating_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-floating_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    Thúc nổi
                </a>
                <a class="nav-link text-right" id="v-uv_print_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-uv_print_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-uv_print_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    In lưới UV
                </a>
                <a class="nav-link text-right" id="v-elevated_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-elevated_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-elevated_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    Máy bế
                </a>
                <a class="nav-link text-right" id="v-box_paste_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-box_paste_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-box_paste_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    Máy dán hộp giấy
                </a>
                <a class="nav-link text-right" id="v-temp_plus_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-temp_plus_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-temp_plus_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    Phát sinh tem toa
                </a>
                <a class="nav-link text-right" id="v-other_plus_<?php echo e($j.'_'.$pindex); ?>-tab" data-toggle="pill" href="#v-other_plus_<?php echo e($j.'_'.$pindex); ?>" role="tab" aria-controls="v-other_plus_<?php echo e($j.'_'.$pindex); ?>" aria-selected="false">
                    Phát sinh vật tư khác
                </a>
            </div>
            <div class="tab-content p-3 w-100 bg_eb radius_5" id="after-print-tab-pro<?php echo e($j.'_'.$pindex); ?>Content">
                <div class="tab-pane fade show active" id="v-print_type_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-print_type_<?php echo e($j.'_'.$pindex); ?>-tab">
                    <?php echo $__env->make('quotes.products.papers.handles.print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="tab-pane fade" id="v-nilon_cover_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-nilon_cover_<?php echo e($j.'_'.$pindex); ?>-tab">
                    Cán nilon
                </div>
                <div class="tab-pane fade" id="v-metalai_cover_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-metalai_cover_<?php echo e($j.'_'.$pindex); ?>-tab">
                    Cán Metalai
                </div>
                <div class="tab-pane fade" id="v-glossy_compress_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-glossy_compress_<?php echo e($j.'_'.$pindex); ?>-tab">
                    Ép Nhũ
                </div>
                <div class="tab-pane fade" id="v-floating_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-floating_<?php echo e($j.'_'.$pindex); ?>-tab">
                    Thúc nổi
                </div>
                <div class="tab-pane fade" id="v-uv_print_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-uv_print_<?php echo e($j.'_'.$pindex); ?>-tab">
                    In lưới UV
                </div>
                <div class="tab-pane fade" id="v-elevated_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-elevated_<?php echo e($j.'_'.$pindex); ?>-tab">
                    Máy bế
                </div>
                <div class="tab-pane fade" id="v-box_paste_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-box_paste_<?php echo e($j.'_'.$pindex); ?>-tab">
                    Máy dán hộp giấy
                </div>
                <div class="tab-pane fade" id="v-temp_plus_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-temp_plus_<?php echo e($j.'_'.$pindex); ?>-tab">
                    Phát sinh tem toa
                </div>
                <div class="tab-pane fade" id="v-other_plus_<?php echo e($j.'_'.$pindex); ?>" role="tabpanel" aria-labelledby="v-other_plus_<?php echo e($j.'_'.$pindex); ?>-tab">
                    Phát sinh khác
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/print.blade.php ENDPATH**/ ?>