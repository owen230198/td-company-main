@extends('Worker::index')
@section('content')
    <div class="row my-4 pb-3">
        <div class="col-lg-6 border_right_green mb-lg-0 mb-3">
            <div class="bg_eb radius_5 box_shadow_3 h-100 p-3 text-center">
                <h3 class="fs-14 text-uppercase border_bot pb-1 mb-3 text-center handle_title color_green mx-auto">Thông tin đơn</h3>   
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Mã đơn : <strong class="color_main ml-1">{{ @$data_product->code }}.</strong>
                </p>  
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Tên sản phẩm : <strong class="color_main ml-1">{{ @$data_product->name }}.</strong>
                </p>  
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Nhóm sản phẩm : <strong class="color_main ml-1">{{ getFieldDataById('name', 'product_categories', $data_product->category) }}.</strong>
                </p>
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Ngày đặt : <strong class="color_main ml-1">{{ date('d/m/Y H:i', strtotime($data_product->created_at)) }}.</strong>
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg_eb radius_5 box_shadow_3 h-100 p-3 text-center">
                <h3 class="fs-14 text-uppercase border_bot pb-1 mb-3 text-center handle_title color_green mx-auto">Thông tin sản xuất</h3>
                @include('Worker::commands.base_command_info')
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Số lượng : <strong class="color_main ml-1">{{ (int) @$data_command->qty }}.</strong>
                </p> 
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Số lượng : <strong class="color_main ml-1">{{ (int) @$data_command->name }}.</strong>
                </p> 
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Loại thiết bị : <strong class="color_main ml-1">{{ getTextMachineType($view_type, @$data_command->machine_type) }}.</strong>
                </p>
                <p class="d-flex align-items-center color_green mb-2">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    Trạng thái : <strong class="color_main ml-1">{{ getStatusWorkerCommand($data_command) }}.</strong>
                </p>
            </div>        
        </div>
    </div> 
    @include('Worker::commands.submit_modal')
    <div class="group_btn_worker_form text-center">
        @if (workerCommandIsProcessing($data_command))
            <button 
            type="button" data-toggle="modal" data-target="#worker-submit-modal" class="radius_5 box_shadow_3 btn btn-primary main_button smooth  font_bold text-center bg_green color_white __worker_submit_btn" 
            data-id={{ $data_command->id }}>
                <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Xác nhận lệnh
            </button>
            @include('Worker::commands.submit_modal')
        @else
            <button 
            type="button" 
            class="radius_5 box_shadow_3 main_button smooth  font_bold text-center bg_green color_white __worker_receive_btn" data-id={{ $data_command->id }}>
                <i class="fa fa-level-down fs-14 mr-1" aria-hidden="true"></i> Nhận lệnh
            </button>   
        @endif
    </div>      
@endsection