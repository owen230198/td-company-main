<div class="item_command overflow_hidden">
    <p class="machine_label color_white bg_red text-uppercase">
        Thiết bị : {{ getTextMachineType($key_type, @$supply->machine_type) }}
        @if (!empty($supply->type))
             - Loại : {{ $supply->type }}    
        @endif
    </p>
    <div class="item_command_content p-2">
        <p class="d-flex align-items-center color_green mb-2">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            Mã lệnh : {{ @$supply->code }}.
        </p>  
        <p class="d-flex align-items-center color_green mb-2">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            Tên sản phẩm : {{ getFieldDataById('name', 'products', $supply->product) }}.
        </p>
        <p class="d-flex align-items-center color_green mb-2">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            Trạng thái : {{ workerCommandIsProcessing($supply) ? 'Đang gia công' : 'Chờ tiếp nhận' }}.
        </p>
        <p class="d-flex align-items-center color_red mb-2">
            <i class="fa fa-asterisk mr-1 fs-14" aria-hidden="true"></i>
            Chú thích : hoàn thành nhanh nhất.
        </p>
        <div class="command_group_btn d-flex mt-1 pt-1 border_top">
            <a href="{{ url('Worker/detail-command/'.@$supply->table.'/'.@$supply->id) }}" class="d-block button_command p-1 color_green smooth  font_bold smooth text-center">
                <i class="fa fa-info-circle fs-14 mr-1" aria-hidden="true"></i> Chi tiết
            </a>
            <button type="button" class="d-block button_command p-1 smooth  font_bold smooth text-center bg_green color_white">
                <i class="fa fa-level-down fs-14 mr-1" aria-hidden="true"></i> Nhận lệnh
            </button>
        </div>     
    </div>
</div>