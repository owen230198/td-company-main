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
            Trạng thái : {{ getStatusWorkerCommand($supply) }}.
        </p>
        <p class="d-flex align-items-center color_red mb-2">
            <i class="fa fa-asterisk mr-1 fs-14" aria-hidden="true"></i>
            Chú thích : hoàn thành nhanh nhất.
        </p>
        <div class="command_group_btn d-flex mt-1 pt-1 border_top">
            <a href="{{ url('Worker/action-command/detail?table='.@$supply->table.'&id='.@$supply->id) }}" class="d-block button_command p-1 color_green smooth  font_bold smooth text-center">
                <i class="fa fa-info-circle fs-14 mr-1" aria-hidden="true"></i> Chi tiết
            </a>
            @if (workerCommandIsProcessing($supply))
                <button 
                type="button" data-toggle="modal" data-target=".worker-submit-modal"
                class="d-block btn btn-primary button_command p-1 smooth  font_bold smooth text-center bg_green color_white __worker_submit_btn"
                data-table={{ $supply->table }} data-id={{ $supply->id }}>
                    <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Xác nhận lệnh
                </button>
            @else
                <button 
                type="button" 
                class="d-block button_command p-1 smooth  font_bold smooth text-center bg_green color_white __worker_receive_btn"
                data-table={{ $supply->table }} data-id={{ $supply->id }}>
                    <i class="fa fa-level-down fs-14 mr-1" aria-hidden="true"></i> Nhận lệnh
                </button>   
            @endif
        </div>     
    </div>
</div>