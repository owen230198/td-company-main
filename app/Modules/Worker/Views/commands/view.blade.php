@extends('Worker::index')
@section('content')
    <div class="row my-4 pb-3">
        <div class="col-lg-6 border_right_green mb-lg-0 mb-3">
            <div class="bg_eb radius_5 box_shadow_3 h-100 p-lg-3 p-2">
                <h3 class="fs-14 text-uppercase border_bot pb-1 mb-3 text-center handle_title color_green mx-auto">Thông tin đơn</h3>
                @include('Worker::commands.info_item', ['note' => 'Mã đơn', 'value' => @$data_product->code])   
                @include('Worker::commands.info_item', ['note' => 'Tên sản phẩm', 'value' => @$data_product->name])  
                @include('Worker::commands.info_item', ['note' => 'Số lượng sản phẩm', 'value' => @$data_product->qty])  
                @include('Worker::commands.info_item', ['note' => 'Nhóm sản phẩm', 'value' => getFieldDataById('name', 'product_categories', @$data_product->category)]) 
                @include('Worker::commands.info_item', ['note' => 'Kiểu hộp', 'value' => getFieldDataById('name', 'product_styles', @$data_product->product_style)])
                @include('Worker::commands.info_item', ['note' => 'Kích thước hộp', 'value' => getSizeTitleProduct($data_product)])
                @include('Worker::commands.info_item', ['note' => 'Ngày đặt', 'value' => getDateTimeFormat($data_order->created_at)])
                @include('Worker::commands.info_item', ['note' => 'Ngày trả', 'value' => getDateTimeFormat($data_order->return_time)])
                @include('Worker::commands.info_item', ['note' => 'Kinh doanh', 'value' => getFieldDataById('name', 'n_users', @$data_order->created_by)])
                @if (!empty($arr_handle['note']))
                    @include('Worker::commands.info_item', ['note' => 'Ghi chú', 'value' => $arr_handle['note']])
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg_eb radius_5 box_shadow_3 h-100 p-lg-3 p-2">
                <h3 class="fs-14 text-uppercase border_bot pb-1 mb-3 text-center handle_title color_green mx-auto">Thông tin sản xuất</h3>
                @include('Worker::commands.base_command_info')      
        </div>
    </div> 
    @include('Worker::commands.submit_modal', ['form' => 'form_checkout', 'm_name' => 'submit'])
    @include('Worker::commands.submit_modal', ['form' => 'form_feedback', 'm_name' => 'feedback'])
    <div class="group_btn_worker_form d-flex justify-content-center align-items-center">
        <button 
        type="button" data-toggle="modal" data-target="#worker-feedback-modal" class="radius_5 box_shadow_3 btn btn-primary main_button smooth  font_bold text-center bg_green color_white __worker_feedback_btn mr-1" 
        data-id={{ $data_command->id }}>
            <i class="fa fa-quote-right fs-14 mr-1" aria-hidden="true"></i> Phản hồi
        </button>
        @if (workerCommandIsProcessing($data_command))
            <button 
            type="button" data-toggle="modal" data-target="#worker-submit-modal" class="radius_5 box_shadow_3 btn btn-primary main_button smooth  font_bold text-center bg_green color_white __worker_submit_btn mr-1" 
            data-id={{ $data_command->id }}>
                <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Xác nhận lệnh
            </button>
            @include('Worker::commands.submit_modal', ['form' => 'form_checkout', 'm_name' => 'submit'])
        @else
            <button 
            type="button" 
            class="radius_5 box_shadow_3 main_button smooth  font_bold text-center bg_green color_white __worker_receive_btn" data-id={{ $data_command->id }}>
                <i class="fa fa-level-down fs-14 mr-1" aria-hidden="true"></i> Nhận lệnh
            </button>   
        @endif
    </div>      
@endsection