@extends('index')
@section('content')
@php
    $singleObject = true;
@endphp
    <div class="dashborad_content position-relative p-3 bg_white product_config_item">
        <form action="{{ $action }}-products{{ $action==\App\Constants\VariableConstant::ACTION_UPDATE?'/'.@$dataItemProduct['id']:'' }}" method="POST" 
        class="actionForm baseAjaxForm" enctype="multipart/form-data" lang="vi">
            @csrf
            @include('orders.products.base_informations', ['sigleObject'=>$singleObject])
            <div class="group_btn_action_form p-1 mt-3">
                <button type="submit" class="station-richmenu-main-btn-area d-none">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>{{ getActionByKey($action) }}
                </button>
                @if ($action == \App\Constants\VariableConstant::ACTION_UPDATE)
                <button type="button" class="station-richmenu-main-btn-area">
                    <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i>In lệnh
                </button>    
                @endif
                <a href="update/orders/{{ @$dataItemProduct['order_id'] }}"
                    class="station-richmenu-main-btn-area">
                    <i class="fa fa-chevron-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
            </div>
        </form>
        <div class="mt-4 pt-4 border_top_thin position-relative">
            <h2 class="station-richmenu-main__ttl text-capitalize mb-3 fs-18">Danh sách lệnh</h2>
            <ul class="nav nav-pills mb-3 tab_product_list" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-design-tab" data-toggle="pill" href="#pills-design" role="tab" aria-controls="pills-design" aria-selected="true">
                        Lệnh thiết kế
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-process-tab" data-toggle="pill" href="#pills-process" role="tab" aria-controls="pills-process" aria-selected="false">
                        Lệnh sản xuất
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-design" role="tabpanel" aria-labelledby="pills-design-tab">
                    <form action="update-commands/c_designs/{{ @$dataItemCDesign['id'] }}" method="POST" class="actionCommandForm baseAjacForm" enctype="multipart/form-data">
                        @include('orders.products.design_commands', 
                        ['singleObject'=>$singleObject, 'dataItem'=>@$dataItemCDesign??[]]);
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-process" role="tabpanel" aria-labelledby="pills-process-tab">
                    @include('orders.products.process_commands', 
                    ['singleObject'=>$singleObject, 'dataItem'=>@$dataItemCProcess??[]])
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }} "></script>
@endsection