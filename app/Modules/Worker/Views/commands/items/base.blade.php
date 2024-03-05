<div class="item_command overflow_hidden">
    <p class="machine_label color_white bg_red text-uppercase">
        {{ getTextMachineType($key_type, @$command->machine_type) }}
    </p>
    <div class="item_command_content p-2">
        <div class="command_item_info">
            <p class="d-flex align-items-center color_green mb-2">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                Mã lệnh : {{ @$command->command }}.
            </p>  
            <p class="d-flex align-items-center color_green mb-2">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                Tên sản phẩm : {{ getFieldDataById('name', 'products', $supply->product) }}.
            </p>
            @if (!empty(getTextSupply(@$supply->type)))
            <p class="d-flex align-items-center color_green mb-2">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                Loại vật tư : {{ getTextSupply($supply->type) }}.
            </p>  
            @endif
            <p class="d-flex align-items-center color_green mb-2">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                Tên vật tư : {{ $command->name }}.
            </p>
            <p class="d-flex align-items-center color_green mb-2">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                Số lượng : {{ @$command->qty }}.
            </p>
            <p class="d-flex align-items-center color_green mb-2">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                Trạng thái : {{ getStatusWorkerCommand($supply) }}.
            </p>
            <p class="d-flex align-items-center color_red mb-2">
                <i class="fa fa-asterisk mr-1 fs-14" aria-hidden="true"></i>
                Chú thích : hoàn thành nhanh nhất.
            </p>
        </div>
        <div class="command_group_btn d-flex mt-1 pt-1 border_top">
            <a href="{{ url('Worker/action-command/detail?id='.@$command->id) }}" class="d-block button_command p-1 color_green smooth  font_bold smooth text-center">
                <i class="fa fa-info-circle fs-14 mr-1" aria-hidden="true"></i> Chi tiết
            </a>
            <button 
                type="button" class="d-block button_command p-1 smooth  font_bold smooth text-center bg_green color_white __worker_receive_btn" data-id={{ $command->id }}>
                    <i class="fa fa-level-down fs-14 mr-1" aria-hidden="true"></i> Nhận lệnh
            </button>   
        </div>     
    </div>
</div>