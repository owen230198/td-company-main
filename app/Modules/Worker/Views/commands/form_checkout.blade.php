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
                @include('view_update.view', [
                    'name' => '',
                    'note' => 'SL KCS xác nhận',
                    'min_label' => 185,
                    'attr' => ['disable_field' => 1],
                    'value' => @$print_handle['handled']
                ])
                @include('view_update.view', [
                    'name' => 'not_handled',
                    'note' => 'Chưa hoàn thành',
                    'attr' => ['type_input' => 'number'],
                    'min_label' => 185,
                    'value' => 0
                ])
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" disabled class="btn btn-primary bg_green color_white main_btn">Chấm công</button>
        </div>
    </div>
</form>