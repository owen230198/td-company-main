<form action="{{ url('Worker/action-command/submit') }}" method="POST" class="w-100 baseAjaxForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ @$data_command->id }}">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Nhập số lượng đã hoàn thành</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @php
                $base_qty_text = @$supply->base_supp_qty ?? @$supply->product_qty;
                if (!empty($arr_handle['handled'])) {
                    $base_qty_text .= ' (đã hoàn thành được '.$arr_handle['handled'].')';
                }
            @endphp
            @include('view_update.view', [
                'name' => '',
                'note' => 'Cty yêu cầu (tốt cần thực tế)',
                'min_label' => 185,
                'attr' => ['disable_field' => 1],
                'value' => $base_qty_text
            ])
            @if (!empty($print_handle))
                @include('view_update.view', [
                    'name' => '',
                    'note' => 'SL thợ in xác nhận',
                    'min_label' => 185,
                    'attr' => ['disable_field' => 1],
                    'value' => @$print_handle['print_confirmed']
                ]) 
            @endif
            <div class="mt-1 pt-2 border_top_eb">
                @if ($view_type != \TDConst::PRINT)
                    <div class="d-lg-flex align-items-center">
                        @include('view_update.view', [
                            'name' => '',
                            'note' => 'Tốt cần thực tế',
                            'min_label' => 185,
                            'attr' => ['disable_field' => 1, 'inject_class' => 'medium_input'],
                            'value' => @$data_command->qty
                        ])
                        <div class="mb-2 ml-lg-1">
                            @include('view_update.text', [
                                'name' => 'bad_qty',
                                'attr' => ['type_input' => 'number', 'inject_class' => 'medium_input', 'placeholder' => 'Số lượng hỏng']
                            ])
                        </div>
                    </div>
                    <div class="d-lg-flex align-items-center">
                        @include('view_update.view', [
                            'name' => '',
                            'note' => 'Loại B thử máy',
                            'min_label' => 185,
                            'attr' => ['disable_field' => 1, 'inject_class' => 'medium_input'],
                            'value' => @$data_command->demo_qty
                        ])
                        <div class="mb-2 ml-lg-1">
                            @include('view_update.text', [
                                'name' => 'bad_demo_qty',
                                'attr' => ['type_input' => 'number', 'inject_class' => 'medium_input', 'placeholder' => 'Số lượng hỏng']
                            ])
                        </div>
                    </div>
                    @include('view_update.view', [
                        'name' => 'not_handled',
                        'note' => 'Chưa hoàn thành',
                        'attr' => ['type_input' => 'number'],
                        'min_label' => 185,
                        'value' => 0
                    ])
                @endif
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" disabled class="btn btn-primary bg_green color_white main_btn">Chấm công</button>
        </div>
    </div>
</form>