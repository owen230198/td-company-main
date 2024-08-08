@extends('index')
@section('content')
    <div class=" row">
        <div class="col-lg-6">
            <h3 class="fs-15 text-uppercase my-lg-3 my-2 text-center handle_title color_green mx-auto">
                {{ $title }}
            </h3>
            <p class="fs-12 font-italic color_gray mb-3">
                {{ $notify->description }}.
                <span class="mx-1">Xem chi tiết sản xuất</span>
                <a class="font_bold color_blue" target="_blank" href="{{ url('update/products/'.$data_command->product) }}">tại đây</a>
            </p>
            
            <form action="{{ url('notify-process/'.$notify->id) }}" method="POST" class="baseAjaxForm">
                @include('managers.worker_feedbacks.form_data', ['value' => @$dataItem])
                <div class="form-group d-flex mb-2">
                    <label class="mb-0 min_150 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
                        Ghi chú xác nhận
                    </label>
                    <textarea name="notify['note']" class="form-control"></textarea>
                </div>
                <div class="mt-lg-4 mt-3 text-right">
                    <button type="submit" disabled class="radius_5 box_shadow_3 main_button smooth mr-2 font_bold text-center bg_green color_white">
                        <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Xác nhận
                    </button>  
                    <button type="button" data-id = {{ $notify->id }} class="remove_notify_button radius_5 box_shadow_3 main_button smooth font_bold text-center bg_red color_white">
                        <i class="fa fa-trash fs-14 mr-1" aria-hidden="true"></i> Xóa
                    </button> 
                    <a href="{{ url('/') }}" class="radius_5 box_shadow_3 main_button smooth font_bold text-center bg_red color_white">
                        <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Hủy
                    </a> 
                </div>
            </form>
        </div>
        <div class="col-lg-6 d-lg-flex d-none align-items-center">
            <img src="{{ url('frontend/admin/images/manager.jpg') }}" alt="" class="w-100 mt-lg-4 mt-3">
        </div>
    </div>  
@endsection